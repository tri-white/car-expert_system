<?php

namespace App\Http\Controllers;
use App\Models\DiagnosticRule;
use Illuminate\Http\Request;

class ConfigureController extends Controller
{
    function index(){
        return view('configure');
    }
    function symptoms(){
        $symptoms = Symptom::all();
        return view('symptoms', compact('symptoms'));
    }
    function malfunctions(){
        return view('malfunctions');
    }
    public function storeSymptom(Request $request)
    {
        $request->validate([
            'symptomName' => 'required|string|max:255',
        ]);

        $symptom = new Symptom();
        $symptom->name = $request->input('symptomName');
        $symptom->save();

        return redirect()->route('symptoms')->with('success', 'Симптом додано успішно.');
    }

    public function editSymptom($id)
    {
        $symptom = Symptom::find($id);
        return view('edit-symptom', compact('symptom'));
    }

    public function updateSymptom(Request $request, $id)
    {
        $request->validate([
            'symptomName' => 'required|string|max:255',
        ]);

        $symptom = Symptom::find($id);
        $symptom->name = $request->input('symptomName');
        $symptom->save();

        return redirect()->route('symptoms')->with('success', 'Симптом відредаговано успішно.');
    }

    public function destroySymptom($id)
    {
        $symptom = Symptom::find($id);
        $symptom->delete();

        return redirect()->route('symptoms')->with('success', 'Симптом видалено успішно.');
    }

}
