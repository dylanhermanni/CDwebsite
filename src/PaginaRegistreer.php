<?php
include ("header.html");
require 'config.php';

	if(isset($_POST['register'])) {
        $errMsg = '';

        // Krijgt de data uit het form
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $secretpin = $_POST['secretpin'];

        if($fullname == '')
            $errMsg = 'Enter your fullname';
        if($username == '')
            $errMsg = 'Enter username';
        if($password == '')
            $errMsg = 'Enter password';
		if($secretpin == '')
			$errMsg = 'Enter a sercret pin number';

		// haalt de gegevens uit de database
        if($errMsg == ''){
            try {
                $stmt = $connect->prepare('INSERT INTO pdo (fullname, username, password, secretpin) VALUES (:fullname, :username, :password, :secretpin)');
                $stmt->execute(array(
                    ':fullname' => $fullname,
                    ':username' => $username,
                    ':password' => $password,
                    ':secretpin' => $secretpin
                ));
                header('Location: register.php?action=joined');
                exit;
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
        $errMsg = 'U bent geregistreerd u kan nu <a href="login.php">inloggen</a>';
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
        Registreren! <br></h1>
    <p class="LoginForm">
    <form class="LoginForm" action="" method="post">
       Naam en achternaam: <input type="text" name="fullname" placeholder="Volledige naam" value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname'] ?>" autocomplete="off" class="box"/><br /><br />
       Gebruikersnaam: <input type="text" name="username" placeholder="Gebruikersnaam" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off" class="box"/><br /><br />
       Wachtwoord: <input type="password" name="password" placeholder="Wachtwoord" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" class="box" /><br/><br />
       Geheime code: <input type="text" name="secretpin" placeholder="Geheime code" value="<?php if(isset($_POST['secretpin'])) echo $_POST['secretpin'] ?>" autocomplete="off" class="box"/><br /><br />
        <input type="submit" name='register' value="Registreren" class='submit'/><br />
    </form>
    </form>
    </p>
</section>
</body>
</html>