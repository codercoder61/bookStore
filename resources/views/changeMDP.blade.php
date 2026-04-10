<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer mot de passe</title>
    <style>
        .success{
            color:green;
        }
    </style>
    <link rel="icon" href="../css/banner.jpg" />
    <link rel="stylesheet" href="../css/styles2.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script>
        let out = "";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/showAccepte',
            data:{'id':{{Session::get('id_etd')}}},
            success: function (data) {
                const p = Object.values(data);
                for(let i=0;i<p.length;i++){
                    
                    out += "<a href='#'>Votre demande d'emprunter le livre "+p[i][0].NOM+" est accepté !</a>";
                    if(i!=p.length-1){
                        out +="<hr style='background-color:yellow;'/>"
                    }
                }
                
                $('.dropdown-content').html(out)
                
            }
        });
    </script>
</head>
<body>
    <div id="main">
    <nav class="navbar" style="positon:absolute;" id="navbar">
            <a class="acc" href="/user">Accueil</a>
            <!-- <a href="#">Livres</a> -->
            <a href="/profile/{{Session::get('id_etd')}}">Profile</a>
            <div class="dropdown">
                <button  id="notifi" class="dropbtn"><i class="fa-solid fa-bell"></i></button>
                <div id="notif"></div>
                <div class="dropdown-content"></div>
            </div>
            <a href="/es">Logout</a> 

            <form action="/searchUser" method="post">
            @csrf
            <input style="position:absolute;left:80%;width:15%;height:30px;top:35%;" id="myInput" name="content" type="search" placeholder="Search..">
            <input type="submit" value="Search" id="sucb" style="position:absolute;left:95%;height:30px;top:35%;"/>
            </form>
            
            <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>

        </nav>
        <div id="banner">
        </div>
        <div id="livres">
            <aside>
                <a class="acc" href="/user"><p id="cat">Categories</p></a>
                <hr/>
                @foreach($categorie as $cat)
                    <a class='lien' href="/user/{{$cat['id_cat']}}">{{$cat['categorie']}}</a>
                @endforeach
            </aside>
            <form class="gf" action="/changeMDP/{{Session::get('id_etd')}}" method="post">
                @csrf
                <label for="mdp">Saisir nouveau mot de passe :</label><input type="password" name="mdp" id="mdp"/><br/><br/>
                <button type="submit">Valider</button><br/><br/>
                <span style="color:red;">@error('mdp'){{$message}}@enderror</span> 
                <p style="color:green;">
                @if(session()->has('message'))
                    {{session()->get('message')}}
                @endif
            </p> 
            </form>

            
            
        </div>
    </div>
    <script>
            function myFunction() {
                    var x = document.getElementById("navbar");
                    if (x.className === "navbar") {
                        x.className += " responsive";
                    } else {
                        x.className = "navbar";
                    }
            }
        </script>
</body>
</html>