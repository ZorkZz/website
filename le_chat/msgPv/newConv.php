<?php
session_start();

include "../bdd/bdd.php";

if(!$_SESSION["user"]){
    ?>
    <script type="text/javascript">
        window.location.href = '../co/';
    </script>
<?php
}

try{
    $req = "INSERT INTO prsnpv (user1,user2) VALUES (?,?)";
    $stmt = $PDO->prepare($req);
    $stmt->execute(array($_SESSION['user'],$_GET['usr']));
    header('Location: ../msgPv');
}catch(PDOException $e){
    echo $e->getMessage();  
}

?>