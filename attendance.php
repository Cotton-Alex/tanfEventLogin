<!DOCTYPE html>
<html>
    <head>
        <?php require('head.php');?>
        <title></title>
    </head>
    <body>
        <?php require('header.php');?>
<?php echo $image_name; 
///* Set up and execute the query. */
//$tsql = "SELECT [TANFCaseID]
//,C.[HouseholdID]
//,M.[PersonID]
//,P.[FirstName]
//,P.[LastName]
//,S.[SSN]
//  FROM [beta_torresmartinez].[TANFCaseModule].[TANFCase] C
//  JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] M
//  ON C.[HouseholdID] = M.[HouseholdID]
//  JOIN [beta_torresmartinez].[PersonModule].[Person] P
//  ON M.[PersonID] = P.[PersonID]
//  JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
//  ON M.[PersonID] = S.[PersonID]
//  WHERE LastName = 'Jones' AND RIGHT(SSN,4) = '4514'";
//
//$stmt = sqlsrv_query($conn, $tsql);
//if ($stmt === false) {
//    echo "Error in query preparation/execution.\n";
//    die(print_r(sqlsrv_errors(), true));
//}
//echo $stmt;
///* Retrieve each row as an associative array and display the results. */
//if ($tsql === 0) {
//    echo "There is no matching account, please try again.\n";
//} else {
//    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
//        echo $row['LastName'] . ", " . $row['SSN'] . "\n";
//    }
//}
//
///* Free statement and connection resources. */
//sqlsrv_free_stmt($stmt);
//sqlsrv_close($conn); 