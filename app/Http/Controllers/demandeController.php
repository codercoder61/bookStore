<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie;
use App\Models\Livre;
use App\Models\Etudiant;
use App\Models\demande;
use App\Models\accepte;

class demandeController extends Controller
{
    //
    function demande($id,$id1){
        $liv = Livre::find($id);
        $etd = Etudiant::find($id1);
        $cat = categorie::all();
        if($liv->NBR_COPIES == 0){
            return view("/emprunt",['categorie'=>$cat])->with([
                "msg"=>"Stock de ce livre est epuise"
            ]);
        }
        // return $liv->NBR_COPIES;
        $a = demande::where('id_etudiant',$etd->id)->get();
        $b = accepte::where('id_etudiant',$etd->id)->get();
        if(count($a)+count($b)<2 && $liv->NBR_COPIES>0){
            // return 89;
            $aa = demande::where('id_etudiant',$etd->id)->where('id_livre',$liv->id)->get();
            $bb = demande::where('id_etudiant',$etd->id)->where('id_livre',$liv->id)->get();

            if(count($aa)==0 && count($bb)==0){
                $dem = new demande;
                $dem->id_livre = $liv->id;
                $dem->id_etudiant = $etd->id;
                $dem->save();
                return view("/emprunt",['categorie'=>$cat])->with([
                    "msg"=>"Demande d'emprunt envoyee"
                ]);
            }
            else{
                return view("/emprunt",['categorie'=>$cat])->with([
                    "msg"=>"Vous avez déja demandé d'emprunter ce livre !"
                ]);
            }
        }
        else{
            return view("/emprunt",['categorie'=>$cat])->with([
                "msg"=>"Vous ne pouvez plus emprunter"
            ]);
        }

        // return 2;
    }

    function showDem(){
        $deme = demande::all();
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
        return view('admin',['demande'=>collect($array)]);
    }

    function accepteDemande($id){
        $demande = demande::find($id);
        $accepte = new accepte;
        $accepte->id_livre = $demande->id_livre;
        $accepte->id_etudiant = $demande->id_etudiant;
        // return $demande->id_etudiant;
        $etd = Etudiant::find($demande->id_etudiant);
        $liv = Livre::find($demande->id_livre);
        $liv->NBR_COPIES -= 1;
        $liv->save();
        // return $etd;
        $etd->nbr_empr += 1;
        $etd->save();
        $accepte->save();
        $demande->delete();
        return redirect()->back();
    }

    function suppDemande($id){
        $demande = demande::find($id);
        $demande->delete();
        return redirect()->back();

    }
}

