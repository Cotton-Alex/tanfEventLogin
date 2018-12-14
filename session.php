<?php

if (!isset($_SESSION['journal_month'])) {
    $_SESSION['journal_month'] = "01";
} else {
    $_SESSION['journal_month'] = htmlspecialchars($_GET['journal_month']);
}

if (!isset($_SESSION['journal_day'])) {
    $_SESSION['journal_day'] = "01";
} else {
    $_SESSION['journal_day'] = htmlspecialchars($_GET['journal_day']);
}

if (!isset($_SESSION['journal_name'])) {
    $_SESSION['journal_name'] = ("1946-1950");
} else {
    $_SESSION['journal_name'] = htmlspecialchars($_GET['journal_name']);
}

?>