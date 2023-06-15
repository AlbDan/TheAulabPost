<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Abbiamo ricevuto una richiesta</h1>
    <p>Ruolo richiesto: {{$info['role']}}</p>
    <p>Email del richiedente: {{$info['email']}}</p>
    <p>Messaggio:</p>
    <p>{{$info['msg']}}</p>
</body>
</html>