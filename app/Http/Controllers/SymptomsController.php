<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symptom;

class SymptomsController extends Controller
{
    function index(){
        $symptoms = Symptom::all();
        return view('symptoms', compact('symptoms'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'symptomName' => 'required|string|max:255',
        ]);

        $symptom = new Symptom();
        $symptom->name = $request->input('symptomName');
        $symptom->save();

        return redirect()->route('symptoms');
    }

    public function edit($id)
    {
        $symptom = Symptom::find($id);
        return view('edit-symptom', compact('symptom'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'symptomName' => 'required|string|max:255',
        ]);

        $symptom = Symptom::find($id);
        $symptom->name = $request->input('symptomName');
        $symptom->save();

        return redirect()->route('symptoms');
    }

    public function destroy($id)
    {
        $symptom = Symptom::find($id);
        $symptom->delete();

        return redirect()->route('symptoms');
    }
}
