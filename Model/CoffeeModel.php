<?php

  require ("Entities/CoffeeEntity.php");

  class CoffeeModel 
  {
    function GetCoffeeTypes(){

      require 'Credentials.php';
      
      $dbc = mysqli_connect($host, $user, $password, $database) or die (mysqli_error());
      mysqli_select_db($dbc, 'coffeedb');
      $result = mysqli_query($dbc, "SELECT DISTINCT type FROM coffee") or die (mysqli_error());
      $types = array();

      while($row = mysqli_fetch_array($result)){
        array_push($types, $row[0]);
      }
      $dbc->close();
      return $types;
    }
    function GetCoffeeByType($type){
      require 'Credentials.php';
      
      $dbc = mysqli_connect($host, $user, $password, $database) or die (mysqli_error());
      mysqli_select_db($dbc, 'coffeedb');

      $query = "SELECT * FROM coffee WHERE type LIKE '$type'";
      $result = mysqli_query($dbc, $query) or die (mysqli_error());
      $coffeeArray = array();

      while($row = mysqli_fetch_array($result)){
        $name = $row[1];
        $type = $row[2];
        $price = $row[3];
        $roast = $row[4];
        $country = $row[5];
        $image = $row[6];
        $review = $row[7];

        $coffee = new CoffeeEntity(-1, $name, $type, $price, $roast, $country, $image, $review);
        array_push($coffeeArray, $coffee);
        
      }
      $dbc->close();
      return $coffeeArray;
    }
  }
  

?>