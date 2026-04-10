<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails livre</title>
    
    <link rel="icon" href="../css/banner.jpg" />
    <link rel="stylesheet" href="../css/styles2.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        ul li{
            color: white;
            font-size: 30px;
        }
        #gallery{
            display:flex;
        }
        #livres{
            display: flex;
        }
        .res{
            color:rgb(224, 224, 103);
            font-size:40px;
        }
        #joj{
            color:rgb(224, 224, 103);
            margin-bottom:20px;
            padding-left:15px;
            font-size:20px; 
        }
        #livs{
            /* background-color:red; */
            width:75%;
            margin-left:2%;
            margin-top:2%;
            display:flex;
            flex-wrap:wrap;
        }
        .t{
            /* background-color:green; */
            width:42%;
            margin:0 20px 20px 20px;
            height:280px;
            border:1px solid white;
            padding: 1px;
            overflow: auto;
        }
        h1{
            /* background-color:rgb(14, 9, 5); */
            color:rgb(224, 224, 103);
            margin-top:20px;
            /* padding-left:15px; */
            font-size:30px;
        }
        .images + p{
            color:white;
        }
        .images{
            float:left;
            padding-left:15px;
            padding-right:15px;
        }
        button{
            padding: 10px 15px;
            background-color: rgb(224, 224, 103);
            border-radius: 20px;
            font-weight: bold;
            cursor:pointer;
        }
        /* .pagination{
            border:2px solid rgb(224, 224, 103);
            padding:15px;
            color:rgb(224, 224, 103);
            text-decoration:none;
            margin-right:4%;
        } */
        #pag{
            position: absolute;
            left:40%;
        }
        @media screen and (max-width: 1000px) {
            #main{
                width:100%;
            }
       
            .t{
                width:100%;
            }
        aside{
            width:50%;
        }
        #pag{
            position: absolute;
            left:15%;
        }
         }
         @media screen and (max-width: 600px) {

         #vid > p{
            left:unset !important;
         }
    .t{
        width:100%;
        height:270px;
        overflow:auto;
    }
    #livs{
        width:95%;
    }
    #main{
        height: fit-content;
        padding-bottom: 20px;
    }
}

            #det{
                margin-top:40px;
                margin-left:10px;
            }

    </style>
    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#livs .t").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
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
                <a class="acc" href="/user"><p id="cat">Categories</p></a>
                <hr/>
                
                @foreach($categorie as $cat)
                    <a class='lien' href="/user/{{$cat['id_cat']}}">{{$cat['categorie']}}</a>
                @endforeach
            </aside>
            <div id='vid'>
                    <p style='width:auto;color:rgb(224,224,103);font-size:40px;position:relative;top:15px;left:15px;background-color:rgb(14, 9, 5);border-radius:20px;padding-left:10px;word-break:break-word'>{{$livre->NOM}}</p>
                    <div id='det'>
                    <img class='images' src="data:image/jpeg;base64,{{ $livre->IMAGES }}">
                    <div id='deta'>
                    <h1 id="livf">Détails du livre: </h1>
                    <ul>
                    <li>By: {{$livre->AUTEUR}}</li>
                    <li>Categorie: {{$catLivre->categorie}}</li>
                    <li>Edition: {{$livre->EDITION}}</li>
                    <li>ISBN: {{$livre->ISBN_livre}}</li>
                    <ul><br/>
                    </div>
                    <p id='desc'>{{$livre->DESCRIPTION}}</p>
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