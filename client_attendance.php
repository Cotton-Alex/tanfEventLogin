<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <h3> Check-in </h3>
        <form action="index.php" method='post'  id="clientAttendee">
            <input type="hidden" name="action" value="clientAttendee">
            <fieldset >
                <legend>Who is in attendance:</legend>
                <?php get_household_members($sessionHouseholdId); ?>
                <?php// foreach ($householdMembers as $householdMember);
                //get_all_household_members($dbHouseholdId);
                ?>
<!--                "<input type = 'checkbox' name = 'clientAttended[]' 
                        value = " . $row['PersonID'] . " 
                        maxlength = '3'/> " . 
                $row['FirstName'] . " " . 
                $row['LastName'] . "<br>"-->
                <input type='submit' name='Submit' value='Submit' />
            </fieldset>
        </form>

    </body>
</html>
