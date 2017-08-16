<?php 
    if(isset($_POST['action'])){
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $servername = "mysql6.000webhost.com";
        $username = "a9666401_crowson";
        $password = "dogdog97";
        $dbname = "a9666401_contact";

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
        $message = filter_var($message, FILTER_SANITIZE_STRING);
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
            exit("$email is not a valid email address");
        }
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = " INSERT INTO `a9666401_contact`.`ContactTable` (`First Name`, `Last Name`, `Email`, `Message`) VALUES ('$firstName', '$lastName', '$email', '$message');";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $formcontent="From: $firstName $lastName \n Message: $message";
        $recipient = "admin@tristancrowson.comyr.com";
        $subject = "Contact Form";
        $mailheader = "From: $email \r\n";

        mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");

        echo '<script type="text/javascript">
                    alert("Thank You for your time! I will be in contact with you shortly."); 
                    window.location.href = "http://tristancrowson.comyr.com/";</script>';

        mysqli_close($conn);

    }
?>