<!DOCTYPE html>
<html lang="en">
<head>
    
<link rel="icon" href="banner.jpg" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password reset</title>
    <link rel="stylesheet" href="css/style4.css"/>
</head>
<body>
<div id="sinscrire">
        <p>Mot de passe oublié</p>
        <form action="/forgetPassword" method="POST">
            @csrf
            <label>Veuillez entrer votre adresse e-mail pour vous envoyer un lien pour changer votre mot de passe :</label>
            <input type="text" placeholder="EMAIL" name="email" />
            <span style="color:red;text-align:center;">@error('email'){{$message}}@enderror</span> 
            <button type="submit" name="valider6">Valider</button>
        </form>
    </div>
</body>
</html>