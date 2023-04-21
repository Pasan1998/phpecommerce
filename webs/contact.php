<?php ob_start();?>
<?php $contact='active';?>

<?php include 'header.php';?>
<?php
include 'menu.php';
?>

<!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Contact Us</h2>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-about">
                        <!--                        <h3>Location</h3>-->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15845.047240424587!2d79.9717652!3d6.8591928!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25175d80c314d%3A0xe8202f13266f417a!2sBlueTech%20Electronics!5e0!3m2!1sen!2slk!4v1678259350788!5m2!1sen!2slk" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>

                        <div class="social-links">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="info">
                        <div>
                            <i class="ri-map-pin-line"></i>
                            <p>136/1/A ,  Horahena Rd,<br> Pannipitiya</p>
                        </div>

                        <div>
                            <i class="ri-mail-send-line"></i>
                            <p>info@blutechelectronics.com</p>
                        </div>

                        <div>
                            <i class="ri-phone-line"></i>
                            <p>077 920 0480</p>
                        </div>

                    </div>
                </div>

                <?php
                //check form submit method
                if ($_SERVER['REQUEST_METHOD'] == "POST") {


                    //seperate variables and values from the form
                    extract($_POST);

                    //data clean
                        $name = cleanInput($name);
                        $email = cleanInput($email);
                        $mobile = cleanInput($mobile);
                        $subject = cleanInput($subject);
                        $message = cleanInput($message);
               

                    //create array variable store validation messages
                    $messages = array();

                    //validate required fields
                    if (empty($name)) {
                        $messages['error_name'] = "The Name should not be empty..!";
                    }

                    if (empty($email)) {
                        $messages['error_email'] = "The email should not be empty..!";
                    }
                    if (empty($mobile)) {
                        $messages['error_mobile'] = "The Mobile Category should not be empty..!";
                    }

                    if (empty($subject)) {
                        $messages['error_subject'] = "The Subject qty should not be empty..!";
                    }

                    if (empty($message)) {
                        $messages['error_message'] = "The Message should not be empty..!";
                    }

                }
                ?>

                <div class="col-lg-5 col-md-12" data-aos="fade-up" data-aos-delay="300">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  class="php-email-form">
                        <div class="form-group">
                            <div class="text-danger"> <?= @$messages['error_name']; ?></div>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" >
                            
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" >
                            <div class="text-danger"> <?= @$messages['error_email']; ?></div>
                        </div>
                        
                        <div class="form-group">
                            <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Your Number" >
                            <div class="text-danger"> <?= @$messages['error_mobile']; ?></div>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" >
                            <div class="text-danger"> <?= @$messages['error_subject']; ?></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" ></textarea>
                            <div class="text-danger"> <?= @$messages['error_message']; ?></div>
                        </div>

                         <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

     <?php include 'footer.php'; ?>
<?php ob_end_flush();?>