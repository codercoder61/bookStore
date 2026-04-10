<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Livre;
use Illuminate\Validation\Validator; 
use App\Models\categorie;
use DB;
class LivreController extends Controller
{
    //

    function sshow(){
        $data = DB::table('livres')->join('categories','livres.id_categorie','=','categories.id_cat')->get() ;
        $dt = categorie::all();

        return view('pdflivre',['livre'=>$data,'categorie'=>$dt]);
    }
    function search(Request $request){
        $res = DB::table('livres')
            ->select('*')
            ->join('categories','livres.id_categorie','=','categories.id_cat')->get();

        if(isset($request->categorie)){
            $res = DB::table('livres')
            ->select('*')
            ->join('categories','livres.id_categorie','=','categories.id_cat')
            ->where('categorie','LIKE','%'.$request->categorie.'%')->get();
        }
        if(isset($request->auteur)){
            $res = DB::table('livres')
            ->select('*')
            ->join('categories','livres.id_categorie','=','categories.id_cat')
            ->where('auteur','LIKE','%'.$request->auteur.'%')->get();
        }
        if(isset($request->edition)){
            $res = DB::table('livres')->select('*')->join('categories','livres.id_categorie','=','categories.id_cat')->where('MAISON_EDITION','LIKE','%'.$request->edition.'%')->get();
            // return 11;
        }
        if(isset($request->categorie) && isset($request->edition)){
            $res = DB::table('livres')
            ->select('*')
            ->join('categories','livres.id_categorie','=','categories.id_cat')
            ->where('categorie','LIKE','%'.$request->categorie.'%')
            ->where('MAISON_EDITION','%'.$request->edition.'%')->get();
        }
        if(isset($request->auteur) && isset($request->edition)){
            $res = DB::table('livres')
            ->select('*')
            ->join('categories','livres.id_categorie','=','categories.id_cat')
            ->where('auteur','LIKE','%'.$request->auteur.'%')
            ->where('MAISON_EDITION','%'.$request->edition.'%')->get();
        }
        if(isset($request->categorie) && isset($request->auteur)){
            $res = DB::table('livres')
            ->select('*')
            ->join('categories','livres.id_categorie','=','categories.id_cat')
            ->where('categorie','LIKE','%'.$request->categorie.'%')
            ->where('auteur','LIKE','%'.$request->auteur.'%')->get(); 
        }
        if(isset($request->categorie) && isset($request->edition)){
            $res = DB::table('livres')
            ->select('*')
            ->join('categories','livres.id_categorie','=','categories.id_cat')
            ->where('categorie','LIKE','%'.$request->categorie.'%')
            ->where('MAISON_EDITION','%'.$request->edition.'%')->get();
        }
        if(isset($request->categorie) && isset($request->auteur) && isset($request->edition)){
            $res = DB::table('livres')
            ->select('*')
            ->join('categories','livres.id_categorie','=','categories.id_cat')
            ->where('categorie','LIKE','%'.$request->categorie.'%')
            ->where('AUTEUR','LIKE','%'.$request->auteur.'%')
            ->where('MAISON_EDITION','%'.$request->edition.'%')->get();
        }
        // return $res->get();
        // return redirect()->back();
        $dt = categorie::all();

        return view('r_livres',['res'=>$res,'categorie'=>$dt]);
        // return $res;
    }
    function deleteLiv($id){
        $data = Livre::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function editLivre(Request $request,$id){
        $livre = Livre::find($id);
        $request->validate([
            'ISBN_livre'=>'required',
            'AUTEUR'=>'required',
            'NOM'=>'required',
            'EDITION'=>'required',
            'DESCRIPTION'=>'required',
            'NBR_COPIES'=>'required',
            'MAISON_EDITION'=>'required',
            'categorie'=>'required'
        ]);
    
        $id_cat = DB::select("select id_cat from categories WHERE categorie='$request->categorie'");
        // $livre = new Livre;
        // $path = $request->file('IMAGES')->getRealPath();    
        // $couverture = file_get_contents($path);
        // $base64 = base64_encode($couverture);
        // $livre->IMAGES = $base64;
        $livre->ISBN_livre = $request->ISBN_livre;
        $livre->AUTEUR = $request->AUTEUR;
        $livre->NOM = $request->NOM;
        $livre->EDITION = $request->EDITION;
        $livre->DESCRIPTION = $request->DESCRIPTION;
        $livre->NBR_COPIES = $request->NBR_COPIES;
        $livre->MAISON_EDITION = $request->MAISON_EDITION;
        $livre->id_categorie = $id_cat[0]->id_cat;
        $livre->update();

        return redirect('succes2');
        
    }
    function showdata($id){
        $data = Livre::find($id);
        $dt = categorie::all();
        $cat=DB::table('livres')
        ->select('categories.categorie')
        ->join('categories','livres.id_categorie','=','categories.id_cat')
        ->where(['id' => $id])
        ->get();
        // $data->delete();
        // return redirect()->back();
        return view('editLivre',['data'=>$data,'dt'=>$dt])->with([
            'cat'=>$cat
        ]);
        // return $cat;
    }
    public function addLivre(Request $request){
        $request->validate([
            'ISBN_livre'=>'unique:livres|required',
            'AUTEUR'=>'required',
            'NOM'=>'unique:livres|required',
            'EDITION'=>'required',
            'DESCRIPTION'=>'required',
            'NBR_COPIES'=>'required',
            'IMAGES'=>'required',
            'MAISON_EDITION'=>'required',
            'categorie'=>'required'
        ]);
    
        $id_cat = DB::select("select id_cat from categories WHERE categorie='$request->categorie'");
        $livre = new Livre;
        $path = $request->file('IMAGES')->getRealPath();    
        $couverture = file_get_contents($path);
        $base64 = base64_encode($couverture);
        $livre->IMAGES = $base64;
        $livre->ISBN_livre = $request->ISBN_livre;
        $livre->AUTEUR = $request->AUTEUR;
        $livre->NOM = $request->NOM;
        $livre->EDITION = $request->EDITION;
        $livre->DESCRIPTION = $request->DESCRIPTION;
        $livre->NBR_COPIES = $request->NBR_COPIES;
        $livre->MAISON_EDITION = $request->MAISON_EDITION;
        $livre->id_categorie = $id_cat[0]->id_cat;
        $livre->save();

        return redirect('succes');
        
    }
    function showLivre(){

        $data = DB::table('livres')->join('categories','livres.id_categorie','=','categories.id_cat')->get() ;
        return view('livres_list',['livre'=>$data]);
        // return $data;
    }

    function showwLivre(){
        $dt = categorie::all();
        $data = DB::table('livres')->join('categories','livres.id_categorie','=','categories.id_cat')->get() ;
        return view('r_livres',['livre'=>$data,'categorie'=>$dt]);
    }

    function showLivreUser(){
        $data = DB::table('livres')->join('categories','livres.id_categorie','=','categories.id_cat')->paginate(4);
        $dt = categorie::all();
        return view('user',['livre'=>$data,'categorie'=>$dt]);
        
    }

    function showLivreUser1($id){
        $dt = categorie::all();
        $cat = categorie::find($id);
        // return $cat;
        // $image = DB::select("select livres.IMAGES from livres");
        $data = DB::table('livres')->join('categories','livres.id_categorie','=','categories.id_cat')->where('id_cat','=',$id)->paginate(4);
        // return response($image->image)->header('Content-Type', 'image/jpeg');
        
        return view('user',['livre'=>$data,'categorie'=>$dt]);

        // return $image;
    }

    function searchUser(Request $req){  
        // return $req->data;
        $dt = categorie::all();

        if(isset($req->content))
        {
            $res = Livre::where('ISBN_livre','like','%'.$req->content.'%')
            ->orWhere('AUTEUR','like','%'.$req->content.'%')
            ->orWhere('NOM','like','%'.$req->content.'%')
            ->orWhere('DESCRIPTION','like','%'.$req->content.'%')
            ->orWhere('MAISON_EDITION','like','%'.$req->content.'%')->paginate(4);
            $res->appends($req->all());
            return view('user',['livre'=>$res,'categorie'=>$dt]);
        }
        else{
            return view('user',['categorie'=>$dt])->with([
                'message'=>"Aucun résultat trouvé !"
            ]);
        }

        

        // return $res;


    }

    function showdetails($id){
        $dt = categorie::all();
        $liv = Livre::find($id);
        $cat = categorie::find($liv->id_categorie);
        // return $cat;
        return view('subpage',['categorie'=>$dt,'livre'=>$liv,'catLivre'=>$cat]);
    }

}
