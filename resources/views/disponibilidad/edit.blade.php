<!DOCTYPE html>
<html>

<head>

<title>

Editar

</title>

</head>

<body>

<h1>

Editar disponibilidad

</h1>

<form
method="POST"
action="/disponibilidad/{{$disp->id_disponibilidad}}"
>

@csrf

@method('PUT')

<select
name="id_empleado"
>

@foreach($groomers as $g)

<option
value="{{$g->id_empleado}}"

{{$disp->id_empleado==$g->id_empleado?'selected':''}}

>

{{$g->id_empleado}}

</option>

@endforeach

</select>

<input
name="dia"
value="{{$disp->dia_semana}}"
/>

<input
type="time"
name="inicio"
value="{{$disp->hora_inicio}}"
/>

<input
type="time"
name="fin"
value="{{$disp->hora_fin}}"
/>

<select
name="estado"
>

<option>

disponible

</option>

<option>

bloqueado

</option>

</select>

<button>

Actualizar

</button>

</form>

</body>

</html>