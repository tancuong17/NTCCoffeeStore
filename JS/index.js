if (localStorage.getItem("cart") != null) {
  let listCoffeeInCart = new Array();
  listCoffeeInCart = JSON.parse(localStorage.getItem("cart"));
  let count = 0;
  for (let i = 0; i < listCoffeeInCart.length; i++) {
    count += listCoffeeInCart[i].quantity;
  }
  $("#quantityInCart").text(count);
}
if(window.location.pathname == "/NTCCoffeeStore/View/Login.php")
{
  $.ajax({
    url: "http://localhost/NTCCoffeeStore/Controller/Account.php",
    type: "post",
    dataType: "text",
    data: { nameFunction: "checkLogin"},
    success: function (result) {
      if(result == 1)
        window.location.href = "http://localhost/NTCCoffeeStore/View/Admin.php";
    }
  });
}
function LoginPage() {
  window.location.href = "http://localhost/NTCCoffeeStore/View/Login.php";
}
function Login() {
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  $.ajax({
    url: "http://localhost/NTCCoffeeStore/Controller/Account.php",
    type: "post",
    dataType: "text",
    data: { nameFunction: "checkAccount", username: username, password: password},
    success: function (result) {
      if(result == 0)
        alert("Tài khoản hoặc mật khẩu không chính xác!");
      else
        window.location.reload();
    }
  });
}
function OpenCart() {
  let listCoffeeInCart = new Array();
  let totalPrice = 0;
  listCoffeeInCart = JSON.parse(localStorage.getItem("cart"));
  document.getElementById("cart-coffee-container").replaceChildren();
  document.getElementById("cart-container").style.display = "flex";
  if (localStorage.getItem("cart") != null) {
    for (let i = 0; i < listCoffeeInCart.length; i++) {
      totalPrice += listCoffeeInCart[i].price * listCoffeeInCart[i].quantity;
      $("#cart-coffee-container").prepend(`
      <div class="cart-product">
        <div class="cart-product-info-container">
          <img class="cart-product-image" src="`+ listCoffeeInCart[i].image + `" alt="Image">
          <div class="cart-product-info">
            <p>`+ listCoffeeInCart[i].name + `</p>
            <p>`+ listCoffeeInCart[i].price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ" + `</p>
          </div>
        </div>
        <div class="cart-product-info-container">
          <input value="`+ listCoffeeInCart[i].quantity + `" onchange="ChangeQuantityInCart(event,` + listCoffeeInCart[i].id + `)" type="number" min="1"/>
          <img onclick="RemoveCoffeeInCart(`+ listCoffeeInCart[i].id + `)" class="icon" src="https://static.thenounproject.com/png/1377320-200.png" alt="icon">
        </div>
      </div>
    `)
    }
    $("#totalPrice").text("Tổng tiền: " + totalPrice.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ");
  }
}
function CloseCart() {
  document.getElementById("cart-container").style.display = "none";
}
function OpenFormCustomer() {
  let listCoffeeInCart = new Array();
  listCoffeeInCart = JSON.parse(localStorage.getItem("cart"));
  if (listCoffeeInCart == null) {
    alert("Giỏ hàng của bạn đang trống!");
    check = false;
  }
  else {
    document.getElementById("cart-container").style.display = "none";
    document.getElementById("form-customer-container").style.display = "flex";
  }
}
function CloseFormCustomer() {
  document.getElementById("form-customer-container").style.display = "none";
}
function AddCoffeeToCart(e, idCoffee) {
  let listCoffeeInCart = new Array();
  let image = e.target.parentElement.parentElement.children[0].src;
  let name = e.target.parentElement.parentElement.children[1].innerHTML;
  let price = e.target.parentElement.children[0].innerHTML;
  let priceReplace1 = price.replace(",", "");
  let priceReplace2 = priceReplace1.replace("đ", "");
  if (localStorage.getItem("cart") == null) {
    listCoffeeInCart.push({ id: idCoffee, name: name, image: image, price: Number(priceReplace2), quantity: 1 });
    localStorage.setItem("cart", JSON.stringify(listCoffeeInCart));
  }
  else {
    listCoffeeInCart = JSON.parse(localStorage.getItem("cart"));
    let postion = listCoffeeInCart.map(e => e.id).indexOf(idCoffee);
    if (postion != -1) {
      listCoffeeInCart[postion].quantity = listCoffeeInCart[postion].quantity + 1;
      localStorage.setItem("cart", JSON.stringify(listCoffeeInCart));
    }
    else {
      listCoffeeInCart.push({ id: idCoffee, name: name, image: image, price: Number(priceReplace2), quantity: 1 });
      localStorage.setItem("cart", JSON.stringify(listCoffeeInCart));
    }
  }
  OpenCart();
  let count = 0;
  for (let i = 0; i < listCoffeeInCart.length; i++) {
    count += listCoffeeInCart[i].quantity;
  }
  $("#quantityInCart").text(count);
}
function RemoveCoffeeInCart(idCoffee) {
  let listCoffeeInCart = new Array();
  listCoffeeInCart = JSON.parse(localStorage.getItem("cart"));
  document.getElementById("cart-coffee-container").replaceChildren();
  let postion = listCoffeeInCart.map(e => e.id).indexOf(idCoffee);
  let count = Number($("#quantityInCart").text()) - listCoffeeInCart[postion].quantity;
  $("#quantityInCart").text(count);
  listCoffeeInCart.splice(postion, 1);
  localStorage.setItem("cart", JSON.stringify(listCoffeeInCart));
  OpenCart();
}
function ChangeQuantityInCart(e, idCoffee) {
  let listCoffeeInCart = new Array();
  listCoffeeInCart = JSON.parse(localStorage.getItem("cart"));
  let postion = listCoffeeInCart.map(e => e.id).indexOf(idCoffee);
  listCoffeeInCart[postion].quantity = e.target.value;
  localStorage.setItem("cart", JSON.stringify(listCoffeeInCart));
  let count = Number($("#quantityInCart").text()) + 1;
  $("#quantityInCart").text(count);
  OpenCart();
}
function Buy() {
  let customer = $("#customer").val();
  let phonenumber = $("#phonenumber").val();
  let address = $("#address").val();
  let note = $("#note").val();
  let date = new Date().toLocaleString();
  let listCoffeeInCart = new Array();
  listCoffeeInCart = JSON.parse(localStorage.getItem("cart"));
  if (customer == "" || phonenumber == "" || address == "")
    alert("Bạn chưa nhập đầy đủ thông tin!");
  else
    $.ajax({
      url: "http://localhost/NTCCoffeeStore/Controller/Order.php",
      type: "post",
      dataType: "text",
      data: { nameFunction: "addOrder", customer: customer, phonenumber: phonenumber, address: address, note: note, date: date, listCoffeeInCart: listCoffeeInCart },
      success: function (result) {
        alert("Đặt hàng thành công!");
        localStorage.removeItem("cart");
        $("#quantityInCart").text(0);
        CloseFormCustomer();
      }
    });
}