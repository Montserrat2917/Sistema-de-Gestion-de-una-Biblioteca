<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="contenedor-login">
        <h1 class="titulo-login">Iniciar Sesión</h1>
        
        <form method="POST" action="verificar_login.php">
            <div class="grupo-input">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" class="campo-texto" placeholder="Ingrese su usuario" required>
            </div>
            
            <div class="grupo-input">
                <label  for="password">Contraseña:</label>
                <div class="contenedor-password">
                    <input type="password" id="password" name="contraseña" class="campo-texto" placeholder="Ingrese su contraseña" required>
                    <button type="button" class="boton-ojo" onclick="mostrarPassword()">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="grupo-botones">
                <button type="submit" class="boton boton-primario">Continuar</button>
                <button type="button" class="boton boton-secundario" onclick="limpiar()">Cancelar</button>
            </div>
        </form>
    </div>

    <script>
        /*
            Equipo 5
            Ramirez Guzman Ramiro
            Reyes Magaña Brayan Emmanuel
            Sanchez Loza Montserrat Guadalupe
            Suarez Camarena Kimberly Lizbeth
        */
        function limpiar(){
            //limpia campo usuario
            document.getElementById('usuario').value = '';
            //limpia campo contra
            document.getElementById('password').value = '';
            
        }

        //para lo del ojo de al lado de la contraseña (que oculte o muestre la contraseña)
        function mostrarPassword() {
            const campoPassword = document.getElementById('password');
            const iconoOjo = document.querySelector('.boton-ojo i');
            
            if (campoPassword.type === 'password') {
                campoPassword.type = 'text';
                iconoOjo.classList.remove('fa-eye');
                iconoOjo.classList.add('fa-eye-slash');
            } else {
                campoPassword.type = 'password';
                iconoOjo.classList.remove('fa-eye-slash');
                iconoOjo.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>