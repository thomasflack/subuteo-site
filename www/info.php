<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/database/testDbFactory.php');

$objDbFactory = new testDbFactory();
$objDb = $objDbFactory->create();

$strQuery = 'SELECT * FROM test.testtable';

$result = $objDb->query($strQuery);

$row = mysqli_fetch_assoc($result);

print_r($row);
