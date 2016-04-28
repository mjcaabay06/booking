<?php
	include "../mysqli_connect.php";
	header("Content type: application/json");
	
	$responseData = array();
	$data = json_decode(file_get_contents("php://input"));
	
	$responseData['selDate'] = $data->date;
	$responseData['limit'] = $data->limit;

	$querySel = "
			SELECT
				*
			FROM
				`booking_limits`
			WHERE
				`selected_date` = '" . mysqli_real_escape_string($mysqli, $responseData["selDate"]) . "'
	";
	$rsSel = mysqli_query($mysqli, $querySel);

	$query = "";
	if ($rsSel->num_rows > 0) {
		$responseData['ll'] = "update";
		$query = "
			UPDATE
				`booking_limits`
			SET
				`maximum_limit` = " . mysqli_real_escape_string($mysqli, $responseData["limit"]) . ",
				`modified_date` = NOW()
			WHERE
				`selected_date` = '" . mysqli_real_escape_string($mysqli, $responseData["selDate"]) . "'
		";
	} else {
		$responseData['ll'] = "insert";
		$query = "
			INSERT INTO
				`booking_limits`
			(
				`selected_date`,
				`maximum_limit`,
				`created_date`,
				`modified_date`
			)
			VALUES
			(
				'" .  mysqli_real_escape_string($mysqli, $responseData["selDate"]) . "',
				'" .  mysqli_real_escape_string($mysqli, $responseData["limit"]) . "',
				NOW(),
				NOW()
			)
		";
	}
	$rs = mysqli_query($mysqli, $query);

	if ($rs !== false) {
		$responseData['status'] = "success";
	} else {
		$responseData['status'] = "error";
		$responseData['message'] = mysqli_error($mysqli);
	}

	include "../mysqli_disconnect.php";
	$responseText = json_encode($responseData);
	echo $responseText;