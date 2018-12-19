<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Joseph Bethards
 * Date: 3/7/2018
 * Time: 5:16 PM
 */
$clientid = $_SESSION['clientid'];
require('/home/jacadeve/public_html/client/landing/db/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['first_name'])) {
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
            if ($alternative_phone_number != null) {
                $q = "INSERT INTO Clients_Emergency_Contacts (client_id, first_name, last_name, phone, alternate_phone) VALUES (" . $_SESSION['clientid'] . ", '$first_name','$last_name',$phone_number,$alternative_phone_number)";
            }
            if ($alternative_phone_number == null) {
                $q = "INSERT INTO Clients_Emergency_Contacts (client_id, first_name, last_name, phone) VALUES (" . $_SESSION['clientid'] . ", '$first_name','$last_name',$phone_number)";
            }
            $p = @mysqli_query($dbc, $q); // Run the query.
            if ($p) { // If it ran OK.
                // Print a message:
                $full_name = $first_name . ' ' . $last_name;
                /*echo "<p>Thank You, Your information has been posted</p>";
                echo "<p> Emergency Contact Name: $full_name</p>";
                echo "<p> Phone Number: $phone_number";
                echo "<p> Alternative Phone: $alternative_phone_number";

                echo "<form method='post' action='UserLanding.php'><button type='submit' class='btn btn-primary btn-lg'>Home</button></form>";
                echo "<br>";*/


            } else { // If it did not run OK.
                // Public message:
                echo '<h1>Error</h1>
                        <p class="error">You could not be registered at this please try again</p>';
                echo $errors;
                // Debugging message:

            } // End of if ($r) IF.
            // Close the database connection.
            // Include the footer and quit the script:
        } else {
            foreach ($errors as $message) {
                echo $message;
            }
        }

    }
    if (isset($_POST['FirstNameUpdate'])) {
        if (empty($_POST['FirstNameUpdate'])) {
            $errors[] = 'You forgot to enter a irst name.';
            $FirstName=mysqli_real_escape_string($dbc, trim($_POST['FirstNameUpdate']));
        } else {
            $FirstName = mysqli_real_escape_string($dbc, trim($_POST['FirstNameUpdate']));

        }
// Check for a last name:
        if (empty($_POST['LastName'])) {
            $errors[] = 'You forgot to enter a last name.';
            $LastName = mysqli_real_escape_string($dbc, trim($_POST['LastName']));
        } else {
            $LastName = mysqli_real_escape_string($dbc, trim($_POST['LastName']));

        }
// Check for an email address:
        if (empty($_POST['Phone'])) {
            $errors[] = 'You forgot to enter a phone number.';
            $Phone=mysqli_real_escape_string($dbc, trim($_POST['phone_number']));
            $Phone= str_replace("(","",$Phone);
            $Phone= str_replace(" ","",$Phone);
            $Phone= str_replace(")","",$Phone);
            $Phone=str_replace("-","",$Phone);
        } else {
            $Phone = mysqli_real_escape_string($dbc, trim($_POST['phone_number']));
            $Phone= str_replace("(","",$Phone);
            $Phone= str_replace(" ","",$Phone);
            $Phone= str_replace(")","",$Phone);
            $Phone=str_replace("-","",$Phone);
        }
        if (empty($_POST['AlternatePhone'])) {
            $AlternativePhone=mysqli_real_escape_string($dbc, trim($_POST['AlternatePhone']));
            $AlternativePhone= str_replace("(","",$AlternativePhone);
            $AlternativePhone= str_replace(" ","",$AlternativePhone);
            $AlternativePhone= str_replace(")","",$AlternativePhone);
            $AlternativePhone=str_replace("-","",$AlternativePhone);
        } else {

            $AlternativePhone = mysqli_real_escape_string($dbc, trim($_POST['AlternatePhone']));
            $AlternativePhone= str_replace("(","",$AlternativePhone);
            $AlternativePhone= str_replace(" ","",$AlternativePhone);
            $AlternativePhone= str_replace(")","",$AlternativePhone);
            $AlternativePhone=str_replace("-","",$AlternativePhone);
        }
        $id = $_POST['contactID'];
        $q = "UPDATE `Clients_Emergency_Contacts` SET `first_name`='$FirstName',`last_name`='$LastName',`phone`=$Phone,`alternate_phone`=$AlternativePhone WHERE `emergency_contact_id`=$id;";
        $r = @mysqli_query($dbc, $q);
        

        if ($r) { // If it ran OK.
            // Print a message:


        } else {
            echo $errors;// If it did not run OK.
            // Debugging message.

        }
    }


}


