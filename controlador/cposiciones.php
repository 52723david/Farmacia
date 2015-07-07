<?php    
        include("../../modelo/confi.php");
        include("../../modelo/clase.php");
        $miconexion = new clase_mysql;
        $miconexion->conectar($db_name,$db_host, $db_user,$db_pasword);
        function  localizacion($opcion="", $lat="", $long="", $fecha="")
        {
            $pos=0;
            $miconexion->consulta("select  Farmacia from turnos where DATEDIFF(dd, ".$fecha.", fecha_inicio)>=0 and DATEDIFF(dd, fecha_fin, ".$fecha.")>=0");
            $auxfarmacias=$miconexion->arregloDatos();
            $retornaFarmacias="";
            for ($i=0; $i < count($auxfarmacias) ; $i++) { 
                if ($i<5) {
                    $miconexion->consulta("select  Nombre, Latitud, Longitud from farmacia where Id=".$auxfarmacias[$i]);
                    $farmacias[$pos]=$miconexion->arregloDatos()[0];
                    $pos++;
                    $farmacias[$pos]=$miconexion->arregloDatos()[1];
                    $pos++;
                    $farmacias[$pos]=$miconexion->arregloDatos()[2];
                    $pos++;
                }else{
                   $i= count($auxfarmacias);
                }
            }
            $pos=0;
            $posLong=2;
            $posLat=1;
            if ($opcion=="") {                  
                $radioTierra = 6378.137; // RADIO DE LA TIERRA DEFINIDO POR WGS84
                for ($i=0; $i <count($farmacias) ; $i++) { 
                    $dlon = $long - $farmacias[$posLong]; 
                    $distance = acos( sin(deg2rad($lat)) * sin(deg2rad($farmacias[$posLat])) +  cos(deg2rad($lat)) * cos(deg2rad($farmacias[$posLat])) * cos(deg2rad($dlon))) * $radioTierra; 
                    $auxfarmacias[$pos]= $farmacias[$i];
                    $pos++;
                    $i++;
                    $auxfarmacias[$pos]= $farmacias[$i];
                    $pos++;
                    $i++;
                    $auxfarmacias[$pos]= $farmacias[$i];
                    $pos++;
                    $auxfarmacias[$pos]= $distance;
                    $pos++;
                    $posLat=$posLat+3;
                    $posLong=$posLong+3;                    
                }
                $pos=0;
                for ($i=3; $i < count($auxfarmacias); $i++) { 
                    $vecDistance[$pos]=$auxfarmacias[$i];
                    $i=$i+3;
                    $pos++;
                }
                for ($i=1; $i <count($vecDistance) ; $i++) { 
                    for ($c=0; $c < count($vecDistance-1); $c++) { 
                        if ($vecDistance[$c]>$vecDistance[$c+1]) {
                            $aux=$vecDistance[$c];
                            $vecDistance[$c]=$vecDistance[$c+1];
                            $vecDistance[$c+1]=$aux;
                        }
                    }
                }
                $pos=0;
                for ($i=0; $i < count($vecDistance); $i++) { 
                    for ($c=3; $c < count($auxfarmacias); $c++) { 
                        if ($vecDistance[$i]==$auxfarmacias[$c]) {
                            $retornaFarmacias[$pos]=$auxfarmacias[$c-3];
                            $pos++;
                            $retornaFarmacias[$pos]=$auxfarmacias[$c-2];
                            $pos++;
                            $retornaFarmacias[$pos]=$auxfarmacias[$c-1];
                            $pos++;
                            $c=count($auxfarmacias);
                        }else{
                            $c=$c+3;
                        }
                    }
                }
            }else{
                $retornaFarmacias=$farmacias;    
            }
            return $retornaFarmacias;
        }
?>