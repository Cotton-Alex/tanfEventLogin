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
            <form action="index.php" method='post' id="staffLogin" autocomplete=off>
                <input type="hidden" name="action" value="verifyEmployee">
                <legend><strong>Employee Login:</strong></legend>
                <label class="form_item" for='lastName' autocomplete=off>Last Name:</label>
                <input type='text' name='lastName' id='lastName' maxlength="30" autocomplete=off/>
                <label class="form_item" for='idNumber' autocomplete=off >ID Number:</label>
                <input type='password' name='idNumber' id='idNumber' maxlength="10" autocomplete=off/>
                <input class="input-btn" type='submit' name='Submit' value='Submit' autocomplete=off />
             </form>
        </main>
    </body>
</html>
