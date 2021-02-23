<?php

// Shows number of games/wins/losses

require 'vendor/autoload.php';
use League\Csv\Writer;
use League\Csv\Reader;
use League\Csv\Statment;

header('Content-Type: text/csv; charset=ISO-8859-1');

class Stats
{

    public function show()
    {
        $stats = $this->getStats();

        echo "\n--- Stats ---\n\n";

        echo "- Games: " . $stats[0] . "\n";
        echo "- Wins: " . $stats[1] . "\n";
        echo "- Losses: " . $stats[2] . "\n\n";

        $menu = new Menu();
        $menu->show();
    }

    public function getStats()
    {
        $file = Reader::createFromPath('csv/stats.csv', 'r');
        $file->addStreamFilter('convert.iconv.ISO-8859-1/UTF-8//TRANSLIT');
        $data = $file->fetchOne();
        return $data;
    }
}
