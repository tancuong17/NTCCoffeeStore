<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/4720/4720989.png">
    <link rel="stylesheet" href="../CSS/index.css">
</head>
<body>
    <section class="login-container">
        <div id="logo-login-conatiner">
            <img id="logo-login" src="https://cdn-icons-png.flaticon.com/512/4720/4720989.png" alt="Logo">
            <p>NTC <br> Coffee Store</p>
        </div>
        <div id="form-login-conatiner">
            <fieldset>
                <legend align="right">Tên tài khoản</legend>
                <input type="text" value="quantri@ntc.com" id="username">
            </fieldset>
            <fieldset>
                <legend align="right">Mật khẩu</legend>
                <input type="password" value="123456789" id="password">
            </fieldset>
            <button onclick="Login()">Đăng nhập</button>
        </div>
    </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js"></script>
<script src="../JS/index.js"></script>
</html>