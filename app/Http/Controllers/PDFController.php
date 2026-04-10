<?php

namespace App\Http\Controllers;
use Dompdf\Dompdf;
use App\Models\Etudiant; 
use Illuminate\Http\Request;
use PDF;
use App\Models\Livre; 
use DB;
use App\Models\categorie;

class PDFController extends Controller
{
    //
    public function generatePDF(){

        $etudiant = Etudiant::all();
        // view()->share('etds',$etds);
        $pdf = PDF::loadview('/pdfetudiant',compact('etudiant'));

        return $pdf->download('liste_etudiant.pdf');
        
    }
    public function generatePDFbook(){

        $data = DB::table('livres')->join('categories','livres.id_categorie','=','categories.id_cat')->get() ;
        $dt = categorie::all();
        $pdf = PDF::loadview('/pdflivre',compact('data','dt'));

        return $pdf->download('liste_livre.pdf');
        
    }
}
