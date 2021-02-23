<?php

// --- The main menu screen for the game.

class Menu
{
    public function show()
    {
        echo "--- Menu ---\n\n";

        echo "- 1. New game\n";
        echo "- 2. Rules\n";
        echo "- 3. Stats\n";
        echo "- 4. Exit\n\n";

        $menuOption = readline("- Enter the number of what you would like to do: ");

        switch ($menuOption) {
            case 1:
                $game = new Board();
                $game->start();
                break;
            case 2:
                $rules = new Rules();
                $rules->show();
                break;
            case 3:
                $stats = new Stats();
                $stats->show();
                break;
            case 4:
                exit;
            default:
                echo "Unknown option, try again.\n\n";
                $this->show();
        }
    }
}
