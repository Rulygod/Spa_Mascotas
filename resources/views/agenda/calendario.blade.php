
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Agenda semanal
    </title>

    <style>

        body{
            margin:0;
            font-family:'Segoe UI';
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

        .calendar{

            display:grid;

            grid-template-columns:
            100px repeat(7,1fr);

            background:white;

            border-radius:15px;

            overflow:hidden;

            box-shadow:
            0 5px 15px rgba(0,0,0,.1);

        }

        .cell{

            border:1px solid #eee;

            min-height:90px;

            padding:10px;

        }

        .hour{

            background:#fafafa;

            font-weight:bold;

        }

        .day-header{

            background:#2193b0;

            color:white;

            text-align:center;

            padding:15px;

        }

        .cita{

            background:#dff4ff;

            border-left:
            5px solid #2193b0;

            padding:8px;

            margin-top:5px;

            border-radius:8px;

            font-size:13px;

        }

        .reservado{
            background:#fff3cd;
        }

        .programado{
            background:#d4edda;
        }

        .cancelado{
            background:#f8d7da;
        }

    </style>

</head>

<body>

    <div class="header">

        <h1>
            Agenda semanal
        </h1>

    </div>

    <div class="container">

        <div class="top-bar">

            <h2>

                Calendario

            </h2>

            <a
                href="/agenda/create"
                class="btn"
            >

                Nueva cita

            </a>

        </div>

        <div class="calendar">

            <div class="day-header">

                Hora

            </div>

            <div class="day-header">Lunes</div>
            <div class="day-header">Martes</div>
            <div class="day-header">Miércoles</div>
            <div class="day-header">Jueves</div>
            <div class="day-header">Viernes</div>
            <div class="day-header">Sábado</div>
            <div class="day-header">Domingo</div>

            @for($h=9;$h<=18;$h++)

                <div class="cell hour">

                    {{ $h }}:00

                </div>

                @for($d=1;$d<=7;$d++)

                    <div

                        class="cell slot"

                        data-dia="{{ $d }}"

                        data-hora="{{ $h }}"

                    >

                        @foreach($citas as $c)

                            @php

                                $dia=
                                date(
                                    'N',
                                    strtotime(
                                        $c->fecha
                                    )
                                );

                                $hora=
                                intval(
                                    substr(
                                        $c->hora_inicio,
                                        0,
                                        2
                                    )
                                );

                            @endphp

                            @if(
                                $dia==$d
                                &&
                                $hora==$h
                            )

                                <div

                                    class="cita {{ $c->estado }}"

                                    draggable="true"

                                    data-id="{{ $c->id_cita }}"

                                >

                                    🐶 {{ $c->mascota }}

                                    <br>

                                    {{ $c->servicio }}

                                    <br>

                                    {{ $c->hora_inicio }}

                                </div>

                            @endif

                        @endforeach

                    </div>

                @endfor

            @endfor

        </div>

    </div>
<script>

let citaActual=null;

document
.querySelectorAll('.cita')

.forEach(c=>{

    c.addEventListener(
        'dragstart',
        ()=>{

            citaActual=
            c.dataset.id;

        }
    );

});

document
.querySelectorAll('.slot')

.forEach(s=>{

    s.addEventListener(
        'dragover',
        e=>{

            e.preventDefault();

        }
    );

    s.addEventListener(
        'drop',

        async ()=>{

            let dia=
            s.dataset.dia;

            let hora=
            s.dataset.hora;

            let response=

            await fetch(

                '/agenda/mover/'+citaActual,

                {

                    method:'POST',

                    headers:{

                        'X-CSRF-TOKEN':
                        '{{ csrf_token() }}',

                        'Content-Type':
                        'application/json'

                    },

                    body:
                    JSON.stringify({

                        dia:dia,

                        hora:hora

                    })

                }

            );

            location.reload();

        }

    );

});

</script>
</body>

</html>