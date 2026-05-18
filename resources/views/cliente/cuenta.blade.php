

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

            <h3>Opciones</h3>

            <div class="option">
                🛒 Ver carrito
            </div>

            <div class="option">
                📅 Mis reservas
            </div>

            <h3>

            🐶 Mis mascotas

            </h3>

            <button onclick="abrirModal()">

            + Agregar mascota

            </button>

            <br><br>

            @foreach($mascotas as $m)

            <div class="option">

            @if($m->foto)

            <img
            src="/storage/{{$m->foto}}"
            width="100"
            height="100"
            style="
            object-fit:cover;
            border-radius:10px;
            "
            />

            @endif

            <h4>

            {{$m->nombre}}

            </h4>

            <p>

            {{$m->especie}}

            {{$m->raza}}

            </p>

            <form
            method="POST"
            action="/mascotas/{{$m->id_mascota}}"
            >

            @csrf

            @method('DELETE')

            <button>

            Eliminar

            </button>

            </form>

            </div>

            @endforeach

            </div>


            <div class="option">
                ⚙ Configuración
            </div>

        </div>

    </div>
    <div
        id="modalMascota"

        style="
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,.6);
        "
        >

        <div

        style="
        background:white;
        width:600px;
        padding:30px;
        margin:50px auto;
        "

        >

        <form

        method="POST"

        action="/mascotas"

        enctype="multipart/form-data"

        >

        @csrf

        <input
        name="nombre"
        placeholder="Nombre"
        required
        >

        <input
        name="especie"
        placeholder="Especie"
        >

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

        <button>

        Guardar

        </button>

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

        </script>
    </body>
</html>