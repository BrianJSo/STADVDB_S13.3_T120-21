<?php

include_once("connections/connection.php");
$con = connection();

$mode = $_REQUEST["mode"];
$strSearch = $_REQUEST["strSearch"];
$pageNum = $_REQUEST["pageNum"] -1;
$pageLimit = 20;
$offset = $pageNum * $pageLimit;

switch ($mode) {
    case "name":
        $sql = 'SELECT name FROM movies WHERE name LIKE "%'.$strSearch.'%" LIMIT '.$pageLimit.' OFFSET '.$offset;
        break;
    case "id":
        $sql = 'SELECT name FROM movies WHERE movies.id = '.$strSearch.' LIMIT '.$pageLimit.' OFFSET '.$offset;
        break;
    case "year":
        $sql = 'SELECT name FROM movies WHERE YEAR = '.$strSearch.' LIMIT '.$pageLimit.' OFFSET '.$offset;
        break;
    case "ratinglessorequal":
        $sql = 'SELECT name FROM movies WHERE movies.rank <= '.$strSearch.' LIMIT '.$pageLimit.' OFFSET '.$offset;
        break;
    case "ratinggreaterorequal":
        $sql = 'SELECT name FROM movies WHERE movies.rank >= '.$strSearch.' LIMIT '.$pageLimit.' OFFSET '.$offset;
        break;
    default:
        $sql = 'SELECT name FROM movies';
  }

$result = $con->query($sql) or die ($con->connect_error);
while($row = $result->fetch_assoc()){
    echo "<li>".$row['name']."</li>";
};

?>