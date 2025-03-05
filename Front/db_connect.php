<?php
    //error_reporting(0);
    /*
    $servername = "34.124.243.161";
    $username = "ite";
    $password = "ite@@#2021";
    $dbname = "project";

        // Create Connection
        $connect = mysqli_connect($servername, $username, $password, $dbname,3366);
        // Check connection
        if (!$connect) {
            echo mysqli_connect_error();
            die("Connection failed" . mysqli_connect_error());
            //หรือย่อเป็น $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed");
        } 
        else{
            //echo "connected";
        }  
    */
    $host_name = "localhost";
    //$host_name = "34.124.243.161";
    $database = "project"; // Change your database name
    //$username = "ite";          // Your database user id 
    $username = "root";          // Your database user id 
    //$password = "ite@@#2021";          // Your password
    $password = "";          // Your password

    $dsn = 'mysql:dbname=project;host='.$host_name.';port=3306;charset=utf8';

    //////// Do not Edit below /////////
    try {
    $dbo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    echo "Connected fail!";
    die();
    }
    //echo "DB connected !!";
?>