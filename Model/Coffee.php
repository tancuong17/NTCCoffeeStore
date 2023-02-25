<?php
    class Coffee{
        public $id;
        public $name;
        public $image;
        public $price;
        public $quantity;
        function getId(){
            return $this->id;
        }
        function setName($name){
            $this->name = $name;
        }
        function getName(){
            return $this->name;
        }
        function setImage($image){
            $this->image = $image;
        }
        function getImage(){
            return $this->image;
        }
        function setPrice($price){
            $this->price = $price;
        }
        function getPrice(){
            return $this->price;
        }
        function setQuantity($quantity){
            $this->quantity = $quantity;
        }
        function getQuantity(){
            return $this->quantity;
        }
        function addCoffee(){
            include "../DatabaseConfig/DBConfig.php";
            $query = "INSERT INTO coffees VALUES (null, '$this->name', '$this->image', '$this->price', '$this->quantity')";
            $queryConnect = mysqli_query($conn, $query);
            $last_id = mysqli_insert_id($conn);
            $result = [$last_id, $this->image];
            echo json_encode($result);
        }
        function updateCoffee($id){
            include "../DatabaseConfig/DBConfig.php";
            if($this->image == null)
                $query = "UPDATE coffees SET name = '$this->name', price = $this->price, quantity = $this->quantity WHERE id = $id";
            else
                $query = "UPDATE coffees SET name = '$this->name', image = '$this->image', price = $this->price, quantity = $this->quantity WHERE id = $id";
            $queryConnect = mysqli_query($conn, $query);
        }
        function getAllCoffee($linkDB){
            include $linkDB;
            $query = "SELECT * FROM coffees";
            $queryConnect = mysqli_query($conn, $query);
            $result = array();
            while($arrayResult = mysqli_fetch_array($queryConnect)){
                $id = $arrayResult['id'];
                $name = $arrayResult['name'];
                $image = $arrayResult['image'];
                $price = $arrayResult['price'];
                $quantity = $arrayResult['quantity'];
                array_push($result, array("id" => $id, "name" => $name, "image" => $image, "price" => $price, "quantity" => $quantity));
            };
            return $result;
        }
    }
?>