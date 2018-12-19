<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Joseph Bethards
 * Date: 2/18/2018
 * Time: 6:07 PM
 */
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
    <style>
        body{
            font-family: 'Ubuntu Mono', monospace;
            font-size: 20px;
        }
    </style>
</head>
<body>

<!--############################################################  Navbar goes here ##################################################-->
<?php
include ("../headerUser.html");
?>
<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

            <?php
            echo "<h1 class='display-3'>$_SESSION[name]</h1>";
            echo "</div>";

            echo "<h1 class='j h2 marg'>Emergency Information</h1>";
           
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                require("/home/jacadeve/public_html/client/landing/db/db.php");
                if (empty($_POST['first_name'])) {
                    $errors[] = 'You forgot to enter your first name.';
                    echo "<p>Please enter a emergency first name</p>";

                } else {
                    $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
                }
                if (empty($_POST['last_name'])) {
                    $errors[] = 'You forgot to enter a last name.';
                    echo "<p>Please enter a emergency last name</p>";
                } else {
                    $last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
                }
                // Check for phone number:
                if (empty($_POST['phone_number'])) {
                    $errors[] = 'You forgot to enter a phone number.';
                    echo "<p>Please enter a emergency phone number.</p>";
                } else {

                    $tempPhone = preg_replace("/[^0-9]/", "", $_POST['phone_number']);
                    //checks is it valid length of the phone number, if yes, it assigns the variable
                    if (strlen($tempPhone) >= 10 || strlen($tempPhone) <= 11) {
                        $phone_number = mysqli_real_escape_string($dbc, trim($tempPhone));
                    } else {
                        $errors[] = "Please enter valid phone number with 10 or 11 numbers.";
                    }
                }
                //checking the alternative phone number
                if (empty($_POST['alternative_phone_number'])) {
                    $alternative_phone_number = null;
                } else {
                    $tempAltNumber = preg_replace("/[^0-9]/", "", $_POST['alternative_phone_number']);
                    $alternative_phone_number = mysqli_real_escape_string($dbc, trim($tempAltNumber));
                }

                if (empty($errors)) { // If everything's OK.
                    // Register the user in the database...
                    // Make the query:
                    if($alternative_phone_number !=null) {
                        $q = "INSERT INTO Clients_Emergency_Contacts (client_id, first_name, last_name, phone, alternate_phone) VALUES (" . $_SESSION['clientid'] . ", '$first_name','$last_name',$phone_number,$alternative_phone_number)";
                    }
                    if($alternative_phone_number ==null){
                        $q = "INSERT INTO Clients_Emergency_Contacts (client_id, first_name, last_name, phone) VALUES (" . $_SESSION['clientid'] . ", '$first_name','$last_name',$phone_number)";
                    }
                    $r = @mysqli_query($dbc, $q); // Run the query.
                    if ($r) { // If it ran OK.
                        // Print a message:
                        $full_name = $first_name . ' ' . $last_name;
                        echo "<p>Thank You, Your information has been posted</p>";
                        echo "<p> Emergency Contact Name: $full_name</p>";
                        echo "<p> Phone Number: $phone_number";
                        echo "<p> Alternative Phone: $alternative_phone_number";

                        echo "<form method='post' action='UserLanding.php'><button type='submit' class='btn btn-primary btn-lg'>Home</button></form>";
                        echo "<br>";
                        exit();

                    } else { // If it did not run OK.
                        // Public message:
                        echo '<h1>Error</h1>
                        <p class="error">You could not be registered at this please try again</p>';
                        echo $errors;
                        // Debugging message:

                    } // End of if ($r) IF.
                    mysqli_close($dbc); // Close the database connection.
                    // Include the footer and quit the script:
                }else{
                    foreach ($errors as $message){
                        echo $message;
                    }
                }

            }
            exit();

            ?>
      <!-- <form action="EmergenyContact.php" method="post">
                <div class="form-row">
                    <div class="form-group col-lg-3 marg ">
                        <label for="first_name">Emergency First</label>
                        <input type="text"
                               name="first_name"
                               class="form-control"
                               id="first_name"
                               value="<?php /*echo $first_name; */?>"
                               required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please enter first name
                        </div>
                    </div>
                    <div class="form-group col-lg-3 marg">
                        <label for="last_name">Emergency Last</label>
                        <input type="text" name="last_name" class="form-control" id="last_name"
                               value="<?php /*echo $last_name; */?>" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please enter last name
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-3 marg">
                        <label for="phone_number">Emergency Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number"
                               value="<?php /*echo $phone_number; */?>" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please enter phone number
                        </div>
                    </div>
                    <div class="form-group col-lg-3 marg">
                        <label for="alternative_phone_number">Alternative Phone Number</label>
                        <input type="text" name="alternative_phone_number" class="form-control"
                               id="alternative_phone_number" value="<?php /*echo $alternative_phone_number */?>" >
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg marg">Submit Information</button>
            </form>
    </div>
