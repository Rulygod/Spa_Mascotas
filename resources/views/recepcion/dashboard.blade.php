<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Recepción Dashboard</title>

<style>

body{
    font-family:Segoe UI;
    margin:0;
    background:#f4f6f9;
}

.header{
    background:#2c3e50;
    color:white;
    padding:20px;
}

.container{
    padding:30px;
}

.card{
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.logout button{
    margin-top:20px;
    padding:10px 20px;
    background:#e74c3c;
    border:none;
    color:white;
    border-radius:8px;
    cursor:pointer;
}

/* MODAL */
.modal-overlay{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.7);
    display:flex;
    justify-content:center;
    align-items:center;
    z-index:9999;
}

.modal-box{
    background:white;
    width:400px;
    padding:30px;
    border-radius:15px;
    text-align:center;
}

.modal-box input{
    width:100%;
    padding:10px;
    margin-top:10px;
}

.modal-box button{
    width:100%;
    padding:12px;
    margin-top:15px;
    background:#4ca1af;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

</style>
</head>

<body>

<div class="header">
    <h1>Panel Recepción</h1>
</div>

<div class="container">
     <h2>👋 Hola {{ $usuario->nombres }}</h2>
        <p>Panel de recepción operativo</p>
    <div class="container">

    <h3 style="margin-bottom:15px;">
        📋 Solicitudes recientes
    </h3>

    <table style="width:100%; border-collapse:collapse; background:white; border-radius:10px; overflow:hidden;">

        <thead style="background:#2193b0; color:white;">

            <tr>
                <th style="padding:12px;">Cliente</th>
                <th style="padding:12px;">Mascota</th>
                <th style="padding:12px;">Servicio</th>
                <th style="padding:12px;">Estado</th>
                <th style="padding:12px;">Fecha</th>
                <th style="padding:12px;">Acciones</th>
            </tr>

        </thead>

        <tbody>

            @foreach($solicitudesRecientes as $s)

            <tr style="border-bottom:1px solid #eee;">

                <td style="padding:12px;">
                    {{ $s->cliente->nombres }}
                </td>

                <td style="padding:12px;">
                    {{ $s->mascota->nombre }}
                </td>

                <td style="padding:12px;">
                    {{ $s->servicio->nombre }}
                </td>

                <td style="padding:12px;">

                    @if($s->estado == 'pendiente')
                        🟡 Pendiente

                    @elseif($s->estado == 'en_proceso')
                        🔵 En proceso

                    @else
                        {{ $s->estado }}
                    @endif

                </td>

                <td style="padding:12px;">
                    {{ $s->created_at }}
                </td>
                <td style="padding:12px;">

    <a href="/agenda/create?solicitud={{ $s->id_solicitud }}"
       style="
            background:#2193b0;
            color:white;
            padding:8px 12px;
            border-radius:6px;
            text-decoration:none;
            display:inline-block;
       ">
        ➕ Crear cita
    </a>

</td>
            </tr>

            @endforeach

        </tbody>

    </table>

</div>
    <div class="card">

       

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-top:20px;">

            <div class="card">
                <h3>📅 Agenda</h3>
                <p>Gestiona todas las citas</p>
                <a href="/recepcion/agenda">Abrir</a>
            </div>

            <div class="card">
                <h3>➕ Nueva cita</h3>
                <p>Crear reserva manual</p>
                <a href="/agenda/create">Crear</a>
            </div>

            <div class="card">
                <h3>⛔ Bloqueos</h3>
                <p>Días no laborales</p>
                <a href="/bloqueos">Gestionar</a>
            </div>

            <div class="card">
                <h3>Disponibilidad Groomers</h3>
                <a href="/disponibilidad">Gestionar</a>
            </div>

        </div>

        <form method="POST" action="/logout" style="margin-top:30px;">
            @csrf
            <button style="background:#e74c3c;padding:10px;color:white;border:none;border-radius:8px;">
                Cerrar sesión
            </button>
        </form>

    </div>

</div>

@if($usuario->primer_login)

<div class="modal-overlay" id="passwordModal">

    <div class="modal-box">

        <h2>🔐 Cambio obligatorio</h2>
        <p>Debes cambiar tu contraseña temporal</p>

        <form id="passwordForm">

            @csrf

            <input type="password" name="password" id="password" placeholder="Nueva contraseña" required>

            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>

            <button type="button" id="btnGuardar">
                Guardar contraseña
            </button>

        </form>

        <div id="successMessage" style="display:none;">
            <h3>✅ Contraseña actualizada</h3>
        </div>

    </div>

</div>

@endif

<script>

const btnGuardar = document.getElementById('btnGuardar');

if(btnGuardar){

btnGuardar.addEventListener('click', async () => {

    const form = document.getElementById('passwordForm');
    const formData = new FormData(form);

    const response = await fetch('/cambiar-password', {
        method:'POST',
        headers:{
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: formData
    });

    if(response.ok){

        document.getElementById('passwordForm').style.display='none';
        document.getElementById('successMessage').style.display='block';

        setTimeout(() => {
            location.reload();
        }, 1500);
    }

});

}

</script>

</body>
</html>