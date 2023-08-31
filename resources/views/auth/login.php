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
            <p class="instituto">Login de <?php echo $user ?? '';  ?></p>
            <p class="descripcion-pagina">Iniciar Sesión</p>
    
            <?php 
              include_once __DIR__ . "./../templates/alertas.php";
            ?>
        </div>
        
        <form 
            class="formulario" 
            action="<?php echo ($user == 'Administrador') ? '/admin/login' : (($user == 'Docente') ? '/teacher/login' : '/student/login'); ?>"
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
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Tu password">
            </div>
    
            <div class="div-btn">
                <input type="submit" class="boton" value="Iniciar Sesión">
            </div>
            
        </form>
    
        <div class="acciones">
            <a href="<?php echo ($user == 'Estudiante') ? '/student/forget-password' : ""; ?>">¿Olvidaste tu Password?</a>
            <?php echo ($user == 'Estudiante') ? '<a href="/student/register">Registrarse</a>' : ""; ?>
        </div>
            
    </div> <!-- contenedor sm -->
</div>