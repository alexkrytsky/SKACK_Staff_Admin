<?php
session_start();
/**
 * register.php
 *
 *
 *
 * Author: Alex Krytskyi
 * Date: 2/21/18
 *
 */

//$session_start();


##### DATABASE SETTINGS

$db_user = 'jacadeve_php';
$db_password = '5]D2!Jtk[8c2';
$db_host = "localhost";
$db_name = "jacadeve_skcac_dev";
$dbc = null;

try {
    $dbc = mysqli_connect($db_host, $db_user, $db_password, $db_name);
} catch (mysqli_sql_exception $exception) {
    die("Failed to connect to the database: " . $exception->getMessage());
}

mysqli_set_charset($dbc, 'utf8');
//Error handling part

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = []; //error array

    //check for a first name:
    if (empty($_POST['firstName'])) {
        $errors[] = 'You forgot to enter your first name';
    } else {
        $fName = trim($_POST['firstName']);
    }
    //check for last name
    if (empty($_POST['lastName'])) {
        $errors[] = 'You forgot to enter your last name';
    } else {
        $lName = trim($_POST['lastName']);
    }
    //check for email
    if (empty($_POST['email'])) {
        $errors[] = 'Please, enter the email address';
    } else {
        //check do we have such email in the database
        $emailTemp = trim($_POST['email']);
        $queryEmail = "SELECT account_id FROM Account WHERE email='$emailTemp'";
        $resultQuery = mysqli_query($dbc, $queryEmail);

        if (mysqli_num_rows($resultQuery) == 0) {
            $email = trim($_POST['email']);
            $_SESSION['email']=$email;
        } else {
            $errors[] = "The email account is already registered! You can <a href='http://jacadevelopment.greenriverdev.com/'>Login</a> or <a href='http://jacadevelopment.greenriverdev.com/client/password/ForgotPassword.php'>Reset your password.</a>";
        }
    }
    //check for password
    if (empty($_POST['password'])) {
        $errors[] = 'Please, enter the password';
    } else {
        $password = $_POST['password'];
    }

    //variables submitted by the user for Client table
    //check for middle name
    if (empty($_POST['middleName'])) {
        $mName = "";
    } else {
        $mName = $_POST['middleName'];
    }
    //check for address
    if (empty($_POST['addr1'])) {
        $errors[] = 'Please, enter the address';
    } else {
        $addr = $_POST['addr1'] . ", " . $_POST['addr2'];
    }
    //check for city
    if (empty($_POST['city'])) {
        $errors[] = 'Please, enter the city';
    } else {
        $city = $_POST['city'];
    }
    //check for state
    if (empty($_POST['state'])) {
        $errors[] = 'Please, select the state';
    } else {
        $state = $_POST['state'];
    }
    //check for zip
    if (empty($_POST['zip'])) {
        $errors[] = 'Please, enter zip code';
    } else {
        //replacing any dash in case zip in format 8898-23. If it still has special characters it won't be populated
        $tempZip = str_replace("-", "", $_POST['zip']);
        if (is_numeric($tempZip)) {
            $zip = $tempZip;
        } else {
            $errors[] = "Please enter a valid zip code. No special characters allowed";
        }
    }

    //check for phone number
    if (empty($_POST['phone'])) {
        $errors[] = 'Please, enter phone number';
    } else {
        //users regex expression to strip all characters but numbers
        $tempPhone = preg_replace("/[^0-9]/", "", $_POST['phone']);
        //checks is it valid length of the phone number, if yes, it assigns the variable
        if (strlen($tempPhone) >= 10 && strlen($tempPhone) <= 11) {
            $phone = $tempPhone;
        } else {
            $errors[] = "Please enter valid phone number with 10 or 11 numbers.";
        }
    }

    //if no errors, we will run the query, otherwise not.
    if (empty($errors)) {

        //adding salt and hashing the password
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2137483647));
        $password = hash('sha256', $password . $salt);

        // Super hash the password
        for ($round = 0; $round < 65536; $round++) {
            $password = hash('sha256', $password . $salt);
        }
        //query to write data to the account table
        $queryAccount = "INSERT INTO Account (email, first_name, last_name, password, salt) VALUES ('$email', '$fName', '$lName', '$password', '$salt')";
        try {
            $runAccountQuery = @mysqli_query($dbc, $queryAccount);
        } catch (mysqli_sql_exception $exception) {
            die('SQL Exception: ' . $exception->getMessage());
        }
        //finding out the account id
        //query to find the email address in account table and get the id of it
        $queryAccountID = "SELECT account_id FROM Account WHERE email = '$email'";

        $selectQueryResult = mysqli_query($dbc, $queryAccountID);
        $rowID = mysqli_fetch_assoc($selectQueryResult);

        //getting the id from the result of the query
        $accountID = $rowID['account_id'];

        //preparing the query for client table
        $queryClients = "INSERT INTO Clients (account_id, middle_name, phone, address, address_city, address_zip, address_state) 
        VALUES ('$accountID', '$mName', '$phone', '$addr', '$city', '$zip', '$state')";

        //running the query to write data to Client table
        try {
            $runClientQuery = @mysqli_query($dbc, $queryClients);
        } catch (mysqli_sql_exception $exception) {
            die('SQL Exception: ' . $exception->getMessage());
        }

        //unset($_SESSION['email']);
        $_SESSION['email']=$email;
        mysqli_close($dbc);
        //if the registration was successful, we will be redirected to the home page for the user
        header('Location: http://jacadevelopment.greenriverdev.com/client/landing/UserLanding.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SKCAC - Register</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
    <link href="register.css" rel="stylesheet" type="text/css">
</head>
<style>
    body{
        font-family: 'Ubuntu Mono', monospace;
        font-size: 20px;
    }
</style>
<body>
<section>
    <?php
    include ("../header.html");
    ?>
    <!--############################################################ logo goes here ##################################################-->
    <?php
    include ("../logo.html");
    ?>
</section>
<div class="container jumbotron">
    <form class="needs-validation" method="post" action="register.php">
        <legend>REGISTER</legend>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="fname">First name</label>
                <input type="text" class="form-control" id="fname" placeholder="First name" name="firstName" value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter your first name
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="lname">Last name</label>
                <input type="text" class="form-control" id="lname" placeholder="Last name" name="lastName" value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter your last name
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="mname">Middle Name</label>
                <input type="text" class="form-control" id="mname" placeholder="Middle Name"
                       name="middleName" value="<?php if (isset($_POST['middleName'])) echo $_POST['middleName']; ?>">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="addr1">Address 1</label>
                <input type="text" class="form-control" id="addr1" required name="addr1" value="<?php if (isset($_POST['addr1'])) echo $_POST['addr1']; ?>">
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter your address
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="addr2">Address 2</label>
                <input type="text" class="form-control" id="addr2" name="addr2" value="<?php if (isset($_POST['addr2'])) echo $_POST['addr2']; ?>">
            </div>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="City" required name="city" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>">
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter the city
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="state">State</label>

                <?php
                $states = array("","AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
                ?>
                <select class="form-control custom-select" required id="state" name="state">
                    <?php

                    foreach ($states as $abbrev) {
                        echo "<option value='" . $abbrev . "'";
                        if (!empty($_POST['state'])) {
                            if ($_POST['state'] == $abbrev) {
                                echo " selected='selected'";
                            }
                        }
                        echo ">" . $abbrev . "</option>";
                    } ?>
                </select>

                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please select state!
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="Zip" required name="zip" minlength="5" maxlength="6" value="<?php if (isset($_POST['zip'])) echo $_POST['zip']; ?>">
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter zip code
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email" required name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter valid email
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="phone">Phone #</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend3">+1</span>
                    </div>
                    <input type="text" class="form-control" id="phone" placeholder="Phone #" required name="phone" maxlength="11" minlength="10" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please enter valid phone number
                    </div>
                </div>

            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" required name="password" minlength="6">
                <div class="valid-feedback" id="passwordFeedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter complex password. Minimum 6 characters
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="passwordConfirm">Confirm password:</label>
                <input type="password" class="form-control" id="passwordConfirm" required name="passwordConfirm">
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Passwords don't match
                </div>
            </div>
        </div>
        <?
        if (isset($errors)) {
            //output messages in a nice format
            echo '<h3>Please fix the following error(s)</h3>
        <div class="alert alert-danger">';
            foreach ($errors as $msg) {
                echo '<li>' . $msg . '</li>';
            }
            echo '</div>';
        }
        ?>
        <button class="btn btn-primary" type="submit" id="submitForm">Submit form</button>
    </form>
</div>

<?php
include("../footer.html");
//include ("../staff/dashboard/components/footer.html");
?>
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="register.js"></script>
</body>
</html>
