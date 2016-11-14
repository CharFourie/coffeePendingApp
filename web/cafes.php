<?php

    $username="b7e635b1e1971d";
    $password="589690c1";
    $database="heroku_353b05db18aecbf";
    $host="us-cdbr-iron-east-04.cleardb.net";

    function cafes_index()
    {
        global $username, $password, $database, $host;
        
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        
        $stmt = $pdo->query("SELECT * from theCafes;");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $cafes = array();
        
        foreach($rows as $row)
        {
            $cafe = new Cafe();
            
            $cafe->name = $row['name'];
            $cafe->coffees = $row['coffees'];
            $cafe->latitude = $row['latitude'];
            $cafe->longitude = $row['longitude'];
            
            array_push($cafes, $cafe);
        }
        
        $pdo->null;
        
        return $cafes;
    }
    
    class Cafe
    {
        public $name;
        public $coffees;
        public $latitude;
        public $longitude;
    }

 ?>