<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="banner.jpg" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste etudiants</title>
    <link rel="stylesheet" href="css/style3.css"/>
    <style>
        #pdf{
            color:red;
        }
        #pdf:hover{
            cursor:pointer;
            text-decoration:underline;
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
            cursor:pointer;
        }
        a{
            text-decoration:none;
            color:black;
        }
        aside div a {
            display: block;
        }

        a + div{
            display: none;
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
            <div>
                <p class="bn">Liste des etudiants <a id="pdf" href="/generateetd">Export to pdf</a> </p>
                
                <div id="list">
                <table>
                    <tr><td>CIN</td><td>Nom</td><td>Prenom</td><td>Groupe</td></tr>
                    @foreach($etudiant as $etd)
                      <!-- <tr><td>{{$etd->cin}}</td> -->
                      <tr><td>{{$etd->cin}}</td><td>{{$etd->nom}}</td><td>{{$etd->prenom}}</td><td>{{$etd->groupe}}</td><td><a href="/delete/{{$etd->id}}"><button type="button">Supprimer</button></a></td></tr>

                      @endforeach
                </table>
                </div>
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