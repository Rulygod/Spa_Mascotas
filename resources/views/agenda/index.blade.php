<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Agenda
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

        th,
        td{

            padding:14px;

            border-bottom:1px solid #ddd;

        }

        .editar{

            background:#f39c12;

            color:white;

            text-decoration:none;

            padding:8px 12px;

            border-radius:6px;

        }

    </style>

</head>

<body>

    <div class="header">

        <h1>
            Agenda
        </h1>

    </div>

    <div class="container">

        <div class="top-bar">
            <a href="/agenda/calendario" class="btn">Ver calendario</a>
            <h2>
                Citas registradas
            </h2>

            <a
                href="/agenda/create"
                class="btn"
            >

                Nueva cita

            </a>

        </div>

        <div class="card">

            <table>

                <tr>

                    <th>
                        Mascota
                    </th>

                    <th>
                        Servicio
                    </th>

                    <th>
                        Fecha
                    </th>

                    <th>
                        Hora
                    </th>

                    <th>
                        Estado
                    </th>

                    <th>
                        Acciones
                    </th>

                </tr>

                @foreach($citas as $c)

                    <tr>

                        <td>
                            {{ $c->mascota }}
                        </td>

                        <td>
                            {{ $c->servicio }}
                        </td>

                        <td>
                            {{ $c->fecha }}
                        </td>

                        <td>
                            {{ $c->hora_inicio }}
                        </td>

                        <td>
                            {{ $c->estado }}
                        </td>

                        <td>

                            <a
                                href="/agenda/{{ $c->id_cita }}/edit"
                                class="editar"
                            >

                                Editar

                            </a>

                        </td>

                    </tr>

                @endforeach

            </table>

        </div>

    </div>

</body>

</html>