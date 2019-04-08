<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title>Staff Login</title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <main>
            <div id="message">
                <?php require('message.php'); ?>
            </div>
            <form action="index.php" method='post' id="staffLogin">
                <input type="hidden" name="action" value="verifyEmployee">
                <legend><strong>Employee Login:</strong></legend>
                <label class="form_item" for='lastName' >Last Name:</label>
                <input type='text' name='lastName' id='lastName'  maxlength="30"/>
                <label class="form_item" for='idNumber' >ID Number:</label>
                <input type='text' name='idNumber' id='idNumber'  maxlength="10"/>
                <input class="input-btn" type='submit' name='Submit' value='Submit' />
            </form>
        </main>
    </body>
</html>
