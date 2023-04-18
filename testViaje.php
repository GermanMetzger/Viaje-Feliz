<?php

include_once("pasajero.php");
include_once("responsableV.php");

class  Viaje
{



    //Atributos
    public $nViaje;
    public $destino;
    public $cantidadMaxPasajeros;
    public $pasajeros = [];
    public $responsableViaje;



    //Propiedades: caracteristicas de nuestros objetos
    //Metodos
    public function __construct($nViaje, $destino, $cantidadMaxPasajeros, $pasajeros, $responsableViaje)
    {
        $this->nViaje = $nViaje;
        $this->destino = $destino;
        $this->cantidadMaxPasajeros = $cantidadMaxPasajeros;
        $this->pasajeros = $pasajeros;
        $this->responsableViaje = $responsableViaje;
    }


    public function get_destino()
    {
        return $this->destino;
    }

    public function set_destino($destino)
    {
        $this->destino = $destino;
    }

    public function get_viaje()
    {
        return $this->nViaje;
    }

    public function get_maximoPasajeros()
    {
        return $this->cantidadMaxPasajeros;
    }

    public function set_maximoPasajeros($cantidadMaxPasajeros)
    {
        $this->cantidadMaxPasajeros = $cantidadMaxPasajeros;
    }

    public function get_pasajeros()
    {
        return $this->pasajeros;
    }

    public function set_pasajeros($pasajeros)
    {
        $this->pasajeros = $pasajeros;
    }

    public function get_ResponsableViaje(){
        return $this->responsableViaje;
    }

    public static function chequeoDeCodigo($codigo, $viajes)
    {
        $retorno = false;
        foreach ($viajes as $viaje) {
            if ($viaje->nViaje == $codigo) {
                $retorno = true;
            }

            return $retorno;
        }
    }
}

function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}


$viajes = [];
$salida = false;



