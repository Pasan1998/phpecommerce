<?php
 
include 'header.php';
include 'menu.php';

$_SESSION['coddetails']= 'yes';
print_r(@$_SESSION);
?>


<section id="signup" class="section-bg ">
    <div class="section-title" data-aos="fade-up">
        <h2>AboutUs</h2>
    </div>

    <div class="container" >
        <div class="row d-flex align-items-center justify-content-center ">
            
             <h1 class="title"> Your order has been confirmed </h1>
            <div class="col-md-8 col-lg-7 col-xl-6">
                <h3>Thank you for trusting us</h3>
                    
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
               
            </div>
        </div>
    </div>
</section>
<?php // print_r(@$_SESSION[$sql2]);?>