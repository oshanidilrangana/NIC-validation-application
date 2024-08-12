<?php

$host="localhost";
$username="root";
$password="";
$dbname="nic_details";

//create Mysql connection
$database= new mysqli($host,$username,$password,$dbname);

//check connection
if ($database->connect_error){
    die("connection failed: ". $database->connect_error);
}

