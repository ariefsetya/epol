<?php

try {
	$dbh = new PDO('mysql:host=localhost;port=3307;dbname=epol', "root", "");


	$truncate_table_participants = $dbh->exec("TRUNCATE TABLE `lottery_participants`");
	$truncate_table_histories = $dbh->exec("TRUNCATE TABLE `lottery_histories`");

	$i = 0;

	$handle = fopen($_GET['f'], "r");
	if ($handle) {
		while (($line = fgets($handle)) !== false) {

			$data = explode(",", $line);

			$insert_table = $dbh->exec("INSERT INTO `lottery_participants` (`number`, `name`, `city`, `category_id`) VALUES ('" . str_pad($data[0], 5, '0', STR_PAD_LEFT) . "', '" . $data[1] . "', '" . $data[2] . "', '" . $data[3] . "')");

			$i++;

		}

		fclose($handle);
	} else {
		echo "error open file";
	}

	$dbh = null;

	echo 'inserted rows ' . $i;
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}


?>