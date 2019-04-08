<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title>Event Login</title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <main>
            <div id="message">
                <?php require('message.php'); ?>
            </div>
            <form action="index.php" method='post'  id="getEventInfo">
                <input type="hidden" name="action" value="getEventInfo">
                <legend><strong>Event:</strong></legend>
                <label for='eventId' >Event Number:</label>
                <input type='text' name='eventId' id='eventId'  maxlength="10"/>
                <select name="eventType" id="eventType">
                    <option value="1">Single Event</option>
                    <option value="2">Multi-session Event</option>
                </select> 
                <input class="input-btn" type='submit' name='Submit' value='Submit' />
            </form>
        </main>
    </body>
</html>
