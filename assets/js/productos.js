const modalBody = document.querySelector('.modal-body');
const contadorProducts = document.querySelector('.counter-products');



//start when the document is ready
if(document.readyState == "loading"){
    document.addEventListener('DOMContentLoaded', function(){
        loadCartFromLocalStorage();
        start();
    });
}else{
    loadCartFromLocalStorage();
    start();
}

            //start------------
function start(){
    addEvents();
    CartCounter();
    update();
}
//------UPDATE & RERENDER-----------
function update(){
    addEvents();
    updateTotal();
}

//-----------ADD EVENTS-----------
function addEvents(){

    //REMOVE ITEMS FROM CART
    let cartRemoveButton = document.querySelectorAll('.cart-remove');


    cartRemoveButton.forEach((btn) => {
        btn.addEventListener("click", handle_removeCartItem);
    })

    //---CHANGE ITEM QUANTITY
    let carQuantity_inputs = document.querySelectorAll('.cart-quantity');
    carQuantity_inputs.forEach((input) =>{
        input.addEventListener("change", handle_changeItemQuantity);
    })

    // ADD ITEM TO CART
    let addCartButton = document.querySelectorAll('.add-cart');
    addCartButton.forEach((btn) => {
        btn.addEventListener("click", handle_addCartItem);
    })

    //PURCHASE ORDER
    const buyButton = document.querySelector('.buybutton');
    buyButton.addEventListener("click", handle_buyOrder);
}

//--------------HANDLE EVENTS FUNCTIONS---------
let itemsAdded = JSON.parse(localStorage.getItem("productCart")) || [];



function handle_addCartItem(){
    let product = this.parentElement;
    let title = product.querySelector('.product-title').innerHTML;
    let price = product.querySelector('.product-price').innerHTML;
    let imgSrc = product.querySelector('.product-img').src;


    let newToAdd = {
        title,
        price,
        imgSrc,
        
    }

    // handle item already exist
    if (itemsAdded.find((el) => el.title == newToAdd.title)) {
        alert("Este producto ya esta en tu carrito!");
        return;
    }else{
        itemsAdded.push(newToAdd);
    }

    // ADD PRODUCT TO CART
    let cartBoxElement = cartBoxComponent(title,price, imgSrc);
    let newNode = document.createElement('div');
    newNode.innerHTML = cartBoxElement;
    const cartContent = modalBody.querySelector('.cart-content');
    cartContent.appendChild(newNode );
    console.log(itemsAdded);

    CartCounter();
    update();
    saveLocal();

}

//---REMOVE CART ITEM-----
function handle_removeCartItem(){
    this.parentElement.remove();
    itemsAdded = itemsAdded.filter((el) => el.title != this.parentElement.querySelector('.cart-product-title').innerHTML);
    CartCounter();
    update();
    saveLocal();
}

//---CHANGE QUANTITY ITEM-----
function handle_changeItemQuantity(){
    if (isNaN(this.value) || this.value < 1) {
        this.value = 1;
    }
    this.value = Math.floor(this.value);

    update();
}

//---BUY BUTTON------
function handle_buyOrder(){
    if (itemsAdded.length <= 0) {
        alert("No hay productos en tu carrito! \n Por favor agrega alguno de la tienda.");
        return;
    } else{
        const cartContent = modalBody.querySelector('.cart-content');
        //cartContent.innerHTML = '';
        payInfo();
        window.location.href="pasarela.html";
    }
}

function loadCartFromLocalStorage() {
    const cartContent = modalBody.querySelector('.cart-content');
    const cartItems = JSON.parse(localStorage.getItem('productCart')) || [];
  
    cartContent.innerHTML = '';
    cartItems.forEach(item => {
      const cartBoxElement = cartBoxComponent(item.title, item.price, item.imgSrc);
      const newNode = document.createElement('div');
      newNode.innerHTML = cartBoxElement;
      cartContent.appendChild(newNode);
    });
  
    CartCounter();
    update();
  }


//----UPDATE & RERENDER FUNCTIONS-------

function updateTotal(){
    let cartBoxes = document.querySelectorAll('.cart-box');
    const totalElement = modalBody.querySelector('.total-price');
    let total = 0;
    cartBoxes.forEach((cartBox) => {
        let priceElement = cartBox.querySelector('.cart-price');
        let price = parseInt(priceElement.innerHTML.replace("$",""));
        let quantity = cartBox.querySelector(".cart-quantity").value;
        total += price * quantity;
    });

    // keep 2 digits after decimal point
    //total = total.toFixed(1);

    totalElement.innerHTML = "$" + total;
}

//---CONTADOR DE PRODUCTOS-----
function CartCounter(){
    contadorProducts.style.display = "block";
    const cartLength = itemsAdded.length;
    localStorage.setItem("cartLength", JSON.stringify(cartLength))
    contadorProducts.innerText = JSON.parse(localStorage.getItem("cartLength"))
}

//--LOCALSTORAGE---
function saveLocal(){
    localStorage.setItem("productCart", JSON.stringify(itemsAdded))
}


//--PAY INFORMATION--

let payContenido = JSON.parse(localStorage.getItem("payInfo")) || [];
function payInfo() {
    
    let product = document.querySelectorAll('.cart-box');
    let total = document.querySelector('.total-price').innerHTML;
    
    for (let i = 0; i < product.length; i++) {
        let title = product[i].querySelector('.cart-product-title').innerHTML;
        let price = product[i].querySelector('.cart-price').innerHTML;
        let imgSrc = product[i].querySelector('.cart-img').src;
        let quantity = product[i].querySelector('.cart-quantity').value;
  
        
        let payInformation = {
            title,
            price,
            imgSrc,
            quantity,
            total
        }
        payContenido.push(payInformation);
    }
    
    localStorage.setItem("payInfo", JSON.stringify(payContenido))
    
}

//----------------HTML COMPONENTS-----
function cartBoxComponent(title,price,imgSrc){
    return `
    <div class="cart-box">
    <img src="${imgSrc}" alt="" class="cart-img" style="width: 5rem;height: 5rem;">
    <div class="cart-product-title">${title}</div>
    <div class="cart-price">${price}</div>
    <input type="number" value="1" class="cart-quantity">
    <!--REMOVE CART-->
    <i class="bi bi-trash cart-remove"></i>
    </div>
    `
}


