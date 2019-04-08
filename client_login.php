<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <main>
            <div id="message">
                <?php include('message.php'); ?>
            </div>
            <div id="welcome_wrapper">
                <?php
                if (isset($_SESSION['eventName'])) {
                    echo "<h3 id=" . "'" . "event_welcome" . "'" . ">WELCOME TO</h3>"
                    . "<h1 id=" . "'" . "event_title" . "'" . ">" . (ucwords($_SESSION['eventName'])) . "</h1>";
                }
                ?>
            </div>
            <form action="index.php" method='post'  id="clientLogin">
                <input type="hidden" name="action" value="clientLogin">
                    <legend><strong>Client Login:</strong></legend>
                    <label for='clientLastName' >Last Name:</label>
                    <input type='text' name='clientLastName' id='clientLastName'  maxlength="30"/>
                    <label for='clientSSN' >Last 4 of SSN:</label>
                    <input type='text' name='clientSSN' id='clientSSN'  maxlength="4"/>
                    <input class="input-btn" type='submit' name='Submit' value='Submit' />
            </form>
        </main>
    </body>
</html>
