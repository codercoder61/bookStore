<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="banner.jpg" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher livre</title>
    <link rel="stylesheet" href="css/styles5.css"/>
    <style>
      label{
        font-size:20px;
      }
      tr:first-child td{
            color:white;
            font-weight:bold;
            padding:15px;
        }

        td{
            color:white;
            padding:15px;
        }
        button{
            padding: 10px 15px;
            background-color: rgb(224, 224, 103);
            border-radius: 20px;
            font-weight: bold;
        }
        a{
            text-decoration:none;
            color:black;
        }
    </style>
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
            <form action="searchEtd" method="post">
              @csrf
                <p>Recherche un etudiant</p><br/>
                <label>Groupe: </label>
                <select name="groupe">
                  <option value="" selected="selected">Choose here</option>
                  <option value="dev101">DEV 101</option>
                  <option value="dev102">DEV 102</option>
                  <option value="dev103">DEV 103</option>
                  <option value="dev104">DEV 104</option>
                </select><br/><br/>
                <label>Nom : </label><input name="nom" type="text"/><br/><br/>
                <label>Prenom : </label><input name="prenom" type="text"/><br/><br/>
                <button type="submit" name="valider3" id="sub">Rechercher</button><br/><br/>  
                <hr style="background-color:white;"/>
              
              <table id="pol">
                    <tr><td>CIN</td><td>Nom</td><td>Prenom</td><td>Groupe</td></tr>
                    @if(!isset($res))
                    @foreach($etudiant as $etd)
                      <tr><td>{{$etd['cin']}}</td><td>{{$etd['nom']}}</td><td>{{$etd['prenom']}}</td><td>{{$etd['groupe']}}</td><td><a href="/delete/{{$etd['id']}}"><button type="button">Supprimer</a></button></td></tr>
                    @endforeach
                    @else

                    @foreach($res as $r)
                      <tr><td>{{$r['cin']}}</td><td>{{$r['nom']}}</td><td>{{$r['prenom']}}</td><td>{{$r['groupe']}}</td><td><a href="/delete/{{$r['id']}}"><button type="button">Supprimer</button></a></td></tr>
                    @endforeach

                    @endif
                </table>
              </form>
        </div>
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