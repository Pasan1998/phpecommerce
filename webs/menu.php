<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center" style="background-color: #6c9eff">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h1 style="color: #ffffff;"><a href="<?= SYSTEM_PATHS ?>index.php">Blue Electronics</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar text-center align-items-center justify-content-between">
            <ul>
                <li class="text-center align-items-center justify-content-center"><a class="nav-link  text-center <?= $home ?>" href="<?= SYSTEM_PATHS ?>index.php">Home</a></li>
                <li><a class="nav-link scrollto <?= $about ?>" href="<?= SYSTEM_PATHS ?>about.php">About</a></li>
                <!-- <?php
                if (isset($_SESSION['products'])) {
                    ?> <div class="nav-item text-end ">
                           <a class="nav-link scrollto" href="cart.php">Cart</a>
                       </div><?php } else {
                ?>
                    <?php
                }
                ?> -->


                <li><a class="nav-link scrollto <?= $shop ?>" href="<?= SYSTEM_PATHS ?>shop.php">Shop</a></li>

                <?php
                if (isset($_SESSION['CustomerId'])) {
                    ?> <div class="nav-item text-end ">
                        <a class="nav-link scrollto " href="">Wishlist</a>
                    </div><?php
                }
                ?>


                <li></li>


                <?php
                if (!isset($_SESSION['CustomerId'])) {
                    ?> <div class="nav-item text-end ">
                        <a class="nav-link scrollto <?= $signup ?>" href="<?= SYSTEM_PATHS ?>signup/signup.php">SignUp</a>
                    </div><?php
                }
                ?>

                <?php
                if (!isset($_SESSION['CustomerId'])) {
                    ?> <div class="nav-item text-end ">
                        <a class="nav-link scrollto <?= $signin ?>" href="<?= SYSTEM_PATHS ?>signin/signin.php">SigniIn</a>
                    </div><?php
                }
                ?>




                <li><a class="nav-link scrollto" href="#">services</a></li>                  





                <li><a class="nav-link scrollto" href="<?= SYSTEM_PATHS ?>contact.php">Contact</a></li>
                <!--                <?php
//                $abc = 10;
//                 if(isset($_SESSION['products'])){
                ?>
                                      <li><a class="getstarted scrollto disabled" href="cart.php">Cartzz //<?php
//                        $totalqty = 0;
//                        if (isset($_SESSION['products'])) {
//                            foreach ($_SESSION['products'] as $key => $value) {
//                                $totalqty += $value['qty'] * $value['price'];
//                            }
//                        }
//                        echo number_format($totalqty);
//                        
                ?></a></li> <?php//                } else { ?>
                                      <li><a class="getstarted scrollto disabled" href="">Cartxx <?php
                ?></a></li><?php
//                }
                ?>
                -->



                <?php
                if (isset($_SESSION['products'])) {
                    ?> <div class="nav-item text-end ">
                        <a class="getstarted scrollto" href="<?= SYSTEM_PATHS ?>cart.php">Cart Rs <?php
                $totalqty = 0;
                if (isset($_SESSION['products'])) {
                    foreach ($_SESSION['products'] as $key => $value) {
                        $totalqty += $value['qty'] * $value['price'];
                    }
                }
                echo number_format($totalqty);
                    ?></a>

                    </div><?php } else {
                        ?>
                    <?php
                }
                ?>

                
                
                
                <?php
                if (isset($_SESSION['CustomerId'])) {?>
                    
                     <li class="dropdown"><a href="#"><span><?= @$_SESSION['First_Name'] . " " . @$_SESSION['Last_Name'] ?></span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="<?= SYSTEM_PATHS ?>customer/customerDashboard.php?CustomerId=<?= @$_SESSION['CustomerId'] ?> ">Profile</a></li>
<!--                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>-->
                        <li><a href="<?= SYSTEM_PATHS ?>logout.php">Signout</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li><?php
                    
                }else{
                    
                }
                ?>
                
                
               


<!--                <a class="nav-link scrollto" href="<?= SYSTEM_PATHS ?>customer/customerDashboard.php?CustomerId=<?= @$_SESSION['CustomerId'] ?> "><?= @$_SESSION['First_Name'] . " " . @$_SESSION['Last_Name'] ?></a></li>-->

                     <?php 
                               if (isset($_SESSION['CustomerId'])) {?>

                                   <li><img style="width:50px; height: 30px; border-radius: 20px;" src="<?= SYSTEM_PATHS ?>../system/assets/images/customers/<?= $_SESSION['CustomerImage'] ?>"></li> <?php
                                }
                                ?>
            
             

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
