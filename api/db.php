<?php

$connect = mysqli_connect("localhost", "root", "", "hng.users");

if (!$connect) {
    echo json_encode(['status'=>'error', 'message' => 'Not Connected']);
    die();

}
/*reusable function to invoke to execute query in mysql like select, delete, update and create records*/
function executeQuery($sql, $data)
{
	global $connect;

	if ($stmt = mysqli_prepare($connect, $sql)) {
		$values = array_values($data);
		$counting = count($values);
		$types = str_repeat('s', $counting);
		//bind parameters to the placeholder
		mysqli_stmt_bind_param($stmt, $types, ...$values);
		if (mysqli_stmt_execute($stmt)) {
			return $stmt;
		} else {
			return false;
		}
	} else {
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($connect);
	}
}
/*  reusable function to select one record from table */
function selectOne($table, $conditions)
{
	global $connect;

	/* return records that match conditions*/

	/* SELECT * FROM  $table WHERE username= ? AND admin =  ? AND email=?  AND password=? LIMIT 1*/
	$sql = "SELECT * FROM $table";
	$i = 0;
	foreach ($conditions as $key => $value) {
		if ($i === 0) {
			$sql = $sql . " WHERE $key = ?";
		} else {
			$sql = $sql . " AND $key = ?";
		}
		$i++;
	}

	$sql = $sql . " LIMIT 1";

	/*--reusable function to invoke to execute query in mysql like select, delete, update and create records*/
	$stmt = executeQuery($sql, $conditions);

	$result = mysqli_stmt_get_result($stmt);
	$record = mysqli_fetch_assoc($result);
	return $record;
}

/* reusable function to select from table */
function selectAll($table, $conditions = array())
{
	global $connect;

	$sql = "SELECT * FROM $table";
	if (empty($conditions)) {
		/* return all records */
		$stmt = mysqli_prepare($connect, $sql);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$records = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $records;
	} else {
		/* return records that match conditions*/
		$i = 0;
		foreach ($conditions as $key => $value) {
			if ($i === 0) {
				$sql = $sql . " WHERE $key = ?";
			} else {
				$sql = $sql . " AND $key = ?";
			}
			$i++;
		}

		$stmt = executeQuery($sql, $conditions);

		$result = mysqli_stmt_get_result($stmt);
		$records = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $records;
	}
}


/*--  reusable function to create record to database table */
function create($table, $data)
{
	global $connect;
	/* INSERT INTO  $table SET username= ?, admin =  ?, email=?, password=? */
	$sql = "INSERT INTO $table SET ";
	$i = 0;
	foreach ($data as $key => $value) {
		if ($i === 0) {
			$sql = $sql . "$key=?";
		} else {
			$sql = $sql . ", $key=?";
		}
		$i++;
	}
	$stmt = executeQuery($sql, $data);

	if ($stmt != false) {
		/* getting the id of the last inserted data record and returning it*/
		$id = mysqli_insert_id($connect);

		return $id;
		/* --getting the id of the last inserted data record  and returning it*/
	} else {

		return 0;
	}
}

/*--  reusable function to update record in database table */
function update($table, $selector, $data)
{
	global $connect;
	$sql = "UPDATE $table SET ";
	$i = 0;
	foreach ($data as $key => $value) {
		if ($i === 0) {
			$sql = $sql . "$key=?";
		} else {
			$sql = $sql . ", $key=?";
		}
		$i++;
	}
	foreach ($selector as $k => $v) {
		$sql = $sql . " WHERE " . $k . "=?";
		$data[$k] = $v;
	}
	$stmt = executeQuery($sql, $data);
	/* returning the updated record as an array(associative array) */
	if ($stmt != false) {
		return mysqli_affected_rows($connect);
	} else {

		return 0;
	}
}
/*--  reusable function to delete record from database table */
function delete($table, $data)
{
	global $connect;
	/* DELETE FROM $table WHERE id = ?*/
	$sql = "DELETE FROM $table WHERE ";
	$i = 0;
	foreach ($data as $key => $value) {
		if ($i === 0) {
			$sql = $sql . " $key=?";
		} else {
			$sql = $sql . " AND $key=?";
		}
		$i++;
	}
	$stmt = executeQuery($sql, $data);


	if ($stmt != false) {

		return mysqli_affected_rows($connect);
	} else {

		return 0;
	}
}
?>