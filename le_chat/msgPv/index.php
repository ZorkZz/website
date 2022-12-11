<?php
session_start();

if(!$_SESSION["user"]){
    ?>
    <script type="text/javascript">
        window.location.href = '../co/';
    </script>
<?php
}

$user = $_SESSION['user'];

include "../bdd/bdd.php";

$BDDPDO = 'prsnpv';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="pv.css">
    <title>Messages prive</title>
</head>
<body>
    <div class="container">
        <div class="retour"><a href="../"><button class="btn btn-outline-secondary">retour au chat principal</button></a></div>
        <table class="table table-striped tb">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">user</th>
                    <th scope="col">acceder a la conv?</th>
                </tr>
            </thead>
            <tbody>
            <?php $REQ = "SELECT * FROM $BDDPDO";
                $recupConv = $PDO->query($REQ);

                while($conv=$recupConv->fetch()){
                    if($conv['user1']==$_SESSION['user'] || $conv['user2']==$_SESSION['user']){
                        if($conv['user1']==$_SESSION['user']){?>
                            <tr>
                                <th class="td"><?=$conv['id']?></th>
                                <td class="td"><?=$conv['user2']?></td>
                                <td class="td"><a href="conv?id=<?=$conv['id'];?>&usr=<?=$conv['user2'];?>"><button class="btn btn-outline-light">acceder</button></a></td>
                            </tr>
                                <?php
                        }elseif($conv['user2']==$_SESSION['user']){
                            ?>
                            <tr>
                                <th class="td"><?=$conv['id']?></th>
                                <td class="td"><?=$conv['user1']?></td>
                                <td class="td"><a href="conv?id=<?= $conv['id'];?>&usr=<?=$conv['user1']?>"><button class="btn btn-outline-light">acceder</button></a></td>
                            </tr>
                        <?php
                        }
                    }
                }?>
            </tbody>
        </table>
        <h1 classe="title" style="text-align: center;margin-top: 60px;margin-bottom: 30px;">Creer une nouvelle conversation</h1>
        <table class="table table-striped tb">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">user</th>
                    <th scope="col">Creer une nouvelle conversation?</th>
                </tr>
            </thead>
            <tbody> 
            <?php
            $userBDD = 'users';
            $selectUser = "SELECT * FROM `$userBDD`";
            $recupUser = $PDO->query($selectUser);

            $REQ1 = "SELECT * FROM `$BDDPDO`";
            $recupConv1 = $PDO->query($REQ1);
            
                while($user = $recupUser->fetch()){
                    if($user['user']!=$_SESSION['user']){
                        
                    ?>
                <tr>
                    <th class="td"><?=$user['id'];?></th>
                    <td class="td"><?=$user['user'];?></td>
                    <td class="td">
                        <form action="newConv.php?id=<?=$user['id'];?>&usr=<?=$user['user'];?>" method="POST">
                            <button name="newConv" class="btn btn-outline-light">acceder</button>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                }
            ?>
            </tbody>
        </table>
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