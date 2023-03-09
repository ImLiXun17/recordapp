<?php
require_once 'vendor/autoload.php';
use Faker\Factory;

// Set the locale for the Faker generator to 'en_PH'
$faker = Factory::create('en_PH');

// Connect to the MySQL database
require "config/config.php";
require "config/db.php";


// Generate fake data for 212 records
for ($id = 6; $id <= 220; $id++) {

    // Generate a random last name and first name
    $lastName = $faker->lastName;
    $firstName = $faker->firstName;

    // Generate a random office id from 1-15
    $officeId = $faker->numberBetween(1, 15);

    // Generate a random municipality in the Philippines
    $municipalities = ['Narra', 'Aborlan', 'Puerto Princesa', 'El Nido', 'Rizal', 'San Vicente', 'Bataraza', 'Brookes Point','Taytay', 'Roxas', ];
    $municipality = $faker->randomElement($municipalities);

    // Combine the generated data to form a record
    $record = [
        "lastname" => $lastName,
        "firstname" => $firstName,
        "office_id" => $officeId,
        "address" => "$municipality, Palawan"
    ];

    // Insert the generated record into the 'employees' table
    $sql = "INSERT INTO employee (lastname, firstname, office_id, address)
            VALUES ('{$record['lastname']}', '{$record['firstname']}', '{$record['office_id']}', '{$record['address']}')";
    if ($conn->query($sql) === FALSE) {
        echo "Error inserting record: " . $conn->error;
    }
}

// Close the MySQL database connection
$conn->close();



?>
