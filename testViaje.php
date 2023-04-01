<?php

class  Viaje{

    

    //Atributos
        public $nViaje;
        public $destino;
        public $cantidadMaxPasajeros;
        public $pasajeros=[
            "nombre"=> "",
            "apellido"=>"",
            "documento"=> 0
        ];

        

    //Propiedades: caracteristicas de nuestros objetos
    //Metodos
   public function __construct($nViaje,$destino,$cantidadMaxPasajeros,$pasajeros){
        $this->nViaje = $nViaje;
        $this->destino = $destino;
        $this->cantidadMaxPasajeros = $cantidadMaxPasajeros;
        $this->pasajeros = $pasajeros;
        
        
    }


    public function get_destino(){
        return $this->destino;
    
    }
    
    public function set_destino($destino){
        $this->destino = $destino;
    }

    public function get_viaje(){
        return $this->nViaje;
    }

    public function get_maximoPasajeros(){
        return $this->cantidadMaxPasajeros;
    
    }
    
    public function set_maximoPasajeros($cantidadMaxPasajeros){
        $this->cantidadMaxPasajeros = $cantidadMaxPasajeros;
    }

    public function get_pasajeros(){
        return $this->pasajeros;
    
    }
    
     public function set_pasajeros($pasajeros){
         $this->pasajeros = $pasajeros;
     }

