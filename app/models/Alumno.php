<?php

namespace Model;

class Alumno extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'Alumno';
    protected static $columnasDB = ['cod_Alumno', 'nombre', 'apellido', 'documento', 'direccion', 'telefono', 'password', 'confirmado','email', 'token'];

    public $cod_Alumno;
    public $nombre;
    public $apellido;
    public $documento;
    public $direccion;
    public $telefono;
    public $email;
    public $password;
    public $confirm_password;
    public $repeat_password;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this->nombre = trim($args['nombre'] ?? '');
        $this->apellido = $args['apellido'] ?? '';
        $this->documento = $args['documento'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
        $this->repeat_password = $args['repeat_password'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = trim($args['token'] ?? '');
    }

    // Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->documento) {
            self::$alertas['error'][] = 'El Documento es Obligatorio';
        }
        if(!$this->direccion) {
            self::$alertas['error'][] = 'La dirección es Obligatoria';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        if(!$this->confirm_password) {
            self::$alertas['error'][] = 'Se require confirmar el Password';
        }
        if($this->confirm_password !== $this->password) {
            self::$alertas['error'][] = 'Los password no coinciden!';
        }


        return self::$alertas;
    }

    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }

        return self::$alertas;
    }
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es Obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    public function validarPasswordRecovery() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe tener al menos 6 caracteres';
        }
        if(!$this->repeat_password) {
            self::$alertas['error'][] = 'Se require confirmar el Password';
        }
        if($this->repeat_password !== $this->password) {
            self::$alertas['error'][] = 'Los password no coinciden!';
        }

        return self::$alertas;
    }

    // Revisa si el usuario ya existe
    public function existeUsuario() {
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El Usuario ya esta registrado';
        }

        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $tokenLength = 60;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
    
        // Generar un token aleatorio con la longitud deseada
        for ($i = 0; $i < $tokenLength; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        $this->token = trim($token);
    }

    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password, $this->password);
        
        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }
    
    // Registros - CRUD
    public function guardarAlumno() {
        $resultado = '';
        if(!is_null($this->cod_Alumno)) {
            // actualizar
            $resultado = $this->actualizarAlumno();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crearAlumno();
        }
        return $resultado;
    }

    // crea un nuevo registro
    public function crearAlumno() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
    
        // Preparar la consulta sin incluir el identificador (cod_Alumno)
        $columnas = array_diff(array_keys($atributos), ['cod_Alumno']);
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', $columnas);
        $query .= ") VALUES (";
        $query .= rtrim(str_repeat('?, ', count($columnas)), ', ');
        $query .= ")";
    
        // Crear un array con los valores a insertar (excluyendo el identificador)
        $valores = array_map(function ($columna) use ($atributos) {
            return $atributos[$columna];
        }, $columnas);
    
        // Preparar y ejecutar la consulta
        $stmt = self::$db->prepare($query);
        $stmt->bind_param(str_repeat('s', count($valores)), ...$valores);
        $resultado = $stmt->execute();
    
        if ($resultado) {
            // Asignar el ID generado automáticamente
            $this->cod_Alumno = self::$db->insert_id;
        }
    
        return [
            'resultado' => $resultado,
            'id' => $this->cod_Alumno
        ];
    }
    

    // Actualizar el registro
    public function actualizarAlumno() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE cod_Alumno = '" . self::$db->escape_string($this->cod_Alumno) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }
    
    // Eliminar un Registro por su ID
    public function eliminarAlumno() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE cod_Alumno = " . self::$db->escape_string($this->cod_Alumno) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

}