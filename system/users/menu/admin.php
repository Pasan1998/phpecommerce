<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                            <div class="text-center text-info"><h4> Bluetech Electronics</h4></div>
                            <li class="nav-item">
                                <a class="nav-link <?= $dashboard ?>" aria-current="page" href="<?= SYSTEM_PATH ?>index.php">
                                    <span data-feather="home" class="align-text-bottom"></span>
                                    Dashboard
                                </a>
                            </li>
                            
                            <li class="nav-item "   >
                                <a class="nav-link <?= $usermanagement ?>" href="<?= SYSTEM_PATH ?>users/admin/userManagement.php">
                                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                                    User Management
                                </a>
                            </li>
                             <li class="nav-item "   >
                                <a class="nav-link" href="<?= SYSTEM_PATH ?>users/admin/customers/customers.php">
                                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                                    customer Management
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="layers" class="align-text-bottom"></span>
                                    Reviews Management
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= SYSTEM_PATH ?>redeemcode/redeemcode.php">
                                    <span data-feather="layers" class="align-text-bottom"></span>
                                    Reedeme codes Management
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="layers" class="align-text-bottom"></span>
                                    Promotional messages
                                </a>
                            </li>
                        </ul>                 
                    </div>
                </nav>
