<?php

// The board for the game

require 'vendor/autoload.php';
use League\Csv\Writer;
use League\Csv\Reader;
use League\Csv\Statment;

header('Content-Type: text/csv; charset=ISO-8859-1');

class Board
{
    public function start()
    {
        echo "\n--- Game start ---\n\n";
        $boardUp   = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9];
        $boardDown = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0];
        $value = 0;
        sleep(2);
        $this->process($boardUp, $boardDown, $value);
    }

    public function show($boardUp, $boardDown)
    {
        echo "\t---------------------------------------------\n\t";
        foreach ($boardUp as $up) {
            echo "| ";
            echo $up == 0 ? " " : $up;
            echo " |";
        }
        echo " ↑ Up";
        echo "\n\t---------------------------------------------\n\t";
        foreach ($boardDown as $down) {
            echo "| ";
            echo $down == 0 ? " " : $down;
            echo " |";
        }
        echo " ↓ Down";
        echo "\n\t---------------------------------------------\n\n";
        sleep(2);
    }

    public function process($boardUp, $boardDown, $value)
    {
        $this->checkWin($boardUp, $boardDown);
        $this->checkLoss($boardUp, $boardDown, $value);

        $this->show($boardUp, $boardDown);

        $value = $value == 0 ? $this->roll() : $value;

        echo "Value to put down: " . $value . "\n\n";

        $this->checkLoss($boardUp, $boardDown, $value);

        $this->flipDown($boardUp, $boardDown, $value);
    }

    public function roll()
    {
        echo "Rolling dice...\n\n";
        sleep(2);

        $die1 = rand(1, 6);
        $die2 = rand(1, 6);
        $value = $die1 + $die2;

        echo "Die 1 rolled: " . $die1 . "\n";
        echo "Die 2 rolled: " . $die2 . "\n\n";

        return $value;
    }

    public function flipDown(&$boardUp, &$boardDown, &$value)
    {
        $flipDown = readline("- Enter the value you want to flip down: ");

        if ($flipDown > 9 || $flipDown < 1 || $flipDown > $value) {
            echo "\n--- Invalid value entered! ---\n\n";
            $this->flipDown($boardUp, $boardDown, $value);
        } elseif (in_array($flipDown, $boardDown)) {
            echo "\n--- Tile already down! ---\n\n";
            $this->flipDown($boardUp, $boardDown, $value);
        } else {
            echo "\nFlipping " . $flipDown . " down...\n\n";
            sleep(2);

            $boardDown[$flipDown] = $flipDown;
            $boardUp[$flipDown]   = 0;

            $value = $value - $flipDown;

            $this->process($boardUp, $boardDown, $value);
        }
    }

    public function checkWin($boardUp, $boardDown)
    {
        if (!in_array(0, $boardDown)) {
            $this->show($boardUp, $boardDown);
            echo "--- You win! ---\n\n";
            sleep(2);
            $this->setStats();
            $menu = new Menu();
            $menu->show();
        }
    }

    public function checkLoss($boardUp, $boardDown, $value)
    {
        if ($value != 0 && !in_array($value, $boardUp)) {
            $tilesUp = $boardUp;
            foreach ($tilesUp as $tile => $position) {
                if ($position == 0) {
                    unset($tilesUp[$tile]);
                }
            }
            $tilesUp = array_values($tilesUp);

            if (sizeof($tilesUp) > 1) {
                for ($i = 0; $i <= sizeof($tilesUp) - 1; $i++) {
                    for ($j = $i + 1; $j <= sizeof($tilesUp) - 1; $j++) {
                        $sum = $tilesUp[$i] + $tilesUp[$j];
                        if ($sum == $value) {
                            return false;
                        } elseif ($sum > $value) {
                            $loss = true;
                        }
                        for ($k = $j + 1; $k <= sizeof($tilesUp) - 1; $k++) {
                            $sum2 = $sum + $tilesUp[$k];
                            if ($sum2 == $value) {
                                return false;
                            } elseif ($sum2 > $value) {
                                break;
                            }
                            for ($l = $k + 1; $l <= sizeof($tilesUp) - 1; $l++) {
                                $sum3 = $sum2 + $tilesUp[$l];
                                if ($sum3 == $value) {
                                    return false;
                                } elseif ($sum3 > $value) {
                                    break;
                                }
                            }
                        }
                    }
                }
            } else {
                if ($tilesUp < $value) {
                    return false;
                }
            }

            if ($sum > $value) {
                echo "--- The value cannot be made.\n\n";
                sleep(2);
                echo "--- You lose! ---\n\n";
                sleep(2);
                $this->setStats(false);
                $menu = new Menu();
                $menu->show();
            }
        }
    }

    public function getStats()
    {
        $file = Reader::createFromPath('csv/stats.csv', 'r');
        $file->addStreamFilter('convert.iconv.ISO-8859-1/UTF-8//TRANSLIT');
        $data = $file->fetchOne();
        return $data;
    }

    public function setStats($result = true)
    {
        $stats = $this->getStats();

        $game = $stats[0];
        $win  = $stats[1];
        $lose = $stats[2];

        $game++;
        $result == true ? $win++ : $lose++;

        $statsFile = fopen('csv/stats.csv', 'w');
        fputcsv($statsFile, [$game, $win, $lose]);
    }
}
