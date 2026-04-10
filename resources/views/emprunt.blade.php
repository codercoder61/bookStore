<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande d'emprunt</title>
    <link rel="stylesheet" href="/css/styles2.css"/>
    
    <link rel="icon" href="/css/banner.jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        #livres{
            display: flex;
        }
        h1{
            margin-top:50px;
            margin-left:20px;
            color:rgb(224, 224, 103);
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
        #gallery{
            display:flex;
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
                <button id="notifi" class="dropbtn"><i class="fa-solid fa-bell"></i></button>
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
                <p id="cat">Categories</p>
                <hr/>
                @foreach($categorie as $cat)
                    <a class='lien' href="/user/{{$cat['id_cat']}}">{{$cat['categorie']}}</a>
                @endforeach
            </aside>
            @if(isset($msg))
                    <h1>{{$msg}}</h1>
            @endif
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