<!DOCTYPE html>
<html>
<head>
    <title>Cliente</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #56ab2f, #a8e063);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 350px;
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            color: gray;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            width: 100%;
            background: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>Bienvenido Cliente</h1>

    <p>{{ $usuario->nombres }} {{ $usuario->apellidos }}</p>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</div>

</body>
</html>