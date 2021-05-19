<?php

class utile{
    public static function gererTitreNiveau1($titre){
        return '<h1 class="perso_backgroundColorBlueLight text-white p-2 mt-2 rounded-lg border border-dark">'.$titre.'</h1>';
    }

    public static function gererTitreNiveau2($titre){
        return '<h2 class="perso_backgroundColorBlueLight text-white p-2 mt-2 rounded-lg border border-dark">'.$titre.'</h2>';
    }
}

?>