     public static function chequeoDeCodigo($codigo,$viajes){
        $retorno = false;
        foreach($viajes as $viaje){
            if($viaje->nViaje == $codigo){
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



do{
echo "1)Cargar nuevo viaje \n";
echo "2)Editar datos viaje \n";
echo "3)Ver viajes\n";
echo "4)Salir\n";




$opcion = trim(fgets(STDIN));
if (is_numeric($opcion)){



      switch($opcion){
    case 1:
        
        echo "Ingrese el codigo de viaje: ";
        $codigoViaje = trim(fgets(STDIN));
        $repetido = false;


        if(count($viajes) > 0){
            foreach($viajes as $viaje){
                if($codigoViaje == $viaje->get_viaje()){
                    echo EscribirAmarillo("El codigo de viaje esta en uso...")."\n";
                    $repetido = true;
                    
                }
                    
                
            
            }
  
        }
        if($repetido){
            break;
        }
        
   /*    

        if($v->chequeoDeCodigo($codigoViaje,$viajes)){

            echo "El codigo de viaje esta en uso... \n";

            break;

        }
*/

        do{

        echo "ingrese el destino: ";
        $destinoViaje = trim(fgets(STDIN));
        

        if(is_numeric($destinoViaje)){
            echo "ingrese un destino valido... \n";
            
         }else{
            

            do{
                echo "ingrese el maximo de pasajeros: ";
            $maxmimoPasajeros = trim(fgets(STDIN));
            if(is_numeric($maxmimoPasajeros)){
                $meQuedo = true;
            $cantPasajeros = 0;
            $pasajeros = [];
            do{
            echo "ingrese el nombre del pasajero ".(++$cantPasajeros).": ";
            $nombrePasajero = trim(fgets(STDIN));
            echo "ingrese el apellido del pasajero: ";
            $apellidoPasajero = trim(fgets(STDIN));
            echo "ingrese el documento del pasajero: ";
            $documentoPasajero = (int)trim(fgets(STDIN));
            array_push($pasajeros,[
                "nombre" => $nombrePasajero,
                "apellido"=> $apellidoPasajero,
                "documento"=> $documentoPasajero
            ]);
            
            do{
            if(count($pasajeros) < $maxmimoPasajeros){
                echo "hay mas pasajeros? (s/n): ";
                $respuesta = trim(fgets(STDIN));
                if($respuesta == "N" || $respuesta == "n"){
                    $meQuedo = false;
                    $hayMas = false;
                }else{

                }
                if($respuesta == "S" || $respuesta == "s"){
                    $meQuedo = false;
                    $hayMas = true;
                }

            }
            }while($meQuedo);
            
        }while($hayMas && count($pasajeros) < $maxmimoPasajeros);
        array_push($viajes, new viaje($codigoViaje,$destinoViaje,$maxmimoPasajeros,$pasajeros));

            }else{
                echo "Ingrese un numero maximo... \n";
            }

            }while(is_numeric($maxmimoPasajeros) <> 1);

        
             }

         }while(is_numeric($destinoViaje));
         

        break;

 
        case 2:

            if(count($viajes) > 0){
                for($j=0;$j<count($viajes);$j++){
                    echo "codigo -> ".$viajes[$j]->get_viaje()." / ".$viajes[$j]->get_destino()."\n";
                }
    
                echo "ingrese el ecodigo del viaje que desea editar: ";
                $codigoDeViajeAEditar = (int)trim(fgets(STDIN));
                foreach($viajes as $viaje){
                    
                    if((int)$viaje->get_viaje() == (int)$codigoDeViajeAEditar){
                        echo "El destino de viaje es ".$viaje->get_destino()."\n";
                        echo "El nuevo destino es? (enter para no cambiar) \n";
                        $tmp = trim(fgets(STDIN));
                        if(strlen($tmp) > 0){
                            $viaje->set_destino($tmp);
                         }
                         echo "La cantidad maxima de pasajeros es ".$viaje->get_maximoPasajeros()."\n";
                         echo "La nueva cantidad es? (enter para no cambiar) \n";
                         $tmp = trim(fgets(STDIN));
                         if(strlen($tmp) > 0){
                            $viaje->set_maximoPasajeros($tmp);
                         }
                         $tmpPasajeros = $viaje->get_pasajeros();
                         
                         for($j=0;$j < count($tmpPasajeros);$j++){
                            echo "Documento -> ".$tmpPasajeros[$j]["documento"]."  /  ".$tmpPasajeros[$j]["nombre"]." ".$tmpPasajeros[$j]["apellido"]."\n";    
                        }
                        echo "Ingrese el documento del pasajero que desea editar: ";
                            $codigoPasajeroAEditar = (int)trim(fgets(STDIN));
                            for($i=0;$i<count($tmpPasajeros);$i++){
                                if($tmpPasajeros[$i]["documento"] == $codigoPasajeroAEditar){
                                    echo "el nombre actual es ".$tmpPasajeros[$i]["nombre"]."\n";
                                    echo "El nuevo nombre es? (enter para no cambiar) \n";
                                    $tmp = trim(fgets(STDIN));
                                    if(strlen($tmp) > 0){
                                        $tmpPasajeros[$i]["nombre"] = $tmp;
                                        
                                    }
                                    echo "El apellido actual es ".$tmpPasajeros[$i]["apellido"]."\n";
                                    echo "El nuevo apellido es? (enter para no cambiar) \n";
                                    $tmp = trim(fgets(STDIN));
                                    if(strlen($tmp) > 0){
                                        $tmpPasajeros[$i]["apellido"] = $tmp;
                                    }                                    
                                }
                            }

                            

                            $viaje->set_pasajeros($tmpPasajeros);

                    }
                    else{
                        echo "Codigo no encontrado... \n";
                    }
                
                }
           
            }else{
                echo "no hay viajes cargados... \n";
                trim(fgets(STDIN));
            }


            
            break;


            case 3:
                $tren = 1;
                echo "hay ".count($viajes)." viaje/s. \n";
                if(count($viajes) > 0){

                    for($j=0;$j < count($viajes);$j++){
                        
                        
                        echo "- - - - - - - -viaje ".$tren."- - - - - - - -\n";
                        echo "Codigo -> ".$viajes[$j]->get_viaje()."\n";
                        echo "Destino -> ".$viajes[$j]->get_destino()."\n";
                        echo "Cantidad maxima de pasajeros -> ".$viajes[$j]->get_maximoPasajeros()."\n";
                        echo "cantidad de pasajeros -> ".count($pasajeros)."\n";
                        echo "pasajeros: \n \n";
                        $pasajeros = $viajes[$j]->get_pasajeros();
                        for($b=0;$b < count($pasajeros);$b++){
                        echo "    ".$pasajeros[$b]["nombre"]." ".$pasajeros[$b]["apellido"]." ".$pasajeros[$b]["documento"]."\n";
                        }
                        echo "- - - - - - - - - - - - - - - - - - - \n";


                        $tren++;

                    }
                    
                        
                }else{

                }
                break;

                case 4:

                    $salida = true;
                    break;




}
}else{
    echo "ingrese un codigo valido... \n";
}


}while($salida == false);