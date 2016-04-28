<?php
	include "../mysqli_connect.php";
	header("Content type: application/json");
	
	$responseData = array();
	$data = json_decode(file_get_contents("php://input"));

	$responseData['userId'] = $data->userId;

	$query = "
			SELECT
				*
			FROM
				`booking_reservations` r
			WHERE
				r.user_id = " . mysqli_real_escape_string($mysqli, $responseData['userId']) . "
			ORDER BY
				r.reserve_date DESC
		";
	$rs = mysqli_query($mysqli, $query);

	$reservations = array();
	if ($rs !== false) {
		while ($reservation = mysqli_fetch_assoc($rs)) {
			$reservations[] = $reservation;
		}
		$responseData['reservations'] = $reservations;
		$responseData['status'] = "success";
	} else {
		$responseData['status'] = "error";
		$responseData['message'] = mysqli_error($mysqli);
	}

	include "../mysqli_disconnect.php";
	$responseText = json_encode($responseData);
	echo $responseText;