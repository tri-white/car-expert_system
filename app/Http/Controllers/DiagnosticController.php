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
        $this->filteredMalfunctions = Malfunction::all();

        return $this->diagnoseMostCommonSymptom();
    }

    public function diagnose(Request $request)
    {
        $answer = $request->input('answer');
        $symptomId = $request->input('symptom_id');
        $this->filteredMalfunctions = $request->input('malfunctions');
        $this->askedSymptoms = $request->input('askedSymptoms');

        if ($answer === 'yes') {
            $this->filterMalfunctionsBySymptom($symptomId);
        } elseif ($answer === 'no') {
            $this->filterMalfunctionsWithoutSymptom($symptomId);
        }

        if ($this->areMoreQuestionsToAsk()) {
            return $this->diagnoseMostCommonSymptom();
        } else {
            return view('results', ['filteredMalfunctions' => $this->filteredMalfunctions]);
        }
    }

    private function diagnoseMostCommonSymptom()
    {
        $mostCommonSymptom = $this->findMostCommonSymptom();

        if ($mostCommonSymptom) {
            array_push($this->askedSymptoms, $mostCommonSymptom);
            return view('diagnose', ['symptom' => $mostCommonSymptom, 
            'malfunctions'=>$this->filteredMalfunctions, 
            'askedSymptoms'=> $this->askedSymptoms]);
        } else {
            return view('results', ['filteredMalfunctions' => $this->filteredMalfunctions]);
        }
    }

    private function findMostCommonSymptom()
    {
        $malfunctionsIds = $this->filteredMalfunctions->pluck('id')->toArray();

        $commonSymptoms = DiagnosticRule::whereIn('malfunction_id', $malfunctionsIds)
            ->groupBy('symptom_id')
            ->selectRaw('symptom_id, COUNT(*) as count')
            ->orderByDesc('count')
            ->get();

        foreach ($commonSymptoms as $commonSymptom) {
            if (!in_array($commonSymptom->symptom_id, $this->askedSymptoms)) {
                return Symptom::find($commonSymptom->symptom_id);
            }
        }

        return null;
    }

    private function filterMalfunctionsBySymptom($symptomId)
        {
            $toRemove = DiagnosticRule::where('symptom_id', $symptomId)
                ->pluck('malfunction_id')
                ->toArray();

            foreach ($this->filteredMalfunctions as $malfunction) {
                if (!in_array($malfunction, $toRemove)) {
                    unset($this->filteredMalfunctions[$malfunction]);
                }
            }

            // Re-index the array after removing elements
            $this->filteredMalfunctions = array_values($this->filteredMalfunctions);
        }

private function filterMalfunctionsWithoutSymptom($symptomId)
{
    // Create an array of malfunction IDs that never appear in the DiagnosticRule table with $symptomId
    $toRemove = DiagnosticRule::whereNotIn('malfunction_id', function ($query) use ($symptomId) {
        $query->select('malfunction_id')
            ->from('diagnostic_rules')
            ->where('symptom_id', $symptomId);
    })->pluck('malfunction_id')->toArray();

    foreach ($this->filteredMalfunctions as $malfunction) {
        if (in_array($malfunction, $toRemove)) {
            unset($this->filteredMalfunctions[$malfunction]);
        }
    }

    // Re-index the array after removing elements
    $this->filteredMalfunctions = array_values($this->filteredMalfunctions);
}

    private function areMoreQuestionsToAsk()
    {
        return $this->findMostCommonSymptom() !== null;
    }
}
