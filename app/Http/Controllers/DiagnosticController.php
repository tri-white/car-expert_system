<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Models\Malfunction;
use App\Models\DiagnosticRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosticController extends Controller
{
    public function index()
    {
        // Get a random symptom from the database
        $randomSymptom = Symptom::inRandomOrder()->first();
        \Log::info(json_encode($randomSymptom));
        // Pass the random symptom data to the view
        return view('diagnose', [
            'randomSymptom' => $randomSymptom->name,
            'symptomId' => $randomSymptom->id,
        ]);
    }
    
    public function diagnose(Request $request)
    {
        $answer = $request->input('answer');
        $symptomId = $request->input('symptom_id');
    
        // Initialize an empty list of malfunctions
        $filteredMalfunctions = Malfunction::all();
    
        // Filter malfunctions based on the user's answer
        if ($answer === 'yes') {
            // Remove malfunctions that don't have the selected symptom
            $filteredMalfunctions = $this->filterMalfunctionsBySymptom($filteredMalfunctions, $symptomId);
        } elseif ($answer === 'no') {
            // Remove malfunctions that have the selected symptom
            $filteredMalfunctions = $this->filterMalfunctionsWithoutSymptom($filteredMalfunctions, $symptomId);
        }
    
        // Check if there are more questions to ask
        if ($this->areMoreQuestionsToAsk()) {
            // Get a new random symptom
            $randomSymptom = Symptom::inRandomOrder()->first();
    
            // Pass the random symptom data to the view
            return view('diagnose', [
                'randomSymptom' => $randomSymptom->name,
                'symptomId' => $randomSymptom->id,
            ]);
        } else {
            // Display the final results with the filtered malfunctions
            return view('results', ['filteredMalfunctions' => $filteredMalfunctions]);
        }
    }
    
    private function filterMalfunctionsBySymptom($malfunctions, $symptomId)
    {
        return $malfunctions->filter(function ($malfunction) use ($symptomId) {
            return $malfunction->symptoms->contains('id', $symptomId);
        });
    }
    
    private function filterMalfunctionsWithoutSymptom($malfunctions, $symptomId)
    {
        return $malfunctions->filter(function ($malfunction) use ($symptomId) {
            return !$malfunction->symptoms->contains('id', $symptomId);
        });
    }
    
    private function areMoreQuestionsToAsk()
    {
        
    }
}
