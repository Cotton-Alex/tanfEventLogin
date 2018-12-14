<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php'); ?>
        <title></title>
    </head>
    <body>
        <?php require('header.php'); ?>
<!--
/* Set up and execute the query. */
$tsql = "SELECT [TANFCaseID]
,C.[HouseholdID]
,M.[PersonID]
,P.[FirstName]
,P.[LastName]
,S.[SSN]
  FROM [beta_torresmartinez].[TANFCaseModule].[TANFCase] C
  JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] M
  ON C.[HouseholdID] = M.[HouseholdID]
  JOIN [beta_torresmartinez].[PersonModule].[Person] P
  ON M.[PersonID] = P.[PersonID]
  JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
  ON M.[PersonID] = S.[PersonID]
  WHERE LastName = 'Jones' AND RIGHT(SSN,4) = '4514'";

$stmt = sqlsrv_query($conn, $tsql);
if ($stmt === false) {
    echo "Error in query preparation/execution.\n";
    die(print_r(sqlsrv_errors(), true));
}
echo $stmt;
/* Retrieve each row as an associative array and display the results. */
if ($tsql === 0) {
    echo "There is no matching account, please try again.\n";
} else {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo $row['LastName'] . ", " . $row['SSN'] . "\n";
    }
}

/* Free statement and connection resources. */
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn); -->

        <?php
        foreach ($db->query('SELECT
										journal.journal_id,
                                        journal.journal_name,
                                        image.image_name,
										entry.entry_id,
                                        entry.page_date, 
                                        entry.image_id, 
                                        entry.entry_date, 
                                        entry.entry_text
                                        FROM entry
                                        INNER JOIN image
                                        ON entry.image_id = image.image_id
                                        INNER JOIN journal
                                        ON entry.journal_id = journal.journal_id
                                        WHERE image.image_name = ' . "'" . $image_file_name . "'" . ' ORDER BY entry_date ASC ;') as $row) {
            echo '<div id="journal_text">';
            echo '<form method = "post" action = "insert_text.php">';
            echo '<input type = "hidden" name = "entry_id" value = "' . $row['entry_id'] . '">';
            echo '<input type = "hidden" name = "journal_id" value = "' . $row['journal_id'] . '">';
            echo '<input type = "hidden" name = "page_date" value = "' . $row['page_date'] . '">';
            echo '<input type = "hidden" name = "image_id" value = "' . $row['image_id'] . '">';
            //echo '<input type = "hidden" name = "entry_date" value = "' . $row['entry_date'] . '">';
            echo '<input type = "hidden" name = "image_name" value = "' . $row['image_name'] . '">';
            //echo '<tr>';
            //echo '<td id="tdDate">' . $row['entry_date'] . '</td>';
            //echo '<tr>';
            echo '<label class="labelDate">Date:</label>';
            echo '<input class="inputDate" type="date" name="entry_date" value=' . $row['entry_date'] . ' />';
            echo '<input type="submit" value="Add Entry" class="addEntryButton"/>';
            echo '<br>';
            echo '<textarea class="transcribeTxtarea" name="entry_text" rows="4" cols="44" wrap="soft" style="overflow:auto">' . $row['entry_text'] . '</textarea>';
            echo '<br>';
            //echo '<tr>';
            //echo '<input type="submit" value="Add Entry" class="addEntryButton"/>';
            //echo '<br>';
            echo '</form>';
            echo '</div>';
        }
        ?>