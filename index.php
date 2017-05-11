<?php
	$csvFile = file('names.csv');
    $data = [];
	$lines = 0;
    foreach ($csvFile as $line) {
        $data[] = str_getcsv($line);
		$lines = $lines + 1;
    }
	$i = 0;
	$j = 0;
	for($i=0;$i<$lines;$i++){
		rename($data[$i][$j+1],$data[$i][$j].".txt");
	}
?> 