<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị cửa hàng</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/4720/4720989.png">
    <link rel="stylesheet" href="../CSS/index.css">
</head>
<body>
    <header class="header">
        <div>
            <img class="logo" src="https://cdn-icons-png.flaticon.com/512/4720/4720989.png" alt="Logo">
            <p>NTC <br> Coffee Store</p>
        </div>
        <button class="login-button" onClick="Logout()">Đăng xuất</button>
    </header>
    <div id="body-admin">
        <fieldset>
            <legend>Đơn hàng</legend>
            <div class="list-order-container" id="list-coffee-admin">
                <?php
                    include "../Controller/Order.php";
                    $order = array_values(getAllOrder());
                    for ($i=0; $i < count($order); $i++) { 
                        echo 
                        "<div class='order'>
                            <div id='info-order'>
                                <div>
                                    <img class='icon' src='https://cdn-icons-png.flaticon.com/512/4143/4143150.png' alt='icon'>
                                    <span>". array_values($order[$i])[2] ."</span>
                                </div>
                                <div>
                                    <img class='icon' src='https://cdn-icons-png.flaticon.com/512/244/244210.png' alt='icon'>
                                    <span>". array_values($order[$i])[3] ."</span>
                                </div>
                                <div>
                                    <img class='icon' src='https://cdn-icons-png.flaticon.com/512/4744/4744824.png' alt='icon'>
                                    <span>". array_values($order[$i])[1] ."</span>
                                </div>
                                <div>
                                    <img class='icon' src='https://cdn-icons-png.flaticon.com/512/3222/3222642.png' alt='icon'>
                                    <span>". array_values($order[$i])[4] ."</span>
                                </div>
                                <div>
                                    <img class='icon' src='https://cdn-icons-png.flaticon.com/512/4305/4305512.png' alt='icon'>
                                    <span>". number_format(array_values($order[$i])[5]) ."đ</span>
                                </div>
                                <div>
                                    <img class='icon' src='https://static.thenounproject.com/png/1328076-200.png' alt='icon'>
                                    <span>".array_values($order[$i])[6] ."</span>
                                </div>
                            </div>
                            <div id='button-order'>
                                <img onclick='UpdateStatusOrder(". array_values($order[$i])[0] .")' class='icon' src='https://cdn-icons-png.flaticon.com/512/2830/2830175.png' alt='icon'>
                                <img onclick='OpenCartOrder(". array_values($order[$i])[0] .")' class='icon' src='https://cdn-icons-png.flaticon.com/512/1899/1899044.png' alt='icon'>
                                <img onclick='OpenNoteOrder(". array_values($order[$i])[0] .")' class='icon' src='https://cdn-icons-png.flaticon.com/512/2599/2599636.png' alt='icon'>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>Sản phẩm</legend>
            <div class="list-coffee-container" id="list-coffee-admin">
                <?php
                    include "../Controller/Coffee.php";
                    include "../Model/Coffee.php";
                    $coffee = array_values(getAllCoffee("../DatabaseConfig/DBConfig.php"));
                    for ($i = count($coffee) - 1; $i >= 0; $i--) {
                        $id = array_values($coffee[$i])[0];
                        $image = array_values($coffee[$i])[2];
                        $name = array_values($coffee[$i])[1];
                        $price = array_values($coffee[$i])[3];
                        $quantity = array_values($coffee[$i])[4];
                        $a = "'";
                        echo 
                        "<div class='coffee'>
                            <img class='image-product' src='..$image' alt='Image'>
                            <p>$name</p>
                            <div>
                                <p>". number_format($price) ."đ<br>Còn $quantity sản phẩm</p> 
                                <img onclick='OpenFormUpdate($i,$id,`$name`,`$image`,$price,$quantity)' class='icon' src='https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png' alt='icon'/>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>Thống kê</legend>
            <select>
                <option>Năm 2023</option>
            </select>
            <div id="statistical">
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
            </div>
        </fieldset>
    </div>
    <div class="cart-icon-container" onclick="OpenFormAdd()">
        <img id="cart-icon" src="https://static.thenounproject.com/png/2675922-200.png" alt="icon">
    </div>
    <div class="modal-container" id="form-add-product-container">
        <div class="modal">
            <div class="modal-header">
                <p>Thông tin sản phẩm</p>
                <img onclick="CloseFormAdd()" class="icon" src="https://icons-for-free.com/iconfiles/png/512/close+cross+delete+exit+remove+icon-1320085939816384527.png" alt="icon">
            </div>
            <div class="modal-body">
                <fieldset>
                    <legend align="right">Tên sản phẩm</legend>
                    <input id="name"/>
                </fieldset>
                <fieldset>
                    <legend align="right">Giá bán</legend>
                    <input type="number" id="price" min="0"/>
                </fieldset>
                <fieldset>
                    <legend align="right">Ảnh sản phẩm</legend>
                    <input type="file" id="image" accept="image/*"/>
                </fieldset>
                <fieldset>
                    <legend align="right">Số lượng</legend>
                    <input type="number" id="quantity" min="0"/>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button onclick="AddProduct()">Thêm</button>
            </div>
        </div>
    </div>
    <div class="modal-container" id="form-update-product-container">
        <div class="modal">
            <div class="modal-header">
                <p>Cập nhật sản phẩm</p>
                <img onclick="CloseFormUpdate()" class="icon" src="https://icons-for-free.com/iconfiles/png/512/close+cross+delete+exit+remove+icon-1320085939816384527.png" alt="icon">
            </div>
            <div class="modal-body">
                <fieldset>
                    <legend align="right">Tên sản phẩm</legend>
                    <input id="nameUpdate"/>
                </fieldset>
                <fieldset>
                    <legend align="right">Giá bán</legend>
                    <input type="number" id="priceUpdate" min="0"/>
                </fieldset>
                <fieldset>
                    <legend align="right">Ảnh sản phẩm</legend>
                    <input type="file" id="imageUpdate" accept="image/*"/>
                </fieldset>
                <fieldset>
                    <legend align="right">Số lượng</legend>
                    <input type="number" id="quantityUpdate" min="0"/>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button onclick="UpdateCoffee()">Cập nhật</button>
            </div>
        </div>
    </div>
    <div class="modal-container" id="cart-container">
        <div class="modal">
            <div class="modal-header">
                <p>Giỏ hàng</p>
                <img onclick="CloseCartOrder()" class="icon" src="https://icons-for-free.com/iconfiles/png/512/close+cross+delete+exit+remove+icon-1320085939816384527.png" alt="icon">
            </div>
            <div class="modal-body" id="cart-coffee-container">
            </div>
        </div>
    </div>
    <div class="modal-container" id="note-container">
        <div class="modal">
            <div class="modal-header">
                <p>Lời nhắn</p>
                <img onclick="CloseNoteOrder()" class="icon" src="https://icons-for-free.com/iconfiles/png/512/close+cross+delete+exit+remove+icon-1320085939816384527.png" alt="icon">
            </div>
            <div class="modal-body" id="note-content-container">
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="../JS/admin.js"></script>
</html>