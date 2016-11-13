<?php

    function cafes_index()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=pendingCoffee", 'root', 'mysql');
        
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