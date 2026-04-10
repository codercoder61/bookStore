<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie;
use App\Models\Livre;
use App\Models\Etudiant;
use App\Models\demande;
use App\Models\accepte;

class accepteController extends Controller
{
    function showDemAcc(){
        $deme = accepte::all();
        // return $deme;
        // return $deme;
        $array = [];
        foreach($deme as $d){
            $etd = Etudiant::find($d->id_etudiant);
            $liv = Livre::find($d->id_livre);
            $id_dem = $d->id;
            $p = compact("etd","liv","id_dem");
            array_push($array,$p);
        }
        // return count($array);
        // return collect($array);
        return view('accepte',['demande'=>collect($array)]);
        // dd($array);
    }
    function supprDemande($id){
        $demande = accepte::find($id);
        $etd = Etudiant::find($demande->id_etudiant);
        $liv = Livre::find($demande->id_livre);
        // $liv->NBR_COPIES +=1;
        $liv->save();
        // return $etd;
        $etd->nbr_empr -= 1;
        $etd->save();
        $demande->delete();
        return redirect()->back();
    }

    function showAccepte(Request $req){

        $a = accepte::where('id_etudiant',$req->id)->get();

        // $output = 0;
        $array = [] ;
        foreach($a as $b){
            $liv = Livre::where('id','=',$b->id_livre)->get();
            // $output .="<a href='#'>Votre demande d'emprunter le livre ".$liv->NOM." est accepté !</a>";
            // $output += $b->id_livre;
            array_push($array,$liv);
        }
        return $array;
        // $liv = Livre::where('id','=',$a->first()->id_livre)->get();
        return view('result')->with($array);
    }
}

