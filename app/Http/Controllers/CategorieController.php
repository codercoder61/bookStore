<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie;
use DB;

class CategorieController extends Controller
{
    function addCate(Request $request){
        $request->validate([
            'categorie'=>'unique:categories|required'
        ]);
        $cate = new categorie;
        $cate->categorie = $request->categorie;
        $cate->save();
        return redirect('/ajoutercategorie')->with([
            'success'=>'Catégorie ajoutée avec succès !'
        ]);
    }


    function show(){
        $data = categorie::all() ;
        return view('ajouter',['categorie'=>$data]);
        // return $data;
    }
}
