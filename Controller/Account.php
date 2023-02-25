<?php
    session_start();
    include "../Model/Account.php";
    function checkAccount(){
        $account = new Account();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $account->setUsername($username);
        $account->setPassword($password);
        $check = $account->checkAccount();
        if($check == 1)
            $_SESSION["login"] = 1;
        else
            $_SESSION["login"] = 0;
        echo $check;
    }
    function checkLogin(){
        if($_SESSION["login"] == 1)
            echo 1;
        else
            echo 0;
    }
    function logout(){
        $_SESSION["login"] = 0;
        echo $_SESSION["login"];
    }
    if(isset($_POST['nameFunction']))
        if(strcmp($_POST['nameFunction'], "checkAccount") == 0)
            checkAccount();
        else if(strcmp($_POST['nameFunction'], "checkLogin") == 0)
            checkLogin();
        else if(strcmp($_POST['nameFunction'], "logout") == 0)
            logout();
?>