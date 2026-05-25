<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agenda</title>

<style>

body{
    margin:0;
    font-family:'Segoe UI';
    background:#f4f6f9;
}

.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    background:#2c3e50;
    padding-top:20px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:15px 20px;
}

.sidebar a:hover{
    background:#34495e;
}

.content{
    margin-left:250px;
    padding:30px;
}

.card{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
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

</style>
</head>
<body>

<div class="sidebar">

    <a href="/admin">📊 Dashboard</a>
    <a href="/admin/empleados">👥 Empleados</a>
    <a href="/admin/agenda">📅 Agenda</a>
    <a href="/admin/servicios">✂ Servicios</a>
    <a href="/admin/disponibilidad">🕒 Disponibilidad</a>
    <a href="/admin/citas">🐶 Citas</a>

</div>

<div class="content">

    <div class="card">

        <h1>📅 Agenda General</h1>

        <p>
            Aquí se visualizarán las citas y horarios del spa.
        </p>

    </div>

</div>

</body>
</html>