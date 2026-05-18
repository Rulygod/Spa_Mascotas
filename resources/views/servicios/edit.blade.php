<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Servicio</title>

<style>

body{
    background:#f4f6f9;
    font-family:'Segoe UI';
}

.container{
    width:600px;
    margin:40px auto;
}

.card{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

input, textarea, select{
    width:100%;
    padding:12px;
    margin-top:10px;
    border-radius:8px;
    border:1px solid #ccc;
}

button{
    width:100%;
    padding:14px;
    border:none;
    background:#2193b0;
    color:white;
    margin-top:20px;
    border-radius:8px;
}

</style>
</head>
<body>

<div class="container">

    <div class="card">

        <h1>Editar Servicio</h1>

        <form
            method="POST"
            action="/admin/servicios/update/{{ $servicio->id_servicio }}"
        >

            @csrf

            <input
                type="text"
                name="nombre"
                value="{{ $servicio->nombre }}"
                required
            >

            <textarea
                name="descripcion"
            >{{ $servicio->descripcion }}</textarea>

            <input
                type="number"
                name="duracion_minutos"
                value="{{ $servicio->duracion_minutos }}"
                required
            >

            <input
                type="number"
                step="0.01"
                name="precio"
                value="{{ $servicio->precio }}"
                required
            >

            <select name="estado">

                <option value="activo">
                    Activo
                </option>

                <option value="inactivo">
                    Inactivo
                </option>

            </select>

            <button type="submit">
                Actualizar
            </button>

        </form>

    </div>

</div>

</body>
</html>