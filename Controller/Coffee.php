<?php
    function getAllCoffee($linkDB){
        $coffee = new Coffee();
        $result = $coffee->getAllCoffee($linkDB);
        return $result;
    }
    function addCoffee(){
        include "../Model/Coffee.php";
        $coffee = new Coffee();
        $time = time();
        $nameImage = (string)$time . ".jpg";
        move_uploaded_file($_FILES['file']['tmp_name'], '../Images/' . $nameImage);
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $image = '/Images/' . $nameImage;
        $coffee->setName($name);
        $coffee->setImage($image);
        $coffee->setPrice($price);
        $coffee->setQuantity($quantity);
        $coffee->addCoffee();
    }
    function updateCoffee(){
        include "../Model/Coffee.php";
        $coffee = new Coffee();
        $id = $_POST['idCoffee'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        if(isset($_FILES['file'])){
            $imageRemove = $_POST['imageRemove'];
            unlink("..$imageRemove");
            $time = time();
            $nameImage = (string)$time . ".jpg";
            move_uploaded_file($_FILES['file']['tmp_name'], '../Images/' . $nameImage);
            $imageLink = '/Images/' . $nameImage;
            $coffee->setName($name);
            $coffee->setPrice($price);
            $coffee->setQuantity($quantity);
            $coffee->setImage($imageLink);
            $coffee->updateCoffee($id);
        }
        else{
            $coffee->setName($name);
            $coffee->setPrice($price);
            $coffee->setQuantity($quantity);
            $coffee->setImage(null);
            $coffee->updateCoffee($id);
        }
    }
    if(isset($_POST['nameFunction']))
        if(strcmp($_POST['nameFunction'], "addCoffee") == 0)
            addCoffee();
        else if(strcmp($_POST['nameFunction'], "updateCoffee") == 0)
            updateCoffee();
?>