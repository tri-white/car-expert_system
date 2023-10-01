<?php

namespace App\Http\Controllers;

use App\Symptom;
use App\Malfunction;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    public function index()
{
    // Get a random symptom from the database
    $randomSymptom = Symptom::inRandomOrder()->first();
    
    // Pass the random symptom data to the view
    return view('diagnose', [
        'randomSymptom' => $randomSymptom->name,
        'symptomId' => $randomSymptom->id,
    ]);
}

public function diagnose(Request $request)
{
    // Handle form submission and user answers here
    // You can access the selected answer using $request->input('answer')
    // Implement the logic to filter malfunctions based on user answers
    // Redirect to the next question or display results when done
}
}
