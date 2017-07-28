<?php
include ("header.html");
require 'config.php';

if(isset($_POST['login'])) {
    $errMsg = '';

    // Get data from FORM
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == '')
        $errMsg = 'Enter username';
    if($password == '')
        $errMsg = 'Enter password';

    if($errMsg == '') {
        try {
            $stmt = $connect->prepare('SELECT id, fullname, username, password, secretpin FROM pdo WHERE username = :username');
            $stmt->execute(array(
                ':username' => $username
            ));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if($data == false){
                $errMsg = "Gebruiker $username is niet gevonden.";
            }
            else {
                if($password == $data['password']) {
                    $_SESSION['name'] = $data['fullname'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['secretpin'] = $data['secretpin'];

                    header('Location: dashboard.php');
                    exit;
                }
                else
                    $errMsg = 'Password not match.';
            }
        }
        catch(PDOException $e) {
            $errMsg = $e->getMessage();
        }
    }
}

if(isset($_SESSION['username'])) {
    header('Location: profiel.php');
    exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section class="Links"><h1 class="tekstkop">
Login! <br></h1>
<p class="LoginForm">
    <form class="LoginForm" action="" method="post">
      Gebruikersnaam:  <input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off" class="box"/><br /><br />
      Wachtwoord:  <input type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" autocomplete="off" class="box" /><br/><br />
        <input type="submit" name='login' value="Login" class='submit'/><br />
    </form>
    <?php
    if(isset($errMsg)){
        echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
    }
    ?>
</p>
</section>
</body>
</html>