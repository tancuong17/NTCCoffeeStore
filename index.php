<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/4720/4720989.png">
    <link rel="stylesheet" href="./CSS/index.css">
</head>
<body>
    <header class="header">
        <div>
            <img class="logo" src="https://cdn-icons-png.flaticon.com/512/4720/4720989.png" alt="Logo">
            <p>NTC <br> Coffee Store</p>
        </div>
        <button class="login-button" onClick="LoginPage()">Đăng nhập</button>
    </header>
    <section>
        <div class="title">
            <img class="icon" src="https://cdn-icons-png.flaticon.com/512/2302/2302389.png" alt="icon">
            <p>Sản phẩm của cửa hàng</p>
        </div>
        <div class="list-coffee-container">
            <?php
                include "./Controller/Coffee.php";
                include "./Model/Coffee.php";
                $coffee = array_values(getAllCoffee("./DatabaseConfig/DBConfig.php"));
                for ($i = count($coffee) - 1; $i >= 0; $i--) { 
                    echo 
                    "<div class='coffee'>
                        <img class='image-product' src='.". array_values($coffee[$i])[2] ."' alt='Image'>
                        <p>". array_values($coffee[$i])[1] ."</p>
                        <div>
                            <p>". number_format(array_values($coffee[$i])[3]) ."đ</p> 
                            <img onclick='AddCoffeeToCart(event,". array_values($coffee[$i])[0] .")' class='icon' src='https://cdn-icons-png.flaticon.com/512/4601/4601551.png' alt='icon'/>
                        </div>
                    </div>";
                }
            ?>
        </div>
    </section>
    <footer>
        <div id="left-footer">
            <div>
                <p>GỌI MUA HÀNG ONLINE(08:00 - 21:00 mỗi ngày)</p>
                <p>1800 1700</p>
                <p>Tất cả các ngày trong tuần(Trừ tết Âm Lịch)</p>
            </div>
            <div>
                <p>GÓP Ý & KHIẾU NẠI(08:00 - 21:00 mỗi ngày)</p>
                <p>1800 1701</p>
                <p>Tất cả các ngày trong tuần(Trừ tết Âm Lịch)</p>
            </div>
        </div>
        <div id="center-footer">
            <img src="https://media-cdn.tripadvisor.com/media/photo-s/11/db/5e/d4/vidriera.jpg" alt="image">
        </div>
        <div id="right-footer">
            <p>KẾT NỐI VỚI CHÚNG TÔI</p>
            <div>
                <img class="connect-icon" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1200px-Facebook_Logo_%282019%29.png" alt="fb-icon">
                <img class="connect-icon" src="https://seeklogo.com/images/T/tiktok-logo-1F4A5DCD45-seeklogo.com.png" alt="tiktok-icon">
                <img class="connect-icon" src="https://classic.vn/wp-content/uploads/2022/07/zalo-icon.png" alt="zalo-icon">
                <img class="connect-icon" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Instagram_logo_2016.svg/2048px-Instagram_logo_2016.svg.png" alt="insta-icon">
            </div>
            <p>Địa chỉ: 160 Phan Huy Ích, phường 12, quận Gò Vấp, thành phố Hồ Chí Minh</p>
        </div>
    </footer>
    <section id="copyright">
        <p>&copy;Bản quyền thuộc về công ty NTC Group</p>
    </section>
    <div class="cart-icon-container" onclick="OpenCart()">
        <span id="quantityInCart">0</span>
        <img id="cart-icon" src="https://cdn-icons-png.flaticon.com/512/1899/1899044.png" alt="icon">
    </div>
    <div class="modal-container" id="cart-container">
        <div class="modal">
            <div class="modal-header">
                <p>Giỏ hàng</p>
                <img onclick="CloseCart()" class="icon" src="https://icons-for-free.com/iconfiles/png/512/close+cross+delete+exit+remove+icon-1320085939816384527.png" alt="icon">
            </div>
            <div class="modal-body" id="cart-coffee-container">
            </div>
            <div class="modal-footer">
                <p id="totalPrice">Tổng tiền: 0đ</p>
                <button onclick="OpenFormCustomer()">Tiếp tục</button>
            </div>
        </div>
    </div>
    <div class="modal-container" id="form-customer-container">
        <div class="modal">
            <div class="modal-header">
                <p>Thông tin khách hàng</p>
                <img onclick="CloseFormCustomer()" class="icon" src="https://icons-for-free.com/iconfiles/png/512/close+cross+delete+exit+remove+icon-1320085939816384527.png" alt="icon">
            </div>
            <div class="modal-body">
                <fieldset>
                    <legend align="right">Họ và tên</legend>
                    <input id="customer"/>
                </fieldset>
                <fieldset>
                    <legend align="right">Số điện thoại</legend>
                    <input type="number" min="0" id="phonenumber"/>
                </fieldset>
                <fieldset>
                    <legend align="right">Địa chỉ nhận hàng</legend>
                    <input id="address"/>
                </fieldset>
                <fieldset>
                    <legend align="right">Ghi chú</legend>
                    <textarea id="note"></textarea>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button onclick="Buy()">Đặt mua</button>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js"></script>
<script src="./JS/index.js"></script>
</html>