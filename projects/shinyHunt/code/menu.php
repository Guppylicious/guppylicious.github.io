<?php

// --- The main menu screen.

class Menu
{
    public function show()
    {
        echo "--- Main menu ---\n\n";
        echo "- 1. Go shiny hunting!\n";
        echo "- 2. Averages Hunt\n";
        echo "- 3. Exit\n\n";
        $menuOption = readline("- Enter the number of what you would like to do: ");

        $startHunt = new GetShiny();

        switch ($menuOption) {
            case 1:
                $startHunt->init(true);
                break;
            case 2:
                $startHunt->init(false);
                break;
            case 3:
                exit;
            default:
                echo "Unknown option, try again.\n\n";
                $this->show();
        }
    }
}