</div>-->
<form action="../landing/EmergenyContact.php" method="post">
    <div class='modal-header bg-secondary text-light'>
        <h5 class='modal-title'
            id='edit-medication-label'>
            Add Contact
        </h5>

    </div>
    <!-- === Modal Header End ==================================================================================== -->
    <div class='modal-body bg-light p-0 m-0'>

        <ul class='list-group list-group-flush'>

            <!-- === Medication Input ============================================================================== -->
            <li class='list-group-item'>
                <div class='d-flex w-100 justify-content-between'>
                    <label class='h5'
                           for='first_name'>
                        First Name
                    </label>
                   <!-- <small class='form-text text-muted text-right'>
                        First Name of t
                    </small>-->
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='first_name'
                           name='first_name'
                           type='text'
                           aria-label='first_name'
                           value="<?php echo $first_name; ?>"
                           required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>

                </div>

            </li>
            <!-- === Medication Input End ========================================================================== -->

            <!-- === Dosage Input ================================================================================== -->
            <li class='list-group-item '>
                <div class='d-flex w-100 justify-content-between'>
                    <label class='h5'
                           for='last_name'>
                        Last Name
                    </label>
                    <!--<small class='form-text text-muted text-right'>
                        The medication dosage in milligrams.
                    </small>-->
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='last_name'
                           name='last_name'
                           type='text'
                           aria-label='LastName'
                           value="<?php echo $last_name; ?>"
                           required>

                </div>

            </li>
            <!-- === Dosage Input End ============================================================================== -->

            <!-- === Frequency Input =============================================================================== -->
            <li class='list-group-item'>
                <div class='d-flex w-100 justify-content-between'>
                    <label class='h5'
                           for='phone_number'>
                        Phone Number
                    </label>
                   <!-- <small class='form-text text-muted text-right'>
                        How often the medication is taken.
                    </small>-->
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='phone_number'
                           name='phone_number'
                           type='text'
                           aria-label='Frequency'
                           required>

                </div>

            </li>
            <!-- === Frequency Input End =========================================================================== -->

            <!-- === Time Taken Input ============================================================================== -->
            <li class='list-group-item '>
                <div class='d-flex w-100 justify-content-between'>
                    <label class='h5'
                           for='alternative_phone_number'>
                        Alternate Phone Number
                    </label>
                    <!--<small class='form-text text-muted text-right'>
                        When the medication is taken.
                    </small>-->
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='alternative_phone_number'
                           name='alternative_phone_number'
                           type='text'
                           aria-label='Time Taken'
                           required>

                </div>

            </li>
            <!-- === Time Taken Input End ========================================================================== -->

        </ul>

    </div>
    <!-- === Button Toolbar ====================================================================================== -->
    <div class='modal-footer bg-secondary btn-toolbar'>
        <a href="../landing/updateContact12.php"><button class='btn btn-danger'
                                                       type='button'
                                                       data-dismiss='modal'>
                Cancel
            </button>
        </a>
        <button class='btn btn-success btn-lg'
                type='submit'>
            Confirm Add
        </button>
    </div>

</form>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
<!--<script src="/home/jacadeve/public_html/register/register.js"></script>-->
<!--<script src="/home/jacadeve/public_html/register/register-backup.js"></script>-->
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
<!--<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
<!--<script src="../register/register.js"></script>-->
<!--<script src="../register/register-backup.js"></script>-->
<script src="js/EmergencyContact.js"></script>
<?php
require_once ('../footer.html');
?>
</body>

