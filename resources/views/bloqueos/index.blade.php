<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>

        Bloqueos

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
            padding:25px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }

        .top-bar{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:20px;

        }

        .btn{

            background:#2193b0;

            color:white;

            text-decoration:none;

            padding:12px 18px;

            border-radius:8px;

        }

        table{

            width:100%;

            border-collapse:collapse;

        }

        th{

            background:#2193b0;

            color:white;

            padding:14px;

            text-align:left;

        }

        td{

            padding:14px;

            border-bottom:1px solid #ddd;

        }

    </style>

</head>

<body>

<div class="header">

    <h1>

        Bloqueos del sistema

    </h1>

</div>

<div class="container">

    <div class="top-bar">

        <h2>

            Feriados y bloqueos

        </h2>

        <a

            href="/bloqueos/create"

            class="btn"

        >

            + Nuevo bloqueo

        </a>

    </div>

    <div class="card">

        <table>

            <tr>

                <th>

                    Fecha

                </th>

                <th>

                    Inicio

                </th>

                <th>

                    Fin

                </th>

                <th>

                    Motivo

                </th>

                <th>

                    Tipo

                </th>

                <th>

                    Estado

                </th>

            </tr>

            @foreach($bloqueos as $b)

            <tr>

                <td>

                    {{ $b->fecha }}

                </td>

                <td>

                    {{ $b->hora_inicio }}

                </td>

                <td>

                    {{ $b->hora_fin }}

                </td>

                <td>

                    {{ $b->motivo }}

                </td>

                <td>

                    {{ $b->tipo }}

                </td>

                <td>

                    {{ $b->estado }}

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</div>

</body>

</html>