<?php
require_once("classes/formatage.utile.php");
require_once("classes/paniers.manager.php");
class Panier{
    public static $paniers = [];

    private $identifiant;
    private $nomClient;
    private $pommes = [];
    private $cerises = [];

    public function __construct($identifiant, $nomClient){
       $this->identifiant = $identifiant;
       $this->nomClient = $nomClient;
    }

    public function getIdentifiant(){
        return $this->identifiant;
    }

    public function setFruitToPanierFromDB(){
        $fruits = panierManager::getFruitPanier($this->identifiant);

        foreach($fruits as $fruit){
            if(preg_match("/cerise/",$fruit['fruit'])){
                $this->cerises[] = new Fruit($fruit['fruit'],$fruit['poids'],$fruit['prix']);
            } else if(preg_match("/pomme/",$fruit['fruit'])){
                $this->pommes[] = new Fruit($fruit['fruit'],$fruit['poids'],$fruit['prix']);
            }
        }
    }

    public function __toString(){
        $affichage = utile::gererTitreNiveau2('Contenu du panier ' . $this->identifiant ." :");
        $affichage .= '<table class="table">';
            $affichage .= '<thead>';
                $affichage .= '<tr>';
                    $affichage .= '<th scope="col">Image</th>';
                    $affichage .= '<th scope="col">Nom</th>';
                    $affichage .= '<th scope="col">Poids</th>';
                    $affichage .= '<th scope="col">Prix</th>';
                    $affichage .= '<th scope="col">Modifier</th>';
                    $affichage .= '<th scope="col">Supprimer</th>';
                $affichage .= '</tr>';
            $affichage .= '</thead>';
            $affichage .= '<tbody>';
        foreach($this->pommes as $pomme){
            $affichage .= $this->affichagePersonaliseFruit($pomme);
        }
        foreach($this->cerises as $cerise){
            $affichage .= $this->affichagePersonaliseFruit($cerise);
        }  
            $affichage .= '</tbody>';
        $affichage .= '</table>';
        return $affichage;
    }

    private function affichagePersonaliseFruit($fruit){
        $affichage = '<tr>';
            $affichage .= '<td>'.$fruit->getImageSmall().'</td>';
            $affichage .= '<td>'.$fruit->getNom().'</td>';
            $affichage .= '<td>';
                if(isset($_GET['idFruit']) && $_GET['idFruit'] === $fruit->getNom()){
                    $affichage .= "<form method='POST' action='#'>";
                        $affichage .= '<input type="hidden" name="type" id="type" value="modification" />';
                        $affichage .= '<input type="hidden" name="idFruit" id="idFruit" value="'.$fruit->getNom().'" />';
                        $affichage .= '<input type="number" name="poidsFruits" id="poidsFruits" value="'.$fruit->getPoids().'" />';
                } else {
                    $affichage .= $fruit->getPoids();
                }
            $affichage .='</td>';
            $affichage .= '<td>';
                if(isset($_GET['idFruit']) && $_GET['idFruit'] === $fruit->getNom()){
                        $affichage .= '<input type="number" name="prixFruits" id="prixFruits" value="'.$fruit->getPrix().'" />';
                } else {
                    $affichage .= $fruit->getPrix();
                }
            $affichage .='</td>';
            $affichage .= '<td>';
            if(isset($_GET['idFruit']) && $_GET['idFruit'] === $fruit->getNom()){
                    $affichage .= '<input class="btn btn-success" type="submit" value="Valider" />';
                $affichage .= "</form>";
            } else {
                $affichage .= '<form action="#" method="GET">';
                    $affichage .= '<input type="hidden" name="idFruit" id="idFruit" value="'.$fruit->getNom().'" />';
                    $affichage .= '<input class="btn btn-primary" type="submit" value="Modifier" />';
                $affichage .= '</form>';
            }
              
            $affichage .= '</td>';
            $affichage .= '<td>';
                $affichage .= '<form action="#" method="POST">';
                    $affichage .= '<input type="hidden" name="idFruit" id="idFruit" value="'.$fruit->getNom().'" />';
                    $affichage .= '<input type="hidden" name="type" id="type" value="supprimer" />';
                    $affichage .= '<input class="btn btn-primary" type="submit" value="Supprimer" />';
                $affichage .= '</form>';
            $affichage .= '</td>';
        $affichage .= '</tr>';
        return $affichage;
    }

    public function addFruit($fruit){
        if(preg_match("/cerise/",$fruit->getNom())){
            $this->cerises[] = $fruit;
        } else if(preg_match("/pomme/",$fruit->getNom())){
            $this->pommes[] = $fruit;
        }
    }

    public function saveInDB(){
        return panierManager::insertIntoDB($this->identifiant, $this->nomClient);
    }

    public static function generateUniqueId(){
        return panierManager::getNbPanierInDB() + 1;
    }

}
?>