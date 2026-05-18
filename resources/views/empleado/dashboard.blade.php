<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel Empleado</title>

<style>

body{
    font-family:'Segoe UI';
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

.logout{
    margin-top:20px;
}

.logout button{
    padding:10px 20px;
    border:none;
    background:#e74c3c;
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
    border-radius:8px;
    border:1px solid #ccc;
}

.modal-box button{
    width:100%;
    padding:12px;
    margin-top:15px;
    border:none;
    background:#4ca1af;
    color:white;
    border-radius:8px;
    cursor:pointer;
}

.strength-bar{
    height:8px;
    background:#ddd;
    border-radius:5px;
    margin-top:8px;
}

.strength{
    height:8px;
    width:0%;
    border-radius:5px;
}

</style>
</head>

<body>

<div class="header">
    <h1>Bienvenido Empleado</h1>
</div>

<div class="container">

    <div class="card">

        <h2>
            Hola {{ Auth::user()->nombres }}
        </h2>

        <p>
            Bienvenido al panel del empleado.
        </p>

        <form class="logout" method="POST" action="/logout">
            @csrf
            <button type="submit">
                Cerrar sesión
            </button>
        </form>

    </div>

</div>

@if(Auth::user()->primer_login)

<div class="modal-overlay" id="passwordModal">

    <div class="modal-box">

        <h2>🔐 Falta un paso...</h2>

        <p>
            Debes cambiar tu contraseña temporal
        </p>

        <form id="passwordForm">

            @csrf

            <input
                type="password"
                name="password"
                id="password"
                placeholder="Nueva contraseña"
                required
            >

            <div class="strength-bar">
                <div id="strength" class="strength"></div>
            </div>

            <small id="strength-text"></small>

            <input
                type="password"
                name="password_confirmation"
                placeholder="Confirmar contraseña"
                required
            >

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

// MEDIDOR

const passwordInput = document.getElementById('password');

if(passwordInput){

const strengthBar = document.getElementById('strength');
const strengthText = document.getElementById('strength-text');

passwordInput.addEventListener('input', function(){

    const value = passwordInput.value;

    let strength = 0;

    if(value.length >= 8) strength++;
    if(/[a-z]/.test(value)) strength++;
    if(/[A-Z]/.test(value)) strength++;
    if(/[0-9]/.test(value)) strength++;
    if(/[@$!%*#?&]/.test(value)) strength++;

    switch(strength){

        case 1:
            strengthBar.style.width = '20%';
            strengthBar.style.background = 'red';
            strengthText.textContent = 'Muy débil';
            break;

        case 2:
            strengthBar.style.width = '40%';
            strengthBar.style.background = 'orange';
            strengthText.textContent = 'Débil';
            break;

        case 3:
            strengthBar.style.width = '60%';
            strengthBar.style.background = 'yellow';
            strengthText.textContent = 'Aceptable';
            break;

        case 4:
            strengthBar.style.width = '80%';
            strengthBar.style.background = 'lightgreen';
            strengthText.textContent = 'Fuerte';
            break;

        case 5:
            strengthBar.style.width = '100%';
            strengthBar.style.background = 'green';
            strengthText.textContent = 'Muy fuerte';
            break;
    }

});
}

// AJAX

const form = document.getElementById('passwordForm');
const btnGuardar = document.getElementById('btnGuardar');

if(btnGuardar){

btnGuardar.addEventListener('click', async function(){

    const formData = new FormData(form);

    const response = await fetch('/cambiar-password', {

        method:'POST',

        headers:{
            'X-CSRF-TOKEN':
            document.querySelector('input[name="_token"]').value
        },

        body:formData
    });

    if(response.ok){

        form.style.display='none';

        document.getElementById('successMessage').style.display='block';

        setTimeout(()=>{

            document.getElementById('passwordModal').style.display='none';

            location.reload();

        },2000);
    }

});

}

</script>

</body>
</html>