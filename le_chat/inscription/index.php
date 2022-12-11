<?php
session_start();
include "../bdd/bdd.php";

$BDD = 'users';
if(isset($_POST['valider'])){
    if(!empty($_POST['user']) && !empty($_POST['pass'])){
        $userSaisit = htmlspecialchars($_POST['user']);
        $passSaisit = htmlspecialchars($_POST['pass']);
        $selectUser = "SELECT * FROM $BDD WHERE user = ?";
        $checkUsers = $PDO->prepare($selectUser);
        $checkUsers->execute(array($userSaisit));
        $data = $checkUsers->fetch();
        $row = $checkUsers->rowCount();
        if($row == 0){
            $Hpass = password_hash($passSaisit, PASSWORD_DEFAULT);
            $requestInscr = "INSERT INTO $BDD (user, pass) VALUES (?,?)";
            $inscr = $PDO->prepare($requestInscr);
            $inscr->execute(array($userSaisit, $Hpass));
            $_SESSION['user'] = $userSaisit;
            ?>
                <script type="text/javascript">
                    window.location.href = '../';
                </script>
            <?php
        }else{
            echo "vous etes deja inscrit";
        }
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
    <link rel="stylesheet" href="inscr.css">
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <div class="inscription">
            <div class="title">inscription</div>
            <form action="" method="POST">
                <label for="" class="form-label">Nom d'utilisateur</label>
                <input type="text" name="user" class="form-control inp" required>
                <label for="" class="form-label">Mot de passe</label>
                <input type="password" name="pass" class="form-control inp" required>
                <button type='submit' name="valider" class="btn btn-success valider">Valider</button>
            </form>
        </div>

        <div class="connection">
            <a href="../co"><button type="button" name="button" class="btn btn-success co">connection</button></a>
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
