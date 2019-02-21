<?php session_start() ?>
//TODO: save event info in session
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title>Event Login</title>
    </head>
    <body>
        <?php require('header.php'); ?>

        <p> Hi <?php echo $dbStaffFirstName ?>, please select your event.</p>

        <form action="index.php" method='post'  id="getEventName">
            <input type="hidden" name="action" value="getEventName">
            <fieldset >
                <legend>Event:</legend>
                <label for='eventId' >Event Number:</label>
                <input type='text' name='eventId' id='eventId'  maxlength="10" />
                <select name="eventType" id="eventType">
                    <option value="1">Single Event</option>
                    <option value="2">Multi-session Event</option>
                </select> 
                <input type='submit' name='Submit' value='Submit' />

            </fieldset>
        </form>

    </body>
</html>
