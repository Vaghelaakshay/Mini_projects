<?php require "class.login.php"; ?>
<?php 
    if (isset($_POST['submit'])) {
       $user = new loginUser($_POST['userNm'],$_POST['userPass']); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="card">
    <div id="card-content">
      <div id="card-title">
        <h2>LOGIN</h2>
        <div class="underline-title"></div>
        <!-- <h5>Both Fields are <span style="color: red;">required</span></h5> -->
      </div>
      <form action="" method="post" enctype="multipart/form-data"  class="form">
        <label for="user-username" style="padding-top:13px">
            &nbsp;Username
          </label>
        <input id="user-username" class="form-content" type="text" name="userNm" autocomplete="off" required />
        <div class="form-border"></div>
        <label for="user-password" style="padding-top:22px">&nbsp;Password
          </label>
        <input id="user-password" class="form-content" type="password" name="userPass" required />
        <div class="form-border"></div>
        <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
        <a href="./index.php" id="signup">Don't have account yet?</a>
        <p class="error" style="color: red;"><?php echo @$user->error ?></p>
        <p class="success" style="color: chartreusegreen;"><?php echo @$user->success?></p>
      </form>
    </div>
  </div>
</body>
</html>