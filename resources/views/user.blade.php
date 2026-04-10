<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="banner.jpg" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book-store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="../css/styles2.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
            background-color:rgb(14, 9, 5);
            color:rgb(224, 224, 103);
            margin-bottom:20px;
            padding-left:15px;
            font-size:20px;
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
            display: flex;
            justify-content: center;
            padding-bottom: 20px;
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
    .t{
        width:100%;
        height:270px;
        overflow:auto;
    }
    #livs{
        width:95%;
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
    <div id="preloader"></div>
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
            
            <!-- <label style="color:white;position:relative;left:20px;top:10px;">Saisissez quelque chose dans le champ de saisie pour rechercher dans le tableau des ISBN,des noms, des categories ou des Editions :</label> -->
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

            <div id="livs">
                    @if(isset($livre))
                    @if($livre->count()==0)
                    <p class="res">Aucun résultat trouvé</p>
                    @endif
                    @foreach($livre as $key=>$value)
                    <div class='t'>
                        <h1>{{$value->NOM}}({{$value->AUTEUR}})</h1>
                        <img class='images' src="data:image/jpeg;base64,{{ $value->IMAGES }}"/>
                        <p> {{substr($value->DESCRIPTION,0,70)}}...</p><br/>
                        <a href="/emprunt/{{$value->id}}/{{Session::get('id_etd')}}"><button>Emprunter</button><br/><br/></a>
                        <a href='/subpage/{{$value->id}}'><button>Details</button></a>
                        </div>
                    @endforeach
                    @else
                    <p class="res">Aucun résultat trouvé</p>
                    @endif
            </div>            
        </div>
        <div id="pag">
            @if(isset($livre))
               {{$livre->links()}}
               @endif
        </div>
    </div>
                    
       
        <script>
            var loader = document.getElementById("preloader");
            window.addEventListener('load',function(){
                loader.style.display="none";
            });
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