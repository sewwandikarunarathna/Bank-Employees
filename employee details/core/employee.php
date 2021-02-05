<?php

class Employee {
    //db stuff
    private $conn;
    private $table = 'employees';

    //employee properties
    public $emp_id;
    public $emp_name;
    public $emp_email;
    public $emp_photo;
    public $emp_address;
    public $branch_id;
    public $emp_password;

    //constructor with db connection
    public function __construct($db){
        $this->conn = $db;
    }

    //getting employee details from database
    public function read(){
        //create query
        $query = 'SELECT
        e.emp_id,
        e.emp_name,
        e.emp_email,
        e.emp_photo,
        br.branch_name as branch_name,
        b.bank_name as bank_name
        FROM
        ' .$this->table . ' e
        LEFT JOIN
        branches br ON e.branch_id = br.branch_id
        LEFT JOIN banks b
        ON br.bank_id = b.bank_id';

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();

        return $stmt;
        
    }

}

?>