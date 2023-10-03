<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Malfunction;
use App\Models\Symptom;
use App\Models\DiagnosticRule;

class DiagnosticController extends Controller
{
    private $filteredMalfunctions;
    private $askedSymptoms=[];

    public function index()
    {
        // Створюємо список всіх несправностей
        $this->filteredMalfunctions = Malfunction::pluck('id')->toArray();
        return $this->diagnoseMostCommonSymptom(); // знаходимо найчастіший симптом, та запитуємо користувача про нього
    }

    public function diagnose(Request $request)
    {
        // Зчитуємо відповідь користувача, та симптом, на який дано відповідь
        $answer = $request->input('answer');
        $symptomId = $request->input('symptom_id');
        $this->filteredMalfunctions = $request->input('malfunctions');
        $this->askedSymptoms = $request->input('askedSymptoms');

        \Log::info($this->filteredMalfunctions);
        if ($answer === 'yes') {
            // Якщо у користувача є симптом - видаляємо всі несправності, у яких цього симптому немає
            $this->filterMalfunctionsBySymptom($symptomId);
        } elseif ($answer === 'no') {
            // Якщо у користувача немає цього симптому - видаляємо всі несправності, у яких цей симптом є
            $this->filterMalfunctionsWithoutSymptom($symptomId);
        }
        \Log::info($this->filteredMalfunctions);
        // Якщо є ще симптоми, про які потрібно запитати користувача, щоб дістати достовірний результат - продовжуємо діалог
        if ($this->areMoreQuestionsToAsk()) {
            $mostCommonSymptom = $this->findMostCommonSymptom();
            array_push($this->askedSymptoms, $mostCommonSymptom->id);
            return view('diagnose', ['symptom' => $mostCommonSymptom, 
            'malfunctions'=>$this->filteredMalfunctions, 
            'askedSymptoms'=> $this->askedSymptoms]);
        } else {
            // Виводимо результат діагностики, якщо більше немає питань до користувача
            return view('results', ['filteredMalfunctions' => $this->filteredMalfunctions]);
        }
    }

    private function diagnoseMostCommonSymptom()
    {
        $mostCommonSymptom = $this->findMostCommonSymptom();

        // Якщо ще є симптоми про які не запитано користувача - запитуємо про них.
        if ($mostCommonSymptom) {
            array_push($this->askedSymptoms, $mostCommonSymptom->id);
            return view('diagnose', ['symptom' => $mostCommonSymptom, 
            'malfunctions'=>$this->filteredMalfunctions, 
            'askedSymptoms'=> $this->askedSymptoms]);
        } else {
             // Виводимо результат діагностики, якщо більше немає питань до користувача
            return view('results', ['filteredMalfunctions' => $this->filteredMalfunctions]);
        }
    }

    private function findMostCommonSymptom()
    {
        $malfunctionsIds = $this->filteredMalfunctions;

        // Отримуємо список симптомів, відсортованих за популярністю. Не зберігаємо симптомів, які не наявні в жодній несправності, яка залишилась в списку можливих несправностей
        $commonSymptoms = DiagnosticRule::whereIn('malfunction_id', $malfunctionsIds)
            ->groupBy('symptom_id')
            ->selectRaw('symptom_id, COUNT(*) as count')
            ->orderByDesc('count')
            ->get();

        // Повертаємо симптом, про який ще не запитано
        foreach ($commonSymptoms as $commonSymptom) {
            if (!in_array($commonSymptom->symptom_id, $this->askedSymptoms)) {
                return Symptom::find($commonSymptom->symptom_id);
            }
        }

        return null;
    }

    private function filterMalfunctionsBySymptom($symptomId)
        {
            // Записуємо всі несправності, в яких є заданий симптом
            $toRemove = DiagnosticRule::where('symptom_id', $symptomId)
                ->pluck('malfunction_id')
                ->toArray();

            // Видаляємо зі списку можливих несправностей, всі несправності в яких не було заданого симптому
            foreach ($this->filteredMalfunctions as $malfunction) {
                if (!in_array($malfunction, $toRemove)) {
                    $key = array_search($malfunction, $this->filteredMalfunctions);

                    if ($key !== false) {
                        unset($this->filteredMalfunctions[$key]);
                    }
                }
            }
            $this->filteredMalfunctions = array_values($this->filteredMalfunctions);
        }

private function filterMalfunctionsWithoutSymptom($symptomId)
{
    // Зберігаємо всі несправності, у яких немає заданого симптому
    $toRemove = DiagnosticRule::whereNotIn('malfunction_id', function ($query) use ($symptomId) {
        $query->select('malfunction_id')
            ->from('diagnostic_rules')
            ->where('symptom_id', $symptomId);
    })->pluck('malfunction_id')->toArray();

    // Видаляємо зі списку можливих несправностей всі несправності, які не мають заданий симптом
    foreach ($this->filteredMalfunctions as $malfunction) {
        if (!in_array($malfunction, $toRemove)) {
            $key = array_search($malfunction, $this->filteredMalfunctions);

            if ($key !== false) {
                unset($this->filteredMalfunctions[$key]);
            }
        }
    }
    $this->filteredMalfunctions = array_values($this->filteredMalfunctions);
}

    private function areMoreQuestionsToAsk()
    {
        // Перевіряємо чи ще залишились симптоми, про які можливо запитати.
        
        return $this->findMostCommonSymptom() !== null;
    }
}
