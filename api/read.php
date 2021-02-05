<?php

//headers
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

//initializing our api
include_once('../core/initialize.php');

//instantiate post

$emp = new Employee($db);

//blog post query
$result =$emp->read();
//get the row count
$num = $result->rowCount();

if($num>0){
    $emp_arr = array();
    $emp_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $emp_item = array(
            'emp_id' =>$emp_id,
            'emp_name' =>$emp_name,
            'emp_email' =>$emp_email,
            'emp_photo' =>$emp_photo,
            'branch_name' =>$branch_name,
            'bank_name' =>$bank_name
        );
        array_push($emp_arr['data'], $emp_item);
    }
    //convert to JSON and output
    
    echo json_encode($emp_arr);
    


}else{
    echo json_encode(array('message' => 'No employees found.'));
}


?>