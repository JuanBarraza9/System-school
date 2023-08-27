<div class="login">

    <div class="background-login">

       <div class="logo-container">
       <picture>
           <source srcset="/build/img/ifts11.webp" type="image/webp">
           <img src="/build/img/ifts11.jpeg" alt="image-instituto">
        </picture>
       </div>

    </div>

    <div class="content-login contenedor-sm">
        <a href="/" class="btn-home">
          <img src="/build/svg/house-black.svg">
        </a>

        <h1>
           Bienvenido al sistema escolar
        </h1>
        <p class="instituto">Login de <?php echo $user ?? '';  ?></p>
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <?php 
          include_once __DIR__ . "./../templates/alertas.php";
        ?>

        <form 
            class="formulario" 
            action="<?php echo ($user == 'Administrador') ? '/admin/login' : (($user == 'Docente') ? '/teacher/login/post' : '/student/login/post'); ?>"
            method="POST"
            >
            <?php if($user == 'Estudiante'){ ?>

                <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email">
                </div>
                
            <?php } else { ?>

               <div class="campo">
               <label for="username">Username</label>
               <input type="text" id="username" name="username" placeholder="Tu Username">
               </div>
               
            <?php } ?>

            <div class="campo">
                <label for="contraseña">contraseña</label>
                <input type="contraseña" id="contraseña" name="contraseña" placeholder="Tu contraseña">
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>

        <div class="acciones">
            <a href="olvide">¿Olvidaste tu Password?</a>
        </div>

    </div> <!-- contenedor sm -->
</div>