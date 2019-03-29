<?php

$read = fopen('php://stdin', 'r');
$write = fopen('php://stdout', 'w');

$t = 0;

fscanf($read, '%d', $t);
while ($t--) {
	fgets($read); // Skip blank line
	fscanf($read, '%d %d', $horizontalLen, $verticalLen);

	$sum = 0;
	$horizontalPointer = 0;
	$verticalPointer = 0;
	$horizontalMultiplier = 1;
	$verticalMultiplier = 1;

	$x = [];
	for ($i = 0; $i < $horizontalLen - 1; $i++) {
		fscanf($read, '%d', $x[$i]);
	}
	rsort($x);

	$y = [];
	for ($i = 0; $i < $verticalLen - 1; $i++) {
		fscanf($read, '%d', $y[$i]);
	}
	rsort($y);

	while ($horizontalPointer < $horizontalLen - 1 || $verticalPointer < $verticalLen - 1) {
		if ($verticalPointer === $verticalLen - 1 || ($horizontalPointer < $horizontalLen - 1 && $x[$horizontalPointer] > $y[$verticalPointer])) {
			$verticalMultiplier++;
			$sum += $x[$horizontalPointer] * $horizontalMultiplier;
			$horizontalPointer++;
			continue;
		}

		$horizontalMultiplier++;
		$sum += $y[$verticalPointer] * $verticalMultiplier;
		$verticalPointer++;
	}

	fprintf($write, "$sum\n");
}

fclose($read);
fclose($write);
