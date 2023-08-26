<?php 

namespace Model;


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


}