<div class="register">

    <div class="content-register contenedor">
        <a href="/" class="btn-home">
          <img src="/build/svg/house-black.svg">
        </a>

        <h2>
           Bienvenido al sistema escolar
        </h2>
        <p class="instituto">Registro de <?php echo $user ?? '';  ?></p>
        <p class="descripcion-pagina">Al registrarte deberás confirmar tu email</p>

        <?php 
          include_once __DIR__ . "./../templates/alertas.php";
        ?>

        <form 
            class="formulario formulario-register" 
            action="/student/register"
            method="POST"
            >

            <div class="campos-flex">
                <div class="campo">
                    <label for="nombre">nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo san($usuario->nombre); ?>">
                </div>
    
                <div class="campo">
                    <label for="apellido">apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo san($usuario->apellido); ?>">
                </div>
            </div>

            <div class="campo">
                <label for="documento">Documento</label>
                <input type="text" id="documento" name="documento" placeholder="Tu Documento" value="<?php echo san($usuario->documento); ?>">
            </div>

            <div class="campo">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" placeholder="Tu Direccion" value="<?php echo san($usuario->direccion); ?>">
            </div>

            <div class="campo">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" placeholder="Tu Telefono" value="<?php echo san($usuario->telefono); ?>">
            </div>
            
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo san($usuario->email); ?>">
            </div>

            <div class="campos-flex">
                <div class="campo">
                    <label for="password">password</label>
                    <input type="password" id="password" name="password" placeholder="Tu Password">
                </div>
                
                <div class="campo">
                    <label for="confirm_password">Confirmar Contraseña</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma el Password">
                </div>
            </div>
            
            <input type="submit" class="boton" value="Registrarse">
        </form>

        <div class="acciones">
            <a href="/student/forget-password">¿Olvidaste tu Password?</a>
            <a href="/student/login">¿Ya tienes una cuenta? Iniciar Sesión</a>
        </div>
        

    </div> <!-- contenedor sm -->
</div>