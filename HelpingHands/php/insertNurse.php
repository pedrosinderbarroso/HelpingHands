<?php 
	require_once "db_connect.php";
	session_start();
	$email = $_SESSION['nurse'];
	
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$name = $request->name; 
	$lastname = $request->lastname;
	$license = $request->license;
	$street = $request->street;
	$city = $request->city;
	$state = $request->state;
	$zipcode = $request->zipcode;
	$phone = $request->phone;
	$price = $request->price;
	$skills = $request->skills;

	/*$msg = "From senior.php: Your name is ".$name." last name is ".$lastname." dob is ".$dob." street is ".$street." city is ".$city." state is ".$state." zipcode is ".$zipcode." phone number is ".$phone." Email is ".$email." condition is ".$condition." emergency contact name is ".$emergencyname." emergency last name is ".$emergencylast." emergency phone is ".$emergencyphone;
	echo $msg;

	*/
	$result = $db->query("SELECT id FROM email WHERE email = '$email'");
	
	//$read = mysql_result($db->query("SELECT id FROM email WHERE email = '$email'"),0);

	  while ( $row = $result->fetch_assoc())  {
		$id = $row['id'];
	  }
	  //echo $read[0];

	if($state == ""){
				$nurse_query = $db->query("UPDATE nurse SET name = '$name', last_name = '$lastname', street_address = '$street', city = '$city', zip = '$zipcode', phone_number = '$phone', price = '$price', license_number = '$license' WHERE eid = '$id'");
	}else{
			$nurse_query = $db->query("UPDATE nurse SET name = '$name', last_name = '$lastname', street_address = '$street', city = '$city', state = '$state', zip = '$zipcode', phone_number = '$phone', price = '$price', license_number = '$license' WHERE eid = '$id'");
	}


	$db->query($nurse_query);

	$result2 = $db->query("SELECT nid FROM nurse WHERE eid = '$id'");
	
	//$read = mysql_result($db->query("SELECT id FROM email WHERE email = '$email'"),0);

	  while ( $row = $result2->fetch_assoc())  {
		$id_nurse = $row['nid'];
	  }

	$description_query = "INSERT INTO description_skills (id, d_nid, description) VALUES (NULL,'$id_nurse', '$skills')";
	
	$db->query($description_query);

	echo 1;
	$db->close();
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
