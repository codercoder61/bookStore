<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="banner.jpg" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <title>Rechercher livre</title>
    <link rel="stylesheet" href="css/styles5.css"/>
</head>
<body>
<div id="main">
        <nav>
            <a class="acc" href="admin">Accueil</a>
            <!-- <a href="#">Livres</a> -->
            <!-- <a href="#">Profile</a> -->
            <a href="/es">Logout</a> 
        </nav>
        <div id="banner"></div>
        <div id="ajouter">
            <aside>
                <p id="cat">Tableau de bord</p>
                <hr/>
                <a href="admin">Demandes</a>
                <a href="accepte">Emprunt</a>
                <a href="etudiant">Etudiants</a>
                <a class="click">Recherche</a>
                <div>
                    <a href="r_livres">- Livres</a>
                    <a href="r_etudiant">- Etudiants</a>
                </div>
                <a class="click">Livres</a>
                <div>
                    <a href="ajouter">- Ajouter</a>
                    <a href="livres_list">- Liste</a>
                </div>
            </aside>
            <form action="search" method="post">
                @csrf
                <p>Recherche un livre</p><br/>
                <label>Catégorie : </label>
                <select name="categorie">
                <option value="" selected="selected">Choose here</option>
                @foreach($categorie as $cat)
                    <option value="{{$cat['categorie']}}">{{$cat['categorie']}}</option>
                @endforeach
                </select><br/><br/>
                <label>Auteur : </label><input name="auteur" type="text"/><br/>
                <label>Maison d'édition : </label><input name="edition" type="text"/><br/><br/>
                <button type="submit" name="valider3" id="sub">Rechercher</button><br/><br/>  
                <hr style="background-color:white;"/>
            
              <table id="tab">
                    <tr><td>ISBN</td><td>Nom</td><td>Categorie</td><td>Edition</td></tr>
                    @if(!isset($res))
                    @foreach($livre as $key=>$value)
                      <tr><td>{{$value->ISBN_livre}}</td><td>{{$value->NOM}}</td><td>{{$value->categorie}}</td><td>{{$value->EDITION}}</td><td><a href="/deleteLiv/{{$value->id}}"><button type="button">Supprimer</a></button></td><td><a href="/editLivre/{{$value->id}}"><button type="button">Modifier</button></a></td></tr>
                    @endforeach
                    @else

                    
                    @foreach($res as $key=>$value)
                      <tr><td>{{$value->ISBN_livre}}</td><td>{{$value->NOM}}</td><td>{{$value->categorie}}</td><td>{{$value->EDITION}}</td><td><a href="/deleteLiv/{{$value->id}}"><button type="button">Supprimer</a></button></td><td><a href="/editLivre/{{$value->id}}"><button type="button">Modifier</button></a></td></tr>
                    @endforeach


                    @endif
                
                </table>
              </form>
        </div>
        <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="admin">Demandes</a>
                        <a href="accepte">Emprunt</a>
                        <a href="etudiant">Etudiants</a>
                        <a class="click">Recherche</a>
                        <div>
                            <a href="r_livres">- Livres</a>
                            <a href="r_etudiant">- Etudiants</a>
                        </div>
                        <a class="click">Livres</a>
                        <div>
                            <a href="ajouter">- Ajouter</a>
                            <a href="livres_list">- Liste</a>
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