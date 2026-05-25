<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Panel Administrador</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI';
    background:#f4f6f9;
    display:flex;
}

/* SIDEBAR */
.sidebar{
    width:260px;
    height:100vh;
    background:#2c3e50;
    color:white;
    position:fixed;
    padding:25px;
    overflow:auto;
}

.sidebar h2{
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    text-decoration:none;
    color:white;
    padding:12px;
    margin-top:8px;
    border-radius:10px;
    transition:.3s;
}

.sidebar a:hover{
    background:#34495e;
}

/* MAIN */
.main{
    margin-left:260px;
    width:100%;
    padding:30px;
}

/* CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.card h3{
    color:#7f8c8d;
    margin-bottom:10px;
}

.card p{
    font-size:28px;
    font-weight:bold;
    color:#2c3e50;
}

/* SECTION */
.section{
    background:white;
    margin-top:30px;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.section h2{
    margin-bottom:15px;
    color:#2c3e50;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#2c3e50;
    color:white;
    padding:12px;
    text-align:left;
    font-size:14px;
}

td{
    padding:12px;
    border-bottom:1px solid #ddd;
    font-size:14px;
}

tr:hover{
    background:#f8f9fa;
}

/* BUTTON */
.btn{
    background:#2193b0;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
}

.btn:hover{
    background:#1b7e97;
}

.logout button{
    width:100%;
    padding:12px;
    margin-top:25px;
    border:none;
    background:#e74c3c;
    color:white;
    border-radius:10px;
    cursor:pointer;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h2>🐾 Spa Mascotas</h2>

    <a href="#dashboard">📊 Dashboard</a>
    <a href="/admin/servicios">✂ Servicios</a>
    <a href="/agenda">📅 Agenda</a>
    <a href="/disponibilidad">
        🕒 Disponibilidad Groomers
    </a>
    <a href="/bloqueos">
         Bloqueos
    </a>
    <a href="/agenda/calendario">🗓 Calendario</a>
    <a href="#usuarios">👥 Usuarios</a>
    <a href="/admin/empleados/create">
        ➕ Crear empleado
    </a>
    <a href="#logs">📜 Logs</a>

    <form class="logout" method="POST" action="/logout">
        @csrf
        <button>Cerrar sesión</button>
    </form>

</div>

<!-- MAIN -->
<div class="main">

@if(session('success'))
<div style="background:#d4edda;color:#155724;padding:12px;border-radius:10px;margin-bottom:15px;">
    {{ session('success') }}
</div>
@endif

<!-- CARDS -->
<div class="cards" id="dashboard">

    <div class="card">
        <h3>Total usuarios</h3>
        <p>{{ $totalUsuarios }}</p>
    </div>

    <div class="card">
        <h3>Clientes</h3>
        <p>{{ $totalClientes }}</p>
    </div>

    <div class="card">
        <h3>Empleados</h3>
        <p>{{ $totalEmpleados }}</p>
    </div>

    <div class="card">
        <h3>Logs hoy</h3>
        <p>{{ $logsHoy }}</p>
    </div>

</div>

<!-- SOLICITUDES -->
<div class="section">

    <h2>📩 Solicitudes pendientes</h2>

    <table>

        <tr>
            <th>Mascota</th>
            <th>Cliente</th>
            <th>Servicio</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>

        @foreach($solicitudes as $s)

        <tr>

            <td>{{ $s->mascota->nombre }}</td>
            <td>{{ $s->cliente->usuario->nombres }}
{{ $s->cliente->usuario->apellidos }}</td>
            <td>{{ $s->servicio->nombre }}</td>
            <td>{{ $s->fecha }}</td>
            <td>{{ $s->hora_inicio }}</td>

            <td>
                <span style="background:#f1c40f;padding:5px 10px;border-radius:8px;font-size:12px;">
                    {{ $s->estado }}
                </span>
            </td>

            <td>
                <a href="/agenda/create?solicitud={{ $s->id_solicitud }}">
                    <button>Crear cita</button>
                </a>    
            </td>

        </tr>

        @endforeach

    </table>

</div>

<!-- USUARIOS -->
<div class="section" id="usuarios">

    <h2>Usuarios registrados</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
        </tr>

        @foreach($usuarios as $u)
        <tr>
            <td>{{ $u->id_usuario }}</td>
            <td>{{ $u->nombres }} {{ $u->apellidos }}</td>
            <td>{{ $u->correo }}</td>
            <td>
                @if($u->id_rol==1)
                    Admin
                @elseif($u->id_rol==2)
                    Cliente
                @else
                    Empleado
                @endif
            </td>
        </tr>
        @endforeach

    </table>

</div>

<!-- LOGS -->
<div class="section" id="logs">

    <h2>Logs del sistema</h2>

    <table>

        <tr>
            <th>Usuario</th>
            <th>Acción</th>
            <th>IP</th>
            <th>Fecha</th>
        </tr>

        @foreach($logs as $log)
        <tr>
            <td>{{ $log->user_id }}</td>
            <td>{{ $log->accion }}</td>
            <td>{{ $log->ip }}</td>
            <td>{{ $log->fecha }}</td>
        </tr>
        @endforeach

    </table>

</div>

</div>

</body>
</html>