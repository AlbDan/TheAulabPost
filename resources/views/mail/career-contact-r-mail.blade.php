<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Esito richiesta di lavoro</title>
</head>
<body>

    <p>
        Ciao {{$info['user']['name']}}, la tua richiesta di lavoro come {{$info['role']}} è stata {{$info['outcome']}}. <br>
        <br>
        The Aulab Post
    </p>
    
</body>
</html>