
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Spa de Mascotas</title>

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

        .container{
            width:100%;
            max-width:1200px;
            display:grid;
            grid-template-columns:1fr 520px;
            background:rgba(255,255,255,0.12);
            backdrop-filter:blur(10px);
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 15px 40px rgba(0,0,0,0.35);
            margin-top:90px;
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
            padding:45px 40px;
            overflow-y:auto;
        }

        .register-title{
            font-size:30px;
            font-weight:700;
            color:#1b2a41;
            margin-bottom:8px;
        }

        .register-subtitle{
            color:#666;
            margin-bottom:25px;
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

        .input-group{
            margin-bottom:18px;
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

        .strength-bar{
            height:8px;
            background:#ddd;
            border-radius:5px;
            margin-top:8px;
        }

        .strength{
            height:8px;
            width:0%;
            border-radius:5px;
        }

        #strength-text{
            font-size:13px;
            color:#666;
            margin-top:5px;
            display:block;
        }

        .btn-register{
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
            margin-top:10px;
        }

        .btn-register:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(33,147,176,0.3);
        }

        .login-link{
            text-align:center;
            margin-top:22px;
            font-size:14px;
            color:#555;
        }

        .login-link a{
            text-decoration:none;
            color:#2193b0;
            font-weight:600;
        }

        .login-link a:hover{
            text-decoration:underline;
        }

        @media(max-width:1000px){

            .container{
                grid-template-columns:1fr;
            }

            .left{
                display:none;
            }
        }

        @media(max-width:700px){

            .navbar{
                padding:18px 25px;
            }

            .nav-links{
                display:none;
            }

            .right{
                padding:35px 25px;
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
            Únete a <span>SpaPets</span>
        </div>

        <p class="description">
            Crea tu cuenta y accede a reservas, historial de servicios,
            seguimiento de mascotas y mucho más.
        </p>

        <div class="features">

            <div class="feature">
                <div class="feature-icon">✓</div>
                Registro rápido y seguro
            </div>

            <div class="feature">
                <div class="feature-icon">✓</div>
                Protección de cuentas y auditoría
            </div>

            <div class="feature">
                <div class="feature-icon">✓</div>
                Acceso a reservas y servicios premium
            </div>

            <div class="feature">
                <div class="feature-icon">✓</div>
                Plataforma moderna y fácil de usar
            </div>

        </div>

    </div>

    <div class="right">

        <h2 class="register-title">
            Crear cuenta
        </h2>

        <p class="register-subtitle">
            Completa tus datos para registrarte
        </p>

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/registro">

            @csrf

            <div class="input-group">
                <label>Nombres</label>
                <input type="text" name="nombres" required>
            </div>

            <div class="input-group">
                <label>Apellidos</label>
                <input type="text" name="apellidos" required>
            </div>

            <div class="input-group">
                <label>Correo electrónico</label>
                <input type="email" name="correo" required>
            </div>

            <div class="input-group">
                <label>Teléfono</label>
                <input type="text" name="telefono" required>
            </div>

            <div class="input-group">
                <label>Dirección</label>
                <input type="text" name="direccion" required>
            </div>

            <div class="input-group">
                <label>Contraseña</label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                >

                <div class="strength-bar">
                    <div id="strength" class="strength"></div>
                </div>

                <small id="strength-text"></small>
            </div>

            <div class="input-group">
                <label>Confirmar contraseña</label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                >
            </div>

            <button type="submit" class="btn-register">
                Crear cuenta
            </button>

        </form>

        <div class="login-link">
            ¿Ya tienes una cuenta?
            <a href="/login">
                Inicia sesión
            </a>
        </div>

    </div>

</div>

<script>

const passwordInput = document.getElementById('password');
const strengthBar = document.getElementById('strength');
const strengthText = document.getElementById('strength-text');

passwordInput.addEventListener('input', function(){

    const value = passwordInput.value;

    let strength = 0;

    if(value.length >= 8) strength++;
    if(/[a-z]/.test(value)) strength++;
    if(/[A-Z]/.test(value)) strength++;
    if(/[0-9]/.test(value)) strength++;
    if(/[@$!%*#?&]/.test(value)) strength++;

    switch(strength){

        case 1:
            strengthBar.style.width = '20%';
            strengthBar.style.background = 'red';
            strengthText.textContent = 'Muy débil';
            break;

        case 2:
            strengthBar.style.width = '40%';
            strengthBar.style.background = 'orange';
            strengthText.textContent = 'Débil';
            break;

        case 3:
            strengthBar.style.width = '60%';
            strengthBar.style.background = 'yellow';
            strengthText.textContent = 'Aceptable';
            break;

        case 4:
            strengthBar.style.width = '80%';
            strengthBar.style.background = 'lightgreen';
            strengthText.textContent = 'Fuerte';
            break;

        case 5:
            strengthBar.style.width = '100%';
            strengthBar.style.background = 'green';
            strengthText.textContent = 'Muy fuerte';
            break;

        default:
            strengthBar.style.width = '0%';
            strengthText.textContent = '';
    }

});

</script>

</body>
</html>