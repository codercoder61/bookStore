<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="banner.jpg" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste livres</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="stylesheet" href="css/style3.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
    <style>
        #pdfbook{
            color:red;
            margin-left:20px;
        }
        #pdfbook:hover{
            text-decoration:underline;
        }
        th{
            color:white;
            font-weight:bold;
            padding:15px;
        }

        th,td{
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
        aside div a {
    display: block;
}

a + div{
    display: none;
}

/* WebKit */
::-webkit-scrollbar {
  width: 12px;
}

::-webkit-scrollbar-track {
  background: #1e1e2f;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(180deg, #4facfe, #00f2fe);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(180deg, #43e97b, #38f9d7);
}

/* Firefox */
* {
  scrollbar-width: thin;
  scrollbar-color: #4facfe #1e1e2f;
}



@media screen and (max-width:600px){
    #ban > p{
        left:unset !important;
        height:unset !important;
        margin-top:10px;
    }

    #list{
        left:unset !important;
    }
}
    </style>
</head>
<body>
    <div id="preloader"></div>

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
            <div id="ban">
            <label id="lav">Saisissez quelque chose dans le champ de saisie pour rechercher dans le tableau des ISBN,des noms, des categories ou des Editions :</label>
            <input id="myInput" type="text" placeholder="Search..">
                <p style="color:rgb(224,224,103);font-size:50px;position:relative;top:15px;left:15px;background-color:rgb(14, 9, 5);height:60px;border-radius:20px;width:100%;padding-left:30px;">Liste des livres<a id="pdfbook" href="/generatebook">Export to PDF</a></p>
                
                <div id="list" style="width:100%;background-color: rgb(14, 9, 5);position:relative;left:2%;top:7%;max-height:70%;overflow:auto;">
                <table>
                    <tr><th>ISBN</th><th>Nom</th><th>Categorie</th><th>Edition</th></tr>
                    <tbody id="myTable">
                    @foreach($livre as $key=>$value)
                      <tr><td>{{$value->ISBN_livre}}</td><td>{{$value->NOM}}</td><td>{{$value->categorie}}</td><td>{{$value->EDITION}}</td><td><a href="/deleteLiv/{{$value->id}}"><button type="button">Supprimer</a></button></td><td><a href="/editLivre/{{$value->id}}"><button type="button">Modifier</button></a></td></tr>
                    @endforeach
                </tbody>
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
            <span id="gear" style="font-size:30px;cursor:pointer;position:fixed;right:20px;bottom:40px;" onclick="openNav()"><i class="fa fa-cog" aria-hidden="true"></i>
    </span>
          
        </div>
    </div>
    <script>
        var loader = document.getElementById("preloader");
            window.addEventListener('load',function(){
                loader.style.display="none";
            });
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
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
