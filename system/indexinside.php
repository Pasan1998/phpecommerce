<?php
ob_start();
?>


        

        <?php
        $role = "manager";
        $msg = null;
        $menu = null;

        switch ($role) {
            case 'manager':
                $msg = "Manager";
                $menu = "menu_manager.php";
                break;
            case 'admin':
                $msg = "Administrator";
                $menu = "menu_admin.php";
                break;
            case 'accountant':
                $msg = "Accountant";
                $menu = "menu_accountant.php";
                break;
            default :
                header("Location:login.php");
        }
        ?> 

        

                <?php
                    include $menu;
                ?>
                
            

<?php
ob_end_flush();
?>