<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Joseph Bethards
 * Date: 3/7/2018
 * Time: 6:17 PM
 */
require ('/home/jacadeve/public_html/client/landing/db/db.php');

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
    $id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
    $id = $_POST['id'];
} else { // No valid ID, kill the script.
    $id=$_SESSION['bid'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Emergency Contact</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">-->
    <link rel="stylesheet" href="/css/navbarStyle.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">

</head>
<style>
    body{
        font-family: 'Ubuntu Mono', monospace;
        font-size: 20px;
    }

    /* .header{
           margin-right: 2%;
           margin-left: 2%;
           margin-top:1%;

       }
       .nav1{
           padding:0px;
       }
       .navitem2{
           float: right;
       }
       .font{
           font-family: 'Vollkron', serif;
           font-size: 100px;
       }*/
</style>
<body>

<!--############################################################  Navbar goes here ##################################################-->
<?php
include ("../headerUser.html");
?>
<?php
echo "<div class='container'>
<div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom\">

<h1 class='display-3'>$_SESSION[name]</h1></div>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
// Check for a first name:
    if (empty($_POST['FirstNameUpdate'])) {
        $errors[] = 'You forgot to enter a irst name.';
    } else {
        $FirstName = mysqli_real_escape_string($dbc, trim($_POST['FirstName']));
    }
// Check for a last name:
    if (empty($_POST['LastName'])) {
        $errors[] = 'You forgot to enter a last name.';
    } else {
        $LastName = mysqli_real_escape_string($dbc, trim($_POST['LastName']));
    }
// Check for an email address:
    if (empty($_POST['Phone'])) {
        $errors[] = 'You forgot to enter a phone number.';
    } else {
        $Phone = mysqli_real_escape_string($dbc, trim($_POST['Phone']));
    }
    if (empty($_POST['AlternatePhone'])) {
    } else {
        $AlternativePhone = ($_POST['AlternatePhone']);
    }
    if (empty($errors)) {

        $q = "UPDATE `Clients_Emergency_Contacts` SET `first_name`='$FirstName',`last_name`='$LastName',`phone`=$Phone,`alternate_phone`=$AlternativePhone WHERE `emergency_contact_id`=$id;";
        $r = @mysqli_query($dbc, $q);
        if ($r) { // If it ran OK.
            // Print a message:

            echo "<script>location.href = '../landing/updateContact12.php';</script>";
            exit();

        } else {
            echo $errors;// If it did not run OK.
            // Debugging message.
            echo "Please try again";
        }
    }
}

$q = "SELECT `first_name`,`last_name`,`phone`,`alternate_phone` FROM `Clients_Emergency_Contacts` WHERE `emergency_contact_id`=$id;";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
// Get the user's information:
    $row = mysqli_fetch_array($r, MYSQLI_NUM);
    #echo '<form action="edit_med.php" method="post">
    /*<p>Medication: <input type="text" name="Medication" size="15" maxlength="15" value="' . $row[0] . '"></p>
    <p>Dosage: <input type="text" name="Dosage" size="15" maxlength="30" value="' . $row[1] . '"></p>
    <p>Frequency: <input type="text" name="Frequency" size="20" maxlength="60" value="' . $row[2] . '"> </p>
    <p>Time Taken: <input type="text" name="Time_Taken" size="20" maxlength="60" value="' . $row[3] . '"> </p>
    <p><input type="submit" name="submit" value="Submit"></p>
    <input type="hidden" name="id" value="' . $id . '">*/
    /*</form>';*/
    echo"

<form action=\"edit_contact.php\" method=\"post\">
    <div class='modal-header bg-secondary text-light'>
        <h5 class='modal-title'
            id='edit-medication-label'>
            Edit Contact
        </h5>
       
    </div>
    <!-- === Modal Header End ==================================================================================== -->
    <div class='modal-body bg-light p-0 m-0'>

        <ul class='list-group list-group-flush'>

            <!-- === Medication Input ============================================================================== -->
            <li class='list-group-item'>
                <div class='d-flex w-100 justify-content-between'>
                    <label class='h5'
                           for='medication-edit-input-medication'>
                        First Name
                    </label>
                   
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='medication-edit-input-medication'
                           name='FirstName'
                           type='text'
                           value='$row[0]'
                           aria-label='Medication'
                           required>
                    
                </div>

            </li>
            <!-- === Medication Input End ========================================================================== -->

            <!-- === Dosage Input ================================================================================== -->
            <li class='list-group-item '>
                <div class='d-flex w-100 justify-content-between'>
                    <label class='h5'
                           for='medication-edit-input-dosage'>
                        Last Name
                    </label>
                    
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='medication-edit-input-dosage'
                           name='LastName'
                           type='text'
                           value='$row[1]'
                           aria-label='Dosage'
                           required>
                    
                </div>

            </li>
            <!-- === Dosage Input End ============================================================================== -->

            <!-- === Frequency Input =============================================================================== -->
            <li class='list-group-item'>
                <div class='d-flex w-100 justify-content-between'>
                    <label class='h5'
                           for='medication-edit-input-frequency'>
                        Phone
                    </label>
                  
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='medication-edit-input-frequency'
                           name='Phone'
                           type='text'
                           value='$row[2]'
                           aria-label='Frequency'
                           required>
                   
                </div>

            </li>
            <!-- === Frequency Input End =========================================================================== -->

            <!-- === Time Taken Input ============================================================================== -->
            <li class='list-group-item '>
                <div class='d-flex w-100 justify-content-between'>
                    <label class='h5'
                           for='medication-edit-input-time-taken'>
                        Alternate Phone
                    </label>
                   
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='medication-edit-input-time-taken'
                           name='AlternatePhone'
                           type='text'
                            value='$row[3]'
                           aria-label='Time Taken'
                           >
                   
                </div>

            </li>
            <!-- === Time Taken Input End ========================================================================== -->

        </ul>

    </div>
    <!-- === Button Toolbar ====================================================================================== -->
    <div class='modal-footer bg-secondary btn-toolbar'>
        <a href='updateContact12.php'><button class='btn btn-danger'
                type='button'
                data-dismiss='modal'>
            Cancel
        </button></a>
        <button class='btn btn-success btn-lg'
                type='submit'>
            Confirm Edit
        </button>
    </div>
</form>
</div>

";
}
echo"</div>";
$_SESSION['bid']=$id;
?>
<?php
require_once ('../footer.html');
?>