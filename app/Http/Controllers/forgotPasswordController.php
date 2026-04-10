<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Etudiant;
// use Session;


class forgotPasswordController extends Controller
{
    //
    public function forgetPassword(Request $req){

        $req->validate([
            'email'=>'required|email|exists:etudiants'
        ]);
        
        $to = $req->email;
        $id_etd = Etudiant::where('email','=',$to)->first()->id;
        // return $id_etd;
        // Session::put('id_etd', $id_etd);
        $subject = 'Password reset';
        $content = "Cliquer sur ce lien pour changer votre mot de passe! http://127.0.0.1:8000/changemdp2/$id_etd ";

        Mail::raw($content, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
        return redirect("/");
    }

    function reset(Request $req,$id){
        // return $id;

        $req->validate([
            'mdp'=>'required'
        ]);
        $etd = Etudiant::find($id);
        $msg = 'Mot de passe changé avec succes';
        $etd->password = $req->mdp;
        $etd->update();

        return redirect()->back()->with([
            'message'=> $msg
        ]);
    }

    public function change($id){
        // return $id;
        return view('changemdp2')->with([
            'id'=>$id
        ]);
    }
}

