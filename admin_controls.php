<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <?php
        if ((isset($_SESSION['eventType'])) AND ( isset($_SESSION['eventId']))) {
            $eventType = $_SESSION['eventType'];
            $sessionEventId = $_SESSION['eventId'];
            if ($eventType == 1) {
                get_one_Time_Event_Attendee_List($sessionEventId);
            } elseif ($eventType == 2) {
                get_multi_Event_Attendee_List($sessionEventId);
            } else {
                echo "";
            }
        } else {
            $message = "No event has been chosen yet.";
        }
        ?>
        <form action="index.php" method='post' id="adminCancel">
            <input type="hidden" name="action" value="adminCancel">
            <input class="admin_btn input-btn" type="submit" name="submit" value="Back">
        </form>
        <form action="index.php" method='post' id="closeEvent">
            <input type="hidden" name="action" value="closeEvent">
            <input class="admin_btn input-btn" type="submit" name="submit" value="Close Event">
        </form>
    </body>
</html>
