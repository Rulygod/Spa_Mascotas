<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>

Nueva Disponibilidad

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

.card{

    background:white;

    padding:25px;

    border-radius:15px;

    box-shadow:0 5px 15px rgba(0,0,0,.1);

}

input,
select{

    width:100%;

    padding:12px;

    margin-top:12px;

}

button{

    margin-top:20px;

    padding:12px;

    border:none;

    background:#2193b0;

    color:white;

}

</style>

</head>

<body>

<div class="header">

<h1>

Registrar disponibilidad

</h1>

</div>

<div class="container">

<div class="card">

<form
method="POST"
action="/disponibilidad"
>

@csrf

<label>

Groomer

</label>

<select
name="id_empleado"
required
>

<option>

Seleccione

</option>

@foreach($groomers as $g)

<option
value="{{$g->id_empleado}}"
>

{{$g->nombres}}
{{$g->apellidos}}

</option>

@endforeach

</select>

<label>

Día

</label>

<select
name="dia"
required
>

<option>Lunes</option>

<option>Martes</option>

<option>Miércoles</option>

<option>Jueves</option>

<option>Viernes</option>

<option>Sábado</option>

<option>Domingo</option>

</select>

<label>

Hora inicio

</label>

<input
type="time"
name="inicio"
required
/>

<label>

Hora fin

</label>

<input
type="time"
name="fin"
required
/>

<button>

Guardar horario

</button>

</form>

</div>

</div>

</body>

</html>