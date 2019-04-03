<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <form action="index.php" method='post' id="adminCancel">
            <input type="hidden" name="action" value="adminCancel">
            <input type="submit" name="submit" value="Back">
        </form>
        <form action="index.php" method='post' id="closeEvent">
            <input type="hidden" name="action" value="closeEvent">
            <input type="submit" name="submit" value="Close Event">
        </form>
        <?php if (isset($attendanceCount)) {
            echo $attendanceCount . " in attendance."; 
        }?>
        <?php include('message.php'); ?>
        <?php //get_household_members($sessionHouseholdId); ?>
    </body>
</html>