do {
    echo "1)Cargar nuevo viaje \n";
    echo "2)Editar datos viaje \n";
    echo "3)Ver viajes\n";
    echo "4)Salir\n";




    $opcion = trim(fgets(STDIN));
    if (is_numeric($opcion)) {



        switch ($opcion) {
            case 1:

                echo "Ingrese el codigo de viaje: ";
                $codigoViaje = trim(fgets(STDIN));
                $repetido = false;


                if (count($viajes) > 0) {
                    foreach ($viajes as $viaje) {
                        if ($codigoViaje == $viaje->get_viaje()) {
                            echo EscribirAmarillo("El codigo de viaje esta en uso...") . "\n";
                            $repetido = true;
                        }
                    }
                }
                if ($repetido) {
                    break;
                }



                do {

                    echo "ingrese el destino: ";
                    $destinoViaje = trim(fgets(STDIN));


                    if (is_numeric($destinoViaje)) {
                        echo "ingrese un destino valido... \n";
                    } else {


                        do {
                            echo "ingrese el maximo de pasajeros: ";
                            $maxmimoPasajeros = trim(fgets(STDIN));
                            if (is_numeric($maxmimoPasajeros)) {

                                $cantPasajeros = 0;
                                $pasajeros = [];
                                do {
                                    $hayMas = false;
                                    echo "ingrese el nombre del pasajero " . (++$cantPasajeros) . ": ";
                                    $nombrePasajero = trim(fgets(STDIN));
                                    echo "ingrese el apellido del pasajero: ";
                                    $apellidoPasajero = trim(fgets(STDIN));
                                    echo "ingrese el documento del pasajero: ";
                                    $documentoPasajero = (int)trim(fgets(STDIN));
                                    echo "ingrese el numero telefonico:";
                                    $numeroTelefono = trim(fgets(STDIN));
                                    array_push($pasajeros, new pasajero($nombrePasajero, $apellidoPasajero, $documentoPasajero, $numeroTelefono));


                                    if (count($pasajeros) < $maxmimoPasajeros) {
                                        echo "hay mas pasajeros? (s/n): ";
                                        $respuesta = trim(fgets(STDIN));
                                        if ($respuesta == "S" || $respuesta == "s") {

                                            $hayMas = true;
                                        }
                                    }
                                } while ($hayMas && count($pasajeros) < $maxmimoPasajeros);
                                echo "Ingrese el nombre del responsable del viaje: ";
                                $nombreResponsable = trim(fgets(STDIN));
                                echo "Ingrese el apellido del responsable del viaje: ";
                                $apellidoResponsable = trim(fgets(STDIN));
                                echo "Ingrese el numero de empleado del responsable del viaje: ";
                                $numeroEmpleadoResponsable = trim(fgets(STDIN));
                                echo "Ingrese el numero de licencia del responsable del viaje: ";
                                $numeroLicenciaResponsable = trim(fgets(STDIN));
                                $responsableViaje = new responsableV($numeroEmpleadoResponsable, $numeroLicenciaResponsable, $nombreResponsable, $apellidoResponsable);
                                array_push($viajes, new viaje($codigoViaje, $destinoViaje, $maxmimoPasajeros, $pasajeros, $responsableViaje));
                            } else {
                                echo "Ingrese un numero maximo... \n";
                            }
                        } while (is_numeric($maxmimoPasajeros) <> 1);
                    }
                } while (is_numeric($destinoViaje));


                break;


            case 2:
                if (count($viajes) > 0) {



                    echo "1)Editar viaje \n2)Agregar pasajero \n";
                    $opcion = trim(fgets(STDIN));
                    if (is_numeric($opcion)) {

                        switch ($opcion) {
                            case 1:



                                if (count($viajes) > 0) {
                                    for ($j = 0; $j < count($viajes); $j++) {
                                        echo "codigo -> " . $viajes[$j]->get_viaje() . " / " . $viajes[$j]->get_destino() . "\n";
                                    }
                                    echo "ingrese el ecodigo del viaje que desea editar: ";
                                    $codigoDeViajeAEditar = (int)trim(fgets(STDIN));
                                    foreach ($viajes as $viaje) {

                                        if ((int)$viaje->get_viaje() == (int)$codigoDeViajeAEditar) {
                                            echo "El destino de viaje es " . $viaje->get_destino() . "\n";
                                            echo "El nuevo destino es? (enter para no cambiar) \n";
                                            $tmp = trim(fgets(STDIN));
                                            if (strlen($tmp) > 0) {
                                                $viaje->set_destino($tmp);
                                            }
                                            echo "La cantidad maxima de pasajeros es " . $viaje->get_maximoPasajeros() . "\n";
                                            echo "La nueva cantidad es? (enter para no cambiar) \n";
                                            $tmp = trim(fgets(STDIN));
                                            if (strlen($tmp) > 0) {
                                                $viaje->set_maximoPasajeros($tmp);
                                            }
                                            $tmpPasajeros = $viaje->get_pasajeros();

                                            for ($j = 0; $j < count($tmpPasajeros); $j++) {
                                                echo "Documento -> " . $pasajeros[$j]->getNombre() . " " . $pasajeros[$j]->getApellido() . " " . $pasajeros[$j]->getNum_Doc() . "  " . $pasajeros[$j]->getTelefono() . "\n";
                                            }
                                            echo "Ingrese el documento del pasajero que desea editar: ";
                                            $codigoPasajeroAEditar = (int)trim(fgets(STDIN));
                                            for ($i = 0; $i < count($tmpPasajeros); $i++) {
                                                if ($tmpPasajeros[$i]->getNum_Doc() == $codigoPasajeroAEditar) {
                                                    echo "el nombre actual es " . $tmpPasajeros[$i]->getNombre() . "\n";
                                                    echo "El nuevo nombre es? (enter para no cambiar) \n";
                                                    $tmp = trim(fgets(STDIN));
                                                    if (strlen($tmp) > 0) {
                                                        $tmpPasajeros[$i]->setNombre($tmp);
                                                    }
                                                    echo "El apellido actual es " . $tmpPasajeros[$i]->getApellido() . "\n";
                                                    echo "El nuevo apellido es? (enter para no cambiar) \n";
                                                    $tmp = trim(fgets(STDIN));
                                                    if (strlen($tmp) > 0) {
                                                        $tmpPasajeros[$i]->setApellido($tmp);
                                                    }
                                                    echo "El numero telefonico actual es " . $tmpPasajeros[$i]->getTelefono() . "\n";
                                                    echo "El nuevo numero telefonico es? (enter para no cambiar) \n";
                                                    $tmp = trim(fgets(STDIN));
                                                    if (strlen($tmp) > 0) {
                                                        $tmpPasajeros[$i]->setTelefono($tmp);
                                                    }
                                                }
                                            }



                                            $viaje->set_pasajeros($tmpPasajeros);
                                        } else {
                                            echo "Codigo no encontrado... \n";
                                        }
                                    }
                                } else {
                                    echo "no hay viajes cargados... \n";
                                    trim(fgets(STDIN));
                                }
                                break;

                            case 2:

                                //aca estan los bugs

                                for ($j = 0; $j < count($viajes); $j++) {
                                    echo "codigo -> " . $viajes[$j]->get_viaje() . " / " . $viajes[$j]->get_destino() . "\n";
                                }
                                echo "ingrese el ecodigo del viaje que desea editar: ";
                                $codigoDeViajeAEditar = (int)trim(fgets(STDIN));

                                foreach ($viajes as $viaje) {
                                    if ((int)$viaje->get_viaje() == (int)$codigoDeViajeAEditar) {
                                        if ((int)$viaje->get_pasajeros() <= $viaje->get_maximoPasajeros()) {
                                            $salida = true;
                                            do {
                                                echo "ingrese el documento del pasajero: ";
                                                $documentoPasajero = (int)trim(fgets(STDIN));

                                                for ($j = 0; $j < count($viajes); $j++) {
                                                    if ($pasajeros[$j]->getNum_Doc() == $documentoPasajero) {
                                                        echo "Ese documento ya esta en uso. \n";
                                                    } else {
                                                        $salida = false;
                                                    }
                                                }
                                            } while ($salida);
                                            $pasajeros = $viaje->get_pasajeros();
                                            echo "ingrese el nombre del pasajero " . (++$cantPasajeros) . ": ";
                                            $nombrePasajero = trim(fgets(STDIN));
                                            echo "ingrese el apellido del pasajero: ";
                                            $apellidoPasajero = trim(fgets(STDIN));
                                            echo "ingrese el numero telefonico:";
                                            $numeroTelefono = trim(fgets(STDIN));
                                            array_push($pasajeros, new pasajero($nombrePasajero, $apellidoPasajero, $documentoPasajero, $numeroTelefono));
                                            $viaje->set_pasajeros($pasajeros);
                                        } else {
                                            echo "este Viaje ya esta en su maximo de pasajeros. \n";
                                            echo $viaje->get_maximoPasajeros() . "\n";
                                            echo (int)$viaje->get_pasajeros() . "\n";
                                        }
                                    } else {
                                        echo "Viaje no ecnontrado. \n";
                                    }
                                }


                                break;
                        }
                    } else {
                        echo "Ingrese un codigo valido. \n
                        ";
                    }






                    break;
                }


            case 3:
                $tren = 1;
                echo "hay " . count($viajes) . " viaje/s. \n";
                if (count($viajes) > 0) {

                    for ($j = 0; $j < count($viajes); $j++) {
                        $pasajeros = $viajes[$j]->get_pasajeros();
                        $responsableViaje = $viajes[$j]->get_ResponsableViaje();


                        
                        echo "- - - - - - - -viaje " . $tren . "- - - - - - - -\n";
                        echo "Codigo -> " . $viajes[$j]->get_viaje() . "\n";
                        echo "Destino -> " . $viajes[$j]->get_destino() . "\n";
                        echo "Responsable del viaje -> " . $responsableViaje->get_nombre()." ".$responsableViaje->get_apellido()."\n";
                        echo "Numero de empleado ->". $responsableViaje->get_numeroEmpleado()."\n";
                        echo "Numero de licencia -> ".$responsableViaje->get_numeroLicencia() ."\n";
                        echo "Cantidad maxima de pasajeros -> " . $viajes[$j]->get_maximoPasajeros() . "\n";
                        echo "cantidad de pasajeros -> " . count($pasajeros) . "\n";
                        echo "pasajeros: \n \n";
                        for ($b = 0; $b < count($pasajeros); $b++) {
                            echo "    " . $pasajeros[$b]->getNombre() . " " . $pasajeros[$b]->getApellido() . " " . $pasajeros[$b]->getNum_Doc() . "  " . $pasajeros[$b]->getTelefono() . "\n";
                        }
                        echo "- - - - - - - - - - - - - - - - - - - \n";


                        $tren++;
                    }
                } else {
                }
                break;

            case 4:

                $salida = true;
                break;
        }
    } else {
        echo "ingrese un codigo valido... \n";
    }
} while ($salida == false);
