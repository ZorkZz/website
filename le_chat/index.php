<?php
session_start();

include "bdd/bdd.php";

if(!$_SESSION["user"]){
?>
    <script type="text/javascript">
        window.location.href = 'co/';
    </script>
<?php
}

$bdd = 'messages';

$chatSQL = "SELECT * FROM $bdd WHERE cacher='non'";
$recupChat = $PDO->query($chatSQL);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Chat</title>
</head>


<?php

if(isset($_POST['destroy'])){
    session_destroy(); 
?>
    <script type="text/javascript">
        window.location.href = 'co/';
    </script>
<?php
}

?>


<body>

    <div class="header">
        <div class="band">
            <div class="txt">
            <div class="msgP"><a href="msgPv"><button class="btn btn-outline-light">messages prive</button></a></div>
            </div>
            <?php if (isset($_SESSION['user'])){?>
            <div class="user"><?=$_SESSION['user']?></div>
            <?php }?>
            <div class="deconection">
                <form action="" method="post">
                    <button class="btn btn-dark" name="destroy">se deconnecter</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped tb">
            <thead>
                <tr>
                    <th scope="col">#</td>
                    <th scope="col">user</td>
                    <th scope="col">message</td>
                    <th scope="col">supprimer</th>
                </tr>
            </thead>
            <tbody>
            <?php while($chat = $recupChat->fetch()){?>
                <tr>
                    <th class="td"><?=$chat['id'];?></td>
                    <td class="td"><?=$chat['user'];?></td>
                    <td class="td"><?=$chat['mess'];?></td>
                    <?php
                    if($chat['user']==$_SESSION['user']){?>
                        <td><a href="cacherMess?id=<?=$chat['id'];?>"><button class="btn btn-danger">supprimer</button></a></td>
                    <?php }else{
                        ?><td><button class="btn btn-secondary">supprimer</button></td><?php
                    }
                }?>
                </tr>
            </tbody>
        </table>

        <?php
        if(isset($_POST['envoyer'])){
            if(!empty($_POST['mess'])){
                $messSaisit = htmlspecialchars($_POST['mess']);
                $requestMess = "INSERT INTO $bdd (user,mess,cacher) VALUES (?,?,?)";
                $mess = $PDO->prepare($requestMess);
                $mess->execute(array($_SESSION['user'], $messSaisit, 'non'));
                echo "message envoye";
                ?>
                    <script type="text/javascript">
                        window.location.href = '../le_chat';
                    </script>
                <?php
            }
        }
        ?>

        <div class="nouvMess">
        <form action="" method="POST">
                <label for="" class="form-label">nouveau message</label>
                <textarea name="mess" cols="30" rows="10" class="form-control" id="floatingTextarea2" placeholder="entrez votre message"></textarea>
                <button type ="submit" class="btn btn-dark" name="envoyer">nouveau message</button>
            </form>
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