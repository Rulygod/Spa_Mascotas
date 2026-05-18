<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Editar cita
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

        }

        button{

            margin-top:20px;

            padding:12px;

            background:#2193b0;

            color:white;

            border:none;

            border-radius:8px;

        }

    </style>

</head>

<body>

    <div class="header">

        <h1>
            Editar cita
        </h1>

    </div>

    <div class="container">

        <div class="card">

            <form
                method="POST"
                action="/agenda/{{ $cita->id_cita }}"
            >

                @csrf

                @method('PUT')

                <input
                    type="date"
                    name="fecha"
                    value="{{ $cita->fecha }}"
                >

                <input
                    type="time"
                    name="hora_inicio"
                    value="{{ $cita->hora_inicio }}"
                >

                <select name="estado">

                    <option>

                        reservado

                    </option>

                    <option>

                        programado

                    </option>

                    <option>

                        cancelado

                    </option>

                    <option>

                        concluido

                    </option>

                </select>

                <button>

                    Actualizar

                </button>

            </form>

        </div>

    </div>

</body>

</html>