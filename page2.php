<html>
    <title>View Information</title>
    <style>
        h1{
            text-align:center;
            color:green;
        }
        h4{
            text-align:center;
            color:blue;
        }
    </style>
    <h1>The Information : </h1>
</html>


<?php

$contents = file("contacts.txt");
foreach ($contents as $line) {
    echo '<h4>'.$line.'</h4>' . "<br>";
}

?>

