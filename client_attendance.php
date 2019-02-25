// autocomplete='off'
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>
        <h3> Check-in </h3>
        <h1></h1>

        <form action="index.php" method='post'  id="clientAttendance">
            <input type="hidden" name="action" value="clientAttendance">
            <fieldset >
                <legend>Who is in attendance:</legend>
                <?php get_household_members($dbHouseholdId); ?>
                <input type='submit' name='Submit' value='Submit' />
            </fieldset>
        </form>

    </body>
</html>
