<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="icon" href="banner.jpg" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/styles2.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>

        #main{
    background-color: rgb(37, 28, 16);
    width:80%;
    margin:auto;
    box-shadow: 0 5px 25px rgba(207, 200, 200, 0.15);
    height:fit-content !important;
    min-height:100vh;
}
        #gallery{
            display:flex;
        }
        #livres{
            display: flex;
        }
        .proff{
            margin-left:5px;
            margin-top:15px;
            margin-right:10px;
            float:left;
            position: relative;
            bottom:20px;
            width:200px;
            height:200px;
        }
        h1{
            margin-top:20px;
            color:rgb(224, 224, 103);
            width:100%;
        }
        ul{
            list-style-type:none;
        }

        ul li{
            color:white;
            font-size:30px;
        }

        ul + p {
            color:white;
        }
        h1 a{
            color:white;
            text-decoration:none;
        }
        h1 a:hover{
            text-decoration:underline;
        }
        h1 a:visited{
            color:white;
        }
        @media screen and (max-width:800px){
            aside{
                display:none;
            }
            #nom{
                width:300px;
                font-size:20px;
                left:0;
            }
            #main{
                width:100%;
            }


        }
        #nom{
            color:rgb(224,224,103);
            font-size:50px;
            position:relative;
            top:15px;
            /* left:15px; */
            background-color:rgb(14, 9, 5);
            /* height:60px; */
            border-radius:20px;
            width:100%;
            padding-left:10px;
            margin-left:20px;
        }

        .proff{
            margin-top:40px;
            margin-left:40px;
        }
        #profile{
            display:flex;
            align-items: center;
        }

        @media screen and (max-width:600px){
            #profile{
                flex-direction:column;
            }
            #nom{
                margin-left:unset;
            }
        }
    </style>
    <script>
    let out = "";
        $(document).ready(function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/test',
            data:{'id':{{Session::get('id_etd')}}},
            success: function (data) {
                if(data>0)
                        {document.getElementById('notif').style.display = 'block';}
                    else
                        document.getElementById('notif').style.display = 'none';
            }
        });

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

        $("#notifi").on("mouseover",function(){
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                    type: 'GET',
                    url: '/rnotif',
                    data:{'id':{{Session::get('id_etd')}}},
                    success: function () {
                        document.getElementById('notif').style.display = 'none';
                    }
            });
        })
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
                <div class="dropdown-content">
            </div>
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
            
            <div>
                    <p id='nom'>{{$etd->prenom}} {{$etd->nom}}</p>
                    <h1 id='titre'><a href='/changeMDP'>Changer mot de passe</a></h1>
                    <h1 style='margin-left:30px;'>Détails de l'étudiant: </h1>
                    <div id='profile'>
                    <img class='proff' src="data:image/jpeg;base64,{{ $etd->profile }}"/>
                    <ul style='margin-top:20px;'>
                    <li>NOM: {{$etd->nom}}</li>
                    <li>PRENOM: {{$etd->prenom}}</li>
                    <li>GROUPE: {{$etd->groupe}}</li>
                    <li>Nombre de livres empruntés: {{$etd->nbr_empr}}</li>
                    <ul><br/>
                    </div>
            </div>
            
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