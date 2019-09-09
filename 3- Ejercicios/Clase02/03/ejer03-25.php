<?php
/*Ejercicio 25 (contar letras):
Se quiere realizar una aplicación que lea un archivo (../misArchivos/palabras.txt) y ofrezca
estadísticas sobre cuantas palabras de 1, 2, 3, 4 y más de 4 letras hay en el texto. No tener en
cuenta los espacios en blanco ni saltos de líneas como palabras.
Los resultados mostrarlos en una tabla.
*/
$cadena ="to  pu  \n gg";
$contador=0;
$contador1=0;
$contador2=0;
$contador3=0;
$contador4=0;
$contador5=0;
$ar =fopen("Archivos/palabras.txt","r");
while(!feof($ar))
{
    $cadena2=fgets($ar);
    $arrayCadena=split(" ",$cadena2);
    //$contador=ContadorLetras($cadena);
    
    
    for($i=0;$i<count($arrayCadena)-1;$i++)
    {
        echo $arrayCadena[$i]."<br>";
    }
}
fclose($ar);
/*
$contador=ContadorLetras($cadena);
switch ($contador) {
    case 0:
          echo "to  pu  \n";
        break;
    case 1:
    echo "1";
    $contador1++;
        break;
    case 2:
    echo "2";
    $contador2++;
        
        break;
    case 3:
    echo "3";
    $contador3++;
        
        break;
    case 4:
    echo "4";
    $contador4++;
        break;
    
    default:
    echo "mas4";
    $contador5++;
        break;
        
}
*/
/*
function ContadorLetras($cadena)
{
  $array = str_split($cadena);
  $contadorLetras=0;
  $contadorPalabras=0;
  for($i=0;$i<count($array);$i++)
{
    if(strcmp($array[$i]," ")!=0)
    {
        if(strcmp($array[$i],"\n")!=0)
        {
            $contadorLetras++;
        }
        else
        {
            break;
        }
       
    }
    else
    {
       $contadorPalabras= ContadorPalabras($contadorLetras);
        continue;
    }
}
return $contadorPalabras;
}
function ContadorPalabras($cant)
{
$contador1=0;
$contador2=0;
$contador3=0;
$contador4=0;
$contador5=0;
switch ($cant) {
    case 0:
          echo "to  pu  \n";
        break;
    case 1:
    echo "1";
    $contador1++;
        break;
    case 2:
    echo "2";
    $contador2++;
        
        break;
    case 3:
    echo "3";
    $contador3++;
        
        break;
    case 4:
    echo "4";
    $contador4++;
        break;
    
    default:
    echo "mas4";
    $contador5++;
        break;
        
}
}
*/
?>