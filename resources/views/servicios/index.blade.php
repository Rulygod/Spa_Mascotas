<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Servicios</title>

<style>

body{
    font-family:'Segoe UI';
    background:#f4f6f9;
    margin:0;
}

.header{
    background:#2c3e50;
    color:white;
    padding:20px 40px;
}

.container{
    padding:40px;
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.btn{
    background:#3498db;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    border-radius:10px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    margin-top:30px;
    border-radius:12px;
    overflow:hidden;
}

th{
    background:#34495e;
    color:white;
}

th,td{
    padding:15px;
    text-align:left;
}

tr:nth-child(even){
    background:#f8f9fb;
}

</style>
</head>
<body>

<div class="header">
    <h1>✂ Gestión de Servicios</h1>
</div>

<div class="container">

    <div class="top">
        <h2>Lista de Servicios</h2>

        <a href="/servicios/create" class="btn">
            + Nuevo Servicio
        </a>
    </div>

    <table>

        <tr>
            <th>Servicio</th>
            <th>Duración</th>
            <th>Precio</th>
            <th>Estado</th>
        </tr>

        @foreach($servicios as $s)

        <tr>
            <td>{{ $s->nombre }}</td>
            <td>{{ $s->duracion_minutos }} min</td>
            <td>Bs {{ $s->precio }}</td>
            <td>{{ $s->estado }}</td>
        </tr>

        @endforeach

    </table>

</div>

</body>
</html>