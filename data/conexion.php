<?php
    function conectarse() {
    	$conexion = null;
        try {                             

         //$conexion = pg_connect("dbname=d9v66gpljua1u9 host=ec2-54-163-227-94.compute-1.amazonaws.com port=5432 user=oygpguxkmdceak password=8f_RosNXtAkzfyLUyOsSuilKbN sslmode=require");
        $conexion = pg_connect("host=localhost dbname = mediasneltex_neltex port = 5432 user = mediasneltex_admin password = root2017");

         if($conexion == false)
            throw new Exception( "Error PostgreSQL ".pg_last_error());         
        } catch( Exception $e )
        {
          throw $e;
        }
        return $conexion;
    }
?>