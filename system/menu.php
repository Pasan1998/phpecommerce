<?php 

 $userrole = $_SESSION['UserRole'];
 echo $userrole;
 
 $menu= "users/menu/$userrole.php";
 //assign menu variable to a particular menu checking the which user is logged on.
 
 include $menu;
 // calling to to above menu variable
 
?>