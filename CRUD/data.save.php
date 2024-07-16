<?php 
     include 'database.php';
     $obj = new database();
     if (isset($_POST['submit'])) {
        $name = $_POST['name'];
         $language = $_POST['language'];
         $experience = $_POST['experience'];
         $city = $_POST['city'];
         $values = ["name"=>$name,"lang"=>$language,"exp"=>$experience,"cityname"=>$city];
         if ($obj->insert('info',$values)) {
           echo"<h2>Data inserted</h2>";
         }else {
            echo"<h2>Have Error something</h2>";
         }
         echo "<a href='./data.show.php'>go to list</a>";
     }
?>