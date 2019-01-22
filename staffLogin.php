<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
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

        <form action="index.php" method='post'  id="getEventName">
            <input type="hidden" name="action" value="clientLogin">
            <fieldset >
                <legend>Event:</legend>
                <label for='eventNumber' >Event Number:</label>
                <input type='text' name='eventNumber' id='eventNumber'  maxlength="10" />
                <select name="eventType" id="eventType">
			<option value="1">Single Event</option>
                        <option value="2">Multi-session Event</option>
		</select> 
                <input type='submit' name='Submit' value='Submit' />

            </fieldset>
        </form>        
    </body>
</html>
