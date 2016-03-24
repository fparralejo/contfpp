<?php
// Fichero que recibe un parámetro un numero con la página y devuleve los datos asociados a esa página

// Pagina a visualizar
$pagina = $_GET['pagina'];

// Array de 50 elementos
$mensajes = array('Texto de un mensaje numero 1','Texto de un mensaje numero 2','Texto de un mensaje numero 3','Texto de un mensaje numero 4','Texto de un mensaje numero 5','Texto de un mensaje numero 6','Texto de un mensaje numero 7','Texto de un mensaje numero 8','Texto de un mensaje numero 9','Texto de un mensaje numero 10','Texto de un mensaje numero 11','Texto de un mensaje numero 12','Texto de un mensaje numero 13','Texto de un mensaje numero 14','Texto de un mensaje numero 15','Texto de un mensaje numero 16','Texto de un mensaje numero 17','Texto de un mensaje numero 18','Texto de un mensaje numero 19','Texto de un mensaje numero 20','Texto de un mensaje numero 21','Texto de un mensaje numero 22','Texto de un mensaje numero 23','Texto de un mensaje numero 24','Texto de un mensaje numero 25','Texto de un mensaje numero 26','Texto de un mensaje numero 27','Texto de un mensaje numero 28','Texto de un mensaje numero 29','Texto de un mensaje numero 30','Texto de un mensaje numero 31','Texto de un mensaje numero 32','Texto de un mensaje numero 33','Texto de un mensaje numero 34','Texto de un mensaje numero 35','Texto de un mensaje numero 36','Texto de un mensaje numero 37','Texto de un mensaje numero 38','Texto de un mensaje numero 39','Texto de un mensaje numero 40','Texto de un mensaje numero 41','Texto de un mensaje numero 42','Texto de un mensaje numero 43','Texto de un mensaje numero 44','Texto de un mensaje numero 45','Texto de un mensaje numero 46','Texto de un mensaje numero 47','Texto de un mensaje numero 48','Texto de un mensaje numero 49','Texto de un mensaje numero 50');


// Devuelvo 10 elementos por página

$posicion = ($pagina-1)*10;


for ($x=0; $x<10; $x++) {
 echo "<div class='mensaje'>";
 echo $mensajes[$posicion+$x];
 echo "</div>";
}


?>