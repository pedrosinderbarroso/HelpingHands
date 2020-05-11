<?php
require_once "db_connect.php";
header('Content-type: application/json');
$schedules = $_REQUEST['schedule'];
$nurseId   = $_REQUEST['nurseid'];
$nurseInfo = $_REQUEST['nurseInfo'];

/*if (count($schedules) > 0) {
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    
    $response = array();
    $sql      = "DELETE FROM Nurse_Availability WHERE nurseid = " . $nurseId;
    $db->query($sql);
    $fName    = $nurseInfo['fName'];
    $lName    = $nurseInfo['lName'];
    $lNumber  = $nurseInfo['lNumber'];
    $skills   = $nurseInfo['skills'];
    $iPrice   = $nurseInfo['iPrice'];
    $iPhone   = $nurseInfo['iPhone'];
    $iAddress = $nurseInfo['iAddress'];
    $iCity    = $nurseInfo['iCity'];
    $iState   = $nurseInfo['iState'];
    $iZip     = $nurseInfo['iZip'];
    $sql      = ("UPDATE nurse SET name = '$fName', last_name = '$lName', street_address = '$iAddress', city = '$iCity', state = '$iState' zip = '$iZip', phone_number = '$iPhone', price = '$iPrice', license_number = '$lNumber' WHERE eid = '92085b29fa51ba6b4cfcb77cc35741ec'");

    $db->query($sql);
    */
    foreach ($schedules as $schedule) {
        //echo json_encode($schedules);
        $availability = $schedule["active"] === "true" ? 1 : 0;
        $day          = $schedule["day"];
        $time         = $schedule["schedule"];
        $sql          = "INSERT INTO Nurse_Availability (nurseid, day, availability, active) VALUES ('92085b29fa51ba6b4cfcb77cc35741ec', '$day', '$time', $availability)";
        
        if ($db->query($sql) !== TRUE) {
            $response["status"]  = "error";
            $response["message"] = $db->error;
            $db->close();
            echo json_encode($response);
            return;
        }
    }

    $response["status"] = "success";
    $db->close();
    echo json_encode($response);
}
?>
