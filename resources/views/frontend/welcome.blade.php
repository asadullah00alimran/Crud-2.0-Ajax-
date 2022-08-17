<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <style>
        
        .button{
            margin-top: 20%;
            margin-left: 40%;
        }
        .btn{
            background: black;
            color: white;
            text-decoration: none;
            cursor: pointer;
            padding: 20px 30px;
        }
    </style>
</head>
<body>
    <div class="button">
        <a href="{{ Route('addemployee')}}" class="btn">Manage Employee</a>
    </div>
</body>
</html>