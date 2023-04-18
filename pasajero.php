<?php
class pasajero{

private $nombre;
private $apellido;
private $num_doc;
private $telefono;

public function __construct($nombre,$apellido,$num_doc,$telefono)
{
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->num_doc = $num_doc;
    $this->telefono = $telefono;
}
//metodos de acceso nombre
public function getNombre () {
    return $this->nombre;
}
public function setNombre($nombre){
    return $this->nombre = $nombre;
}
//metodos de acceso apellido
public function getApellido (){
    return $this->apellido;
}
public function setApellido($apellido){
    return $this->apellido = $apellido;
}
//metodos de acceso num_doc
public function getNum_doc (){
    return $this->num_doc;
}
public function setNum_doc($num_doc){
    return $this->num_doc = $num_doc;
}
//metodos de acceso telefono
public function getTelefono (){
    return $this->telefono;
}
public function setTelefono($telefono){
    return $this->telefono = $telefono;
}

}
?>