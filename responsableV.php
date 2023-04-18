<?php


class responsableV{

    public $numeroEmpleado;
    public $numeroLicencia;
    public $nombre;
    public $apellido;

    public function __construct($numeroEmpleado,$numeroLicencia,$nombre,$apellido){
        
        $this->numeroEmpleado = $numeroEmpleado;
        $this->numeroLicencia = $numeroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function get_numeroEmpleado(){
        return $this->numeroEmpleado;
    }

    public function get_numeroLicencia(){
        return $this->numeroLicencia;
    }

    public function get_nombre(){
        return $this->nombre;
    }

    public function get_apellido(){
        return $this->apellido;
    }

    public function set_numeroEmpleado($numeroEmpleado){
        $this->numeroEmpleado = $numeroEmpleado;
    }

    
    public function set_numeroLiencia($numeroLicencia){
        $this->numeroLicencia = $numeroLicencia;
    }


    public function set_nombre($nombre){
        $this->nombre = $nombre;
    }

    
    public function set_apellido($apellido){
        $this->apellido = $apellido;
    }


}

?>