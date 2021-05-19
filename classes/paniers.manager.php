<?php

require_once("classes/panier.class.php");
require_once("classes/monPDO.class.php");
class panierManager{
    public static function setPaniersFromDB(){
        $pdo = monPDO::getPDO();
        $stmt = $pdo->prepare("Select identifiant, NomClient from panier");
        $stmt->execute();
        $paniers = $stmt->fetchAll();
        foreach ($paniers as $panier){
            Panier::$paniers[] = new Panier($panier['identifiant'], $panier['NomClient']);
        }
    }

    public static function getFruitPanier($identifiant){
        $pdo = monPDO::getPDO();
        $req = "select f.nom as fruit, f.poids as poids, f.prix as prix from panier p inner join fruit f on f.identifiant = p.identifiant where p.identifiant = :id";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id", $identifiant, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getNbPanierInDB(){
        $pdo = monPDO::getPDO();
        $req = "select count(*) as nbPanier from panier";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $resultat = $stmt->fetch();
        return $resultat['nbPanier'];
    }

    public static function insertIntoDB($identifiant,$nom){
        $pdo = monPDO::getPDO();
        $req = "insert into panier (identifiant, NomClient) values (:id,:nom)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id", $identifiant, PDO::PARAM_INT);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        try{
            return $stmt->execute();
        } catch (PDOException $e){
            echo "Erreur : ". $e->getMessage();
            return false;
        }
    }

    public static function getPaniers(){
        $pdo = monPDO::getPDO();
        $stmt = $pdo->prepare("Select identifiant, NomClient from panier");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>