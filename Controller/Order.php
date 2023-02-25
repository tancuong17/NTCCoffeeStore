<?php
    include "../Model/Order.php";
    function getAllOrder(){
        $order = new Order();
        $result = $order->getAllOrder();
        return $result;
    }
    function addOrder(){
        $order = new Order();
        $date = $_POST['date'];
        $customer = $_POST['customer'];
        $phonenumber = $_POST['phonenumber'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $listCoffee = $_POST['listCoffeeInCart'];
        $order->setDate($date);
        $order->setCustomer($customer);
        $order->setPhonenumber($phonenumber);
        $order->setAddress($address);
        $order->setNote($note);
        $order->addOrder($listCoffee);
    }
    function getCoffeeInOrder(){
        $order = new Order();
        $idOrder = $_POST['idOrder'];
        $result = $order->getCoffeeInOrder($idOrder);
        echo json_encode($result);
    }
    function getNoteOrder(){
        $order = new Order();
        $idOrder = $_POST['idOrder'];
        $result = $order->getNoteOrder($idOrder);
        echo $result;
    }
    function updateStatusOrder(){
        $order = new Order();
        $idOrder = $_POST['idOrder'];
        $order->updateStatusOrder($idOrder);
    }
    if(isset($_POST['nameFunction']))
        if(strcmp($_POST['nameFunction'], "addOrder") == 0)
            addOrder();
        else if(strcmp($_POST['nameFunction'], "getCoffeeInCart") == 0)
            getCoffeeInOrder();
        else if(strcmp($_POST['nameFunction'], "getNoteOrder") == 0)
            getNoteOrder();
        else if(strcmp($_POST['nameFunction'], "updateStatusOrder") == 0)
            updateStatusOrder();
        else if(strcmp($_POST['nameFunction'], "getOrders") == 0)
        {
            $result = getAllOrder();
            echo json_encode($result);
        }
?>  