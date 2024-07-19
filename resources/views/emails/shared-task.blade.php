<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compartir tarea</title>
</head>

<body>

    <h1>Tarea compartida</h1>
    <p><b>Información:</b></p>
    <p><b>Tarea:</b> {{ $task->title }}</p>
    <p><b>Descripción:</b> {{ $task->description }}</p>
    <p><b>Remitida por:</b> {{ $user->name }} {{ $user->email }}</p>

</body>

</html>
