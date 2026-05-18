<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Nueva Cita
    </title>

    <style>

        body{
            font-family:'Segoe UI';
            background:#f4f6f9;
            margin:0;
        }

        .header{
            background:#2193b0;
            color:white;
            padding:20px;
        }

        .container{
            padding:30px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }

        input,
        select{

            width:100%;
            padding:12px;
            margin-top:12px;

            border:1px solid #ddd;
            border-radius:8px;

        }

        button{

            margin-top:20px;

            padding:12px;

            background:#2193b0;

            color:white;

            border:none;

            border-radius:8px;

            cursor:pointer;

        }

    </style>

</head>

<body>

    <div class="header">

        <h1>
            Nueva cita
        </h1>

    </div>

    <div class="container">

        <div class="card">
            @if(session('error'))

            <div>

            {{ session('error') }}

            </div>

            @endif
            <form method="POST" action="/agenda">

                @csrf

                <label>
                    Mascota
                </label>

                <select name="id_mascota">

                    @foreach($mascotas as $m)

                        <option value="{{ $m->id_mascota }}">

                            {{ $m->nombre }}

                        </option>

                    @endforeach

                </select>

                <label>
                    Servicio
                </label>

                <select name="id_servicio">

                    @foreach($servicios as $s)

                        <option value="{{ $s->id_servicio }}">

                            {{ $s->nombre }}

                        </option>

                    @endforeach

                </select>

                <label>
                    Groomer
                </label>

               <select name="id_empleado">

                    @foreach($groomers as $g)

                        <option value="{{ $g->id_empleado }}">

                            {{ $g->nombres }}
                            {{ $g->apellidos }}

                        </option>

                    @endforeach

                </select>

                <label>
                    Fecha
                </label>

                <input
                    type="date"
                    name="fecha"
                    required
                >

                <label>
                    Hora inicio
                </label>

                <input
                    type="time"
                    name="hora_inicio"
                    required
                >

                <button>

                    Guardar cita

                </button>

            </form>

        </div>

    </div>

</body>

</html>