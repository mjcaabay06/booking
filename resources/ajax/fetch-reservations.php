<?php
	include "../mysqli_connect.php";
	header("Content type: application/json");
	
	$responseData = array();
	$data = json_decode(file_get_contents("php://input"));

	$responseData['reserveDate'] = $data->reserveDate;

	$query = "
			SELECT
				u.user_id,
				u.fname,
				u.lname,
				u.uname,
				r.reserve_date,
				r.remarks,
				r.status
			FROM
				`booking_users` u
			LEFT JOIN
				`booking_reservations` r
			ON
				u.user_id = r.user_id
			WHERE
				r.reserve_date = '" . mysqli_real_escape_string($mysqli, $responseData['reserveDate']) . "'
			ORDER BY
				r.created_date DESC
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