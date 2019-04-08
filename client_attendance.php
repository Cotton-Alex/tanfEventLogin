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
            <h3> Check-in </h3>
            <form id="attendance_form" action="index.php" method='post'  id="clientAttendee">
                <input type="hidden" name="action" value="clientAttendee">
                <legend class="attendance_form_legend"><strong>Who is in attendance:</strong></legend>
                <?php get_household_members($sessionHouseholdId); ?>
                <input class="input-btn attendance_form_btn" type='submit' name='Submit' value='Submit' />
            </form>
        </main>
    </body>
</html>
