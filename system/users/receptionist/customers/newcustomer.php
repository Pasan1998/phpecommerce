<?php ob_start(); ?>

<?php $signup = 'active'; ?>

<?php
include '../../../../webs/header.php';

?> 
<?php include '../../../../webs/assets/phpmail/mail.php'; ?>

<?php
//check form submit method
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    //seperate variables and values from the form
    extract($_POST);

    //data clean
    $Title = cleanInput($Title);
    $cFirstName = cleanInput($FirstName);
    $cLastName = cleanInput($LastName);
    $cEmail = cleanInput($Email);
    $cNIC = cleanInput($NIC);
    $cPassword = cleanInput($Password);
    $cConfirmPassword = cleanInput($ConfirmPassword);
    $cMobile = cleanInput($Mobile);
//    $cGender = cleanInput($Gender);
    $cAddress = cleanInput($Address);
    $cAddress2 = cleanInput($Address2);
    $cCity = cleanInput($City);

    $customerImage = $_FILES['cImage'];

    //create array variable store validation messages
    $messages = array();

    //validate required fields

    if (empty($Title)) {
        $messages['error_title'] = "Customer Title  should not be empty!";
    }

    if (!isset($cGender)) {
        $messages['error_gender'] = "The Gender should be selected..!";
    }

    if (empty($cFirstName)) {
        $messages['error_firstname'] = "Customer First Name should not be empty!";
    }
    if (empty($cLastName)) {
        $messages['error_lastname'] = "Customer Last Name should not be empty!";
    }
    if (empty($cEmail)) {
        $messages['error_email'] = "The email should not be empty..!";
    }
    if (empty($cNIC)) {
        $messages['error_nic'] = "The NIC  should not be empty..!";
    }
    if (empty($cPassword)) {
        $messages['error_password'] = "The Password  should not be empty..!";
    }
    if (empty($cConfirmPassword)) {
        $messages['error_confirmpassword'] = "The confirm password should not be empty..!";
    }
    if (empty($cMobile)) {
        $messages['error_mobile'] = "The mobile should not be empty..!";
    }
