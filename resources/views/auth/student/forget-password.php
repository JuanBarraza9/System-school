<div class="formulario-general">

    <div class="background-form">

        <div class="logo-container">
           <picture>
               <source srcset="/build/img/ifts11.webp" type="image/webp">
               <img src="/build/img/ifts11.jpeg" alt="image-instituto">
            </picture>
       </div>

    </div>

    <div class="contenedor">
        <div class="content-form-father">
        <a href="/" class="btn-home">
          <img src="/build/svg/house-black.svg">
        </a>

        <h2>
           Bienvenido al sistema escolar
        </h2>
        <p class="instituto">Recuperar password</p>
        <p class="descripcion-pagina">Indica tu email para recuerar tu password</p>

        <?php 
          include_once __DIR__ . "./../../templates/alertas.php";
        ?>
        </div>

        <form 
            class="formulario" 
            action="<?php echo ($user == 'Administrador') ? '/admin/forget-password' : (($user == 'Docente') ? '/teacher/forget-password' : '/student/forget-password'); ?>"
            method="POST"
            >
            
            <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu email registrado">
            </div>

            <div class="div-btn">
                <input type="submit" class="boton" value="Enviar Instrucciones">
            </div>
        </form>

        <div class="acciones">
            <a  href="<?php echo ($user == 'Estudiante') ? '/student/login' : ""; ?>">Iniciar Sesion</a>
            <?php echo ($user == 'Estudiante') ? '<a href="/student/register">Registrarse</a>' : ""; ?>
        </div>
    
    </div> <!-- contenedor sm -->
</div>