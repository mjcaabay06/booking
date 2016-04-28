<?php
	include "resources/mysqli_connect.php";
	
	$queryTime = "
			SELECT
				*
			FROM
				`booking_logs`
			WHERE
				`created_date` > (NOW() - interval 30 minute)
	";
	$rsTime = mysqli_query($mysqli, $queryTime);

	if ($rsTime->num_rows < 1000) {
		$userId = $_SESSION['userId'];
		$url = $_SERVER['REQUEST_URI'];

		$query = "
				INSERT INTO
					`booking_logs`
				(
					`user_id`,
					`url`,
					`created_date`,
					`modified_date`
				)
				VALUES
				(
					" . mysqli_real_escape_string($mysqli, $userId) . ",
					'" . mysqli_real_escape_string($mysqli, $url) . "',
					NOW(),
					NOW()
				)";
		$rs = mysqli_query($mysqli, $query);
	} else {
		echo "redirect";
	}

	include "resources/mysqli_disconnect.php";