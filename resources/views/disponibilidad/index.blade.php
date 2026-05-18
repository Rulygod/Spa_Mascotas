<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title>
        Disponibilidad Groomers
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
            margin-bottom:20px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }

        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .btn{
            text-decoration:none;
            background:#2193b0;
            color:white;
            padding:12px 18px;
            border-radius:8px;
        }

        .btn:hover{
            background:#176b82;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,
        td{
            padding:14px;
            border-bottom:1px solid #ddd;
            text-align:left;
        }

        th{
            background:#f7f9fb;
        }

        .acciones{
            display:flex;
            gap:10px;
        }

        .editar{
            text-decoration:none;
            background:#f39c12;
            color:white;
            padding:8px 12px;
            border-radius:6px;
        }

        .eliminar{
            border:none;
            background:#e74c3c;
            color:white;
            padding:8px 12px;
            border-radius:6px;
            cursor:pointer;
        }

    </style>

</head>

<body>

    <div class="header">

        <h1>
            Disponibilidad Groomers
        </h1>

    </div>

    <div class="container">

        <div class="top-bar">

            <h2>
                Horarios registrados
            </h2>

            <a
                href="/disponibilidad/create"
                class="btn"
            >
                + Nueva disponibilidad
            </a>

        </div>

        <div class="card">

            <table>

                <tr>

                    <th>
                        Empleado
                    </th>

                    <th>
                        Día
                    </th>

                    <th>
                        Inicio
                    </th>

                    <th>
                        Fin
                    </th>

                    <th>
                        Estado
                    </th>

                    <th>
                        Acciones
                    </th>

                </tr>

                @foreach($datos as $d)

                    <tr>

                        <td>
                            {{$d->nombres}}
                            {{$d->apellidos}}
                        </td>

                        <td>
                            {{ $d->dia_semana }}
                        </td>

                        <td>
                            {{ $d->hora_inicio }}
                        </td>

                        <td>
                            {{ $d->hora_fin }}
                        </td>

                        <td>
                            {{ $d->estado }}
                        </td>

                        <td>

                            <div class="acciones">

                                <a
                                    href="/disponibilidad/{{ $d->id_disponibilidad }}/edit"
                                    class="editar"
                                >
                                    Editar
                                </a>

                                <form
                                    method="POST"
                                    action="/disponibilidad/{{ $d->id_disponibilidad }}"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="eliminar"
                                        type="submit"
                                    >
                                        Eliminar
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </table>

        </div>

    </div>

</body>

</html>