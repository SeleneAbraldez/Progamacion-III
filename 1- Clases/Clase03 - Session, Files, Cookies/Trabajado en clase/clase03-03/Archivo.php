<?php
    class Archivo
    {
        public static function Subir()
        {
            $origen = $_FILES["foto"]["tmp_name"];
            $destino = "./Archivos/" . $_FILES["foto"]["name"];

            $todoOk = FALSE;

            //si ya existe
            if(file_exists($destino) == FALSE){
                move_uploaded_file($origen, $destino);
                //echo("La foto " . $destino . " se subio correctamente.");
                echo("<br>");
                $todoOk = TRUE;
            }else{
                echo("ERROR - La foto " . $destino . " ya existe, no se pudo subir.");
                echo("<br>");
            }

            return $todoOk;
        } 
    }
?>