//    if (empty($cGender)) {
//        $messages['error_gender'] = "The gender should not be empty..!";
//    }
    if (empty($cAddress)) {
        $messages['error_address'] = "The address should be selected..!";
    }
    if (empty($cCity)) {
        $messages['error_city'] = "The city should be selected..!";
    }

    if ($_FILES['cImage']['name'] == "") {
        $messages['error_cimage'] = "The Images should not be empty..!";
    }



    //adavnced validation

    if (!empty($cNIC)) {

        $niclength = strlen($cNIC);
        if ($niclength == 10 || $niclength == 12) {
            
        } else {
            $messages['error_nic'] = "The NIC  length should 10 or 12!";
        }
    }

    if (!empty($cEmail)) {
        $file_ext = explode(".", $cEmail);
        $file_ext = strtolower(end($file_ext));
        //select allowed file type
        $allowed = array("com", "yahoo", "me");
        //check wether the file type is allowed
        if (in_array($file_ext, $allowed)) {
            
        } else {
            $messages['file_error'] = "Invalid mail type";
        }
    }


    if (!empty($Mobile)) {
        $mobilelength = strlen($Mobile);
        if ($mobilelength == 10) {
            if ($Mobile === '0000000000') {
                $messages['error_mobile'] = "The mobile number all can not be Zeros";
            }
        } else {
            $messages['error_mobile'] = "The mobile bnumber should must have only 10 numbers";
        }
    }

    if (!empty($cEmail)) {
        if (!filter_var($cEmail, FILTER_VALIDATE_EMAIL)) {
            $messages['error_email'] = "The email is not well formatted..!";
        }
    }


    if ($_FILES['cImage']['name'] != "") {
        $customerImage = $_FILES['cImage'];
        $filename = $customerImage['name'];
        $filetmpname = $customerImage['tmp_name'];
        $filesize = $customerImage['size'];
        $fileerror = $customerImage['error'];
        //take file extension
        $file_ext = explode(".", $filename);
        $file_ext = strtolower(end($file_ext));
        //select allowed file type
        $allowed = array("jpg", "jpeg", "png", "gif");
        //check wether the file type is allowed
        if (in_array($file_ext, $allowed)) {
            if ($fileerror === 0) {
                //file size gives in bytes
                if ($filesize <= 40000000) {
                    //giving appropriate file name. Can be duplicate have to validate using function
                    $file_name_new = uniqid('', true) . $cFirstName . $cLastName. '.' . $file_ext;
                    //directing file destination
                    $file_path = "../../../assets/images/customers/" . $file_name_new;
                    //moving binary data into given destination
                    if (move_uploaded_file($filetmpname, $file_path)) {
                        "The file is uploaded successfully";
                    } else {
                        $messages['file_error'] = "File is not uploaded";
                    }
                } else {
                    $messages['file_error'] = "File size is invalid";
                }
            } else {
                $messages['file_error'] = "File has an error";
            }
        } else {
            $messages['file_error'] = "Invalid File type";
        }
    }





    if (!empty($cPassword)) {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $cPassword);
        $lowercase = preg_match('@[a-z]@', $cPassword);
        $number = preg_match('@[0-9]@', $cPassword);
        $specialChars = preg_match('@[^\w]@', $cPassword);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($cPassword) < 8) {
            $messages['error_password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
        }
    }

    if ((!empty($cPassword)) && (!empty($cConfirmPassword))) {

        if ($cPassword != $cConfirmPassword) {
            $messages['error_password'] = " Passwords are not match";
        }
    }


    if (!empty($cEmail)) {
        $sql = "SELECT * FROM tbl_customers WHERE Email='$cEmail'";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            $messages['error_email'] = "This email is already in the database";
        }
    }






    if (empty($messages)) {

        $db = dbConn();
        $cPassword = sha1($cPassword);
        $referencenumber = rand();
        $sql = "INSERT INTO tbl_customers (Title,FirstName,LastName,Email,NIC,Password,Mobile,Gender,Address,Address2,City,ReferenceNumber,CustomerImage) VALUES ('$Title','$cFirstName','$cLastName','$cEmail','$cNIC','$cPassword','$cMobile','$cGender', '$cAddress', '$cAddress2', '$cCity' , '$referencenumber','$file_name_new' )";
        $results = $db->query($sql);

        $to = $cEmail;
        $toname = $Title . $cFirstName . $cLastName;
        $subject = "Welcome to BlueTech Electronics" . $Title . $cFirstName . $cLastName;
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
    <!--[if !mso]><!-- -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap" rel="stylesheet">
    <!--<![endif]-->
</head>

<body>
    <div class="es-wrapper-color">
        <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#ffffff"></v:fill>
			</v:background>
		<![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="esd-email-paddings" valign="top">
                        <table cellpadding="0" cellspacing="0" class="esd-header-popover es-header" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="es-p20t es-p20r es-p20l esd-structure" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="es-m-p0r esd-container-frame" valign="top" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group_90.png" alt="Logo" style="display: block;" height="50" title="Logo"></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" bgcolor="#F3E2D8" style="background-color: #f3e2d8;">
                                        <table class="es-content-body" style="background-color: #f3e2d8;" width="600" cellspacing="0" cellpadding="0" bgcolor="#F3E2D8" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p40b es-p20r es-p20l" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r es-m-p20b esd-container-frame" width="560" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group_89_Ouc.png" alt style="display: block;" width="515"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p30t">
                                                                                        <h1>' . $referencenumber . '</h1>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p20t es-p20b">
                                                                                        <p>Hi! Welcome! Thanks for joining!&nbsp;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-button">
                                                                                        <!--[if mso]><a href="https://viewstripo.email" target="_blank" hidden>
	<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="https://viewstripo.email" 
                style="height:51px; v-text-anchor:middle; width:274px" arcsize="51%" stroke="f"  fillcolor="#bc2919">
		<w:anchorlock></w:anchorlock>
		<center style= "color:#ffffff; font-family:arial, "helvetica neue", helvetica, sans-serif; font-size:18px; font-weight:400; line-height:18px;  mso-text-raise:1px" >START A PROJECT</center>
	</v:roundrect></a>
<![endif]-->
                                                                                        <!--[if !mso]><!-- --><span class="es-button-border msohide"><a href="https://viewstripo.email" class="es-button" target="_blank">START A PROJECT</a></span>
                                                                                        <!--<![endif]-->
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" background="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_T5s.png" style="background-image: url(https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_T5s.png); background-repeat: no-repeat; background-position: center bottom;">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#fef3ed" style="background-color: #fef3ed; border-radius: 45px; border-collapse: separate;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-p30t es-p20b es-p20r es-p20l" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group1.png" alt style="display: block;" height="252"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p10b es-p20r es-p20l">
                                                                                        <h2><a href="https://viewstripo.email" target="_blank">Discover new projects</a></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p30b es-p40r es-p40l es-m-p20r es-m-p20l">
                                                                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" background="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_5Fp.png" style="background-image: url(https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_5Fp.png); background-repeat: no-repeat; background-position: center bottom;">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#fef3ed" style="background-color: #fef3ed; border-radius: 45px; border-collapse: separate;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-p30t es-p20b es-p20r es-p20l" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group2.png" alt style="display: block;" height="252"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p10b es-p20r es-p20l">
                                                                                        <h2><a href="https://viewstripo.email" target="_blank">From idea to market</a></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p30b es-p40r es-p40l es-m-p20r es-m-p20l">
                                                                                        <p>Interdum velit euismod in pellentesque. Nec feugiat in fermentum posuere urna. Velit dignissim sodales ut eu sem integer vitae justo eget. Aliquam eleifend mi in nulla posuere sollicitudin aliquam.</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" background="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_lfP.png" style="background-image: url(https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/mask_group_lfP.png); background-repeat: no-repeat; background-position: center bottom;">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#fef3ed" style="background-color: #fef3ed; border-radius: 45px; border-collapse: separate;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-p30t es-p20b es-p20r es-p20l" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img class="adapt-img" src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group.png" alt style="display: block;" height="252"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p10b es-p20r es-p20l">
                                                                                        <h2><a href="https://viewstripo.email" target="_blank">Start a project</a></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p30b es-p40r es-p40l es-m-p20r es-m-p20l">
                                                                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" esd-custom-block-id="648189">
                                        <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p40t es-p40b es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" align="left" class="esd-container-frame">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p5t es-p5b">
                                                                                        <h2>Questions?</h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p20b">
                                                                                        <p><a href="https://viewstripo.email" target="_blank">Learn more about us</a>&nbsp;and&nbsp;<a href="https://viewstripo.email" target="_blank">sign up to receive updates</a>&nbsp;from our team.</p>
                                                                                        <p>Reply to this email or call to connect with us.</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-button es-p40b"><span class="es-button-border"><a href="tel:" class="es-button" target="_blank">+ (000) 123 456 789</a></span></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-p10t es-p20b" style="font-size: 0px;"><a target="_blank" href="https://viewstripo.email"><img src="https://tlr.stripocdn.email/content/guids/CABINET_0d71d49034ae71e9fc9c6ea70677feb4/images/group_90.png" alt="Logo" style="display: block;" height="40" title="Logo"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-social es-p20b" style="font-size:0">
                                                                                        <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center" valign="top" class="es-p25r"><a target="_blank" href="https://viewstripo.email"><img title="Facebook" src="https://tlr.stripocdn.email/content/assets/img/social-icons/rounded-black/facebook-rounded-black.png" alt="Fb" height="24"></a></td>
                                                                                                    <td align="center" valign="top" class="es-p25r"><a target="_blank" href="https://viewstripo.email"><img title="Twitter" src="https://tlr.stripocdn.email/content/assets/img/social-icons/rounded-black/twitter-rounded-black.png" alt="Tw" height="24"></a></td>
                                                                                                    <td align="center" valign="top" class="es-p25r"><a target="_blank" href="https://viewstripo.email"><img title="Instagram" src="https://tlr.stripocdn.email/content/assets/img/social-icons/rounded-black/instagram-rounded-black.png" alt="Inst" height="24"></a></td>
                                                                                                    <td align="center" valign="top"><a target="_blank" href="https://viewstripo.email"><img title="Youtube" src="https://tlr.stripocdn.email/content/assets/img/social-icons/rounded-black/youtube-rounded-black.png" alt="Yt" height="24"></a></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-menu" esd-tmp-menu-color="#ffffff" esd-tmp-divider="0|solid|#efefef" esd-tmp-menu-font-size="12px">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" class="es-menu">
                                                                                            <tbody>
                                                                                                <tr class="links">
                                                                                                    <td align="center" valign="top" width="25%" class="es-p10t es-p10b es-p5r es-p5l"><a target="_blank" href="https://viewstripo.email">Location</a></td>
                                                                                                    <td align="center" valign="top" width="25%" class="es-p10t es-p10b es-p5r es-p5l"><a target="_blank" href="https://viewstripo.email">Contact</a></td>
                                                                                                    <td align="center" valign="top" width="25%" class="es-p10t es-p10b es-p5r es-p5l"><a target="_blank" href="https://viewstripo.email">Help</a></td>
                                                                                                    <td align="center" valign="top" width="25%" class="es-p10t es-p10b es-p5r es-p5l"><a target="_blank" href="https://viewstripo.email">Privacy</a></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p15t es-p15b">
                                                                                        <p style="font-size: 12px;">You are receiving this email because you have visited our site or asked us about the regular newsletter. Make sure our messages get to your Inbox (and not your bulk or junk folders).<br><a target="_blank" href="https://viewstripo.email/" style="font-size: 12px;">Privacy police</a>&nbsp;|&nbsp;<a target="_blank" style="font-size: 12px;">Unsubscribe</a></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="esd-footer-popover es-footer" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="left">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image es-infoblock made_with" style="font-size:0"><a target="_blank" href="https://viewstripo.email/?utm_source=templates&utm_medium=email&utm_campaign=crowdfunding_2&utm_content=turn_your_ideas_into_reality"><img src="https://tlr.stripocdn.email/content/guids/CABINET_09023af45624943febfa123c229a060b/images/7911561025989373.png" alt width="125" style="display: block;"></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>';
        $alt = "Customer  Registration";
        send_email($to, $toname, $subject, $body, $alt);

        if ($results) {
            echo "";
        }
    }

    if (empty($messages)) {
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '<?= $pName ?>',
                text: 'Product is Created'
            })
        </script>
        <?php ?>
        <?php  header("Location:verify.php");
       
    }

    if (empty($messages)) {
        @$Title = null;
        @$cFirstName = null;
        @$cLastName = null;
        @$cEmail = null;
        @$cNIC = null;
        @$cPassword = null;
        @$cConfirmPassword = null;
        @$cMobile = null;
//    $cGender = cleanInput($Gender);
        @$cAddress = null;
        @$cCity = null;
        @$cGender = null;
    }
}
?>


        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<section id="signup" class="section-bg ">
    <div class="section-title" data-aos="fade-up">
        <h2>AboutUs</h2>
    </div>

    <div class="container" >
        <div class="row d-flex align-items-center justify-content-center ">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="../../../../webs/assets/images/signup.jpg"
                     class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <!-- Email input -->
                    <h1 class="title"> Personal Details </h1>
                    <div class="form-outline mb-4">
                        <div class="form-outline mb-2">
                            <label for="title" class="form-label">Select Title </label>
                            <select id="title" name="Title" class="form-control">
                                <option value="">- -</option>                                
                                <option value="Mr" <?php
                                if (@$Title == "Mr") {
                                    echo "selected";
                                }
                                ?>>Mr.</option>
                                <option value="Miss"<?php
                                if (@$Title == "Miss") {
                                    echo "selected";
                                }
                                ?>>Miss.</option>

                            </select>
                            <div class="text-danger"> <?= @$messages['error_title']; ?></div> 
                        </div>


                        <div class="orm-outline mb-2">
                            <label>Select Gender</label>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="cGender" id="male" value="male" <?php
                                if (@$cGender == 'male') {
                                    echo "checked";
                                }
                                ?>>
                                <label class="form-check-label" for="sell">Male</label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="cGender" id="female" value="female" <?php
                                if (@$cGender == 'female') {
                                    echo "checked";
                                }
                                ?>>
                                <label class="form-check-label" for="female">Female</label>
                            </div>

                            <div class="text-danger"> <?= @$messages['error_gender']; ?></div>
                        </div>


                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">First Name</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="first_name" name="FirstName" value="<?= @$cFirstName; ?>">
                            <div class="text-danger"> <?= @$messages['error_firstname']; ?></div>  
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Last Name</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="last_name" name="LastName" value="<?= @$cLastName; ?>">
                            <div class="text-danger"> <?= @$messages['error_lastname']; ?></div>
                        </div>

                        <div class="form-outline mb-2">
                            <label for="ProductImage" class="form-label">File upload</label>
                            <input class="form-control" type="file" id="ProductImage"  name="cImage">
                            <div class="text-danger"> <?= @$messages['error_cimage']; ?></div>
                            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
                        </div>


                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Email address</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="email_address" name="Email" value="<?= @$cEmail; ?>">
                            <div class="text-danger"> <?= @$messages['error_email']; ?></div>
                            
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">NIC</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="nic_number" name="NIC" value="<?= @$cNIC; ?>">
                            <div class="text-danger"> <?= @$messages['error_nic']; ?></div>
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Password </label>
                            <input type="password" placeholder="" class="form-control form-control-sm" id="password" name="Password" value="<?= @$cPassword; ?>">
                            <div class="text-danger"> <?= @$messages['error_password']; ?></div>
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Confirm Password</label>
                            <input type="password" placeholder="" class="form-control form-control-sm" id="confirm_password" name="ConfirmPassword" value="<?= @$cConfirmPassword; ?>">
                            <div class="text-danger"> <?= @$messages['error_confirmpassword']; ?></div>
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Address Line 1</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="address" name="Address" value="<?= @$cAddress; ?>">
                            <div class="text-danger"> <?= @$messages['error_address']; ?></div>
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Address Line 2</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="address" name="Address2" value="<?= @$cAddress2; ?>">
                            <div class="text-danger"> <?= @$messages['error_address']; ?></div>
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">Mobile Number</label>
                            <input type="text" placeholder="" class="form-control form-control-sm" id="phone" name="Mobile" value="<?= @$cMobile; ?>">
                            <div class="text-danger"> <?= @$messages['error_mobile']; ?></div>
                        </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form1Example13">City</label>
                            <input type="text" class="form-control form-control-sm" id="city" name="City" value="<?= @$cCity; ?>">
                            <div class="text-danger"> <?= @$messages['error_city']; ?></div>
                        </div>



                    </div>

                    <!-- Password input -->




                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted"></p>
                    </div>



                </form>
            </div>
        </div>
    </div>
</section>
</main>
<?php include '../../../footer.php'; ?>

<?php ob_end_flush(); ?>