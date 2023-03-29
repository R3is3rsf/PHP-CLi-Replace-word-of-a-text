<?php

function openDocument($docu,$permisos){
    //Abro el documento
    $document = fopen($docu,$permisos);
    return $document;
}

function closeDocument($document){
    fclose($document);
}

function imprimir($arr){
    foreach($arr as $value){
        print $value;
    }
}

function leer($document,$arrayMulti=null){
     $lineas=[];

     if(!empty($arrayMulti)):
        while($read = fgets($document)):
            foreach($arrayMulti as $value):
      
                if(preg_match("/{$value['buscar']}/i",$read)):
                    $read = str_replace($value['buscar'],$value['reemplazar'],$read);
                endif;
           
                
            endforeach;
            $lineas[]=$read;
        endwhile;
    endif;

    if(empty($arrayMulti)):
       while($read = fgets($document)): 
        $lineas[]=$read;
       endwhile;  
    endif;  

    return $lineas;
 }

 $document=openDocument('document.txt','r+');
//Llamada a la funcion
$lines = leer($document);
imprimir($lines);
print "\n";
closeDocument($document);


//TENGO QUE CREAR UN ARRAY MULTIDIMENCIONAL CON CLAVES DE PALABRA Y REEMPLAZO DE PALABRA.
$count=0;    
do{
$buscar = readline("Ingrese palabra que quiere reemplazar: ");
$reemplazar = readline("Por cual desea reemplazarla: ");
$arrayMulti[$count] = [
                          'buscar'=>$buscar,
                          'reemplazar'=>$reemplazar
                      ];
$count++;
$seleccion = readline("Desea reemplazar mas palabras: s=si , n=no ");
}while($seleccion=='s');


$document=openDocument('document.txt','r+');
$array = leer($document,$arrayMulti);
closeDocument($document);

$document=openDocument('document.txt','w+');

#Modificar contenido
foreach($array as $value):
    fwrite($document,$value) ;
endforeach;
imprimir($array);

closeDocument($document);




//$read= preg_replace("/(Persona)/","USUARIO", $read);
