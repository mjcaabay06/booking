<?php
	include "../mysqli_connect.php";
	header("Content type: application/json");
	
	$responseData = array();
	$data = json_decode(file_get_contents("php://input"));

	$responseData['selDate'] = $data->date;

	$query = "
			SELECT
				`maximum_limit`
			FROM
				`booking_limits`
			WHERE
				`selected_date` = '" . mysqli_real_escape_string($mysqli, $responseData['selDate']) . "'
			LIMIT 1
		";
	$rs = mysqli_query($mysqli, $query);

	if ($rs !== false) {
		$limit = mysqli_fetch_assoc($rs);

		$responseData['limit'] = $limit['maximum_limit'] == null ? 0 : $limit['maximum_limit'];
		$responseData['status'] = "success";
	} else {
		$responseData['status'] = "error";
		$responseData['message'] = mysqli_error($mysqli);
	}

	include "../mysqli_disconnect.php";
	$responseText = json_encode($responseData);
	echo $responseText;