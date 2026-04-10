<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css"/>
    
    <link rel="icon" href="banner.jpg" />
    <style>
        span{
            color:red;
            margin-left:35px;
        }
    </style>
</head>
<body>
<div id="sinscrire">
        <p>Inscrivez vous</p>
        <form action="add" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="CIN" name="cin" required value="{{old('cin')}}"/>
            <span>@error('cin'){{$message}}@enderror</span>
            <input type="text" placeholder="NOM" name="nom" required value="{{old('nom')}}"/>
            <input type="text" placeholder="PRENOM" name="prenom" required value="{{old('prenom')}}"/>
            <input type="text" placeholder="EMAIL" name="email" required value="{{old('email')}}"/>
            <span>@error('email'){{$message}}@enderror</span>
                <label id="choix-groupe">Choisissez votre groupe :</label>
                <select name="groupe" value="{{old('groupe')}}" required>
                    <option value="dev101">DEV 101</option>
                    <option value="dev102">DEV 102</option>
                    <option value="dev103">DEV 103</option>
                    <option value="dev104">DEV 104</option>
                </select>
            <span>@error('groupe') {{$message}} @enderror</span>
            <label id="charger_photo">Charger photo de profile :</label><input value="{{old('profile')}}" type="file" name="profile" required/>
            <input type="text" placeholder="LOGIN" name="login" required value="{{old('login')}}"/>
            <span>@error('login') {{$message}} @enderror</span>
            <input type="password" placeholder="PASSWORD" name="password" required value="{{old('password')}}"/>
            <span>@error('password') {{$message}} @enderror</span>
            <button type="submit" name="valider">S'inscrire</button>
        </form>
    </div>
</body>
</html>


