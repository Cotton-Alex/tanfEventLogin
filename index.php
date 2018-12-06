<!DOCTYPE html>
<?php require('waConnect.php'); ?>
<?php require('functions.php'); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //case 'getOneTimeEventNames':
        $params = array(&$_POST['query']);
        $tsql = "SELECT [TANFOneTimeEventManagementID], [EventName]
        FROM [beta_torresmartinez] . [TANFOneTimeEventManagementModule] . [TANFOneTimeEventManagement]";
        $getOneTimeEventNames = $conn->prepare($tsql);
        $getOneTimeEventNames->execute($params);
        $oneTimeEventNames = $getOneTimeEventNames->fetchAll(PDO::FETCH_ASSOC);
        $oneTimeEventNamesCount = count($oneTimeEventNames);
        if ($oneTimeEventNamesCount > 0) {
            BeginProductsTable($oneTimeEventNamesCount);
            foreach ($oneTimeEventNames as $row) {
                echo $row;
            }
            EndProductsTable();
        } else {
            DisplayNoProdutsMsg();
        }
//        } catch (Exception $e) {
//        die(print_r($e->getMessage()));
//        }
//        GetSearchTerms(!null);
//        break;
//        case 'getproducts':
//        try {
//        $params = array($_POST['query']);
//        $tsql = "SELECT ProductID, Name, Color, Size, ListPrice
//FROM Production.Product
//WHERE Name LIKE '%' + ? + '%' AND ListPrice > 0.0";
//        $getProducts = $conn->prepare($tsql);
//        $getProducts->execute($params);
//        $products = $getProducts->fetchAll(PDO::FETCH_ASSOC);
//        $productCount = count($products);
//        if ($productCount > 0) {
//        BeginProductsTable($productCount);
//        foreach ($products as $row) {
//        PopulateProductsTable($row);
//        }
//        EndProductsTable();
//        } else {
//        DisplayNoProdutsMsg();
//        }
//        } catch (Exception $e) {
//        die(print_r($e->getMessage()));
//        }
//        GetSearchTerms(!null);
//        break;
//        
        ?>
    </body>
</html>
