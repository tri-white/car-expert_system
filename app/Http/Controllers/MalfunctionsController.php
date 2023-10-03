<?php

namespace App\Http\Controllers;
use App\Models\Malfunction;
use Illuminate\Http\Request;
use App\Models\Symptom;

class MalfunctionsController extends Controller
{
    public function index()
    {
        $malfunctions = Malfunction::all();
        $symptoms = Symptom::all();

        return view('malfunctions', compact('malfunctions'), compact('symptoms'));
    }

    public function create()
    {
        $symptoms = Symptom::all();
        return view('malfunctions.create', compact('symptoms'));
    }

    public function store(Request $request)
    {
        // Validate the form data

        // Create a new malfunction and save it

        // Attach selected symptoms to the malfunction

        // Redirect back with success message
    }

    public function edit(Malfunction $malfunction)
    {
        $symptoms = Symptom::all();
        return view('malfunctions.edit', compact('malfunction', 'symptoms'));
    }

    public function update(Request $request, Malfunction $malfunction)
    {
        // Validate the form data

        // Update the malfunction and save it

        // Sync selected symptoms to the malfunction

        // Redirect back with success message
    }

    public function destroy(Malfunction $malfunction)
    {
        // Delete the malfunction

        // Redirect back with success message
    }
}
