<?php

namespace App\Http\Controllers;
use App\Models\Admission;
use Illuminate\Http\Request;
use Auth;
class AdmissionController extends Controller
{
    public function viewAdmission() {
        $data = Admission::where('gym_id', Auth::user()->id)->get();
        return view('profile.view-admission', compact('data'));
    }
    public function actionAdmission($adm_id, $verb) {
        if (array_search($verb, ['enrolled', 'cancelled']) === false)
            abort(404);

        $admission = Admission::findOrFail($adm_id);
        $admission->status = $verb;
        $admission->save();
        $msg = ["success" => true, "msg"	=> "Admission $verb"];
        return view('message', compact('msg'));
    }
}
