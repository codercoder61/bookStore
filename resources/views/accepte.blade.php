<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <meta charset="UTF-8">
    
    <link rel="icon" href="banner.jpg" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandes acceptés</title>
    <link rel="stylesheet" href="css/styles5.css"/>
    <style>
      h1{
        margin-top:20px;
        margin-left:20px;
        color:rgb(224, 224, 103);
        background-color:rgb(14, 9, 5);
        width:90%;
        padding:10px;
      }
      h1 ~ p{
        color:white;
        margin-left:25px;
        margin-top:20px;
        display:inline-block;
        margin-right:20px;
      }
      #pl{
        width:90%;
      }
      button{
        padding: 10px 15px;
        background-color: rgb(224, 224, 103);
        border-radius: 20%;
        font-weight: bold;
        cursor:pointer;
      }
      .abc{
        margin-left:40px;
        margin-top:10px;
      }
    </style>
</head>
<body>
<div id="main">
<div id="preloader"></div>

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
          <div id="pl">
              <h1>Demandes acceptés</h1>
              @if(isset($demande))
              @foreach ($demande as $item)
                <div style="margin-top: 20px;margin-left: 20px;">
                  <p style="color:#fff;display:inline-block;margin-right:5px;">{{ $item['etd']->prenom }} {{ $item['etd']->nom }} a emprunté le livre {{ $item['liv']->NOM }}</p><a href="supprDemande/{{$item['id_dem']}}"><button>Supprimer</button></a><br/>
                </div>
              @endforeach
              @endif
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

