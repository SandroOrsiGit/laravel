<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Website Contact</h1>
    <p>Er is een nieuwe form inzending.</p>

    <ul>
        <li>Naam:{{ $data['naam'] }}</li>
        <li>E-mailadres:{{ $data['email'] }}</li>
    </ul>
</body>

</html>
