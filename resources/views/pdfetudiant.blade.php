<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="banner.jpg" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste etudiants</title>
    <!-- <link rel="stylesheet" href="css/style3.css"/> -->
    <style>
        td{
            border:1px solid black;
            padding:10px;
        }

        table{
            border-collapse:collapse;
        }
        #main{
            width:60%;

            margin:auto;
        }
    </style>
</head>
<body>
<div id="main">
            <div>
                <h1>Liste des etudiants</h1>
                
                <div id="list">
                <table>
                    <tr><td>CIN</td><td>Nom</td><td>Prenom</td><td>Groupe</td></tr>
                    @foreach($etudiant as $etd)
                      <tr><td>{{$etd['cin']}}</td><td>{{$etd['nom']}}</td><td>{{$etd['prenom']}}</td><td>{{$etd['groupe']}}</td></tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>