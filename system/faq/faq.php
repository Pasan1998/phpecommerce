<?php ob_start(); ?>

<?php $product = 'active'; ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 
<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage Products</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>faq/faqnew.php" class="btn btn-sm btn-outline-secondary">New FAQ</a>

                </div>
     

            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
</main>