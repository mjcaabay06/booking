<?php
	include "../mysqli_connect.php";
	header("Content type: application/json");
	
	$responseData = array();
	$data = json_decode(file_get_contents("php://input"));
	
	$responseData['reserveDate'] = $data->reserveDate;
	$responseData['userId'] = $data->userId;
	$responseData['remarks'] = $data->remarks;

	$queryLimit = "
			SELECT
				`maximum_limit`
			FROM
				`booking_limits`
			WHERE
				`selected_date` = '" . mysqli_real_escape_string($mysqli, $responseData["reserveDate"]) . "'
	";
	$rsLimit = mysqli_query($mysqli, $queryLimit);
	$rsLimitAssoc = mysqli_fetch_assoc($rsLimit);

	$queryRes = "
			SELECT
				*
			FROM
				`booking_reservations`
			WHERE
				`reserve_date` = '" . mysqli_real_escape_string($mysqli, $responseData["reserveDate"]) . "'
	";
	$rsRes = mysqli_query($mysqli, $queryRes);

	$queryAccnt = "
			SELECT
				*
			FROM
				`booking_reservations`
			WHERE
				`reserve_date` = '" . mysqli_real_escape_string($mysqli, $responseData["reserveDate"]) . "'
			AND
				`user_id` = " . mysqli_real_escape_string($mysqli, $responseData["userId"]) . "
	";
	$rsAccnt = mysqli_query($mysqli, $queryAccnt);
	
	if ($rsRes->num_rows < $rsLimitAssoc['maximum_limit']) {
		if ($rsAccnt->num_rows > 0) {
			$responseData['status'] = 'accnt';
			$responseData['message'] = 'You have already booked on this date.';
		} else {
			$query = "
				INSERT INTO
					`booking_reservations`
				(
					`user_id`,
					`reserve_date`,
					`remarks`,
					`status`
				)
				VALUES
				(
					" . mysqli_real_escape_string($mysqli, $responseData["userId"]) . ",
					'" .  mysqli_real_escape_string($mysqli, $responseData["reserveDate"]) . "',
					'" .  mysqli_real_escape_string($mysqli, $responseData["remarks"]) . "',
					1
				)";
			$rs = mysqli_query($mysqli, $query);

			if ($rs !== false) {
				$responseData['status'] = "success";
				$responseData['message'] = "Successfully reserved.";
			} else {
				$responseData['status'] = "error";
				$responseData['message'] = mysqli_error($mysqli);
			}
		}
	} else {
		$responseData['status'] = "maxlimit";
		$responseData['message'] = "Sorry. There's no slot for this day.";
	}

	include "../mysqli_disconnect.php";
	$responseText = json_encode($responseData);
	echo $responseText;