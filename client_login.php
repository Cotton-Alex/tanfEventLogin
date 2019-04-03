<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>
        
        <?php if (isset($attendanceCount)) {
            echo $attendanceCount . " in attendance."; 
        }?>
        
        <?php include('message.php'); ?>
        
        <?php
        if (isset($_SESSION['eventName'])) {
            echo "<p><h3> WELCOME TO </h3><p>"
            . "<p><h1>" . ($_SESSION['eventName']) . "</h1></p>";
        }?> 
        <form action="index.php" method='post'  id="clientLogin">
            <input type="hidden" name="action" value="clientLogin">
            <fieldset >
                <legend>Client Login:</legend>
                <label for='clientLastName' >Last Name:</label>
                <input type='text' name='clientLastName' id='clientLastName'  maxlength="30" required/>
                <label for='clientSSN' >Last 4 of SSN:</label>
                <input type='text' name='clientSSN' id='clientSSN'  maxlength="4" required/>
                <input type='submit' name='Submit' value='Submit' />
            </fieldset>
        </form>

    </body>
</html>
