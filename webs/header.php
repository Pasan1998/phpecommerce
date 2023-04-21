<?php
ob_start();
session_start();
include 'function.php';
include 'config.php';

if (isset($_SESSION['signedinTime'])) {
    if(time()-$_SESSION['signedinTime'] >100000){
        
        header('Location:logout.php');
      
        
    }
    
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BlueTech Electronics</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons --> 
   <link href="<?= SYSTEM_PATHS ?>assets/images/asd.png" rel="icon">
        <link href="<?= SYSTEM_PATHS ?>assets/images/asd.png" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

      <!-- Vendor CSS Files -->
      <link href="<?= SYSTEM_PATHS ?>assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="<?= SYSTEM_PATHS ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= SYSTEM_PATHS ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="<?= SYSTEM_PATHS ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="<?= SYSTEM_PATHS ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="<?= SYSTEM_PATHS ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="<?= SYSTEM_PATHS ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="<?= SYSTEM_PATHS ?>assets/css/card.css" rel="stylesheet" type="text/css"/>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>

        <!-- Template Main CSS File -->
        <link href="<?= SYSTEM_PATHS ?>assets/css/style.css" rel="stylesheet"> 
        <link href="<?= SYSTEM_PATHS ?>assets/css/signup.css" rel="stylesheet">


</head>

<body>
    <?php
    ob_end_flush();
    ?>