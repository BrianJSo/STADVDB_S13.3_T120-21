<?php

include_once("connections/connection.php");
$con = connection();

$mode = $_REQUEST["mode"];
$strSearch = $_REQUEST["strSearch"];
$strSearch2 = $_REQUEST["strSearch2"];
$pageNum = $_REQUEST["pageNum"] - 1;
$pageLimit = 20;
$offset = $pageNum * $pageLimit;

switch ($mode) {

    // Single Queries
    case "name":
        $sql = 'SELECT name FROM movies WHERE name LIKE "%' . $strSearch . '%" LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;
    case "id":
        $sql = 'SELECT name FROM movies WHERE movies.id = ' . $strSearch . ' LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;
    case "year":
        $sql = 'SELECT name FROM movies WHERE YEAR = ' . $strSearch . ' LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;
    case "ratinglessorequal":
        $sql = 'SELECT name FROM movies WHERE movies.rank <= ' . $strSearch . ' LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;
    case "ratinggreaterorequal":
        $sql = 'SELECT name FROM movies WHERE movies.rank >= ' . $strSearch . ' LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;

    // Two Table Queries
    case "directorname":
        $sql = 'SELECT name FROM movies 
                JOIN movies_directors AS md ON movies.id = md.movie_id 
                JOIN directors ON directors.id = md.director_id 
                JOIN directorfullname ON directors.id = directorfullname.id
                WHERE directorfullname.full_name LIKE "%'.$strSearch.'%" 
                LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;
    case "directorid":
        $sql = 'SELECT name FROM movies
                JOIN movies_directors AS md ON movies.id = md.movie_id
                JOIN directors ON directors.id = md.director_id
                JOIN directorfullname ON directors.id = directorfullname.id
                WHERE directors.id = ' . $strSearch . '
                LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;
    
    // Three Table Queries
    case "movietoactor":
        $sql = 'SELECT actorfullname.full_name, roles.role, movies.name FROM actors
                JOIN roles ON actors.id = roles.actor_id
                JOIN movies ON roles.movie_id = movies.id
                JOIN actorfullname ON actors.id = actorfullname.id
                WHERE movies.name LIKE "%' . $strSearch . '%"
                LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;
    case "actorgenre":
        $sql = 'SELECT actorfullname.full_name, COUNT(mg.genre) AS "Acted in a Genre"  FROM roles
                JOIN movies ON roles.movie_id = movies.id
                JOIN movies_genres AS mg ON movies.id = mg.movie_id
                JOIN actors ON roles.actor_id = actors.id
                JOIN actorfullname ON actorfullname.id = actors.id
                WHERE mg.genre LIKE "%' . $strSearch . '%" AND actorfullname.full_name LIKE "%' . $strSearch2 . '%"
                GROUP BY actorfullname.full_name
                LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;
    
    // Four to Six Table Queries
    case "actordirector":
        $sql = 'SELECT actorfullname.full_name AS "Actor Name", COUNT(movies.name) AS "Number of times played under the director" FROM actors
                JOIN roles ON roles.actor_id = actors.id
                JOIN movies ON roles.movie_id = movies.id
                JOIN movies_directors AS md ON md.movie_id = movies.id
                JOIN directors ON directors.id = md.director_id
                JOIN directorfullname ON directors.id = directorfullname.id
                JOIN actorfullname ON actorfullname.id = actors.id
                WHERE actorfullname.full_name LIKE "%' . $strSearch . '%" AND directorfullname.full_name LIKE "%' . $strSearch2 . '%"
                GROUP BY actorfullname.full_name
                LIMIT ' . $pageLimit . ' OFFSET ' . $offset;
        break;

    default:
        $sql = 'SELECT name FROM movies';
}
echo "no results found";
$result = $con->query($sql) or die($con->connect_error);

$finfo = $result->fetch_fields();
$numFields = count($finfo);

echo "<tr>";
echo "<th></th>";
foreach ($finfo as $val) {
    echo "<th>" .  $val->name . "</th>";
}
echo "</tr>";
$rowCount = 0;
while ($row = $result->fetch_array()) {
    echo "<tr>";
    $rowCount++;
    echo "<td>" . ($offset+$rowCount) . "</td>";

    for($i = 0; $i < $numFields; $i++){
        echo "<td>" . $row[$i] . "</td>";
    }
    echo "</tr>";
};
