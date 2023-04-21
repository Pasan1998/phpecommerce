


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">

                        <div class="text-center text-info">
                            <h4 class="logoname"> Bluetech Electronics</h4></div>
                            
                            <img src="<?= SYSTEM_PATH ?>assets/images/asd.png" class="img-fliud menuround">
                            
                            
                            <li class="nav-item">
                                <a class="nav-link <?= $dashboard ?>"   aria-current="page" href="<?= SYSTEM_PATH ?>index.php">
                                    <span data-feather="home" class="align-text-bottom"></span>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $product ?>" href="<?= SYSTEM_PATH ?>products/products.php" >
                                    <span data-feather="file" class="align-text-bottom"></span>
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $categorypagemenu ?>" href="<?= SYSTEM_PATH ?>category/categories.php">
                                    <span data-feather="file" class="align-text-bottom"></span>
                                    Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $orders ?>" href="<?= SYSTEM_PATH ?>orders/orders.php">
                                    <span data-feather="file" class="align-text-bottom"></span>
                                    Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= SYSTEM_PATH ?>faq/faq.php">
                                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                    Manage FAQ's
                                </a>
                            </li>    
                             <li class="nav-item">
                                <a class="nav-link <?= $sucessstorymenu ?>" href="<?= SYSTEM_PATH ?>sucessstories/allsuccesstories.php">
                                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                    Success Stories
                                </a>
                            </li>  
                              <li class="nav-item">
                                <a class="nav-link" href="<?= SYSTEM_PATH ?>sucessstories/allsuccesstories.php">
                                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                    Service management
                                </a>
                            </li> 
                             <li class="nav-item">
                                <a class="nav-link" href="<?= SYSTEM_PATH ?>preorders/allpreorders.php">
                                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                    Add Pre-Order Products
                                </a>
                            </li>  
                              <li class="nav-item">
                                <a class="nav-link <?= $review ?>" href="<?= SYSTEM_PATH ?>reviews/reviews.php">
                                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                    Review Management
                                </a>
                            </li>  
                              <li class="nav-item">
                                <a class="nav-link" href="<?= SYSTEM_PATH ?>sucessstories/allsuccesstories.php">
                                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                    Customer points 
                                </a>
                            </li> 
                    </div>
                </nav>

