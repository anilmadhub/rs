<?php

if($_SERVER['SERVER_NAME']=='localhost')
{
define( 'DB_HOST', 'localhost' );  
define( 'DB_USER', 'root' );  
define( 'DB_PASS', '' );  
define( 'DB_NAME', 'resa_planning' );  	
}
else{
define( 'DB_HOST', 'mysql5-33.90' );  
define( 'DB_USER', 'datacallresav2' );  
define( 'DB_PASS', 'r3s4data' );  
define( 'DB_NAME', 'datacallresav2' );  
}
?>