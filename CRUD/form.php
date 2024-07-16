<?php 
    include 'database.php';
    $obj = new database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
</head>
<body>
    <h2>ADD NEW USER</h2>
    <hr>
    <form action="data.save.php" method="post">
        <label >Name</label>
        <input type="text" name="name" required><br>
        <label >Language</label>
        <input type="text" name="language" required><br>
        <label >Experience</label>
        <input type="number" name="experience" required><br>
        <label >City</label>
        <select name="city" id=""" required>
        <option value=''></option>
        <?php 
        $obj->select('city','*',null,null,null,null);
        $result= $obj->getResult();
          foreach ($result as list("id"=>$cid, "CTname"=>$ct)) {
               echo "<option value='$cid'>$ct</option>";
          }
            ?>    
    </select><br>
       <button type="submit" name="submit">SUBMIT</button>   
    </form>
    <a href='./data.show.php'>back</a>
</body>
</html>