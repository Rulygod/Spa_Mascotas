<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Spa Mascotas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
            }

            body {
                background: #f5f7fa;
            }

            /* NAVBAR */
            nav {
                background: white;
                padding: 15px 40px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }

            nav h2 {
                color: #2193b0;
            }

            nav a {
                margin-left: 20px;
                text-decoration: none;
                color: #333;
                font-weight: bold;
            }

            nav a:hover {
                color: #2193b0;
            }
            .nav-right{
                display:flex;
                align-items:center;
                gap:20px;
            }

            .user-menu{
                display:flex;
                align-items:center;
                gap:15px;
            }

            .user-menu form{
                margin:0;
            }

            .user-name{
                color:#2193b0;
                font-weight:bold;
            }

            .logout-btn{
                border:none;
                padding:8px 15px;
                border-radius:8px;
                background:#e74c3c;
                color:white;
                cursor:pointer;
                font-weight:bold;
            }

            .logout-btn:hover{
                background:#c0392b;
            }

            /* HERO */
            .hero {
                height: 90vh;
                background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
                            url('https://images.unsplash.com/photo-1601758003122-53c40e686a19');
                background-size: cover;
                background-position: center;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                color: white;
            }

            .hero h1 {
                font-size: 50px;
            }

            .hero p {
                margin: 20px 0;
                font-size: 20px;
            }

            .btn {
                padding: 12px 25px;
                background: #2193b0;
                color: white;
                border: none;
                text-decoration: none;
                border-radius: 5px;
            }

            .btn:hover {
                background: #176b82;
            }

            /* SERVICIOS */
            .services {
                padding: 60px 40px;
                text-align: center;
            }

            .services h2 {
                margin-bottom: 30px;
            }

            .cards {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }

            .card {
                background: white;
                padding: 20px;
                width: 300px;
                margin: 10px;
                border-radius: 10px;
                box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            }

            .card h3 {
                margin-bottom: 10px;
            }

            /* ABOUT */
            .about {
                background: #2193b0;
                color: white;
                padding: 60px 40px;
                text-align: center;
            }

            /* FOOTER */
            footer {
                background: #333;
                color: white;
                text-align: center;
                padding: 20px;
            }

            .logout-btn{
                border:none;
                padding:8px 15px;
                border-radius:8px;
                background:#e74c3c;
                color:white;
                cursor:pointer;
            }

            .logout-btn:hover{
                background:#c0392b;
            }
        </style>
    </head>
    <body>

    <!-- NAVBAR -->
    <nav>

        <h2>Spa Mascotas</h2>

        <div class="nav-right">

            <a href="#">Inicio</a>
            <a href="#servicios">Servicios</a>
            <a href="#nosotros">Nosotros</a>

            @if(Auth::check())

                <div class="user-menu">

                    <span class="user-name">
                        👤 {{ Auth::user()->nombres }}
                    </span>

                    <a href="/cuenta">
                        Ver cuenta
                    </a>

                    <form method="POST" action="/logout">
                        @csrf

                        <button type="submit" class="logout-btn">
                            Cerrar sesión
                        </button>
                    </form>

                </div>

            @else

                <a href="/login">Iniciar Sesion</a>
                <a href="/registro">Registrarse</a>

            @endif

        </div>

    </nav>

    <!-- HERO -->
    <section class="hero">
        <div>
            <h1>Cuidado y Amor para tu Mascota 🐾</h1>
            <p>Baños, cortes y atención profesional</p>
            <a href="/registro" class="btn">Reserva Ahora</a>
        </div>
    </section>

    <!-- SERVICIOS -->
    <section id="servicios" class="services">
        <h2>Nuestros Servicios</h2>

        <div class="cards">
            <div class="card">
                <h3>Baño y Grooming</h3>
                <p>Limpieza completa para tu mascota</p>
            </div>

            <div class="card">
                <h3>Corte de Pelo</h3>
                <p>Estilos modernos y personalizados</p>
            </div>

            <div class="card">
                <h3>Veterinaria</h3>
                <p>Atención médica especializada</p>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="nosotros" class="about">
        <h2>Sobre Nosotros</h2>
        <p>Somos un spa especializado en el cuidado de mascotas, brindando amor y atención profesional.</p>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>© 2026 Spa Mascotas - Todos los derechos reservados</p>
    </footer>

    </body>
</html>