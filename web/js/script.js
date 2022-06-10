

function addToCart(cat_menu_item_id,price){
    cantidad = document.getElementById(cat_menu_item_id).value;
    if(cantidad != '' && cantidad != 0){
        $.post('/cart/add-cart', { cat_menu_item_id: cat_menu_item_id, price:price,quantity:cantidad}, function(data) {
            if (data) {
                alert('Se ha añadido correctamente');
                document.getElementById(cat_menu_item_id).value = ''
            }else{
                alert('Ha ocurrido un error, intente más tarde');
            }
        });
    }else{
        alert('Tienes que agregar una cantidad')
    }
    
}

function deleteItemCart(id){
    var response = confirm("¿Estas seguro de borrar de tu carrito este platillo?");
    if(response){
        $.post('/cart/delete-item-cart', {cart_id:id}, function(data) {
            if (data) {
                alert('Se ha elimando correctamente del carrito');
                window.location.reload()
            }else{
                alert('Ha ocurrido un error, intente más tarde');
            }
        });    
    }
}