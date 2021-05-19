<?php
    require_once("classes/fruits.class.php");
    require_once("classes/panier.class.php");
    require_once("classes/monPDO.class.php");
    require_once("classes/paniers.manager.php");
    require_once("classes/fruits.manager.php");
    include("common/header.php");
    include("common/menu.php");  
?>

<div class="container">

<?php
    if(isset($_POST['idFruit']) && $_POST['type'] === "modification"){
        $idFruitToUpdate = $_POST['idFruit'];
        $poidsFruitToUpdate = (int) $_POST['poidsFruits'];
        $prixFruitToUpdate = (int) $_POST['prixFruits'];
        $res = fruitManager::updateFruitDB($idFruitToUpdate,$poidsFruitToUpdate,$prixFruitToUpdate);
        if($res){
            echo '<div class="alert alert-success mt-2" role="alert">La modification a été effectuée en BD</div>';
        } else {
            echo '<div class="alert alert-danger mt-2" role="alert">La modification n\'a pas été effectuée en BD</div>';
        }
    } else if(isset($_POST['idFruit']) && $_POST['type'] === "supprimer"){
        $idFruitToUpdate = $_POST['idFruit'];
        $res = fruitManager::deleteFruitFromPanier($idFruitToUpdate);
        if($res){
            echo '<div class="alert alert-success mt-2" role="alert">La suppression a été effectuée en BD</div>';
        } else {
            echo '<div class="alert alert-danger mt-2" role="alert">La suppression n\'a pas été effectuée en BD</div>';
        }
    }

    panierManager::setPaniersFromDB();

    foreach(Panier::$paniers as $panier){
        $panier->setFruitToPanierFromDB();
        echo $panier;
    }
?>
</div>
<?php 
    include("common/footer.php");
?>