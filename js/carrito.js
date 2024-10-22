$(document).ready(function() {
    // Carga inicial del carrito
    $('#carrito-compras-tienda').load("process/carrito.php");
    
    // Manejo del clic en el botón "Añadir"
    $(".botonCarrito").click(function(){
        let precio = $(this).val(); // Obtiene el value del botón (código del producto)
        
        // Carga el carrito con el precio del producto agregado
        $('#carrito-compras-tienda').load("process/carrito.php?precio=" + precio);
        
        // Muestra el modal del carrito
        $('.modal-carrito').modal('show');
    });

    // Manejo del clic en el botón del carrito en la navegación
    $(".carrito-button-nav").click(function(){
        $("#container-carrito-compras").animate({height: 'toggle'}, 200);
    });
});
