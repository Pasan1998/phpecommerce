<?php
session_start();
if (!isset($_SESSION['UserId'])) {
    header("Location:login.php");
}
include 'config.php';
include 'function.php';
//include 'logout.php';

if (isset($_SESSION['loggedinTime'])) {
    if(time()-$_SESSION['loggedinTime'] >9000){
        
        header("Location:logout.php");
        
    }
    
}


?>
<!doctype html>


<html lang="en">
    <head>
        
       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> <?php
            $Usersroles= $_SESSION['UserRole'] ;
            $Usersroles= strtoupper($Usersroles);
            echo $Usersroles;
            ?>
        </title>
         <link href="<?= SYSTEM_PATH ?>assets/images/asd.png" rel="icon">

        <link href="<?= SYSTEM_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet" >
        <link href="<?= SYSTEM_PATH ?>assets/css/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="<?= SYSTEM_PATH ?>assets/css/card.css" rel="stylesheet" type="text/css"/>
        <link href="<?= SYSTEM_PATH ?>assets/css/mangerCard.css" rel="stylesheet" type="text/css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top  flex-md-nowrap p-0 shadow">
        
         <img class="logoimge" src="<?= SYSTEM_PATH ?>assets/images/asd.png">
           
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="col-sm-3 text-lg-start">
                Welcome <?= $_SESSION['FirstName'] . " " . $_SESSION['LastName'] ?>
            </div>
<!--            <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">-->
         
          <div class="navbar-nav">
                <div class="nav-item text-end ">
                    <a class="nav-link px-3 text-bg-warning" href="<?= SYSTEM_PATH ?>users/profile.php?UserId=<?= $_SESSION['UserId']?>">Profile</a>
                </div>
            </div>
            <div class="navbar-nav">
                <div class="nav-item text-end ">
                    <a class="nav-link px-3 text-bg-warning" href="<?= SYSTEM_PATH ?>logout.php">Sign out</a>
                </div>
            </div>
        </header>
        <div class="container-fluid">
            <div class="row">