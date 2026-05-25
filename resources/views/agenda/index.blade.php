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
        .back-btn{

    background:#7f8c8d;

    color:white;

    text-decoration:none;

    padding:12px 18px;

    border-radius:8px;

}

.back-btn:hover{

    opacity:.9;

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
        th{

            background:#2193b0;

            color:white;

            text-align:left;

        }

        td{

            vertical-align:middle;

        }

        td:last-child{

            white-space:nowrap;

        }

        .editar,
        .cancelar{

            display:inline-block;

        }
        .cancelar{
        
            background:#e74c3c;

            color:white;

            border:none;

            padding:8px 12px;

            border-radius:6px;

            cursor:pointer;

            margin-left:5px;

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

    <a
    href="/admin"
    class="back-btn"
    >

    ← Dashboard

    </a>

    <h2>

    Citas registradas

    </h2>

    <div>

        <a
        href="/agenda/calendario"
        class="btn"
        >

        Calendario

        </a>

        <a
        href="/agenda/create"
        class="btn"
        >

        Nueva cita

        </a>

    </div>

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
                        {{ $c->mascota->nombre }}
                    </td>

                    <td>
                        {{ $c->servicio->nombre }}
                    </td>

                    <td>
                        {{ $c->fecha }}
                    </td>

                    <td>
                        {{ $c->hora_inicio }}
                    </td>

                    <td>

                        @if($c->estado == 'cancelado')
                            ❌ Cancelado

                        @elseif($c->estado == 'reservado')
                            🟢 Reservado

                        @else
                            {{ $c->estado }}
                        @endif

                    </td>

                    <td>

                        <a href="/agenda/{{ $c->id_cita }}/edit" class="editar">
                            Editar
                        </a>

                        @if($c->estado != 'cancelado')

                        <form method="POST" action="/agenda/cancelar/{{ $c->id_cita }}" style="display:inline">
                            @csrf
                            <button class="cancelar">
                                Cancelar
                            </button>
                        </form>

                        @endif

                    </td>

                </tr>

                @endforeach

            </table>

        </div>

    </div>

</body>

</html>