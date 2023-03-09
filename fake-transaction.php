<?php
require_once 'vendor/autoload.php';
use Faker\Factory;

// Set the locale for the Faker generator to 'en_PH'
$faker = Factory::create('en_PH');

// Connect to the MySQL database
require "config/config.php";
require "config/db.php";


// Generate fake data for 212 records
for ($id = 8; $id <= 220; $id++) {

    // Generate a random employee and office id
    $employee_id = $faker->numberBetween(1,220);
    $office_id= $faker->numberBetween(1,15);

    // Generate a action
    $actions = ['IN','OUT','COMPLETE'];
    $action = $faker->randomElement($actions);

    //Generate Remarks
    $remarks = ['Signed','For Approval','Process'];
    $remark = $faker->randomElement($remarks);

    // Generate document code
    $documentcode = $faker->numberBetween(1,220);

    //generate employee based on ID
    $documentcode = $faker->numberBetween(100,200);


    // Combine the generated data to form a record
    $record = [
        "employee_id" => $employee_id,
        "office_id" => $office_id,
        "action" => $action,
        "remark" => $remark,
        "documentcode"=>$documentcode
    ];

    // Insert the generated record into the 'employees' table
    $sql = "INSERT INTO transaction (employee_id, office_id, action, remarks, documentcode)
            VALUES ('{$record['employee_id']}', '{$record['office_id']}', '{$record['action']}', '{$record['remark']}','{$record['documentcode']}')";
    if ($conn->query($sql) === FALSE) {
        echo "Error inserting record: " . $conn->error;
    }
}

// Close the MySQL database connection
$conn->close();



?>
