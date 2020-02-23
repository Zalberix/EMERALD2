<?php 
$post = $_POST;

$host = "localhost";
$user = "root";
$password = "";
$db_name = "stock";

$answer = [];

$link = mysqli_connect($host, $user, $password, $db_name);

mysqli_query($link, "SET NAMES 'utf8' ");

// $query = "SELECT `buys`.`buy`, `clients`.`name` AS `client`, `products`.`name` AS `product`, `buys`.`count` AS `count` FROM `buys`,`clients`,`products` WHERE `clients`.`id` = `buys`.`client` AND `products`.`id` = `buys`.`product`";
// $result = mysqli_query($link, $query) or die(mysqli_error($link));

// for ($data = []; $row  = mysqli_fetch_assoc($result); $data[] = $row);
// $answer["buys"] = $data;

//список машин
// $query = "SELECT `name`,`type` FROM `drivers`";
// $result = mysqli_query($link, $query) or die(mysqli_error($link));

// for ($data = []; $row  = mysqli_fetch_assoc($result); $data[] = $row);
// $answer["providers"] = $data;

//список поставщиков
$query = "SELECT `name` FROM `providers`";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

for ($data = []; $row  = mysqli_fetch_assoc($result); $data[] = $row);
$answer["providers"] = $data;

//список продуктов
$query = "SELECT `name` FROM `products`";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

for ($data = []; $row  = mysqli_fetch_assoc($result); $data[] = $row);
$answer["products"] = $data;

//список клиентов
$query = "SELECT `name` FROM `clients`";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

for ($data = []; $row  = mysqli_fetch_assoc($result); $data[] = $row);
$answer["clients"] = $data;

//список поставок
$query = "SELECT `plan`.`item`, `providers`.`name` AS `destination` ,`plan`.`type` AS `typeOfTransportation`, `products`.`name` AS `product`, `count` AS `countProduct` FROM `plan`, `products`,`providers` WHERE `plan`.`type` = 0 AND `products`.`id` = `plan`.`product` AND `plan`.`destination` = `providers`.`id` AND `plan`.`item` = 1 ;";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

for ($data = []; $row  = mysqli_fetch_assoc($result); $data[] = $row);
$answer["postDelivery"] = $data;

//список доставок
$query = "SELECT `plan`.`item`, `clients`.`name` AS `destination` ,`plan`.`type` AS `typeOfTransportation`, `products`.`name` AS `product`, `count` AS `countProduct` FROM `plan`, `products`,`clients` WHERE `plan`.`type` = 1 AND `products`.`id` = `plan`.`product` AND `plan`.`destination` = `clients`.`id` AND `plan`.`item` = 1 ;";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

for ($data = []; $row  = mysqli_fetch_assoc($result);$data[] = $row);
$answer["delivery"] = $data;

$link->close();

echo json_encode($answer);

?>