/**
 * Formats a phone number into a standard format.
 *
 * @param $number int Un-formatted phone number.
 * @return string Formatted phone number.
 */
function render_phone_number( $number ) {
    return preg_replace( '~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $number );
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
    body {
        font-family: 'Quattrocento', serif;
        font-size: 20px;
    }

    width {
    width: 3%;
    }
    .i-am-centered { margin: auto; max-width: 80%;}

</style>
<body>
<!--############################################################  Navbar goes here ##################################################-->
<?php
include("../headerUserNew.html");
?>

<!--############################################################  Text goes here ##################################################-->


    <div class="bg-light">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <?php
        $q = "SELECT `emergency_contact_id`,`first_name`,`last_name`,`phone`,`alternate_phone` FROM `Clients_Emergency_Contacts` WHERE `client_id`=$clientid AND `active_contact`=1;";
        $r = @mysqli_query($dbc, $q);
        $numo = mysqli_num_rows($r);
        echo "<h1 class='display-3'><div class='container'>$_SESSION[name]</div></h1>";
        echo "</div></div><div class=\"container\">";
        echo "<h1>Emergency Contacts</h1>";
        if ($numo > 0) { // If it ran OK, display the records.
            // Print how many users there are:
            // Table header.

        } else {
            echo '<p class="error">You have no registered emergency contacts at this time</p>';
        }
        echo '<div class="i-am-centered">
                <div class="row">';
        $i=1;
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

            /*  echo '

               <div><a href="#" data-toggle="modal" data-target="#editContact ' . $row['emergency_contact_id'] . '">Edit</a></div><br>
               <div><a href="../landing/delete_contact.php?id=' . $row['emergency_contact_id'] . '">Delete</a></div><br>
               <div>' . $row['first_name'] . "  " . $row['last_name'] . '</div><br>
               <div>' . $row['phone'] . '</div>
               <div>' . $row['alternate_phone'] . '</div>';*/
            echo '
            
			<div class="card border-dark" style="width: 25rem; margin-bottom: 2%; margin-left: 2%; padding: 0;">
                    <div class="card-header">
                    Emergency Contact
                            </div>
      <ul class="list-group list-group-flush">
   
    <li class="list-group-item"><div>Name:</div><div>' . $row['first_name'] . "  " . $row['last_name'] . '</div></li>
    <li class="list-group-item"><div>Phone:</div><div>' . render_phone_number($row['phone']) . '</div></li>';
            if($row['alternate_phone'] !=null){
                echo'
    <li class="list-group-item"><div>Alternative Phone:</div><div>' . render_phone_number($row['alternate_phone']) . '</div></li>';
    }
    echo'
  </ul>
    <div class="card-footer">
     <a class="text-white" href="#" data-toggle="modal" data-target="#editContact ' . $row['emergency_contact_id'] . '"><button class="btn btn-primary">Edit</button></a>
     <a class="text-white" href="../landing/delete_contact.php?id=' . $row['emergency_contact_id'] . '"> <button class="btn btn-primary">Delete</button></a>
  </div>
</div>';



        }
        echo'</div> </div>';


        /*$x = "SELECT `emergency_contact_id`,`first_name`,`last_name`,`phone`,`alternate_phone` FROM `Clients_Emergency_Contacts` WHERE `client_id`=$clientid;";*/
        $o = @mysqli_query($dbc, $q);

        while ($row = mysqli_fetch_array($o, MYSQLI_ASSOC)) {
            echo "<form action=\"updateContact12.php\" method=\"post\">
    <div class=\"modal fade\" id='editContact $row[emergency_contact_id]' tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\"
         aria-hidden=\"true\">
        <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class='modal-title'
                        id='edit-medication-label'>
                        Edit Contact
                        <input type='hidden' name='contactID' value=$row[emergency_contact_id]>
                    </h5>

                </div>
                <!-- === Modal Header End ==================================================================================== -->
                <div class='modal-body bg-light p-0 m-0'>

                    <ul class='list-group list-group-flush'>

                        <!-- === MFirst Naeme Input ============================================================================== -->
                        <li class='list-group-item'>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='first_name'>
                                    First Name
                                </label>

                            </div>
                            <div class='input-group'>
                                <input class='form-control'
                                       id='first_name'
                                       name='FirstNameUpdate'
                                       type='text'
                                       aria-label='FirstNameUpdate'
                                       required
                                       value='$row[first_name]'
                                       >

                            </div>

                        </li>
                        <!-- === First Name Input End ========================================================================== -->

                        <!-- === Last Input ================================================================================== -->
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
                                       value=$row[last_name]
                                       aria-label='Dosage'
                                       required>

                            </div>

                        </li>
                        <!-- === last Input End ============================================================================== -->

                        <!-- === Phone Input =============================================================================== -->
                        <li class='list-group-item'>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='medication-edit-input-frequency'>
                                    Phone
                                </label>

                            </div>
                            <div class='input-group'>
                                <input class='form-control phone'
                                       id='medication-edit-input-frequency'
                                       name='phone_number'
                                       type='text'
                                       value= $row[phone]
                                       aria-label='Frequency'
                                       required>

                            </div>

                        </li>
                        <!-- === phone End =========================================================================== -->

                        <!-- === alt phone Input ============================================================================== -->
                        <li class='list-group-item '>
                            <div class='d-flex w-100 justify-content-between'>
                                <label class='h5'
                                       for='alternative_phone_number'>
                                    Alternate Phone
                                </label>

                            </div>
                            <div class='input-group'>
                                <input class='form-control phone'
                                       id='alternative_phone_number'
                                       name='AlternatePhone'
                                       type='text'
                                       aria-label='Time Taken'
                                       value=$row[alternate_phone]>

                            </div>

                        </li>
                        <!-- === alt phone Input End ========================================================================== -->

                    </ul>

                </div>
                <!-- === Button Toolbar ====================================================================================== -->
                <div class='modal-footer btn-toolbar'>
                    <button class='btn btn-secondary'
                                                          type='button'
                                                          data-dismiss='modal'>
                            Cancel
                        </button>
                        <a href='updateContact12.php'>
                    <button class='btn btn-primary '
                            type='submit'
                            data-target='#'>
                        Confirm Edit
                    </button></a>
                </div>
             </div>
        </div>
    </div>
                
</form>";
        }


        mysqli_close($dbc);

        ?>
        <br>
        <!--<a href="../landing/EmergenyContact.php">
            <button class="btn btn-primary btn-lg" style="font-size: 25px">Add Contact</button>
        </a>-->
        <!-- ADD CONTACT MODAL -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addContact">
            Add Contact
        </button>

    </div>
</div>
<form action="updateContact12.php" method="post">
    <div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Emergency Contact</h5>
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

                                       required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>

                            </div>

                        </li>
                        <!-- === Last Name Input End ============================================================================== -->

                        <!-- === Phone Number Input =============================================================================== -->
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
                                <input class='form-control phone'
                                       id='phone_number'
                                       name='phone_number'
                                       type='text'
                                       aria-label='Frequency'
                                       required >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>

                            </div>

                        </li>
                        <!-- === Phone Input End =========================================================================== -->

                        <!-- ==alt phone Taken Input ============================================================================== -->
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
                                <input class='form-control phone'
                                       id='alternative_phone_number'
                                       name='alternative_phone_number'
                                       type='text'
                                       aria-label='Time Taken'
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
                    <button type="submit" class="btn btn-primary">Save Contact</button>
                </div>
            </div>
        </div>
    </div>
</form>

</div>
<br>

<?php
require_once('../footer.html');
?>

<!--jQuery-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<!--Bootstrap tooltips-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="js/EmergencyContact.js"></script>
</body>
</html>
