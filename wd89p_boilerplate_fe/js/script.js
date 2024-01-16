let itemsInCart = [];
let CHECKOUT_API = "http://localhost:8000/api/";

$("#alert").hide();
function addToCart() {
    
    //document.getElementById('name').value
    let name = $('#name').val();
    let qty = $('#qty').val();
    let price = $('#price').val();
    let uom = $('#uom').val();

    itemsInCart.push({
        name : name,
        qty : qty,
        price : price,
        uom : uom,
        total_amount : qty * price
    });

    loadTable();
}

function loadTable() {
    let tr = "";
    let overAlltotalAmount = 0;
    for(let i = 0; i < itemsInCart.length; i++) {
        tr += "<tr>" +
            "<td>" + itemsInCart[i].name + "</td>" +
            "<td>" + itemsInCart[i].qty + "</td>" +
            "<td>" + itemsInCart[i].price + "</td>" +
            "<td>" + itemsInCart[i].uom + "</td>" +
            "<td>" + itemsInCart[i].total_amount + "</td>" +
        "</tr>";

        overAlltotalAmount += itemsInCart[i].total_amount;
    }

    $("#overAllTotalAmount").html(overAlltotalAmount)

    $("#itemsInCart").html(tr);
}

function checkout() {
    $.ajax({
        "url" : CHECKOUT_API + 'checkout', //URL of the API
        "type" : "POST", //GET and POST 
        "data" : "cart=" + JSON.stringify(itemsInCart), 
        "success" : function (response) { //success yung response
            console.log(response)
            $("#refNo").html(response.reference);
            $("#alert").show();
        },
        "error" : function (xhr, status, error) { //error yung response
            console.log(error)
            alert("Error")
        }
    });
}

function trackOrder() {
    $.ajax({
        "url" : CHECKOUT_API + 'track-order', //URL of the API
        "type" : "POST", //GET and POST 
        "data" : "order_ref_no=" + $("#order_ref").val(), 
        "success" : function (response) { //success yung response
            itemsInCart = response.data;
            loadTable();
        },
        "error" : function (xhr, status, error) { //error yung response
            console.log(error)
            alert("Error")
        }
    });
}