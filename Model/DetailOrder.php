<?php
    class DetailOrder{
        public $id;
        public $idOrder;
        public $idCoffee;
        public $price;
        public $quantity;
        function getId(){
            return $this->id;
        }
        function setIdOrder($idOrder){
            $this->idOrder = $idOrder;
        }
        function getIdOrder(){
            return $this->idOrder;
        }
        function setIdCoffee($idCoffee){
            $this->idCoffee = $idCoffee;
        }
        function getIdCoffee(){
            return $this->idCoffee;
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
        function addDetailOrder(){
            include "../DatabaseConfig/DBConfig.php";
            $queryAddDetailOrder = "INSERT INTO detailorders VALUES (null, '$this->idOrder', '$this->idCoffee', '$this->price', '$this->quantity')";
            $queryDetailOrderConnect = mysqli_query($conn, $queryAddDetailOrder);
        }
    }
?>