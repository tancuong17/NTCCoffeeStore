if (window.location.pathname == "/NTCCoffeeStore/View/Admin.php") {
  $.ajax({
    url: "http://localhost/NTCCoffeeStore/Controller/Account.php",
    type: "post",
    dataType: "text",
    data: { nameFunction: "checkLogin" },
    success: function (result) {
      if (result == 0)
        window.location.href = "http://localhost/NTCCoffeeStore/View/Login.php";
    }
  });
}
$.ajax({
  url: "http://localhost/NTCCoffeeStore/Controller/Order.php",
  type: "post",
  dataType: "json",
  data: { 'nameFunction': "getOrders" },
  success: function (result) {
    localStorage.setItem("orders", JSON.stringify(result));
  }
});
let orders = JSON.parse(localStorage.getItem("orders"));
var xValues = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
var yValues = new Array();
var quantityOrder = new Array();
let total = 0;
let quantity = 0;
for (let i = 0; i < 12; i++) {
  for (let j = 0; j < orders.length; j++) {
    if (orders[j].date.slice(13).slice(0, 1) == (i + 1) && orders[j].status == "Đã giao hàng")
      total = total + Number(orders[j].total);
    if (orders[j].date.slice(13).slice(0, 1) == (i + 1))
      quantity = quantity + 1;
  }
  yValues[i] = total;
  quantityOrder[i] = quantity;
  total = 0;
  quantity = 0;
}
var barColors = ["red", "green", "blue", "orange", "brown", "red", "green", "blue", "orange", "brown", "red", "red"];
new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      data: yValues
    }]
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: "Thống kê doanh thu"
    }
  }
});
new Chart("myChart2", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: quantityOrder
    }]
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: "Thống kê đơn hàng"
    }
  }
});
let idCoffeeUpdate = "";
let imageRemove = "";
let positionUpdate = "";
function Logout() {
  $.ajax({
    url: "http://localhost/NTCCoffeeStore/Controller/Account.php",
    type: "post",
    dataType: "text",
    data: { nameFunction: "logout" },
    success: function (result) {
      window.location.reload();
    }
  });
}
function OpenFormAdd() {
  document.getElementById("form-add-product-container").style.display = "flex";
}
function CloseFormAdd() {
  document.getElementById("form-add-product-container").style.display = "none";
}
function OpenFormUpdate(position, idCoffee, nameCoffee, imageCoffee, priceCoffee, quantityCoffee) {
  idCoffeeUpdate = idCoffee;
  imageRemove = imageCoffee;
  positionUpdate = position;
  document.getElementById("form-update-product-container").style.display = "flex";
  $("#nameUpdate").val(nameCoffee);
  $("#priceUpdate").val(priceCoffee);
  $("#quantityUpdate").val(quantityCoffee);
}
function CloseFormUpdate() {
  document.getElementById("form-update-product-container").style.display = "none";
}
function UpdateCoffee() {
  let name = document.getElementById("nameUpdate").value;
  let price = document.getElementById("priceUpdate").value;
  let quantity = document.getElementById("quantityUpdate").value;
  var file_data = $('#imageUpdate').prop('files')[0];
  var form_data = new FormData();
  form_data.append('idCoffee', idCoffeeUpdate);
  form_data.append('file', file_data);
  form_data.append('name', name);
  form_data.append('price', price);
  form_data.append('quantity', quantity);
  form_data.append('imageRemove', imageRemove);
  form_data.append('nameFunction', "updateCoffee");
  $.ajax({
    url: "http://localhost/NTCCoffeeStore/Controller/Coffee.php",
    type: "post",
    contentType: false,
    processData: false,
    dataType: "text",
    data: form_data,
    success: function (result) {
      window.location.reload();
      document.getElementById("form-update-product-container").style.display = "none";
    }
  });
}
function AddProduct() {
  let name = document.getElementById("name").value;
  let price = document.getElementById("price").value;
  let quantity = document.getElementById("quantity").value;
  const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
  var file_data = $('#image').prop('files')[0];
  if (!validImageTypes.includes(file_data["type"])) {
    alert("Chỉ nhận file ảnh!");
  }
  if (name == "" || price == "" || quantity == "") {
    alert("Bạn chưa nhập đầy đủ thông tin!");
  }
  else {
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('name', name);
    form_data.append('price', price);
    form_data.append('quantity', quantity);
    form_data.append('nameFunction', "addCoffee");
    $.ajax({
      url: "http://localhost/NTCCoffeeStore/Controller/Coffee.php",
      type: "post",
      contentType: false,
      processData: false,
      dataType: "json",
      data: form_data,
      success: function (result) {
        window.location.reload();
        document.getElementById("form-add-product-container").style.display = "none";
      }
    });
  }
}
function OpenCartOrder(idOrder) {
  $.ajax({
    url: "http://localhost/NTCCoffeeStore/Controller/Order.php",
    type: "post",
    dataType: "json",
    data: { idOrder: idOrder, nameFunction: "getCoffeeInCart" },
    success: function (result) {
      for (let i = 0; i < result.length; i++) {
        $("#cart-coffee-container").prepend(`
          <div class="cart-product">
            <div class="cart-product-info-container">
              <img class="cart-product-image" src="..`+ result[i].image + `" alt="Image">
              <div class="cart-product-info">
                  <p>`+ result[i].name + `</p>
                  <p>`+ result[i].price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + "đ" + `</p>
              </div>
            </div>
            <p class="quantityCoffeeInCart">`+ result[i].quantity + `</p>
          </div>
        `)
      }
      document.getElementById("cart-container").style.display = "flex";
    }
  });
}
function CloseCartOrder() {
  document.getElementById("cart-coffee-container").replaceChildren();
  document.getElementById("cart-container").style.display = "none";
}
function OpenNoteOrder(idOrder) {
  $.ajax({
    url: "http://localhost/NTCCoffeeStore/Controller/Order.php",
    type: "post",
    dataType: "text",
    data: { idOrder: idOrder, nameFunction: "getNoteOrder" },
    success: function (result) {
      $("#note-content-container").prepend(`
          <p>`+ result + `</p>
        `)
      document.getElementById("note-container").style.display = "flex";
    }
  });
}
function CloseNoteOrder() {
  document.getElementById("note-content-container").replaceChildren();
  document.getElementById("note-container").style.display = "none";
}
function UpdateStatusOrder(idOrder) {
  $.ajax({
    url: "http://localhost/NTCCoffeeStore/Controller/Order.php",
    type: "post",
    dataType: "text",
    data: { idOrder: idOrder, nameFunction: "updateStatusOrder" },
    success: function (result) {
      console.log(result);
      window.location.reload();
    }
  });
}