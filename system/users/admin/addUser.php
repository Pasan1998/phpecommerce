<?php ob_start();?>
<?= $usermanagement='active';?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<?php include '../../assets/phpmail/mail.php'; ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New User</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>users/admin/userManagement.php" class="btn btn-sm btn-outline-secondary">View users</a>

            </div>  
        </div>
    </div>

    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


    //seperate variables and values from the form
    extract($_POST);

    //data clean
    $uTtile = cleanInput($Title);
    $uFirstName = cleanInput($FirstName);
    $uLastName = cleanInput($LastName);
    $Email = cleanInput($Email);
    $uPassword = cleanInput($Password);
    $confirmPassword = cleanInput($confirmPassword);
    $uUserRole = cleanInput($UserRole);
    $uStatus = cleanInput($Status);
    $userimage = $_FILES['uImage'];
    //                      $uAddDate = date ('Y-m-d',strtotime(cleanInput($AddDate)));
    //$uAddUser = cleanInput($AddUser);
    //create array variable store validation messages
    $messages = array();

    //validate required fields
    if (empty($uTtile)) {
    $messages['error_uTtile'] = "The User's title should not be empty..!";
    }

    if (empty($uFirstName)) {
    $messages['error_uFirstName'] = "The User's FirstName should not be empty..!";
    }

    if (empty($uLastName)) {
    $messages['error_uLastName'] = "The User's LastName should not be empty..!";
    }

    if (empty($Email)) {
    $messages['error_email'] = "The User's email should not be empty..!";
    }

    if (empty($uPassword)) {
    $messages['error_uPassword'] = "The User's Password should not be empty..!";
    }

    if (empty($confirmPassword)) {
    $messages['error_uconfirmPassword'] = "The User's confirm Password should not be empty..!";
    }

    if (empty($uUserRole)) {
    $messages['error_uUserRole'] = "The User's UserRole should not be empty..!";
    }

    if (empty($uStatus)) {
    $messages['error_uStatus'] = "The User's Status should be selected..!";
    }



    if ($_FILES['uImage']['name'] == "") {
    $messages['error_uimage'] = "The Images should not be empty..!";
    }




    if (!empty($uPassword)) {
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $uPassword);
    $lowercase = preg_match('@[a-z]@', $uPassword);
    $number = preg_match('@[0-9]@', $uPassword);
    $specialChars = preg_match('@[^\w]@', $uPassword);
    if (!$uppercase ||!$lowercase ||!$number ||!$specialChars || strlen($uPassword) < 8) {
    $messages['error_uPassword'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
    }
    }

    if ((!empty($uPassword)) && (!empty($confirmPassword))) {

    if ($uPassword != $confirmPassword) {
    $messages['error_uPassword'] = " Passwords are not match";
    }
    }

    if ($_FILES['uImage']['name'] != "") {
    $userimage = $_FILES['uImage'];
    $filename = $userimage['name'];
    $filetmpname = $userimage['tmp_name'];
    $filesize = $userimage['size'];
    $fileerror = $userimage['error'];
    //take file extension
    $file_ext = explode(".", $filename);
    $file_ext = strtolower(end($file_ext));
    //select allowed file type
    $allowed = array("jpg", "jpeg", "png", "gif", "jfif");
    //check wether the file type is allowed
    if (in_array($file_ext, $allowed)) {
    if ($fileerror === 0) {
    //file size gives in bytes
    if ($filesize <= 2097152) {
    //giving appropriate file name. Can be duplicate have to validate using function
    $file_name_new = uniqid('', true) . $uFirstName . '.' . $file_ext;
    //directing file destination
    $file_path = "../../assets/images/users/" . $file_name_new;
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



    if (!empty($Email)) {
    $sql = "SELECT * FROM tbl_users WHERE Email='$Email'";
    $db = dbConn();
    $results = $db->query($sql);
    if ($results->num_rows > 0) {
    $messages['error_email'] = "This email is already in the database";
    }
    }





    if (empty($messages)) {
    
    $db = dbConn();
    $uPassword = sha1($uPassword);
    $referencenumber = rand();
    $AddUser = $_SESSION['UserId'];
    $AddDate = date('Y-m-d');
    //$insertuser = "INSERT INTO tbl_users (Title, FirstName, LastName, UserName, Password, UserRole, Status, AddDate, AddUser) VALUES ('$uTtile','$uFirstName','$uLastName','$uPassword','$uUserRole','$uStatus','$uAddDate','$uAddUser') ";
    $insertuser = "INSERT INTO tbl_users (Title,FirstName,LastName,Email,Password,UserRole,Status,UserImage, ReferenceNumber, AddUser,AddDate) VALUES ('$uTtile','$uFirstName','$uLastName','$Email','$uPassword',  '$uUserRole','$uStatus','$file_name_new', '$referencenumber', '$AddUser','$AddDate') ";
    $result = $db->query($insertuser);
    
     $uUserRole = null;
    $uStatus = null;
    
    if ($insertuser) {
    echo"<div class='text-success'><h2>User Created Succesfully<h2></div > ";
    print_r($insertuser);
    } else {
    echo "data inserted unsucess";
    }
    }

    if (empty($messages)) {
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $uFirstName ?>',
            text: '<?php $uFirstName ?> User  is Created'
        })
    </script>

    <?php
    }

    if(empty($messages)){

    
    $to = $Email;
    $toname = $uTtile . $uFirstName . $uLastName;
    $subject = "Welcome to BlueTech Electronics" . $uTtile . $uFirstName . $uLastName;
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
                                                                                        <h1></h1>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p20t es-p20b">
                                                                                    <h2>'.$referencenumber.'</h2>
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
    $alt = "User   Registration";
    send_email($to, $toname, $subject, $body, $alt);

    if ($results) {
    echo "results available";
    }


    }

    

    if (empty($messages)) {
    $uTtile = null;
    $uFirstName = null;
    $uLastName = null;
    $Email = null;
    $uPassword = null;
    $confirmPassword = null;
    $uUserRole = null;
    $uStatus = null;
    
    header('location:addUser.php');
    }

    }
    ?>


    <form method="POST" class="col-md-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  enctype="multipart/form-data" >

        <div class="mb-3">
            <label for="title" class="form-label">Select Title </label>
            <select id="title" name="Title" class="form-control">
                <option value="">--</option>                                
                <option value="Mr" <?php
                if (@$Title == 'Mr') {
                    echo "selected";
                }
                ?> >Mr.</option>
                <option value="Miss" <?php
                if (@$Title == 'Miss') {
                    echo "selected";
                }
                ?> >Miss</option>
                <option value="Mrs" <?php
                        if (@$Title == 'Mrs') {
                            echo "selected";
                        }
                ?> >Mrs</option>
            </select>
            <div class="text-danger"> <?= @$messages['error_uTtile']; ?></div>
        </div>


        <div class="mb-3">
            <label for="first_name" class="form-label">Enter First Name</label>
            <input type="text" class="form-control" id="first_name" name="FirstName" value="<?= @$uFirstName; ?>">
            <div class="text-danger"> <?= @$messages['error_uFirstName']; ?></div>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Enter Last Name</label>
            <input type="text" class="form-control" id="last_name" name="LastName" value="<?= @$uLastName; ?>">
            <div class="text-danger"> <?= @$messages['error_uLastName']; ?></div>
        </div>

        <div class="mb-3">
            <label for="UserImage" class="form-label">File upload</label>
            <input class="form-control" type="file" id="UserImage"  name="uImage">
            <div class="text-danger"> <?= @$messages['error_uimage']; ?></div>
            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
        </div>

        <div class="mb-3">
            <label for="user_email" class="form-label">Enter  Email</label>
            <input type="email" class="form-control" id="user_email" name="Email" value="<?= @$Email; ?>">
            <div class="text-danger"> <?= @$messages['error_email']; ?></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Enter Password </label>
            <input type="password" class="form-control" id="password" name="Password" value="<?= @$uPassword; ?>">
            <div class="text-danger"> <?= @$messages['error_uPassword']; ?></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Enter Confirm Password </label>
            <input type="password" class="form-control" id="password" name="confirmPassword" value="<?= @$confirmPassword; ?>">
            <div class="text-danger"> <?= @$messages['error_uPassword']; ?></div>
        </div>

        <div class="mb-3">
            <label for="user_role" class="form-label">Select User Role</label>
            <select id="user_role" name="UserRole" class="form-control">
                <option value="">--</option>                                
                <option value="admin" <?php
                if (@$UserRole == "admin") {
                    echo "selected";
                }
                ?> >Admin</option>
                <option value="manager" <?php
                if (@$UserRole == "manager") {
                    echo "selected";
                }
                ?> >Manager</option>
                <option value="ordercollector" <?php
                        if (@$UserRole == "ordercollector") {
                            echo "selected";
                        }
                        ?> >Order Collector</option>
                <option value="orderdistributor" <?php
                if (@$UserRole == "orderdistributor") {
                    echo "selected";
                }
                ?> >Order Distributor</option>
                <option value="storekeeper" <?php
                if (@$UserRole == "storekeeper") {
                    echo "selected";
                }
                ?> >Store Keeper</option>
                <option value="returnofficer" <?php
                        if (@$UserRole == "returnofficer") {
                            echo "selected";
                        }
                ?> >Return Officer</option>
                
                <option value="accountant" <?php
                        if (@$UserRole == "accountant") {
                            echo "selected";
                        }
                ?> >Accountant</option>
                
                <option value="owner" <?php
                if (@$UserRole == "owner") {
                    echo "selected";
                }
                ?> >Owner</option>
                
                <option value="warrantyofficer" <?php
                if (@$UserRole == "warrantyofficer") {
                    echo "selected";
                }
                ?> >Warranty Officer</option>
                
                <option value="repiarofficer" <?php
                if (@$UserRole == "repiarofficer") {
                    echo "selected";
                }
                ?> >Repair Officer</option>
                
                <option value="receptionist" <?php
                if (@$UserRole == "receptionist") {
                    echo "selected";
                }
                ?> >Receptionist</option>
                
                
            </select>
            <div class="text-danger"> <?= @$messages['error_uUserRole']; ?></div>
        </div>

        <div class="mb-3">
            <label for="Status" class="form-label">Select User Status</label>
            <select id="Status" name="Status" class="form-control">
                <option value="">--</option>                                
                <option value="1" <?php
                if (@$Status == "1") {
                    echo "selected";
                }
                ?> >Active</option>
                <option value="2" <?php
                if (@$Status == "2") {
                    echo "selected";
                }
                ?>>Inactive</option>
                <option value="3" <?php
                if (@$Status == "3") {
                    echo "selected";
                }
                ?>>Blocked</option>

            </select>
            <div class="text-danger"> <?= @$messages['error_uStatus']; ?></div>
        </div>





        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>

<?php include '../../footer.php'; ?>

<?php   ob_end_flush()?>