<?php 
function foo(){ 
    echo "En foo() <br>"; 
} 

function bar($arg = '') { //funcion con argumento definido
    echo "En bar(); el argumento es '$arg' <br>"; 
} 

function echoit($string){ 
    echo $string." en echoit"; 
} 

$func = "foo";  //variable que referencia a la función foo
$func();        // Llama a foo() 
$func = "bar"; //variable que referencia a la función bar
$func("parametro 1");  // Llama a bar() 
$func = "echoit"; //variable que referencia a la función echoit
$func("parametro 2");  // Llama a echoit() 
?> 