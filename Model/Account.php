<?php
    class Account{
        public $username;
        public $password;
        function getUsername(){
            return $this->username;
        }
        function setUsername($username){
            $this->username = $username;
        }
        function getPassword(){
            return $this->password;
        }
        function setPassword($password){
            $this->password = $password;
        }
        function checkAccount(){
            include "../DatabaseConfig/DBConfig.php";
            $query = "SELECT count(username) FROM account WHERE username = '$this->username' and password = $this->password";
            $queryConnect = mysqli_query($conn, $query);
            $arrayResult = mysqli_fetch_array($queryConnect);
            return $arrayResult[0];
        }
    }
?>