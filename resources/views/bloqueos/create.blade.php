<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>

        Nuevo bloqueo

    </title>

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
            padding:30px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
            max-width:700px;
        }

        input,
        select{

            width:100%;

            padding:12px;

            margin-top:12px;

            margin-bottom:15px;

            border:1px solid #ddd;

            border-radius:8px;

        }

        button{

            padding:12px 20px;

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

        Registrar bloqueo

    </h1>

</div>

<div class="container">

    <div class="card">

        <form

            method="POST"

            action="/bloqueos"

        >

            @csrf

            <label>

                Fecha

            </label>

            <input

                type="date"

                name="fecha"

                required

            >

            <label>

                Hora inicio (opcional)

            </label>

            <input

                type="time"

                name="hora_inicio"

            >

            <label>

                Hora fin (opcional)

            </label>

            <input

                type="time"

                name="hora_fin"

            >

            <label>

                Motivo

            </label>

            <input

                name="motivo"

                placeholder="Feriado"

                required

            >

            <label>

                Tipo

            </label>

            <select

                name="tipo"

            >

                <option value="feriado">

                    Feriado

                </option>

                <option value="mantenimiento">

                    Mantenimiento

                </option>

                <option value="ausencia">

                    Ausencia

                </option>

                <option value="descanso">

                    Descanso

                </option>

            </select>

            <button>

                Guardar bloqueo

            </button>

        </form>

    </div>

</div>

</body>

</html>