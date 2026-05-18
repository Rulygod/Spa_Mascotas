<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Verificación 2FA</title>

<style>

body{
    font-family:'Segoe UI';
    background:linear-gradient(135deg,#2c3e50,#4ca1af);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.box{
    background:white;
    padding:40px;
    width:350px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

input{
    width:100%;
    padding:12px;
    margin-top:15px;
    border-radius:8px;
    border:1px solid #ccc;
}

button{
    width:100%;
    padding:12px;
    margin-top:15px;
    border:none;
    background:#4ca1af;
    color:white;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#3b8d99;
}

.error{
    color:red;
}

.success{
    color:green;
}

</style>
</head>

<body>

<div class="box">

    <h2>🔐 Verificación 2FA</h2>

    <p>
        Se envió un código de 6 dígitos a tu correo
    </p>

    @if(session('error'))
        <p class="error">
            {{ session('error') }}
        </p>
    @endif

    @if(session('success'))
        <p class="success">
            {{ session('success') }}
        </p>
    @endif

    <form method="POST" action="/verificar-2fa">

        @csrf

        <input
            type="text"
            name="codigo"
            placeholder="Código de 6 dígitos"
            required
        >

        <button type="submit">
            Verificar
        </button>

    </form>

    <form method="POST" action="/reenviar-2fa">

        @csrf

        <button type="submit">
            Reenviar código
        </button>

    </form>

</div>

</body>
</html>