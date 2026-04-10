<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="banner.jpg" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste livres</title>
    <style>
        th,td{
            border:1px solid black;
            padding:10px;
        }
        table{
            border-collapse:collapse;
        }
    </style>
</head>
<body>
<div id="main">

                <h1>Liste des livres</h1>
                <div id="list">
                <table>
                    <tr><th>ISBN</th><th>Nom</th><th>Categorie</th><th>Edition</th></tr>
                    <tbody>
                    @foreach($data as $key=>$value)
                      <tr><td>{{$value->ISBN_livre}}</td><td>{{$value->NOM}}</td><td>{{$value->categorie}}</td><td>{{$value->EDITION}}</td></tr>
                    @endforeach
                </tbody>
                </table>
                </div>
                </div>
        </div>
        </div>
    </div>
</body>
</html>