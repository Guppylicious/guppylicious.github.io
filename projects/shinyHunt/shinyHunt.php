<?php

require_once 'code/menu.php';
require_once 'code/getShiny.php';
require_once 'code/getPokemon.php';

echo "\n--- Shiny Pokémon Hunter ---\n\n";

$menu = new Menu();
$menu->show();
