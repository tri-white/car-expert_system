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

    public function add(Request $request)
{
    $request->validate([
        'malfunctionName' => 'required|string|max:255',
        'malfunctionDescription' => 'nullable|string',
        'symptoms' => 'required|array',
        'symptoms.*' => 'integer|exists:symptoms,id',
    ]);

    $malfunction = new Malfunction();
    $malfunction->name = $request->input('malfunctionName');
    $malfunction->description = $request->input('malfunctionDescription');
    $malfunction->save();

    // Sync symptoms to the malfunction
    $malfunction->symptoms()->sync($request->input('symptoms'));

    return redirect()->route('malfunctions');
}

public function update(Request $request, $id)
{
    $request->validate([
        'malfunctionName' => 'required|string|max:255',
        'malfunctionDescription' => 'nullable|string',
        'symptoms' => 'required|array',
        'symptoms.*' => 'integer|exists:symptoms,id',
    ]);

    $malfunction = Malfunction::find($id);
    $malfunction->name = $request->input('malfunctionName');
    $malfunction->description = $request->input('malfunctionDescription');
    $malfunction->save();

    // Sync symptoms to the malfunction
    $malfunction->symptoms()->sync($request->input('symptoms'));

    return redirect()->route('malfunctions');
}


    public function edit($id)
    {
        $malfunction = Malfunction::find($id);
        $symptoms = Symptom::all();

        return view('edit-malfunction', compact('malfunction', 'symptoms'));
    }



    public function destroy($id)
    {
        $malfunction = Malfunction::find($id);
        $malfunction->delete();

        return redirect()->route('malfunctions');
    }
}
