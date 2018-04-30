<?php 
class Foo 
{ 
    function Var1() { 
	
	 echo "<hr>Esto es Var1<br><hr>"; 
        $name = "Bar"; //esta linea referencia al metodo Bar guardandolo en la variable name
        $this->$name(); // Esto llama al método Bar()  ; para esto es necesario agregar () a la variable
    } 
     
    function Bar(){ 
        echo "Esto es Bar<br><hr>"; 
    } 
} 

echo "<hr>Esto es Principal <br>"; 
$foo = new Foo(); 
$funcname = "Var1"; 
$foo->$funcname();  // Esto llama a $foo->Var() 
?> 
