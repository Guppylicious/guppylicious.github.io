<?php

// --- The rules screen for the game.

class Rules
{
    public function show()
    {
        echo "\n--- Rules ---\n\n";

        echo "To start, there are 9 'tiles' which are all considered 'up'.\n";
        echo "The aim is to flip all the tiles down.\n\n";

        echo "To do this you must:\n";
        echo "- Roll 2 dice.\n";
        echo "- Flip down tiles that add up to the value rolled.\n";
        echo "-- For example, if you rolled a 4 and 5, you would need to flip down a value adding up to 9.\n";
        echo "- The value flipped down can be any number of valid tiles, as long as it adds up to the value rolled.\n";
        echo "-- For example, for a value of 9, you could flip down the 9 tile, but also 1 and 8, 2 and 7 or even 1, 2 and 6.\n";
        echo "- Once the value rolled has been met you can roll again to continue flipping down tiles.\n\n";

        echo "However:\n";
        echo "- Once a tile is put down, it cannot be flipped up again.\n";
        echo "- Once a value has been used, it cannot be used again.\n\n";

        echo "When all tiles are flipped down, you win.\n";
        echo "If there are no possible moves left and there are tiles still up, you lose.\n\n";

        $menu = new Menu();
        $menu->show();
    }
}
