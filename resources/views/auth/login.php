<div class="login">

    <div class="background-login">

       <div class="logo-container">
       <picture>
           <source srcset="/build/img/logo-not.webp" type="image/webp">
           <img src="/build/img/logo-not.jpg" alt="image-instituto">
        </picture>
       </div>

    </div>

    <div class="content-login contenedor-sm">

        <h1>
           Bienvenido al sistema escolar
        </h1>
        <p class="instituto">Login de <?php echo $user ?? '';  ?></p>
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <form class="formulario" action="/" method="POST">
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
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Tu Password">
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>

        <div class="acciones">
            <a href="olvide">¿Olvidaste tu Password?</a>
        </div>

    </div> <!-- contenedor sm -->
</div>