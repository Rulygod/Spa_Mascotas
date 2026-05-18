<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>
Panel Administrador
</title>

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

    grid-template-columns:
    repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

}

.card{

    background:white;

    padding:25px;

    border-radius:15px;

    box-shadow:
    0 5px 15px rgba(0,0,0,.08);

}

.card h3{

    color:#7f8c8d;

    margin-bottom:10px;

}

.card p{

    font-size:30px;

    color:#2c3e50;

    font-weight:bold;

}

.card-link{

    text-decoration:none;

    color:inherit;

}

/* SECCIONES */

.section{

    background:white;

    margin-top:30px;

    padding:25px;

    border-radius:15px;

    box-shadow:
    0 5px 15px rgba(0,0,0,.08);

}

.section h2{

    margin-bottom:20px;

}

table{

    width:100%;

    border-collapse:collapse;

}

th{

    background:#2c3e50;

    color:white;

    padding:12px;

}

td{

    padding:12px;

    border-bottom:1px solid #ddd;

}

tr:hover{

    background:#f8f9fa;

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

.success{

    background:#d4edda;

    color:#155724;

    padding:15px;

    border-radius:10px;

    margin-bottom:20px;

}

</style>

</head>

<body>

<div class="sidebar">

    <h2>
        🐾 Spa Mascotas
    </h2>

    <a href="#dashboard">
        📊 Dashboard
    </a>

    <a href="/admin/empleados">
        👤 Registrar empleado
    </a>

    <a href="/admin/servicios">
        ✂ Servicios
    </a>

    <a href="/disponibilidad">
        🕒 Disponibilidad Groomers
    </a>

    <a href="/agenda">
        📅 Agenda General
    </a>

    <a href="/agenda/calendario">
        🗓 Calendario
    </a>

    <a href="#usuarios">
        👥 Usuarios
    </a>

    <a href="#logs">
        📜 Logs
    </a>

    <form
        class="logout"
        method="POST"
        action="/logout"
    >

        @csrf

        <button>

            Cerrar sesión

        </button>

    </form>

</div>

<div class="main">

@if(session('success'))

<div class="success">

    {{ session('success') }}

</div>

@endif

<!-- ESTADISTICAS -->

<div
class="cards"
id="dashboard"
>

<div class="card">

    <h3>

        Total usuarios

    </h3>

    <p>

        {{ $totalUsuarios }}

    </p>

</div>

<div class="card">

    <h3>

        Clientes

    </h3>

    <p>

        {{ $totalClientes }}

    </p>

</div>

<div class="card">

    <h3>

        Empleados

    </h3>

    <p>

        {{ $totalEmpleados }}

    </p>

</div>

<div class="card">

    <h3>

        Logs hoy

    </h3>

    <p>

        {{ $logsHoy }}

    </p>

</div>

<a
href="/admin/servicios"
class="card-link"
>

<div class="card">

    <h3>

        ✂ Servicios

    </h3>

    <p>

        Gestionar servicios

    </p>

</div>

</a>

<a
href="/disponibilidad"
class="card-link"
>

<div class="card">

    <h3>

        🕒 Disponibilidad

    </h3>

    <p>

        Horarios groomers

    </p>

</div>

</a>

<a
href="/agenda"
class="card-link"
>

<div class="card">

    <h3>

        📅 Agenda

    </h3>

    <p>

        Gestión citas

    </p>

</div>

</a>

<a
href="/agenda/calendario"
class="card-link"
>

<div class="card">

    <h3>

        🗓 Calendario

    </h3>

    <p>

        Vista semanal

    </p>

</div>

</a>

</div>

<!-- USUARIOS -->

<div
class="section"
id="usuarios"
>

<h2>

Usuarios registrados

</h2>

<table>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Correo</th>

<th>Rol</th>

<th>Estado</th>

</tr>

@foreach($usuarios as $u)

<tr>

<td>

{{ $u->id_usuario }}

</td>

<td>

{{ $u->nombres }}

{{ $u->apellidos }}

</td>

<td>

{{ $u->correo }}

</td>

<td>

@if($u->id_rol==1)

Administrador

@elseif($u->id_rol==2)

Cliente

@else

Empleado

@endif

</td>

<td>

{{ $u->estado }}

</td>

</tr>

@endforeach

</table>

</div>

<!-- LOGS -->

<div
class="section"
id="logs"
>

<h2>

Logs sistema

</h2>

<table>

<tr>

<th>Usuario</th>

<th>Rol</th>

<th>Acción</th>

<th>IP</th>

<th>Fecha</th>

</tr>

@foreach($logs as $log)

<tr>

<td>

{{ $log->user_id }}

</td>

<td>

{{ $log->rol }}

</td>

<td>

{{ $log->accion }}

</td>

<td>

{{ $log->ip }}

</td>

<td>

{{ $log->fecha }}

</td>

</tr>

@endforeach

</table>

</div>

</div>

</body>

</html>