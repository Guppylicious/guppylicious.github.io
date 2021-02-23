<?php

// ---- Hunt for a shiny until one is found and return number of attempts

class GetShiny
{
    public function init(bool $singleRun)
    {
        $odds = 0;

        echo "\n--- Choose a Gen ---\n\n";
        echo "- 1. Gen 2-5 (1 in 8191)\n";
        echo "- 2. Gen 6+ (1 in 4096)\n\n";
        $genOption = readline("- Pick which gen to run from: ");

        switch ($genOption) {
            case 1:
                $odds = 8191;
                break;
            case 2:
                $odds = 4096;
                break;
            default:
                echo "Unknown option, try again.\n\n";
                $this->start();
        }

        $singleRun ? $this->singleRun($odds) : $this->multiRun($odds);
    }

    public function shinyHunt($odds)
    {
        $shinyHit = false;
        $attempts = 0;

        while (!$shinyHit) {
            $attempts++;
            $num1 = rand(1, $odds);
            $num2 = rand(1, $odds);

            if ($num1 == $num2) {
                $shinyHit = true;
            }
        }

        return $attempts;
    }

    public function singleRun(int $odds)
    {
        $result  = $this->shinyHunt($odds);
        $chances = round($result / $odds, 4) * 100;

        $getPokemon = new GetPokemon();
        echo "\nYou found a shiny " . $getPokemon->getRandom() . "\n";

        echo "\nIt took " . $result . " attempts to find a shiny Pokémon!\n";
        echo "\nThe chances of getting a shiny in this many attempts was " . $chances . "%.\n\n";

        $this->end();
    }

    public function multiRun(int $odds)
    {
        echo "\nRunning through " . $odds . " attempts, this may take a while...\n";

        $attempts    = 0;
        $high        = 0;
        $highAttempt = 0;
        $low         = PHP_INT_MAX;
        $lowAttempt  = 0;

        for ($i = 0; $i <= $odds; $i++) {
            if ($i == round($odds / 2)) {
                echo "\nWe're half way there, please wait a little longer...\n";
            }

            $result    = $this->shinyHunt($odds);
            $attempts += $result;

            if ($result > $high) {
                $high        = $result;
                $highAttempt = $i;
            }
            if ($result < $low) {
                $low        = $result;
                $lowAttempt = $i;
            }
        }

        $average = round($attempts / $odds);

        echo "\nOn average it took " . $average . " attempts to find a shiny Pokémon!\n";
        echo "\nThe most attempts it took you to find a shiny Pokémon was " . $high . ", on attempt " . $highAttempt . ".";
        echo "\nThe least attempts it took you to find a shiny Pokémon was " . $low . ", on attempt " . $lowAttempt . ".\n\n";

        $this->end();
    }

    public function end()
    {
        sleep(3);

        $menu = new Menu();
        $menu->show();
    }
}
