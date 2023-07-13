const payContenido = document.querySelector('.pagoContenidoCarrito');
const modalBody = document.querySelector('.modal-body');
const precioTotal = document.querySelector('.precio-total');
const btnRegresar = document.querySelector('#Devolverse');


if(document.readyState == "loading"){
    document.addEventListener('DOMContentLoaded', function(){
    fromLocalStorageTopayment();
    });

}else{
    fromLocalStorageTopayment();
    
}


function devolverse(){
    localStorage.clear('payInfo');
    window.location.href = 'index.php';
}




function fromLocalStorageTopayment(){
    const cartItems = JSON.parse(localStorage.getItem('payInfo'));
    cartItems.forEach(element => {
        const payContent = payInformation(element.id,element.title, element.price, element.imgSrc, element.quantity);
        const newNode = document.createElement('div');
        newNode.innerHTML = payContent;
        payContenido.appendChild(newNode)
        
    });
    precioTotal.innerHTML = cartItems[0].total;

}


//--PAY INFORMATION--
function payInformation(id,title,price,imgSrc,quantity){
    return`
    <div class="payInformation">
    <div class="container cart-box">
    <span class="cart-product-id" hidden>${id}</span>
    <img src="${imgSrc}" alt="" class="cart-img" style="width: 5rem;height: 5rem;">
    <div class="cart-product-title">${title}</div>
    <div class="cart-price">${quantity}</div>
    <div class="cart-price">${price}</div>
    `
}