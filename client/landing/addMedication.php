<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Joseph Bethards
 * Date: 3/7/2018
 * Time: 2:33 PM
 */


require("/home/jacadeve/public_html/client/landing/db/db.php");
$client_id = $_SESSION['clientid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Medication</title>
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
<?php
echo "
<div class='container'>
<div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom\">

<h1 class='display-3'>$_SESSION[name]</h1>
</div>
<div class='container' ";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
// Check for a first name:
    if (empty($_POST['Medication'])) {
        $errors[] = 'You forgot to enter a medication name.';
    } else {
        $Medication = mysqli_real_escape_string($dbc, trim($_POST['Medication']));
    }
// Check for a last name:
    if (empty($_POST['Dosage'])) {
        $errors[] = 'You forgot to enter a dosage.';
    } else {
        $Dosage = mysqli_real_escape_string($dbc, trim($_POST['Dosage']));
    }
// Check for an email address:
    if (empty($_POST['Frequency'])) {
        $errors[] = 'You forgot to enter a frequency.';
    } else {
        $Frequency = mysqli_real_escape_string($dbc, trim($_POST['Frequency']));
    }
    if (empty($_POST['Time_Taken'])) {
        $errors[] = 'You forgot to enter the medication time.';
    } else {
        $Time_Taken = ($_POST['Time_Taken']);
    }
    if (empty($errors)) {
        $q = "INSERT INTO Clients_Medications(client_id, medication, dosage, frequency, time_taken)
    VALUES ($client_id,'$Medication','$Dosage','$Frequency','$Time_Taken');";
        $r = @mysqli_query($dbc, $q);


        if ($r) { // If it ran OK.
            // Print a message:
           echo"<h1>The medication has been added</h1>
            <br>
            <a href='../landing/Medication1.1.php'><button class='btn btn-primary'>Return to Medication page</button></a>";
            exit();

        } else { // If it did not run OK.
            /*echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
            // Debugging message.
            echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';*/
        }
    }
}
       /* echo '<form action="addMedication.php" method="post">
<p>Medication: <input type="text" name="Medication" size="15" maxlength="15" placeholder="Medication"></p>
<p>Dosage: <input type="text" name="Dosage" size="15" maxlength="30" placeholder="Dosage"></p>
<p>Frequency: <input type="text" name="Frequency" size="20" maxlength="60" placeholder="Frequency"></p>
<p>Time Taken: <input type="text" name="Time_Taken" size="20" maxlength="60" placeholder="Time Taken"></p>
<p><input type="submit" name="submit" value="Submit"></p>
</form>';*/

    echo"</div>
    </div>";

?>

<form action="../landing/addMedication.php" method="post">
<div class='modal-header bg-secondary text-light'>
    <h5 class='modal-title'
        id='edit-medication-label'>
        Add Medication
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
                        Medication
                    </label>
                    <small class='form-text text-muted text-right'>
                        The medication name and other information.
                    </small>
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='medication-edit-input-medication'
                           name='Medication'
                           type='text'
                           placeholder='Tylenol'
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
                        Dosage
                    </label>
                    <small class='form-text text-muted text-right'>
                        The medication dosage in milligrams.
                    </small>
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='medication-edit-input-dosage'
                           name='Dosage'
                           type='text'
                           placeholder='1000'
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
                        Frequency
                    </label>
                    <small class='form-text text-muted text-right'>
                        How often the medication is taken.
                    </small>
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='medication-edit-input-frequency'
                           name='Frequency'
                           type='text'
                           placeholder='Daily,Weekly, etc'
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
                        Time Taken
                    </label>
                    <small class='form-text text-muted text-right'>
                        When the medication is taken.
                    </small>
                </div>
                <div class='input-group'>
                    <input class='form-control'
                           id='medication-edit-input-time-taken'
                           name='Time_Taken'
                           type='text'
                           placeholder='1:00 PM'
                           aria-label='Time Taken'
                           required>

                </div>

            </li>
            <!-- === Time Taken Input End ========================================================================== -->

        </ul>

</div>
<!-- === Button Toolbar ====================================================================================== -->
<div class='modal-footer bg-secondary btn-toolbar'>
    <a href="../landing/Medication1.1.php"><button class='btn btn-danger'
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
