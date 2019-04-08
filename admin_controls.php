<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <main>
            <?php
            if (isset($_SESSION['eventName'])) {
                echo "<h3 id=" . "'" . "event_welcome" . "'" . ">Attendee List for</h3>"
                . "<h1 id=" . "'" . "event_title" . "'" . ">" . (ucwords($_SESSION['eventName'])) . "</h1>";
            }
            ?>
            <form id ="attendance_form" action="index.php" method='post'  id="clientAttendee" autocomplete=off>
                <input type="hidden" name="action" value="clientAttendee">
                <legend class="attendance_form_legend"><strong>Attended:</strong></legend>
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
                <div>
                <button class="input-btn" type='submit' name='action' value='closeEvent'>Close</button>
                <button class="input-btn" type='submit' name='action' value='adminCancel'>Cancel</button>
                </div>
            </form>
<!--            <form action="index.php" method='post' id="adminCancel">
                <input type="hidden" name="action" value="adminCancel">
                <input class="admin_btn input-btn" type="submit" name="submit" value="Back">
            </form>
            <form action="index.php" method='post' id="closeEvent">
                <input type="hidden" name="action" value="closeEvent">
                <input class="admin_btn input-btn" type="submit" name="submit" value="Close Event">
            </form>-->
        </main>
    </body>
</html>
