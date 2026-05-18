
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Spa de Mascotas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            background:
            linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
            url('https://images.unsplash.com/photo-1517849845537-4d257902454a?q=80&w=1600&auto=format&fit=crop');
            background-size:cover;
            background-position:center;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        .container{
            width:100%;
            max-width:1100px;
            margin-top:80px;
            display:grid;
            grid-template-columns:1fr 430px;
            background:rgba(255,255,255,0.12);
            backdrop-filter:blur(10px);
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 15px 40px rgba(0,0,0,0.35);
        }

        .left{
            padding:70px;
            color:white;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .logo{
            font-size:42px;
            font-weight:700;
            margin-bottom:20px;
        }

        .logo span{
            color:#6dd5ed;
        }

        .description{
            font-size:17px;
            line-height:1.8;
            opacity:0.95;
            max-width:500px;
        }

        .features{
            margin-top:35px;
        }

        .feature{
            display:flex;
            align-items:center;
            gap:12px;
            margin-bottom:18px;
            font-size:15px;
        }

        .feature-icon{
            width:35px;
            height:35px;
            border-radius:50%;
            background:#6dd5ed;
            display:flex;
            justify-content:center;
            align-items:center;
            color:#1b2a41;
            font-weight:bold;
        }

        .right{
            background:white;
            padding:50px 40px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .login-title{
            font-size:30px;
            font-weight:700;
            color:#1b2a41;
            margin-bottom:8px;
        }

        .login-subtitle{
            color:#666;
            margin-bottom:30px;
            font-size:14px;
        }

        .alert-error{
            background:#ffe5e5;
            color:#c0392b;
            padding:12px;
            border-radius:10px;
            margin-bottom:18px;
            font-size:14px;
        }

        .alert-success{
            background:#e7ffe9;
            color:#1e8449;
            padding:12px;
            border-radius:10px;
            margin-bottom:18px;
            font-size:14px;
        }

        .input-group{
            margin-bottom:20px;
        }

        .input-group label{
            display:block;
            margin-bottom:8px;
            color:#1b2a41;
            font-weight:500;
            font-size:14px;
        }

        .input-group input{
            width:100%;
            padding:14px;
            border-radius:12px;
            border:1px solid #dcdcdc;
            font-size:15px;
            transition:0.3s;
            background:#f8f9fb;
        }

        .input-group input:focus{
            outline:none;
            border-color:#2193b0;
            box-shadow:0 0 0 4px rgba(33,147,176,0.15);
            background:white;
        }

        .btn-login{
            width:100%;
            padding:14px;
            border:none;
            border-radius:12px;
            background:linear-gradient(135deg,#2193b0,#6dd5ed);
            color:white;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
            margin-top:5px;
        }

        .btn-login:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(33,147,176,0.3);
        }

        .divider{
            text-align:center;
            margin:25px 0;
            position:relative;
            color:#999;
            font-size:13px;
        }

        .divider::before,
        .divider::after{
            content:'';
            position:absolute;
            top:50%;
            width:40%;
            height:1px;
            background:#ddd;
        }

        .divider::before{
            left:0;
        }

        .divider::after{
            right:0;
        }

        .google-btn{
            width:100%;
            padding:13px;
            border-radius:12px;
            border:1px solid #ddd;
            background:white;
            cursor:pointer;
            font-weight:500;
            transition:0.3s;
        }

        .google-btn:hover{
            background:#f5f5f5;
        }

        .register-link{
            text-align:center;
            margin-top:25px;
            font-size:14px;
            color:#555;
        }

        .register-link a{
            text-decoration:none;
            color:#2193b0;
            font-weight:600;
        }

        .register-link a:hover{
            text-decoration:underline;
        }

        .navbar{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            padding:18px 60px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            z-index:1000;
            background:rgba(0,0,0,0.25);
            backdrop-filter:blur(10px);
        }

        .nav-logo{
            color:white;
            font-size:28px;
            font-weight:700;
        }

        .nav-logo span{
            color:#6dd5ed;
        }

        .nav-links{
            display:flex;
            gap:30px;
        }

        .nav-links a{
            color:white;
            text-decoration:none;
            font-size:15px;
            font-weight:500;
            transition:0.3s;
        }

        .nav-links a:hover{
            color:#6dd5ed;
        }

        @media(max-width:900px){

            .navbar{
                padding:18px 25px;
            }

            .nav-links{
                display:none;
            }

            .container{
                grid-template-columns:1fr;
            }

            .left{
                display:none;
            }
        }

    </style>
</head>
<body>

<nav class="navbar">

    <div class="nav-logo">
        Spa<span>Pets</span>
    </div>

    <div class="nav-links">
        <a href="/">Inicio</a>
        <a href="/#servicios">Servicios</a>
        <a href="/#nosotros">Nosotros</a>
        <a href="/#contacto">Contacto</a>
    </div>

</nav>

<div class="container">

    <div class="left">

        <div class="logo">
            Spa<span>Pets</span>
        </div>

        <p class="description">
            Plataforma integral para la gestión de reservas, clientes,
            empleados y servicios especializados para mascotas.
        </p>

        <div class="features">

            <div class="feature">
                <div class="feature-icon">✓</div>
                Gestión completa de clientes y mascotas
            </div>

            <div class="feature">
                <div class="feature-icon">✓</div>
                Seguridad avanzada y auditoría de accesos
            </div>

            <div class="feature">
                <div class="feature-icon">✓</div>
                Administración de empleados y turnos
            </div>

            <div class="feature">
                <div class="feature-icon">✓</div>
                Reservas y servicios organizados en tiempo real
            </div>

        </div>

    </div>

    <div class="right">

        <h2 class="login-title">
            Bienvenido
        </h2>

        <p class="login-subtitle">
            Inicia sesión para continuar al sistema
        </p>

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login">

            @csrf

            <div class="input-group">
                <label>Correo electrónico</label>
                <input
                    type="email"
                    name="correo"
                    placeholder="Ingrese su correo"
                    required
                >
            </div>

            <div class="input-group">
                <label>Contraseña</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Ingrese su contraseña"
                    required
                >
            </div>

            <button type="submit" class="btn-login">
                Ingresar al sistema
            </button>

        </form>

        <div class="divider">
            o continuar con
        </div>

        <a href="/auth/google">
            <button class="google-btn">
                Continuar con Google
            </button>
        </a>

        <div class="register-link">
            ¿No tienes una cuenta?
            <a href="/registro">
                Regístrate aquí
            </a>
        </div>

    </div>

</div>

</body>
</html>
