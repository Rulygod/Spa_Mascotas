<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registrar Empleado</title>

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
    width:250px;
    height:100vh;
    background:#2c3e50;
    color:white;
    position:fixed;
    padding:25px;
}

.sidebar h2{
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin-top:10px;
    border-radius:8px;
    transition:0.3s;
}

.sidebar a:hover{
    background:#34495e;
}

/* MAIN */

.main{
    margin-left:250px;
    width:100%;
    padding:40px;
}

/* FORM */

.form-box{
    background:white;
    max-width:700px;
    padding:35px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.form-box h2{
    margin-bottom:25px;
    color:#2c3e50;
}

.input-group{
    margin-bottom:18px;
}

.input-group label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
    color:#333;
}

.input-group input,
.input-group select{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}

.input-group input:focus,
.input-group select:focus{
    border-color:#4ca1af;
    outline:none;
}

/* BOTON */

button{
    width:100%;
    padding:14px;
    border:none;
    background:#4ca1af;
    color:white;
    border-radius:8px;
    font-size:15px;
    cursor:pointer;
}

button:hover{
    background:#3b8d99;
}

/* ERRORES */

.error{
    background:#f8d7da;
    color:#721c24;
    padding:12px;
    border-radius:8px;
    margin-bottom:20px;
}

/* LOGOUT */

.logout button{
    margin-top:30px;
    background:#e74c3c;
}

.logout button:hover{
    background:#c0392b;
}

.info{
    background:#e8f4ff;
    color:#2c3e50;
    padding:12px;
    border-radius:8px;
    margin-bottom:20px;
}

</style>
</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <h2>🐾 Spa Mascotas</h2>

    <a href="/admin">
        Dashboard
    </a>

    <a href="/admin/empleados">
        Registrar empleado
    </a>

    <a href="/admin#usuarios">
        Usuarios
    </a>

    <a href="/admin#logs">
        Logs
    </a>

    <form class="logout" method="POST" action="/logout">
        @csrf

        <button type="submit">
            Cerrar sesión
        </button>
    </form>

</div>

<!-- MAIN -->

<div class="main">

    <div class="form-box">

        <h2>Registrar nuevo empleado</h2>

        <div class="info">
            La contraseña temporal se generará automáticamente.
        </div>

        @if($errors->any())

            <div class="error">

                @foreach($errors->all() as $error)

                    <div>{{ $error }}</div>

                @endforeach

            </div>

        @endif

        <form method="POST" action="/admin/empleados">

            @csrf

            <div class="input-group">
                <label>Nombres</label>

                <input
                    type="text"
                    name="nombres"
                    required
                >
            </div>

            <div class="input-group">
                <label>Apellidos</label>

                <input
                    type="text"
                    name="apellidos"
                    required
                >
            </div>

            <div class="input-group">
                <label>Correo</label>

                <input
                    type="email"
                    name="correo"
                    required
                >
            </div>

            <div class="input-group">
                <label>Teléfono</label>

                <input
                    type="text"
                    name="telefono"
                    required
                >
            </div>

            <div class="input-group">
                <label>Cargo</label>

                <select name="cargo" required>

                    <option value="">
                        Seleccione...
                    </option>

                    <option value="Groomer">
                        Groomer
                    </option>

                    <option value="Recepcionista">
                        Recepcionista
                    </option>

                </select>
            </div>

            <div class="input-group">
                <label>Turno</label>

                <select name="turno" required>

                    <option value="">
                        Seleccione...
                    </option>

                    <option value="Mañana">
                        Mañana
                    </option>

                    <option value="Tarde">
                        Tarde
                    </option>

                    <option value="Noche">
                        Noche
                    </option>

                </select>
            </div>


            <button type="submit">
                Registrar empleado
            </button>

        </form>

    </div>

</div>

</body>
</html>