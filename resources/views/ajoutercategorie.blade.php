<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter categorie</title>
    <link rel="stylesheet" href="css/styles2.css"/>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="icon" href="banner.jpg" />

    <style>

        a + div {
    display: none;
}
        #livres{
            display: flex;
            justify-content:center;
        }
        button{
            padding: 10px 15px;
            background-color: rgb(224, 224, 103);
            border-radius: 20%;
            font-weight: bold;
            position: relative;
            top:10px;
        }
        span{
            color:rgb(224, 224, 103);
        }
        #banner {
            /* background-image: url("banner.jpg"); */
            width: 100%;
            height: 350px;
            background-size: cover;
            box-shadow: 0 5px 25px rgb(207 200 200 / 15%);
        }
        .success{
            color:green;
        }

        .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    background-color: rgb(14, 9, 5);
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }
  
  .sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: rgb(224, 224, 103);
    display: block;
    transition: 0.3s;
  }
  
  .sidenav a:hover {
    color: #f1f1f1;
  }
  
  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }
  #gear{
    display: none;
  }

  @media screen and (max-width:600px){
    #main{
        width:100%;
    }
    aside{
        display: none;
    }
    .dropup{
        display:inline-block;
    }
    #gear{
        display: block;
    }
    #banner{
        display: none;
    }
    #ajouter{
        margin-top:10px;
    }
}

@media screen and (max-width:600px){
    #livres > form.gf{
        width:90% !important;
        margin:auto;
    }
    #livres{
        width:100% !important;
    }
}
    </style>
</head>
<body>
    <div id="main">
        
        <nav class="navbar" style="positon:absolute;" id="navbar">
            <a class="acc" href="admin">Accueil</a>
            
            <p style="display:inline-block;"><a href="/es" id="log">Logout</a></p> 
        </nav>
        <div id="banner">
            
        </div>
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
        
          <div id="livres" style="width:80%">
            <form class="gf" style="width:80%;" action="ajout" method="post">
                @csrf
                <label for="mdp">Saisir nouvelle catégorie :</label>
                <input type="text" name="categorie" id="categorie" value="{{old('categorie')}}"/>
                <button type="submit">Valider</button><br/><br/>
                <span >@error('categorie'){{$message}}@enderror</span> 
                
               <p class="success">
                @if(session()->has('success'))
                    {{session()->get('success')}}
                @endif
                </p> 
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
    <script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>

 <script>
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


</body>
</html>