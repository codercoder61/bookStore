<?php

use App\Http\Controllers\accepteController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\demandeController;
use App\Http\Controllers\EtudiantController;
use App\Http\controllers\forgotPasswordController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\PDFController;
use App\Models\categorie;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

// use App\Models\categorie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/r_livres', function () {
    return view('r_livres');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/forget', function () {
    return view('forget');
});
Route::get('/livres_list', function () {
    return view('livres_list');
});
Route::get('/ajoutercategorie', function () {
    return view('ajoutercategorie');
});

Route::get('/r_etudiant', function () {
    return view('r_etudiant');
});
Route::get('/', function () {
    if (Cookie::has('remember_me_admin')) {
        return redirect('admin');
    }
    if (Cookie::has('remember_me')) {
        return redirect('user');
    }

    return view('connection');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/admin', [demandeController::class, 'showDem']);

Route::get('/etudiant', function () {
    return view('etudiant');
});

Route::get('/accepte', function () {
    return view('accepte');
});
Route::get('/inscription', function () {
    return view('inscription');
});

Route::get('/user', function () {
    return view('user');
});

Route::get('succes', function () {
    return view('succes');
});

Route::post('add', [EtudiantController::class, 'addEtd']);

Route::post('ajoutLivre', [LivreController::class, 'addLivre']);

Route::post('ajout', [CategorieController::class, 'addCate']);

Route::post('login', [EtudiantController::class, 'login']);

Route::get('ajouter', [CategorieController::class, 'show']);

Route::get('etudiant', [EtudiantController::class, 'show']);

Route::get('livres_list', [LivreController::class, 'showLivre']);

Route::get('/es', [EtudiantController::class, 'es']);

Route::post('search', [LivreController::class, 'search']);

Route::post('searchUser', [LivreController::class, 'searchUser']);

Route::get('searchUser', [LivreController::class, 'searchUser']);

Route::post('searchEtd', [EtudiantController::class, 'searchEtd']);

// Route::get('editLivre',[CategorieController::class,'cate']);

Route::get('r_etudiant', [EtudiantController::class, 'showw']);

Route::get('r_livres', [LivreController::class, 'showwLivre']);

Route::get('delete/{id}', [EtudiantController::class, 'delete']);

Route::get('deleteLiv/{id}', [LivreController::class, 'deleteLiv']);

Route::get('editLivre/{id}', [LivreController::class, 'showdata']);

Route::post('edit/{id}', [LivreController::class, 'editLivre']);

Route::get('succes2', function () {
    return view('succes2');
});

// Route::get('editLivre/{id}',[LivreController::class,'cate']);

Route::get('subpage', function () {
    return view('subpage');
});

Route::get('profile', function () {
    return view('profile');
});

Route::get('subpage/{id}', [LivreController::class, 'showdetails']);

Route::get('profile/{id}', [EtudiantController::class, 'showdetailsEtd']);

Route::get('/changeMDP/{id?}', function () {
    $dt = categorie::all();

    return view('changeMDP', ['categorie' => $dt]);
});

Route::post('/changeMDP/{id}', [EtudiantController::class, 'changeMDP']);

Route::get('emprunt', function () {
    return view('emprunt');
});

Route::get('/emprunt/{id}/{id1}', [demandeController::class, 'demande']);

Route::get('accepteDemande/{id}', [demandeController::class, 'accepteDemande']);

Route::get('suppDemande/{id}', [demandeController::class, 'suppDemande']);

Route::get('/accepte', [accepteController::class, 'showDemAcc']);

Route::get('supprDemande/{id}', [accepteController::class, 'supprDemande']);

// Route::get('/user',[LivreController::class,'slider']);

Route::get('user', [LivreController::class, 'showLivreUser']);

Route::get('/showAccepte', [accepteController::class, 'showAccepte']);

Route::get('user/{id}', [LivreController::class, 'showLivreUser1']);

Route::post('forgetPassword', [forgotPasswordController::class, 'forgetPassword']);

Route::post('/reset/{id}', [forgotPasswordController::class, 'reset']);

Route::get('changemdp2/{id}', [forgotPasswordController::class, 'change']);

Route::get('changemdp2', function () {
    return view('changemdp2');
});

Route::get('/test', [EtudiantController::class, 'turn']);

Route::get('/rnotif', [EtudiantController::class, 'turnOff']);

// Route::get('/generatePDF',[PDFController::class,'generatePDF']);

Route::get('/pdfetudiant', [EtudiantController::class, 'sshow']);
Route::get('/pdflivre', [LivreController::class, 'sshow']);

Route::get('/generateetd', [PDFController::class, 'generatePDF']);

Route::get('/generatebook', [PDFController::class, 'generatePDFbook']);
