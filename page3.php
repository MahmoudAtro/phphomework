<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Form</title>
    <style>
        h1{
            text-align: center;
            color:green;
        }
        form{
            text-align:center;
            margin:auto;
        }
        label{
            color:blue;
        }
        .inp{
            width: 25%;
            border:green solid 2px;
        }
        div{
            text-align:center;
        }
        .btn{
            color:white;
            background-color: red;
        }
    </style>
</head>
<body>
    <h1>Search Form</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Type name for search :</label><br>
    <input type="name" name="searchname" class="inp"><br>
    <br>
    <input type="submit" value="Search" class="btn">

</form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["searchname"])){
        echo "<br> <div> Error: Invalid input! </div>";
        exit();
    }
    $query = $_POST["searchname"];
    function search($query) {
    $file = 'contacts.txt';
    $name = $query;
    $contents = file_get_contents($file);
    $pattern = preg_quote($name, '/');
    $pattern = "/^.*$pattern.*\$/m";
    if(empty($name)){
        echo "<div>"."<br> the query is empty" . "</div>";
        exit();
    }
    if (preg_match_all($pattern, $contents, $matches)) {
        echo "<div>" ."<br>" . "Information:" . "</div>";
        echo "<div>" . implode("<br>", $matches[0]) . "</div>";
    } else {
        echo "<div>"."<br> there is no query for this name" . "</div>";
    }
}
     search($query);
}

?>