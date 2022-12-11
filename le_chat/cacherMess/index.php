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

$bdd = 'messages';
$id = $_GET['id'];


if(isset($_GET['id']) && !empty($_GET['id'])){
    $element = $PDO->prepare("SELECT * FROM $bdd WHERE id=?");
    $element->execute(array($id));
    if($element->rowCount()>0){
        $cacher = $PDO->prepare("UPDATE $bdd SET cacher=? WHERE id=$id");
        $cacher->execute(array('oui'));
        ?>
            <script type="text/javascript">
                window.location.href = '../co';
            </script>
        <?php
    }
}
?>