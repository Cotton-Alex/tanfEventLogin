<?php

function BeginProductsTable($rowCount) {
    /* Display the beginning of the search results table. */
    $headings = array("ID", "OneTimeEventNames");
    echo "<table align='center' cellpadding='5'>";
    echo "<tr bgcolor='silver'>$rowCount Results</tr><tr>";
    foreach ($headings as $heading) {
        echo "<td>$heading</td>";
    }
    echo "</tr>";
}

function EndProductsTable() {
    echo "</table><br/>";
}

function PopulateProductsTable($values) {
    /* Populate Products table with search results. */
    $oneTimeEventNamesID = $values['TANFOneTimeEventManagementID'];
    echo "<tr>";
    foreach ($values as $key => $value) {
        if (0 == strcasecmp("Name", $key)) {
            echo "<td><a href='?action=getreview&productid=$oneTimeEventNamesID'>$value</a></td>";
        } elseif (!is_null($value)) {
            if (0 == strcasecmp("ListPrice", $key)) {
                /* Format with two digits of precision. */
                $formattedPrice = sprintf("%.2f", $value);
                echo "<td>$$formattedPrice</td>";
            } else {
                echo "<td>$value</td>";
            }
        } else {
            echo "<td>N/A</td>";
        }
    }
    echo "<td>
<form action='adventureworks_demo_pdo.php' enctype='multipart/form-data' method='POST'>
<input type='hidden' name='action' value='writereview'/>
<input type='hidden' name='productid' value='$productID'/>
<input type='submit' name='submit' value='Write a Review'/>
</td></tr>
</form></td></tr>";
}

function DisplayNoProdutsMsg() {
    echo "<h4 align='center'>No products found.</h4>";
}

function GetSearchTerms($success) {
    /* Get and submit terms for searching the database. */
    if (is_null($success)) {
        echo "<h4 align='center'>Review successfully submitted.</h4>";
    }
    echo "<h4 align='center'>Enter search terms to find products.</h4>";
    echo "<table align='center'>
<form action='adventureworks_demo.php'
enctype='multipart/form-data' method='POST'>
<input type='hidden' name='action' value='getproducts'/>
<tr>
<td><input type='text' name='query' size='40'/></td>
</tr>
<tr align='center'>
<td><input type='submit' name='submit' value='Search'/></td>
</tr>
</form>
</table>";
}

?>