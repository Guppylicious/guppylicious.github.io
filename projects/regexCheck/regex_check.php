<?php
//---- detect whether a regex passes based on given strings.
require 'vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

//---- get file from terminal argument and parse
$file = $argv[1];
$yaml = Yaml::parseFile($file);

$tick = mb_convert_encoding('&#10003;', 'UTF-8', 'HTML-ENTITIES'); //tick symbol
$cross = mb_convert_encoding('&#10007;', 'UTF-8', 'HTML-ENTITIES'); //cross symbol

//---- check each string for each pattern
foreach ($yaml['patterns'] as $pattern) {
	print ("\e[1;33m\n----- Checking " . $pattern . "\e[0m\n\n");
	
	$titleMask = "\e[0;35m %-'-40s %-'-40s %-'-40s\e[0m\n";
	$expectedMask = "\n\e[1;34m%-'-144s\e[0m\n\n";
	$mask = " %-40s %-42s %-40s\n"; //heading character count didn't match results for some reason
	
	printf($titleMask, " String ", "| Outcome ", "| Captures ");
	
	$state = true;
	
	foreach ($yaml['strings'] as $string) {
		$value = $string['value'];
		$expected = $string['expected'];
		
		$result = preg_match($pattern, $value, $matches);
		
		$matchArray = [];
		
		foreach (array_slice($matches, 1) as $match) {
			array_push($matchArray, $match);
		}
		
		$matchString = implode(", ", $matchArray);
		
		if ($expected == 1) {
			if ($state == true) {
				printf($expectedMask, " Expected match ");
				$state = false;
			}
			if ($result) {
				printf("\e[0;32m" . $mask, " '" . $value . "'", "| " . $tick . " matched as expected",  "| " . $matchString . "\e[0m");	
			} else {
				printf("\e[0;31m" . $mask, " '" . $value . "'", "| " . $cross . " unmatched unexpectedly", "| " . $matchString . "\e[0m");
			}
		} else {
			if ($state == false) {
				printf($expectedMask, " Expected unmatch ");
				$state = true;
			}
			if (!$result) {
				printf("\e[0;32m" . $mask, " '" . $value . "'", "| " . $tick . " unmatched as expected", "| " . $matchString . "\e[0m");
			} else {
				printf("\e[0;31m" . $mask, " '" . $value . "'", "| " . $cross . " matched unexpectedly", "| " . $matchString . "\e[0m");
			}
		}
		
	}
}
print("\n");