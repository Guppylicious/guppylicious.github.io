<?php

require_once 'game/menu.php';
require_once 'game/board.php';
require_once 'game/rules.php';
require_once 'game/stats.php';

echo "\n--- Shut the Box ---\n\n";

$menu = new Menu();
$menu->show();
