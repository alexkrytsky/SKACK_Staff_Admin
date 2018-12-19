<?php
session_start();
require ('/home/jacadeve/public_html/client/landing/db/db.php');
$client_id = $_SESSION['clientid'];
/**
 * Created by PhpStorm.
 * User: Joseph Bethards
 * Date: 3/7/2018
 * Time: 11:29 AM
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['MedicationUpdate'])) {
        if (empty($_POST['MedicationUpdate'])) {
            $errors[] = 'You forgot to enter a medication name.';
        } else {
            $Medication = mysqli_real_escape_string($dbc, trim($_POST['MedicationUpdate']));
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
            $id=$_POST['MedicationID'];
            $q = "UPDATE `Clients_Medications` SET `medication`='$Medication',`dosage`='$Dosage',`frequency`='$Frequency',`time_taken`='$Time_Taken' WHERE `id`=$id;";
            $r = @mysqli_query($dbc, $q);
           /* echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';*/
        }
    }

    else {
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

            } else { // If it did not run OK.
                echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
                // Debugging message.
               /* echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';*/
            }
        }
    }

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
    <style>
        body{
            font-family: 'Quattrocento', serif;
            font-size: 20px;
        }
        .i-am-centered { margin: auto; max-width: 80%;}
    </style>
</head>
<body>
<!--############################################################  Navbar goes here ##################################################-->
<?php
include ("../headerUserNew.html");
?>

<div class="bg-light">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<?php

//echo client name
echo "<h1 class='display-3'><div class='container'>$_SESSION[name]</div></h1>";
echo "</div></div><div class=\"container\">";
/*echo "</div>";*/

echo "<h1>Medication</h1>";


$q="SELECT `id`,`medication`,`dosage`,`frequency`,`time_taken`FROM `Clients_Medications` WHERE `client_id`=$client_id AND active=1 ;";
$r = @mysqli_query($dbc, $q);
/*$row = @mysqli_fetch_array($r, MYSQLI_NUM);*/
$num = mysqli_num_rows($r);
echo"<br>";

//if the user has contacts:
if ($num > 0) { // If it ran OK, display the records.
    // Print how many users there are:
    // Table header.
    $r = @mysqli_query($dbc, $q);
    echo '<div class="i-am-centered">
                <div class="row">';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
            
			<div class="card border-dark" style="width: 25rem; margin-bottom: 2%; margin-left: 2%; padding: 0;">
                    <div class="card-header">
                     Medication
                            </div>
      <ul class="list-group list-group-flush ">
   
    <li class="list-group-item "><div>Medication:</div><div>' . $row['medication'] . '</div></li>
    <li class="list-group-item"><div>Dosage(mg):</div><div>' . $row['dosage'] . '</div></li>
       
    <li class="list-group-item"><div>Frequency:</div><div>' . $row['frequency']. '</div></li>
      <li class="list-group-item"><div>Time Taken:</div><div>' . $row['time_taken']. '</div></li>
  </ul>
    <div class="card-footer">
     <a class="text-white" href="#" data-toggle="modal" data-target="#editMedication ' . $row['id'] . '"><button class="btn btn-primary">Edit</button></a>
     <a class="text-white" href="../landing/delete_med.php?id=' . $row['id'] . '"> <button class="btn btn-primary">Delete</button></a>
  </div>
</div>';
    }
    echo '</div></div>'; // Close divs.
    // Free up the resources.
