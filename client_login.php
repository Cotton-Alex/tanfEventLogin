<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <h3> WELCOME TO </h3>
        <h1><?php echo $eventName ?></h1>

        <form action="index.php" method='post'  id="clientLogin">
            <input type="hidden" name="action" value="clientLogin">
            <fieldset >
                <legend>Client Login:</legend>
                <label for='clientLastName' >Last Name:</label>
                <input type='text' name='clientLastName' id='clientLastName'  maxlength="30" />
                <label for='clientSSN' >Last 4 of SSN:</label>
                <input type='text' name='clientSSN' id='clientSSN'  maxlength="4" />
                <input type='submit' name='Submit' value='Submit' />
            </fieldset>
        </form>

    </body>
</html>
