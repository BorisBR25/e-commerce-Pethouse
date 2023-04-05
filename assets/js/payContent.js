const payContenido = document.querySelector('.pagoContenidoCarrito');
const modalBody = document.querySelector('.modal-body');
const precioTotal = document.querySelector('.precio-total');


if(document.readyState == "loading"){
    document.addEventListener('DOMContentLoaded', function(){
        fromLocalStorageTopayment();
        
    });
}else{
    fromLocalStorageTopayment();
    
}



function fromLocalStorageTopayment(){
    const cartItems = JSON.parse(localStorage.getItem('payInfo'));
    cartItems.forEach(element => {
        const payContent = payInformation(element.title, element.price, element.imgSrc, element.quantity);
        const newNode = document.createElement('div');
        newNode.innerHTML = payContent;
        payContenido.appendChild(newNode)
        
    });
    precioTotal.innerHTML = cartItems[0].total;

}


//--PAY INFORMATION--
function payInformation(title,price,imgSrc,quantity){
    return`
    <div class="payInformation">
    <div class="container cart-box">
    <img src="${imgSrc}" alt="" class="cart-img" style="width: 5rem;height: 5rem;">
    <div class="cart-product-title">${title}</div>
    <div class="cart-price">${quantity}</div>
    <div class="cart-price">${price}</div>
    `
}