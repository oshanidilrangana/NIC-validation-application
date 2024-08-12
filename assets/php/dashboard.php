<?php

include 'db_connect.php';

 
function calculateDetails($nic) {
    $year = "";
    $days = "";
    $gender = "";

    if (strlen($nic) == 10) {
        $year =  substr($nic, 0, 2);
        $days = (int) substr($nic, 2, 3);
    } elseif (strlen($nic) == 12) {
        $year = substr($nic, 0, 4);
        $days = (int) substr($nic, 4, 3);
    } else {
        return false;
    }
    

    if ($days > 500) {
        $days -= 500;
        $gender = "Female";
    } else {
        $gender = "Male";
    }

    $date = DateTime::createFromFormat('z Y', ($days - 1) . ' ' . $year);
    $birthday = $date->format('Y-m-d');
    $age = $date->diff(new DateTime('now'))->y;

    return [
        'nic' => $nic,
        'birthday' => $birthday,
        'age' => $age,
        'gender' => $gender
    ];
}

 


$pdo = new PDO('mysql:host=localhost;dbname=nic_details', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $results = [];
    $stmt = $pdo->prepare("INSERT INTO nic_details (nic, birthday, age, gender) VALUES (?, ?, ?, ?)");

    for ($i = 0; $i < 4; $i++) {
        $file = $_FILES['csvFiles']['tmp_name'][$i];
        $handle = fopen($file, 'r');

        if ($handle) {
            while (($line = fgetcsv($handle)) !== false) {
                $nic = $line[0];
                $details = calculateDetails($nic);

                if ($details) {
                    $stmt->execute([$details['nic'], $details['birthday'], $details['age'], $details['gender']]);
                    $results[] = $details;
                }
            }
            fclose($handle);
        }
    }

    header('Location:index.php');
     
}

 
