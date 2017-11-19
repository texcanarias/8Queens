<?php
function verificarTablero($Tablero){
    $dimension = count($Tablero);
    for($a=0;$a<($dimension-1);++$a){
        for($b=$a+1;$b<$dimension;++$b){
            if($Tablero[$a] == $Tablero[$b] || ($Tablero[$a] + $a) == ($Tablero[$b] + $b) || ($a - $Tablero[$a]) == ($b - $Tablero[$b]))
                return FALSE;
        }
    }
    return TRUE;
}


//Funcion del algoritmo que recorre toda la tabla.
function Recorrido($Tabla, $Elementos, $Nivel){
    if(0 == $Nivel){
        $Tabla[0] = 0;
        for($i=0; $i<$Elementos; ++$i){
            if(verificarTablero($Tabla)){
                echo implode("",$Tabla)."\n";
            }
            ++$Tabla[0];
        }
        Recorrido($Tabla, $Elementos, ++$Nivel);
    }
    else{
        ++$Tabla[$Nivel];
        if($Tabla[$Nivel] == $Elementos){
            $Tabla[$Nivel] = 0; //Como llegamos al final reseteamos el contador
            if(($Nivel+1)==$Elementos){
                return; //No se pueden bajar mas niveles
            }        
            Recorrido($Tabla, $Elementos, ++$Nivel); //Si llegamos al final de un nivel bajamos al siguiente
        }
        else{
            Recorrido($Tabla, $Elementos, 0); //Si no llegamos al final recorremos el nivel 0 completo
        }
    }
}

function recorrerEscenarios($Inicial,$Final){
    for($Elementos = $Inicial; $Elementos <= $Final ; ++$Elementos){

        $tiempoInicial  = microtime(true);

        $Tabla = array();

        for($i=0; $i<$Elementos; ++$i){
            $Tabla[] = 0;
        }


        Recorrido($Tabla, $Elementos, 0);
        
        $tiempoConsumido = microtime(true) - $tiempoInicial;
        echo "Tiempo transcurrido (".$Elementos." elementos)= ".$tiempoConsumido."\n";
    }
}

recorrerEscenarios(2,20);