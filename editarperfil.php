<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once 'helpers/meta.php';?>

    <title>Food Rescue</title>

    <?php include_once 'helpers/css.php';?>

</head>

<body>

<?php include_once 'components/cp_header.php';?>

<?php include_once 'components/cp_editarperfil.php';?>

<?php include_once 'components/cp_nav.php';?>

<?php include_once 'components/cp_botao.php';?>

<?php include_once 'helpers/js.php';?>

</body>

</html>

<script>

    function loadDoc() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("countnotif").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "count_notif.php", true);
        xhttp.send();

    }
    window.onload = function(){
        setInterval(function(){loadDoc();}, 1000);
    };


    function checkPass() {
        //Store the password field objects into variables ...
        var pass1 = $("#password");
        var pass2 = $("#password_confirm");

        console.log(pass1.value, pass2);
        //Store the Confimation Message Object ...
        var message = $('#confirmMessage');
        //Set the colors we will be using ...
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        //Compare the values in the password field
        //and the confirmation field
        if (pass1.val() == pass2.val()) {
            //The passwords match.
            //Set the color to the good color and inform
            //the user that they have entered the correct password
            pass2.css("backgroundColor", goodColor);
            message.css("color", goodColor);
            message.html("Passwords Match");
        } else {
            //The passwords do not match.
            //Set the color to the bad color and
            //notify the user.
            pass2.css("backgroundColor", badColor);
            message.css("color", badColor);
            message.html("Passwords Do Not Match!");
        }
    }


    // validates text only
    function Validate(txt) {
        txt.value = txt.value.replace(/[^a-zA-Z-'\n\r.]+/g, '');
    }

    // validate email
    function email_validate(email) {
        var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

        if (regMail.test(email) == false) {
            document.getElementById("status").innerHTML = "<span class='warning'>Email address is not valid yet.</span>";
        } else {
            document.getElementById("status").innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>";
        }
    }

    // validate date of birth
    function dob_validate(dob) {
        var regDOB = /^(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})$/;

        if (regDOB.test(dob) == false) {
            document.getElementById("statusDOB").innerHTML = "<span class='warning'>DOB is only used to verify your age.</span>";
        } else {
            document.getElementById("statusDOB").innerHTML = "<span class='valid'>Thanks, you have entered a valid DOB!</span>";
        }
    }



</script>