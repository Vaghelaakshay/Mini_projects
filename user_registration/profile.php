<?php 
    session_start();
    if (!isset($_SESSION['user'])) {
      header("location:login.php"); exit();  
    }
    if (isset($_GET['logout'])) {
       unset($_SESSION['user']);
       header("location:login.php"); exit();  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>account</title>
</head>
<body>
    <h2>Welcome <?php echo $_SESSION['user'];?></h2>
    <a href="?logout">log out</a>
    <main>
        <p>something access <?php echo $_SESSION['user'];?> </p>
    </main>
</body>
</html>