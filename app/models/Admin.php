<?php 

namespace Model;

use function App\debuguear;

class Admin extends ActiveRecord {
    // Base DE DATOS
    protected static $tabla = 'Administrador';
    protected static $columnasDB = ['cod_Admin', 'username', 'contraseña'];
    

    public $cod_Admin;
    public $username;
    public $contraseña;
    
    public function __construct($args = [])
    {
        $this->cod_Admin = $args['cod_Admin'] ?? null;
        $this->username = $args['username'] ?? '';
        $this->contraseña = $args['contraseña'] ?? '';
    }

    public function validarLogin() {

        if(!$this->username) {
            self::$alertas['error'][] = 'El email es Obligatorio';
        }
        if(!$this->contraseña) {
            self::$alertas['error'][] = 'La contraseña es Obligatoria';
        }

        return self::$alertas;
    }



}