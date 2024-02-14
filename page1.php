<!DOCTYPE html>
<html>
<head>
<title>Contact Form</title>
<style>
    form , h1 ,h4{
        text-align:center;
        margin:auto;
    }
    h1{
        color:#33691E;
    }
    h4{
        color:blue;
    }
    .in{
        width:30%;
        border:green solid 1px;
    }
    label{
        color:red;
    }
    .btn,.btn1{
        color:white;
        background-color: red ; 
        display: inline;
    }
    #text{
        text-decoration: none;
        color:white;
    }
    div{
        text-align:center;
    }
</style>
</head>
<body>
<h1>Contact Form</h1>
<h4>This Form To My HomeWork PHP Language</h4><br>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label>Name:</label><br>
<input type="text" name="nameform" class="in"><br>
<label>Email:</label><br>
<input type="text" name="emailform" class="in"><br>
<label>Phone:</label><br>
<input type="text" name="phoneform" class="in"><br><br>
<input type="submit" value="Submit" class="btn">
<button class="btn1"><a href="page2.php" id="text">Show Information</a></button>
<button class="btn1"><a href="page3.php" id="text">Search</a></button>
</form>
</body>
</html>





<?php
class Contact {
    public $name;
    public $email;
    public $phone;

    function __construct($nameform, $emailform, $phoneform) {
        $this->name = $nameform;
        $this->email = $emailform;
        $this->phone = $phoneform;
    }
}

class information {
    private $infoarray = array();
    static $n=-1;
    function addinformation($contact) {
        foreach ($this->infoarray as $c) {
            if($c->email == $contact->email){
                return false;
            }
                }
        array_push($this->infoarray, $contact);
        return true;
    }

    function getContacts() {
        return $this->contacts;
    }

  function CheckFromInformation(){
  $name = $_POST["nameform"];
  $email = $_POST["emailform"];
  $phone = $_POST["phoneform"];
  if (empty($name) || empty($email) || empty($phone)) {
    return false;
  } 
  return true;
}

    function SaveToFile($filename) {
        try {
            $file = fopen($filename, "w");
            if (!$file) {
                throw new Exception("Unable to open file!");
            }
            foreach ($this->infoarray as $info) {
                fwrite($file, json_encode($info)."\n");
                echo "<br>";
            }
            fclose($file);
        } catch (Exception $e) {
            echo "<br> <div> Error: ".$e->getMessage() ."</div>";
        }
    }

    function loadFromFile($filename) {
        try {
            if (!file_exists($filename)) {
                throw new Exception("File not found!");
            }
            $file = fopen($filename, "r");
            if (!$file) {
                throw new Exception("Unable to open file!");
            }
            while (!feof($file)) {
                $line = fgets($file);
                if ($line != "") {
                    array_push($this->infoarray, json_decode(trim($line)));
                }
            }
            fclose($file);
        } catch (Exception $e) {
            echo "<br> <div> Error: ".$e->getMessage() ."</div>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["nameform"]) || !isset($_POST["emailform"]) || !isset($_POST["phoneform"])){
        echo "<br> <div> Error: Invalid input! </div>";
        exit();
    }

    $contact = new Contact($_POST["nameform"], $_POST["emailform"], $_POST["phoneform"]);
    $list = new information();
    $list->loadFromFile("contacts.txt");
    if(!$list->CheckFromInformation()){
        echo "<br> <div> Error: information is falid!</div>";
        exit();
    }
    if (!$list->addinformation($contact)) {
        echo "<br> <div> Error: Email already exists!</div>";
        exit();
    }else{
        echo "<br> <div> Information Saved Successfuly!</div>";
    }
    $list->saveToFile("contacts.txt");
}
?>

