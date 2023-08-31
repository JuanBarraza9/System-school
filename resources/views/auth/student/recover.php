<div class="formulario-general">
    <div class="contenedor-sm">
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
            
                <?php if($error) return; ?>
            </div>
            <form 
                class="formulario" 
                method="POST"
                >
                
                <div class="campo">
                    <label for="password">Nuevo Passowrd*</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu nuevo password">
                </div>
                
                <div class="campo">
                    <label for="repeat_password">Repetir Passowrd*</label>
                    <input type="password" id="repeat_password" name="repeat_password" placeholder="Repite el password">
                </div>
            
                <div class="div-btn">
                   <input type="submit" class="boton" value="Restablecer">
                </div>
            </form>
    
            <div class="acciones">
                <a  href="<?php echo ($user == 'Estudiante') ? '/student/login' : ""; ?>">Iniciar Sesion</a>
            </div>
            
    </div> <!-- contenedor sm -->

</div>
    