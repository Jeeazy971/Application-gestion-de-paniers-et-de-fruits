<?php
    require_once("classes/fruits.class.php");
    require_once("classes/panier.class.php");
    require_once("classes/monPDO.class.php");
    require_once("classes/fruits.manager.php");
    include("common/header.php");
    include("common/menu.php");  
?>
<div class="container">
<?php  echo utile::gererTitreNiveau2("Fruits :") ?>

<?php

    if(isset($_POST['idPanier'])){
        $idFruit = $_POST['idFruit'];
        $idPanier = (int) $_POST['idPanier'];
        $res = fruitManager::updatePanierForFruitDB($idFruit,$idPanier);
        if($res){
            echo '<div class="alert alert-success mt-2" role="alert">La modification a été effectuée en BD</div>';
        } else {
            echo '<div class="alert alert-danger mt-2" role="alert">La modification n\'a pas été effectuée en BD</div>';
        }
    }

    fruitManager::setFruitsFromDB();
    echo '<div class="row mx-auto">';
    foreach(Fruit::$fruits as $fruit){
        echo '<div class="col-sm p-2">';
            echo $fruit->afficherListeFruit();
        echo '</div>'; 
    }
    echo '</div>';
?>
</div>
<?php 
    include("common/footer.php");
?>