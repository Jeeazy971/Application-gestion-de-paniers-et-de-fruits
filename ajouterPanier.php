<?php 
    require_once("classes/fruits.class.php");
    require_once("classes/panier.class.php");
    require_once("classes/formatage.utile.php");
    include("common/header.php");
    include("common/menu.php");
?>
<div class="container">
<?php echo utile::gererTitreNiveau2("Ajout d'un panier :"); ?>

<?php   
    echo '<form action="#" method ="POST" >';
        echo '<div class="row">';
            echo '<div class="col">';
                echo '<label for="client">Nom du client : </label>';
                echo '<input class="form-control" type="text" name="client" id="client" required/>';
            echo '</div>';
            echo '<div class="col">';
                echo '<label for="nb_pommes">Nombres de pommes : </label>';
                echo '<input class="form-control" type="number" name="nb_pommes" id="nb_pommes" required/>';
            echo '</div>';
            echo '<div class="col">';
                echo '<label for="nb_cerise">Nombres de cerises : </label>';
                echo '<input class="form-control" type="number" name="nb_cerise" id="nb_cerise" required/>';
            echo '</div>';
            echo '<input class="btn btn-primary" type="submit" value="Créer le panier" />';
        echo '</div>';
    echo "</form>";

    if(isset($_POST['client']) && !empty($_POST['client'])){
        $p = new Panier(Panier::generateUniqueId(),$_POST['client']);
        $res = $p->saveInDB();
        if($res){
            $nbPomme = (int)$_POST['nb_pommes'];
            $nbCerise = (int)$_POST['nb_cerise'];
            $cpt = 1;
            $nbFruitInDB=Fruit::genererUniqueID();
            for($i = 0 ; $i < $nbPomme;$i++){
                $fruit = new Fruit("pomme".($nbFruitInDB+$cpt),rand(120,160),20);
                $fruit->saveInDB($p->getIdentifiant());
                $p->addFruit($fruit);
                $cpt++;
            }
            for($i = 0 ; $i < $nbCerise;$i++){
                $fruit = new Fruit("cerise".($nbFruitInDB+$cpt),rand(120,160),20);
                $fruit->saveInDB($p->getIdentifiant());
                $p->addFruit($fruit);
                $cpt++;
            } 
            echo $p;
            echo "OK";

        } else {
            echo "L'ajout n'a pas fonctionné";
        }
    }
?>
</div>
<?php 
    include("common/footer.php");
?>