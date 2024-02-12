function redirectToPage() {
    // Puedes cambiar 'nueva_pagina.html' por la URL a la que deseas redirigir
    window.location.href = '../vistas/carrito_compras/carrito_compras.php';
}


$(document).ready(function(){
  $('.navbar-toggler').click(function(){
    $('#navbarSupportedContent').toggleClass('show');
  });
});
