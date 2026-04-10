<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="banner.jpg" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="stylesheet" href="../css/styles2.css"/>
    <style>
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
            /* top:10% */
        }
        span{
            color:red;
        }

        
        .success{
            color:green;
        }
        
    </style>
</head>
<body>
    <div id="main">
        <nav class="navbar">
            <a class="acc" href="/">Se conneter</a>
        </nav>
        <div id="banner"></div>
        <div id="livres">
            <form class="gf" action="/reset/{{$id}}" method="post">
                @csrf
                <label for="mdp">Saisir nouveau mot de passe :</label><input type="password" name="mdp" id="mdp"/>
                
                <button type="submit">Valider</button><br/><br/>
                <span>@error('mdp'){{$message}}@enderror</span> 

                <p class="success">
                @if(session()->has('message'))
                    {{session()->get('message')}}
                @endif
                </p> 
            </form>
            
        </div>
    </div>
</body>
</html>