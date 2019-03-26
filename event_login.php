// autocomplete='off'
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title>Event Login</title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <?php require('message.php'); ?>
        <h3>Add event confirmation with option to change event number after this page</h3><br>
        <form action="index.php" method='post'  id="getEventInfo">
            <input type="hidden" name="action" value="getEventInfo">
            <fieldset >
                <legend>Event:</legend>
                <label for='eventId' >Event Number:</label>
                <input type='text' name='eventId' id='eventId'  maxlength="10" required/>
                <select name="eventType" id="eventType">
                    <option value="1">Single Event</option>
                    <option value="2">Multi-session Event</option>
                </select> 
                <input type='submit' name='Submit' value='Submit' />

            </fieldset>
        </form>

    </body>
</html>
