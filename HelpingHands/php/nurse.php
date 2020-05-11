<?php 
	require_once "db_connect.php";
	session_start();
	
	 if(!isset($_SESSION["nid"])){
	 	$email = $_SESSION['nurse'];
		$result = $db->query("SELECT nurse.nid FROM nurse INNER JOIN email ON nurse.eid = email.id  WHERE email.email = '$email'");
		while ( $row = $result->fetch_assoc())  {
			$id = $row['nid'];
		 }
		 $_SESSION["nid"] = $id;
	 }
	
	$nid = $_SESSION["nid"];



	$resultNurse = $db->query("SELECT nurse.name AS fname, nurse.last_name AS lname, nurse.street_address AS street, nurse.city AS city, nurse.state AS selected, nurse.zip AS zipcode, nurse.phone_number AS phone, nurse.price AS price, nurse.license_number AS license, nurse.photos AS pic, description_skills.description AS skills FROM nurse INNER JOIN description_skills ON nurse.nid = description_skills.d_nid WHERE nid = '$nid'");

	if($resultNurse->num_rows == 0)
	{
		$resultNurse = $db->query("SELECT name AS fname, last_name AS lname, street_address AS street, city, state AS selected, zip AS zipcode, phone_number AS phone, price, license_number AS license, photos AS pic FROM nurse WHERE nid = '$nid'");
	}

	
	//Initialize array variable

	//Fetch into associative array
	  while ( $row = $resultNurse->fetch_assoc())  {
		$dbdata=$row;
	  }

	//Print array in JSON format
	echo json_encode($dbdata);
	
	
	
	/*require_once "db_connect.php";	


	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$name = $request->name; 
	$lastname = $request->lastname;
	$dob = $request->dob;
	$street = $request->street;
	$city = $request->city;
	$state = $request->state;
	$zipcode = $request->zipcode;
	$phone = $request->phone;
	$email = $request->email;
	$condition = $request->condition;
	$emergencyname = $request->emergencyname;
	$emergencylast = $request->emergencylast;
	$emergencyphone = $request->emergencyphone;
	$password = $request->password;

	$msg = "From senior.php: Your name is ".$name." last name is ".$lastname." dob is ".$dob." street is ".$street." city is ".$city." state is ".$state." zipcode is ".$zipcode." phone number is ".$phone." Email is ".$email." condition is ".$condition." emergency contact name is ".$emergencyname." emergency last name is ".$emergencylast." emergency phone is ".$emergencyphone. " and password is ".$password;
	echo $msg;


	$key = md5(microtime().rand());
	$key2 = md5(microtime().rand());

	$user_query = "INSERT INTO email (id, email, password) VALUES ('$key', '$email', '$password')";

	$senior_query = "INSERT INTO senior (sid, name, last_name, date_birth, street_address, city, state, zip, phone_number, eid) 
	VALUES ('$key2','$name','$lastname','$dob','$street', '$city', '$state','$zipcode','$phone', '$key')";
	
	$description_query = "INSERT INTO description_cond (id, d_sid, description) VALUES (NULL,'$key2', '$condition')";

	$emergency_query = "INSERT INTO emergency_cont (id, e_sid, name, last_name, phone_number) VALUES (NULL,'$key2', '$emergencyname', '$emergencylast', '$emergencyphone')";

	$result = $db->query($user_query);
	$result2 = $db->query($senior_query);
	$result3 = $db->query($description_query);
	$result4 = $db->query($emergency_query);
		$msg = "N foi ".$result." ".$result2." ".$result3." ".$result4." ".$key." " .$key2	;
		echo $msg;

*/
 ?>
