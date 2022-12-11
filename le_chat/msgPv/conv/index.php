<?php
session_start();

if(!$_SESSION["user"]){
    ?>
    <script type="text/javascript">
        window.location.href = '../co/';
    </script>
    <?php
}

$_SESSION['userConv'] = $_GET['usr'];
$_SESSION['idConv'] = $_GET['id'];

$usr1 = $_SESSION["user"];
$usr2 = $_SESSION['userConv'];

if(!$_SESSION['userConv'] && !$_SESSION['idConv']){
    ?>
    <script type="text/javascript">
        window.location.href = '../';
    </script>
<?php
}

include "../../bdd/bdd.php";

$convName = $_SESSION['idConv'];

$requestCreate = "CREATE TABLE IF NOT EXISTS `$convName`(
    id int(2) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    $usr1 varchar(255),
    $usr2 varchar(255),
    afficher varchar(11)
    )";

    if($SQL->query($requestCreate)){
    }else{
        echo 'error '. mysqli_error($SQL);
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="conv.css">
    <title>conversation</title>
</head>
<body>

    <?php
    
    if(isset($_POST['send'])){
        if(!empty($_POST['mess'])){
            $messageSaisit = htmlspecialchars($_POST['mess']);
            $requestSend = "INSERT INTO `$convName` ($usr1, afficher) VALUES (?,?)";
            $mess = $PDO->prepare($requestSend);
            $mess->execute(array($messageSaisit, 'oui'));
        }
    }

    ?>
    <a href="../"><button class="btn btn-outline-light" style="margin-top: 10px;">retour</button></a>
    <div class="title">Messages avec <?=$_GET['usr'];?></div>
    <div class="container">
        <?php
        $messSQL = "SELECT * FROM `$convName`";
        $recupMess = $PDO->query($messSQL);
        while($message = $recupMess->fetch()){
            if($message[$usr2]==NULL){
        ?>
        <div class="col usr1"><?=$usr1?></div>
        <div class="col"><?=$message[$usr1];?></div>
            <?php }elseif($message[$usr1]==NULL){?>
        <div class="col usr2"><?=$usr2?></div>
        <div class="col"><?=$message[$usr2];?></div>
            <?php }}?>
    </div>

    <div class="container-mess">
        <form action="" method="post" class="txt">
            <input name="mess" class="form-control message" placeholder="entrez votre message">

            <button name='send' class="btn btn-outline-success">envoyer</button>
        </form>
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