//if the user has no contacts
}
else { // If no records were returned.
    echo '<p class="error">You have no registered medications at this time</p>';
}
$y = @mysqli_query($dbc, $q);
while($row = mysqli_fetch_array($y, MYSQLI_ASSOC)) {
    echo "<form action=\"Medication1.1.php\" method=\"post\">
    <div class=\"modal fade\" id=\"editMedication $row[id]\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\"
         aria-hidden=\"true\">
        <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"exampleModalLabel\">Edit Medication</h5>
                    <input type='hidden' name='MedicationID' value=$row[id]>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>
                <div class=\"modal-body\">
                    <ul class='list-group list-group-flush'>

                        <!-- === Medication update  ============================================================================== -->
                        <li class='list-group-item'>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='Medication'>
                                    Medication Name
                                </label>
                                <!-- <small class='form-text text-muted text-right'>
                                     First Name of t
                                 </small>-->
                            </div>
                            <div class='input-group'>
                                <input class='form-control'
                                       id='Medication'
                                       name='MedicationUpdate'
                                       type='text'
                                       aria-label='Medication'
                                        value='$row[medication]'
                                       required>
                                <div class=\"valid-feedback\">
                                    Looks good!
                                </div>

                            </div>

                        </li>
                        <!-- === medication update End ========================================================================== -->

                        <!-- === Dosage updarte ================================================================================== -->
                        <li class='list-group-item '>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='Dosage'>
                                    Dosage(mg)
                                </label>
                                <!--<small class='form-text text-muted text-right'>
                                    The medication dosage in milligrams.
                                </small>-->
                            </div>
                            <div class='input-group'>
                                <input class='form-control'
                                       id='Dosage'
                                       name='Dosage'
                                       type='text'
                                       aria-label='LastName'
                                       value='$row[dosage]'
                                       required>
                                <div class=\"valid-feedback\">
                                    Looks good!
                                </div>

                            </div>

                        </li>
                        <!-- === Dosage update End ============================================================================== -->

                        <!-- === Frequency update =============================================================================== -->
                        <li class='list-group-item'>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='Frequency'>
                                    Frequency
                                </label>
                                <!-- <small class='form-text text-muted text-right'>
                                     How often the medication is taken.
                                 </small>-->
                            </div>
                            <div class='input-group'>
                                <input class='form-control phone'
                                       id='Frequency'
                                       name='Frequency'
                                       type='text'
                                       aria-label='Frequency'
                                       required
                                        value='$row[frequency]'>
                                <div class=\"valid-feedback\">
                                    Looks good!
                                </div>

                            </div>

                        </li>
                        <!-- === Frequency update End =========================================================================== -->

                        <!-- ==time taken update============================================================================== -->
                        <li class='list-group-item '>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='Time_Taken'>
                                    Time_Taken
                                </label>
                                <!--<small class='form-text text-muted text-right'>
                                    When the medication is taken.
                                </small>-->
                            </div>
                            <div class='input-group'>
                                <input class='form-control phone'
                                       id='Time_Taken'
                                       name='Time_Taken'
                                       type='text'
                                       aria-label='Time Taken'
                                       value='$row[time_taken]'
                                       required
                                >

                            </div>
                            <div class=\"valid-feedback\">
                                Looks good!
                            </div>

                        </li>
                        <!-- === time taken update End ========================================================================== -->

                    </ul>


                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
                    <button type=\"submit\" class=\"btn btn-primary\">Save </button>
                </div>
            </div>
        </div>
    </div>
</form>";
}
?>
<!--        <button class="btn btn-primary btn-lg" style="font-size: 25px" onclick="location.href='http://jacadevelopment.greenriverdev.com/client/landing/addMedication.php'">Add Medication</button>
-->

<!-- ADD CONTACT MODAL -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addMedication">
    Add Medication
</button>
<form action="Medication1.1.php" method="post">
    <div class="modal fade" id="addMedication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Medication</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class='list-group list-group-flush'>

                        <!-- === First Name Input ============================================================================== -->
                        <li class='list-group-item'>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='Medication'>
                                    Medication Name
                                </label>
                                <!-- <small class='form-text text-muted text-right'>
                                     First Name of t
                                 </small>-->
                            </div>
                            <div class='input-group'>
                                <input class='form-control'
                                       id='Medication'
                                       name='Medication'
                                       type='text'
                                       aria-label='first_name'
                                        placeholder="tylenol"
                                       required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>

                            </div>

                        </li>
                        <!-- === First Name Input End ========================================================================== -->

                        <!-- === Last Name Input ================================================================================== -->
                        <li class='list-group-item '>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='Dosage'>
                                    Dosage
                                </label>
                                <!--<small class='form-text text-muted text-right'>
                                    The medication dosage in milligrams.
                                </small>-->
                            </div>
                            <div class='input-group'>
                                <input class='form-control'
                                       id='Dosage'
                                       name='Dosage'
                                       type='text'
                                       aria-label='LastName'
                                        placeholder="50"
                                       required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>

                            </div>

                        </li>
                        <!-- === Last Name Input End ============================================================================== -->

                        <!-- === Frequency Input =============================================================================== -->
                        <li class='list-group-item'>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='Frequency'>
                                    Frequency
                                </label>
                                <!-- <small class='form-text text-muted text-right'>
                                     How often the medication is taken.
                                 </small>-->
                            </div>
                            <div class='input-group'>
                                <input class='form-control phone'
                                       id='Frequency'
                                       name='Frequency'
                                       type='text'
                                       aria-label='Frequency'
                                       required
                                        placeholder="Daily, Weekly, etc">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>

                            </div>

                        </li>
                        <!-- === Frequency End =========================================================================== -->

                        <!-- ==alt phone Taken Input ============================================================================== -->
                        <li class='list-group-item '>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='Time_Taken'>
                                    Time Taken
                                </label>
                                <!--<small class='form-text text-muted text-right'>
                                    When the medication is taken.
                                </small>-->
                            </div>
                            <div class='input-group'>
                                <input class='form-control phone'
                                       id='Time_Taken'
                                       name='Time_Taken'
                                       type='text'
                                       aria-label='Time Taken'
                                       placeholder="12:00 PM"
                                >

                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>

                        </li>
                        <!-- === alt phone Input End ========================================================================== -->

                    </ul>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
</div>
<br>

<?php
require_once ('../footer.html');
?>

<!--jQuery-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<!--Bootstrap tooltips-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
