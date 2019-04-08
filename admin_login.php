<?php // session_start();   ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title>Admin Login</title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <main>
            <div id="message">
                <?php include('message.php'); ?>
            </div>
            <form action="index.php" method='post' id="adminLogin">
                <input type="hidden" name="action" value="adminLogin">
                <legend><strong>Admin Login:</strong></legend>
                <label for='lastName' >Last Name:</label>
                <input type='text' name='lastName' id='lastName'  maxlength="30"/>
                <label for='idNumber' >ID Number:</label>
                <input type='text' name='idNumber' id='idNumber'  maxlength="10"/>
                <button class="input-btn" type='submit' name='action' value='adminLogin'>Submit</button>
                <button class="input-btn" type='submit' name='action' value='adminCancel'>Cancel</button>
            </form>
        </main>
    </body>
</html>
