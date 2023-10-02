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
    private $askedSymptoms;

    public function index()
    {
        // Initialize an empty list of malfunctions
        $this->filteredMalfunctions = Malfunction::all();
        $this->askedSymptoms = [];

        // Start diagnosing with the most common symptom
        return $this->diagnoseMostCommonSymptom();
    }

    public function diagnose(Request $request)
    {
        $answer = $request->input('answer');
        $symptomId = $request->input('symptom_id');

        // Update asked symptoms list
        $this->askedSymptoms[] = $symptomId;

        // Filter malfunctions based on the user's answer
        if ($answer === 'yes') {
            $this->filterMalfunctionsBySymptom($symptomId);
        } elseif ($answer === 'no') {
            $this->filterMalfunctionsWithoutSymptom($symptomId);
        }

        if ($this->areMoreQuestionsToAsk()) {
            // Continue diagnosing with the most common symptom among remaining malfunctions
            return $this->diagnoseMostCommonSymptom();
        } else {
            // Display the final results with the filtered malfunctions
            return view('results', ['filteredMalfunctions' => $this->filteredMalfunctions]);
        }
    }

    private function diagnoseMostCommonSymptom()
    {
        // Find the symptom that is most common among remaining malfunctions
        $mostCommonSymptom = $this->findMostCommonSymptom();

        if ($mostCommonSymptom) {
            // Ask the user about the most common symptom
            return view('diagnose', ['symptom' => $mostCommonSymptom]);
        } else {
            // No more common symptoms, display results
            return view('results', ['filteredMalfunctions' => $this->filteredMalfunctions]);
        }
    }

    private function findMostCommonSymptom()
    {
        $malfunctionsIds = $this->filteredMalfunctions->pluck('id')->toArray();

        // Get a list of symptoms that are associated with remaining malfunctions
        $commonSymptoms = DiagnosticRule::whereIn('malfunction_id', $malfunctionsIds)
            ->groupBy('symptom_id')
            ->selectRaw('symptom_id, COUNT(*) as count')
            ->orderByDesc('count')
            ->get();

        // Find the most common symptom
        foreach ($commonSymptoms as $commonSymptom) {
            if (!in_array($commonSymptom->symptom_id, $this->askedSymptoms)) {
                return Symptom::find($commonSymptom->symptom_id);
            }
        }

        return null;
    }

    private function filterMalfunctionsBySymptom($symptomId)
    {
        // Filter malfunctions to keep only those with the specified symptom
        $this->filteredMalfunctions = $this->filteredMalfunctions->filter(function ($malfunction) use ($symptomId) {
            return $malfunction->hasSymptom($symptomId);
        });
    }

    private function filterMalfunctionsWithoutSymptom($symptomId)
    {
        // Filter malfunctions to remove those with the specified symptom
        $this->filteredMalfunctions = $this->filteredMalfunctions->filter(function ($malfunction) use ($symptomId) {
            return !$malfunction->hasSymptom($symptomId);
        });
    }

    private function areMoreQuestionsToAsk()
    {
        // Check if there are more common symptoms to ask about
        return $this->findMostCommonSymptom() !== null;
    }
}
