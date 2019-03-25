// autocomplete='off'
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title>Staff Login</title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <?php require('message.php'); ?>
        <form action="index.php" method='post' id="staffLogin">
            <input type="hidden" name="action" value="verifyEmployee">
            <fieldset >
                <legend>Employee Login:</legend>
                <label for='lastName' >Last Name:</label>
                <input type='text' name='lastName' id='lastName'  maxlength="30" required/>
                <label for='idNumber' >ID Number:</label>
                <input type='text' name='idNumber' id='idNumber'  maxlength="10" required/>
                <input type='submit' name='Submit' value='Submit' />
            </fieldset>
        </form>

    </body>
</html>
