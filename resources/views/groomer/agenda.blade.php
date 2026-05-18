<!DOCTYPE html>

<html>

<head>

<title>

Agenda Groomer

</title>

<style>

body{

margin:0;

font-family:'Segoe UI';

background:#f4f6f9;

}

.header{

background:#2c3e50;

padding:20px;

color:white;

}

.container{

padding:30px;

}

.grid{

display:grid;

grid-template-columns:

repeat(
auto-fit,
minmax(
320px,
1fr
)

);

gap:20px;

}

.card{

background:white;

padding:25px;

border-radius:15px;

box-shadow:
0 5px 15px rgba(
0,0,0,.1
);

}

.badge{

display:inline-block;

padding:5px 12px;

border-radius:20px;

background:#2193b0;

color:white;

margin-top:10px;

}

.btn{

display:block;

margin-top:15px;

padding:12px;

background:#2193b0;

color:white;

text-align:center;

text-decoration:none;

border-radius:10px;

}

.today{

border-left:
7px solid green;

}

.future{

border-left:
7px solid orange;

}

</style>

</head>

<body>

<div class="header">

<h1>

Mi Agenda Groomer

</h1>

</div>

<div class="container">

<div class="grid">

@foreach($citas as $c)

<div class="card

{{

$c->fecha==date('Y-m-d')

?

'today'

:

'future'

}}

">

<h2>

🐶

{{ $c->mascota }}

</h2>

<p>

Servicio:

<b>

{{ $c->servicio }}

</b>

</p>

<p>

Fecha:

{{ $c->fecha }}

</p>

<p>

Hora:

{{ $c->hora_inicio }}

-

{{ $c->hora_fin }}

</p>

<span class="badge">

{{ $c->estado }}

</span>

<a

href="/groomer/ficha/{{ $c->id_cita }}"

class="btn"

>

Abrir ficha

</a>

</div>

@endforeach

</div>

</div>

</body>

</html>