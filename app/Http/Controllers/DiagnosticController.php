<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\Malfunction;
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

        // Start diagnosing with a random symptom
        return $this->diagnoseRandomSymptom();
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
            // Continue diagnosing with the next random symptom
            return $this->diagnoseRandomSymptom();
        } else {
            // Display the final results with the filtered malfunctions
            return view('results', ['filteredMalfunctions' => $this->filteredMalfunctions]);
        }
    }

    private function diagnoseRandomSymptom()
    {
        // Get a new random symptom that hasn't been asked yet
        $randomSymptom = Symptom::whereNotIn('id', $this->askedSymptoms)
            ->inRandomOrder()
            ->first();

        if ($randomSymptom) {
            // Pass the random symptom data to the view
            return view('diagnose', [
                'randomSymptom' => $randomSymptom->name,
                'symptomId' => $randomSymptom->id,
            ]);
        } else {
            // No more symptoms to ask, display the final results
            return view('results', ['filteredMalfunctions' => $this->filteredMalfunctions]);
        }
    }

    private function filterMalfunctionsBySymptom($symptomId)
    {
        $this->filteredMalfunctions = $this->filteredMalfunctions->filter(function ($malfunction) use ($symptomId) {
            return $malfunction->symptoms->contains('id', $symptomId);
        });
    }

    private function filterMalfunctionsWithoutSymptom($symptomId)
    {
        $this->filteredMalfunctions = $this->filteredMalfunctions->filter(function ($malfunction) use ($symptomId) {
            return !$malfunction->symptoms->contains('id', $symptomId);
        });
    }

    private function areMoreQuestionsToAsk()
    {
        // Check if there are more symptoms to ask based on askedSymptoms
        $remainingSymptoms = Symptom::whereNotIn('id', $this->askedSymptoms)->count();
        return $remainingSymptoms > 0;
    }
}
