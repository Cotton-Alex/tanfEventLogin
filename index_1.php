<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <?php require('func.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>


        <!--        <form action="func.php" method="post">
                    <label>Client Attendance Login:  </label>
                    <br>
                    <input type="hidden" name ="action" value ="clientLogin">
                    <input type="text" name="lastName" placeholder="Last Name">
                    <input type="text" name="ssn" placeholder="Last 4 of SSN"> 
                    <input type="submit" name="submit" value="Submit"/>
                </form>-->


        <form id='login' action='func.php' method='post' accept-charset='UTF-8'>
            <fieldset >
                <legend>Client Attendance Login:</legend>
                <input type='hidden' name='submitted' id='submitted' value='1'/>

                <label for='lastName' >Last Name*:</label>
                <input type='text' name='lastName' id='lastName'  maxlength="50" />

                <label for='ssn' >Last 4 of SSN*:</label>
                <input type='ssn' name='ssn' id='ssn' maxlength="50" />

                <input type='submit' name='Submit' value='Submit' />

            </fieldset>
        </form>        
    </body>
</html>
