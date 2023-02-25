<?php
    class Order{
        public $id;
        public $date;
        public $status;
        public $customer;
        public $phonenumber;
        public $address;
        public $note;
        function getId(){
            return $this->id;
        }
        function setDate($date){
            $this->date = $date;
        }
        function getDate(){
            return $this->idFood;
        }
        function setStatus($status){
            $this->idStatus = $idStatus;
        }
        function getStatus(){
            return $this->status;
        }
        function setCustomer($customer){
            $this->customer = $customer;
        }
        function getCustomer(){
            return $this->customer;
        }
        function setPhonenumber($phonenumber){
            $this->phonenumber = $phonenumber;
        }
        function getPhonenumber(){
            return $this->phonenumber;
        }
        function setAddress($address){
            $this->address = $address;
        }
        function getAddress(){
            return $this->address;
        }
        function setNote($note){
            $this->note = $note;
        }
        function getNote(){
            return $this->note;
        }
        function getNoteOrder($idOrder){
            include "../DatabaseConfig/DBConfig.php";
            $query = "SELECT note FROM orders WHERE id = $idOrder";
            $queryConnect = mysqli_query($conn, $query);
            $arrayResult = mysqli_fetch_array($queryConnect);
            $note = $arrayResult['note'];
            return $note;
        }
        function updateStatusOrder($idOrder){
            include "../DatabaseConfig/DBConfig.php";
            $query1 = "UPDATE orders SET status = 'Đã giao hàng' WHERE id = $idOrder";
            $queryConnect1 = mysqli_query($conn, $query1);
            $query2 = "SELECT detailorders.idCoffee, detailorders.quantity FROM orders INNER JOIN detailorders on orders.id = detailorders.idOrder WHERE detailorders.idOrder = $idOrder";
            $queryConnect2 = mysqli_query($conn, $query2);
            while($arrayResult = mysqli_fetch_array($queryConnect2)){
                $idCoffee = $arrayResult['idCoffee'];
                $quantity = $arrayResult['quantity'];
                $query3 = "UPDATE coffees SET quantity = quantity - $quantity  WHERE id = $idCoffee";
                $queryConnect3 = mysqli_query($conn, $query3);
            };
        }
        function getCoffeeInOrder($idOrder){
            include "../DatabaseConfig/DBConfig.php";
            $query = "SELECT coffees.image, coffees.name, coffees.price, detailorders.quantity FROM detailorders INNER JOIN coffees ON detailorders.idCoffee = coffees.id WHERE idOrder = $idOrder";
            $queryConnect = mysqli_query($conn, $query);
            $result = array();
            while($arrayResult = mysqli_fetch_array($queryConnect)){
                $image = $arrayResult['image'];
                $name = $arrayResult['name'];
                $price = $arrayResult['price'];
                $quantity = $arrayResult['quantity'];
                array_push($result, array("image" => $image, "name" => $name, "price" => $price, "quantity" => $quantity));
            };
            return $result;
        }
        function getAllOrder(){
            include "../DatabaseConfig/DBConfig.php";
            $query = "SELECT orders.id, date, customer, phonenumber, address, status, SUM(detailorders.price * detailorders.quantity) as total
            FROM orders INNER JOIN detailorders ON orders.id = detailorders.idOrder GROUP BY orders.id";
            $queryConnect = mysqli_query($conn, $query);
            $result = array();
            while($arrayResult = mysqli_fetch_array($queryConnect)){
                $id = $arrayResult['id'];
                $date = $arrayResult['date'];
                $customer = $arrayResult['customer'];
                $phonenumber = $arrayResult['phonenumber'];
                $address = $arrayResult['address'];
                $total = $arrayResult['total'];
                $status = $arrayResult['status'];
                array_push($result, array("id" => $id, "date" => $date, "customer" => $customer, "phonenumber" => $phonenumber, "address" => $address, "total" => $total, "status" => $status));
            };
            return $result;
        }
        function addOrder($listCoffee){
            include "../DatabaseConfig/DBConfig.php";
            include "../Model/DetailOrder.php";
            $queryAddOrder = "INSERT INTO orders VALUES (null, '$this->date', 'Chưa giao hàng', '$this->customer', '$this->phonenumber', '$this->address', '$this->note')";
            $queryOrderConnect = mysqli_query($conn, $queryAddOrder);
            $idOrder = mysqli_insert_id($conn);
            $listCoffeeInCart = array_values($listCoffee);
            for ($i=0; $i < count($listCoffeeInCart); $i++) {
                $detailOrder = new DetailOrder();
                $detailOrder->setIdOrder($idOrder);
                $detailOrder->setIdCoffee(array_values($listCoffee[$i])[0]);
                $detailOrder->setPrice(array_values($listCoffee[$i])[3]);
                $detailOrder->setQuantity(array_values($listCoffee[$i])[4]);
                $detailOrder->addDetailOrder();
            }
            echo $idOrder;
        }
    }
?>