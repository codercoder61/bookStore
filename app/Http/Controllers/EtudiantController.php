<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\categorie;
use App\Models\accepte;
use Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;



class EtudiantController extends Controller
{
    //
    function es(){
        if(Cookie::has('remember_me_admin')){
            Cookie::queue(Cookie::forget('remember_me_admin'));
        }
        if(Cookie::has('remember_me')){
            Cookie::queue(Cookie::forget('remember_me'));
        }
        return redirect('/');
    }
    function delete($id){
        $data = Etudiant::find($id);
        $data->delete();
        return redirect()->back();
    }
    function addEtd(Request $request){
        DB::beginTransaction();
        try {
        $request->validate([
            // 'email'=>'email',
            'cin'=>'unique:etudiants',
            'email'=>'email|unique:etudiants',
            'login'=>'unique:etudiants'
        ]);
        $etudiant = new Etudiant;
        $path = $request->file('profile')->getRealPath();    
        $logo = file_get_contents($path);
        $base64 = base64_encode($logo);
        $etudiant->profile = $base64;
        $etudiant->cin=$request->cin;
        $etudiant->nom=$request->nom;
        $etudiant->prenom=$request->prenom;
        $etudiant->email=$request->email;
        $etudiant->groupe=$request->groupe;
        $etudiant->login=$request->login;
        $etudiant->password=$request->password;
        $etudiant->nbr_empr = 0;
        $etudiant->save();
        DB::commit();
        return redirect('/');
    } 
    catch (\Exception $e) {
        // An error occurred, rollback the transaction
        DB::rollback();
        $msg = "Une erreur est survenue lors de votre essai d'inscription!";
        return redirect('/')->with('message',$msg);
        // Handle the exception or log the error
    }
    }
    function login(Request $req){
        $req->validate([
            'password'=>'required',
            'login'=>'required'
        ]);
        $etudiant =  Etudiant::where('login',$req->input('login'))->get();
        if($req->input('login')=="admin" and $req->input('password')=="admin"){
            if ($req->has('ss_active')) {
                $minutes = 60 * 24; 
                $cookie = Cookie::make('remember_me_admin', 'admin', $minutes);
                return redirect('admin')->withCookie($cookie);
            }
            return redirect('admin');
        }
        if(count($etudiant)>0)
        {
            if($etudiant[0]->password==$req->input('password')){
                $id_etd = $etudiant->first()->id;
                Session::put('id_etd', $id_etd);
                if ($req->has('ss_active')) {
                    $minutes = 60 * 24; 
                    $cookie = Cookie::make('remember_me', $id_etd, $minutes);
                    return redirect('user')->withCookie($cookie);
                }
                return redirect('user');
            }}
            else{
                Cookie::queue(Cookie::forget('remember_me'));
            }
        
        return redirect('/')->with([
            'fail'=>'Login ou mot de passe incorrect'
        ]);
    }
    

    function show(){    
        $etudiant = DB::select('CALL etudiants()');
        // dd($data);
        return view('etudiant')->with('etudiant',$etudiant);
    }

    // function sshow(){
    //     $data = Etudiant::all() ;
    //     return view('pdfetudiant',['etudiant'=>compact($data)]);
    // }

    function showw(){

        $data = Etudiant::all() ;
        return view('r_etudiant',['etudiant'=>$data]);
    }

    function searchEtd(Request $request){
        $res = Etudiant::all();

        if($request->groupe){
            $res = Etudiant::where('groupe','=',$request->groupe)->get();
        }

        if($request->nom){
            $res = Etudiant::where('nom','LIKE','%'.$request->nom.'%')->get();
            // return $res;
        }

        if($request->prenom){
            $res = Etudiant::where('prenom','LIKE','%'.$request->prenom.'%')->get();
        }

        if($request->groupe && $request->nom){
            $res = Etudiant::where('groupe','=',$request->groupe)
            ->where('nom','like','%'.$request->nom.'%')
            ->get();        
        }
        if($request->groupe && $request->prenom){
            $res = Etudiant::where('groupe','=',$request->groupe)
            ->where('prenom','like','%'.$request->prenom.'%')
            ->get();
        }
        if($request->nom && $request->prenom){
            $res = Etudiant::where('prenom','like','%'.$request->prenom.'%')
            ->where('nom','like','%'.$request->nom.'%')
            ->get();
        }
        if($request->nom && $request->prenom && $request->groupe ){
            $res = Etudiant::where('prenom','like','%'.$request->prenom.'%')
            ->where('nom','like','%'.$request->nom.'%')
            ->where('groupe','=',$request->groupe)
            ->get();
        }

        // return $res;
        // $dt = categorie::all();

        return view('r_etudiant',['res'=>$res]);
    }

    
    function showdetailsEtd($id){
        $etd = Etudiant::find($id);
        // return $etd;
        $dt = categorie::all();

        return view('profile',['categorie'=>$dt,'etd'=>$etd]);
    }

    function turn(Request $req){
        $tt = accepte::where('id_etudiant','=',$req->id)->where('status','=',1)->get();
        return count($tt);
    }

    function turnOff(Request $req){
        $tf = accepte::where('id_etudiant','=',$req->id)->get();
        foreach($tf as $t)
        {
            $t->status = 0;
            $t->update();
        }
    }

    function changeMDP(Request $req,$id){
        $req->validate([
            'mdp'=>'required'
        ]);

        $etd = Etudiant::find($id);
        $msg = 'Mot de passe changé avec succes';
        $etd->password = $req->mdp;
        $etd->update();

        return redirect('/changeMDP')->with([
            'message'=> $msg
        ]);
    }
}
