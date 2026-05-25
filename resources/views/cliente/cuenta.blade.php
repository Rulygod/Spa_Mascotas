

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Mi Cuenta</title>

    <style>

        body{
            font-family:'Segoe UI';
            margin:0;
            background:#f4f6f9;
        }

        .header{
            background:#2193b0;
            color:white;
            padding:20px;
        }
        .modal{

            display:none;

            position:fixed;

            top:0;
            left:0;

            width:100%;
            height:100%;

            background:
            rgba(
            0,0,0,.65
            );

            z-index:999;

            overflow:auto;

            }

            .modal-content{

            background:white;

            width:700px;

            max-width:95%;

            margin:50px auto;

            padding:30px;

            border-radius:20px;

            box-shadow:
            0 10px 30px rgba(
            0,0,0,.2
            );

            animation:
            showModal .25s;

            }

            @keyframes showModal{

            from{

            opacity:0;

            transform:
            translateY(-20px);

            }

            to{

            opacity:1;

            transform:
            translateY(0);

            }

            }

            .modal-header{

            display:flex;

            justify-content:
            space-between;

            align-items:center;

            margin-bottom:20px;

            }

            .close-btn{

            border:none;

            background:#e74c3c;

            color:white;

            width:35px;

            height:35px;

            border-radius:50%;

            cursor:pointer;

            font-size:16px;

            }

            .form-grid{

            display:grid;

            grid-template-columns:
            1fr 1fr;

            gap:15px;

            margin-bottom:15px;

            }

            .pet-form input,
            .pet-form select,
            .pet-form textarea{

            width:100%;

            padding:12px;

            border:
            1px solid #ddd;

            border-radius:10px;

            box-sizing:border-box;

            }

            .pet-form textarea{

            margin-top:10px;

            min-height:80px;

            }

            .modal-actions{

            display:flex;

            justify-content:flex-end;

            gap:10px;

            margin-top:20px;

            }

            .btn-cancel{

            background:#95a5a6;

            color:white;

            border:none;

            padding:12px 20px;

            border-radius:10px;

            cursor:pointer;

            }

            .btn-save{

            background:#2193b0;

            color:white;

            border:none;

            padding:12px 20px;

            border-radius:10px;

            cursor:pointer;

            }

        .container{
            padding:40px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
            margin-bottom:20px;
        }

        .option{
            padding:15px;
            border-radius:10px;
            background:#f8f9fb;
            margin-top:10px;
            cursor:pointer;
            transition:0.3s;
        }

        .option:hover{
            background:#eaf6fa;
        }
        nav{
            background:white;
            padding:15px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }

        nav h2{
            color:#2193b0;
        }

        nav a{
            text-decoration:none;
            color:#333;
            font-weight:bold;
        }

        nav a:hover{
            color:#2193b0;
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
        .btn-add{

            background:#2193b0;
            color:white;
            border:none;
            padding:12px 18px;
            border-radius:10px;
            cursor:pointer;
            font-weight:bold;

            }

            .btn-add:hover{

            background:#1b7e97;

            }

            .mascotas-grid{

            display:grid;

            grid-template-columns:
            repeat(
            auto-fit,
            minmax(
            320px,
            1fr
            )
            );

            gap:20px;

            margin-top:20px;

            }

            .pet-card{

            background:white;

            border-radius:18px;

            overflow:hidden;

            box-shadow:
            0 5px 15px rgba(
            0,0,0,.1
            );

            transition:.3s;

            }

            .pet-card:hover{

            transform:
            translateY(-5px);

            }

            .pet-img{

            height:220px;

            overflow:hidden;

            background:#eef7fa;

            }

            .pet-img img{

            width:100%;

            height:100%;

            object-fit:cover;

            }

            .pet-placeholder{

            height:100%;

            display:flex;

            align-items:center;

            justify-content:center;

            font-size:70px;

            }

            .pet-info{

            padding:20px;

            }

            .pet-info h3{

            margin:0 0 10px;

            color:#2193b0;

            }

            .badge{

            background:#dff4ff;

            padding:5px 12px;

            border-radius:20px;

            font-size:13px;

            font-weight:bold;

            }

            .pet-actions{

            padding:20px;

            display:flex;

            justify-content:space-between;

            align-items:center;

            border-top:
            1px solid #eee;

            }

            .btn-history{

            background:#27ae60;

            color:white;

            border:none;

            padding:10px 15px;

            border-radius:8px;

            cursor:pointer;

            }

            .btn-delete{

            background:#e74c3c;

            color:white;

            border:none;

            padding:10px 15px;

            border-radius:8px;

            cursor:pointer;

            }

        </style>
    </head>
    <body>

    <nav>

        <h2>Spa Mascotas</h2>

        <div class="nav-right">

            <a href="/">Inicio</a>
            <a href="/#servicios">Servicios</a>
            <a href="/#nosotros">Nosotros</a>

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

        </div>

    </nav>

    <div class="container">

        <div class="card">

            <h2>
                {{ Auth::user()->nombres }}
                {{ Auth::user()->apellidos }}
            </h2>

            <p>
                {{ Auth::user()->correo }}
            </p>

            <p>
                {{ Auth::user()->telefono }}
            </p>

        </div>

        <div class="card">
            @if(session('success'))
                <div style="
                    background:#d4edda;
                    color:#155724;
                    padding:12px;
                    border-radius:10px;
                    margin-bottom:20px;
                ">
                    {{ session('success') }}
                </div>
            @endif
            <h3>Opciones</h3>

            <div class="option">
                🛒 Ver carrito
            </div>

            <div class="option" onclick="openSolicitudModal()">
                📅 Solicitar cita
            </div>
            <h3>

                🐶 Mis mascotas

                </h3>

                <button
                onclick="abrirModal()"
                class="btn-add"
                >

                + Agregar mascota

                </button>

                <br><br>

                <div class="mascotas-grid">

                @foreach($mascotas as $m)

                <div class="pet-card">

                    <div class="pet-img">

                        @if($m->foto)

                        <img
                        src="/storage/{{$m->foto}}"
                        >

                        @else

                        <div class="pet-placeholder">

                        🐾

                        </div>

                        @endif

                    </div>

                    <div class="pet-info">

                        <h3>

                        {{$m->nombre}}

                        </h3>

                        <span class="badge">

                        {{$m->especie}}

                        </span>

                        <p>

                        <b>Raza:</b>

                        {{$m->raza}}

                        </p>

                        <p>

                        <b>Temperamento:</b>

                        {{$m->temperamento_general}}

                        </p>

                        <p>

                        <b>Alergias:</b>

                        {{$m->alergias ?? 'Ninguna'}}

                        </p>

                    </div>

                    <div class="pet-actions">

                        <button class="btn-history">

                        📜 Historial

                        </button>

                        <form
                        method="POST"
                        action="/mascotas/{{$m->id_mascota}}"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                            class="btn-delete"
                            >

                            Eliminar

                            </button>

                        </form>

                    </div>

                </div>

                @endforeach

                </div>
                <div class="card">

                    <h3>📅 Mis Solicitudes</h3>

                    <!-- 🟡 PENDIENTES -->
                    <h4>🟡 Pendientes</h4>

                    @foreach($solicitudesPendientes as $s)
                        <div class="option">
                            🐶 Mascota: <b>{{ $s->nombre_mascota }}</b> <br>
                            🛠 Servicio: <b>{{ $s->nombre_servicio }}</b> <br>
                            📅 {{ $s->fecha }} - {{ $s->hora_inicio }} <br>
                            ⏳ Estado: {{ $s->estado }}
                        </div>
                    @endforeach


                    <!-- 🔵 EN PROCESO -->
                    <h4 style="margin-top:20px;">🔵 En proceso</h4>

                    @foreach($solicitudesProceso as $s)
                        <div class="option">
                            🐶 Mascota: <b>{{ $s->nombre_mascota }}</b> <br>
                            🛠 Servicio: <b>{{ $s->nombre_servicio }}</b> <br>
                            📅 {{ $s->fecha }} - {{ $s->hora_inicio }} <br>
                            ⚙ Estado: {{ $s->estado }}
                        </div>
                    @endforeach


                    <!-- 🟢 HISTORIAL -->
                    <h4 style="margin-top:20px;">🟢 Historial</h4>

                    @foreach($historial as $s)
                        <div class="option">
                            🐶 Mascota: <b>{{ $s->nombre_mascota }}</b> <br>
                            🛠 Servicio: <b>{{ $s->nombre_servicio }}</b> <br>
                            📅 {{ $s->fecha }} - {{ $s->hora_inicio }} <br>
                            ✅ Finalizado
                        </div>
                    @endforeach

                </div>

            <div class="option">
                ⚙ Configuración
            </div>

        </div>

    </div>
    <div id="modalSolicitud" class="modal">

        <div class="modal-content">

            <div class="modal-header">

                <h2>📅 Solicitar cita</h2>

                <button class="close-btn" onclick="cerrarModalSolicitud()">
                    ✕
                </button>

            </div>

            <form method="POST" action="/solicitudes" class="pet-form">
                @csrf

                <div class="form-grid">

                    <select name="id_mascota" required>
                        <option value="">Mascota</option>
                        @foreach($mascotas as $m)
                            <option value="{{ $m->id_mascota }}">
                                {{ $m->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <select name="id_servicio" required>
                        <option value="">Servicio</option>
                        @foreach($servicios as $s)
                            <option value="{{ $s->id_servicio }}">
                                {{ $s->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <input type="date" name="fecha" required>

                    <input type="time" name="hora_inicio" required>

                </div>

                <textarea name="nota" placeholder="Observaciones (opcional)"></textarea>

                <div class="modal-actions">

                    <button type="button" class="btn-cancel" onclick="cerrarModalSolicitud()">
                        Cancelar
                    </button>

                    <button class="btn-save">
                        Enviar solicitud
                    </button>

                </div>

            </form>

        </div>

    </div>
    <div
        id="modalMascota"
        class="modal"
        >

        <div class="modal-content">

        <div class="modal-header">

        <h2>

        🐶 Nueva mascota

        </h2>

        <button
        class="close-btn"
        onclick="cerrarModalMascota()"
        >

        ✕

        </button>

        </div>

        <form

        method="POST"
        action="/mascotas"

        enctype="multipart/form-data"

        class="pet-form"

        >

        @csrf

        <div class="form-grid">

        <input
        name="nombre"
        placeholder="Nombre"
        required
        >

        <select name="especie">

        <option>

        Perro

        </option>

        <option>

        Gato

        </option>

        <option>

        Otro

        </option>

        </select>

        <input
        name="raza"
        placeholder="Raza"
        >

        <select
        name="sexo"
        >

        <option>

        Macho

        </option>

        <option>

        Hembra

        </option>

        </select>

        <input
        type="date"
        name="fecha_nacimiento"
        >

        <input
        name="peso"
        placeholder="Peso"
        >

        <input
        name="color"
        placeholder="Color"
        >

        <select
        name="temperamento"
        >

        <option>

        tranquilo

        </option>

        <option>

        nervioso

        </option>

        <option>

        agresivo

        </option>

        <option>

        miedoso

        </option>

        <option>

        jugueton

        </option>

        </select>

        </div>

        <textarea
        name="alergias"
        placeholder="Alergias"
        ></textarea>

        <textarea
        name="cuidados"
        placeholder="Cuidados"
        ></textarea>

        <textarea
        name="observaciones"
        placeholder="Observaciones"
        ></textarea>

        <input
        type="file"
        name="foto"
        >

        <div class="modal-actions">

        <button
        type="button"
        class="btn-cancel"

        onclick="
        cerrarModalMascota()
        "

        >

        Cancelar

        </button>

        <button
        class="btn-save"
        >

        Guardar mascota

        </button>

        </div>

        </form>

        </div>

        </div>

        <script>

        function abrirModal(){

        document
        .getElementById(
        'modalMascota'
        )

        .style.display='block';

        }

        function cerrarModalMascota(){

        document
        .getElementById(
        'modalMascota'
        )

        .style.display='none';

        }

        window.onclick=function(e){

        let modal=

        document.getElementById(
        'modalMascota'
        );

        if(e.target==modal){

        cerrarModalMascota();

        }

        }

        </script>
        <script>
        function openSolicitudModal(){
            document.getElementById('modalSolicitud').style.display = 'block';
        }

        function closeSolicitudModal(){
            document.getElementById('modalSolicitud').style.display = 'none';
        }
        </script>
    </body>
</html>