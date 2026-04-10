<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .err{
            color:red;
            margin-left:45px;
        }
    </style>
    <link rel="icon" href="banner.jpg" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'une bibliotheque</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
</head>
<body>
    <div id="se_connecter">
        <p id="coo">Connectez vous</p>
        <form action="login" method="post">
            @csrf
            <!-- @method('PUT') -->

            <input type="text" placeholder="Login" name="login" value="{{old('login')}}" />
            <span class="err">@error('login'){{$message}}@enderror</span>
            <!-- <div id="wrapper"> -->
            <input type="password" placeholder="Password" id="password" name="password" value="{{old('password')}}"/>
            <span id="sp"><i class="fa-solid fa-eye" id="eye"></i></span>
            <span class="err">@error('password'){{$message}}@enderror</span>
            <!-- </div> -->
            <button type="submit" name="valider2">🔒Se connecter</button>
            <div style="display:flex;flex-direction:column;">
                <div>
                    <input type="checkbox" name="ss_active" id="active"/>
                    <label for="active">Garder ma session active</label>
                </div>
                
            <div>
               <p class="error">
                @if(session()->has('fail'))
                    {{session()->get('fail')}}
                @endif
                </p>
                <p class="error">
                @if(session()->has('message'))
                    {{session()->get('message')}}
                @endif
                </p>
            <hr/>
            <p id="compte">Vous n'avez pas de compte?</p>
            <a href="/inscription">Créer un compte</a>
            <a href="/forget">Mot de passe oublié</a>
       </form>
    </div>
    <script>
        var state= false;
        function toggle(){
            if(state){
                document.getElementById("password").setAttribute("type","password");
                document.getElementById("eye").style.color="7a797e";
                state = false;
            }else{
                document.getElementById("password").setAttribute("type","text");
                document.getElementById("eye").style.color="5887ef";
                state = true;
            }
        }

        document.getElementById("eye").addEventListener('click',toggle);
    </script>
</body>
</html>