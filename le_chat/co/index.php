<?php
session_start();
include "../bdd/bdd.php";

$BDD = 'users';

if(isset($_POST['valider'])){
    if(!empty($_POST['user']) && !empty($_POST['pass'])){
        $userSaisit = htmlspecialchars($_POST['user']);
        $passSaisit = htmlspecialchars($_POST['pass']);
        $selectUsers = "SELECT * FROM $BDD";
        $recupUsers = $PDO->query($selectUsers);
        while($user = $recupUsers->fetch()){
            if($user['user'] == $userSaisit && password_verify($passSaisit,$user['pass'])){
                echo "connection";
                $_SESSION['user'] = $userSaisit;
                ?>
                    <script type="text/javascript">
                        window.location.href = '../';
                    </script>
                <?php
            }else{
                echo "erreur de connection";
            }
        }
    }elseif(empty($_POST['user']) && !empty($_POST['pass'])){
        echo "veuillez entrer un nom d'utilisaateur";
    }elseif(!empty($_POST['user']) && empty($_POST['pass'])){
        echo "veuillez entrer un mot de passe";
    }else{
        echo "veuillez entrer un nom d'utilisateur et un mot de passe";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="co.css">
    <title>Tchat</title>
</head>
<body>
    <div class="container">
        <div class="connection">
            <div class="title">Connection</div>
            <form action="" method="POST">
                <label for="" class="form-label">Nom d'utilisateur</label>
                <input type="text" name="user" class="form-control inp" required>
                <label for="" class="form-label">Mot de passe</label>
                <input type="password" name="pass" class="form-control inp" required>
                <button type='submit' name="valider" class="btn btn-success valider">Valider</button>
            </form>
        </div>

        <div class="inscription">
            <a href="../inscription"><button type="button" name="envoyer" class="btn btn-success inscr">inscription</button></a>
        </div>
    </div>
<!--


▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄
██░▄▄▄░██░▄▄▄░██████░█████░▄▄▄█▄▀█▀▄
██▀▀▀▄▄██▀▀▀▄▄██████░█████░▄▄▄███░██
██░▀▀▀░██░▀▀▀░██████░▀▀░██░▀▀▀█▀▄█▄▀
▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀


 -->
</body>
</html>
