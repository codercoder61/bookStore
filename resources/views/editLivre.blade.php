<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="banner.jpg" />
    <style>
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <title>Modifier livre</title>
    <link rel="stylesheet" href="../css/styles5.css"/>
    <style>
        span{
            color:red;
        }

        @media screen and (max-width:1250px){
            #ajouter > form > textarea{
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
<div id="main">
        <nav>
            <a class="acc" href="/admin">Accueil</a>
            <a href="/es">Logout</a> 
        </nav>
        <div id="banner"></div>
        <div id="ajouter">
            <aside>
                <p id="cat">Tableau de bord</p>
                <hr/>
                <a href="/admin">Demandes</a>
                <a href="/accepte">Emprunt</a>
                <a href="/etudiant">Etudiants</a>
                <a class="click">Recherche</a>
                <div>
                    <a href="/r_livres">- Livres</a>
                    <a href="/r_etudiant">- Etudiants</a>
                </div>
                <a class="click">Livres</a>
                <div>
                    <a href="/ajouter">- Ajouter</a>
                    <a href="/livres_list">- Liste</a>
                </div>
            </aside>
            
            <form action="/edit/{{$data['id']}}" method="post" enctype="multipart/form-data">
                @csrf
                <p>Modifier livre</p><br/>
                <label>Selectionner Catégorie :</label>
                <select name="categorie" value="">
                @foreach($dt as $p)
                  <option value="{{$p->categorie}}" {{($p->categorie==$cat->first()->categorie)?"selected":""}}>{{$p->categorie}}</option>               
                @endforeach
                </select><br/><br/>
                
                <label>ISBN : </label><input type="text" name="ISBN_livre" value="{{$data['ISBN_livre']}}"/><br/><br/>
                <span>{{$errors->first('ISBN_livre')}}</span><br/><br/>
                <label>AUTEUR : </label><input type="text" name="AUTEUR" value="{{$data['AUTEUR']}}"/><br/><br/>
                <span>{{$errors->first('AUTEUR')}}</span><br/><br/>
                <label>NOM : </label><input type="text" name="NOM" value="{{$data['NOM']}}"/><br/><br/>
                <span>{{$errors->first('NOM')}}</span><br/><br/>
                
                <label>Edition</label><input type="text" name="EDITION" value="{{$data['EDITION']}}"/><br/><br/>
                <span>{{$errors->first('EDITION')}}</span><br/><br/>
                <label id="desc">Description</label><textarea name="DESCRIPTION" rows="5" cols="84" maxlength="170">{{$data['DESCRIPTION']}}</textarea><br/><br/>
                <span>{{$errors->first('DESCRIPTION')}}</span><br/><br/>
                <label>Nombre de copies en stock</label><input name="NBR_COPIES" value="{{$data['NBR_COPIES']}}" type="number"/><br/><br/>
                <span>{{$errors->first('NBR_COPIES')}}</span><br/><br/>
                <label>Maison d'edittion</label><input name="MAISON_EDITION" type="text" value="{{$data['MAISON_EDITION']}}"/><br/><br/>
                <span>{{$errors->first('MAISON_EDITION')}}</span><br/><br/>
                <button type="submit" id="sub">Modifier</button>
            </form>
        </div>
        <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="/admin">Demandes</a>
                        <a href="/accepte">Emprunt</a>
                        <a href="/etudiant">Etudiants</a>
                        <a class="click">Recherche</a>
                        <div>
                            <a href="/r_livres">- Livres</a>
                            <a href="/r_etudiant">- Etudiants</a>
                        </div>
                        <a class="click">Livres</a>
                        <div>
                            <a href="/ajouter">- Ajouter</a>
                            <a href="/livres_list">- Liste</a>
                        </div>
                  </div>
            <span id="gear" style="font-size:30px;cursor:pointer;position:fixed;right:10px;bottom:20px;" onclick="openNav()"><i class="fa fa-cog" aria-hidden="true"></i>
</span>
          
        </div>
    </div>
    <script>
var dropdown = document.getElementsByClassName("click");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</body>
</html>