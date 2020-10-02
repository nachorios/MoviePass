<?php



	//Agregamos la libreria para genera códigos QR
	include("phpqrcode/qrlib.php");    
    
    
    

    

            $dir = 'temp/';
            
                //Declaramos la ruta y nombre del archivo a generar
            $filename = $dir . "qr.png"; 
        
                //Parametros de Condiguración
            
            $tamaño = 15; //Tamaño de Pixel
            $level = 'H'; //Precisión Baja
            $framSize = 5; //Tamaño en blanco
            $contenido = $id_function;
            //Enviamos los parametros a la Función para generar código QR 
	        QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
        
    
     
?>