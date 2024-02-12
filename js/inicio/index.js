function addToCart(info_articulo) {
    // Puedes acceder a la información del producto aquí
    var id_usuario = info_articulo.id_usuario;
    var id_articulo = info_articulo.id_articulo;
    var quantity = info_articulo.quantity;
    //var assembly = info_articulo.assembly;
    var stock = info_articulo.stock;
    var price = info_articulo.price;

    if(stock != 'null'){
      var valorSeleccionado = $("#stock" + id_articulo + " option:selected").text();
      var extractedNumber = valorSeleccionado.match(/\d+/)[0];
      console.log(extractedNumber);
    }

    if(stock == 'null' || price == 'null'){
      bootbox.dialog({
        title: "Warning",
        message: "Please select the price and a color",
        buttons: {
          success: {
            label: "Close",
            className: "btn-danger",
          },
        },
      });
    }else if(extractedNumber == 0){
      bootbox.dialog({
        title: "Warning",
        message: "No stock",
        buttons: {
          success: {
            label: "Close",
            className: "btn-danger",
          },
        },
      });
    }else{
  
  /*console.log("ID de Usuario:", id_usuario);
    console.log("ID de Artículo:", id_articulo);
    console.log("Cantidad:", quantity);
    console.log("Assembly:", assembly);
    console.log("Stock:", stock);
    console.log("Precio:", price);*/
    // Puedes realizar otras acciones, como enviar la información al servidor, etc.

    bootbox.confirm({
        title: "Confirmation",
        message: "Are you sure to add to the shopping cart?",
        buttons: {
          cancel: {
            label: '<i class="fa fa-times"></i> Cancel',
            className: "btn-danger",
          },
          confirm: {
            label: '<i class="fa fa-check"></i> Accept',
            className: "btn-success",
          },
        },
        callback: function (result) {
          console.log("This was logged in the callback: " + result);
    
          if (result == true) {
            var dialog = bootbox.dialog({
              title: "Processing",
              message:
                '<div style="justify-content:center; display:flex;"><div class="spinner-border spinner-border-lg text-info"></div></div><br><p class="text-center text-primary">Loading...</p>',
              size: "small",
              // closeButton: false,
              centerVertical: true,
            });
    
            $.ajax({
              url: "../../ajax/inicio/agregar.php?op=1",
              type: "POST",
              data: {
                    id_usuario : id_usuario,
                    id_articulo : id_articulo,
                    quantity : quantity,
                    //assembly : assembly,
                    stock : stock,
                    price : price
              },
            })
              .done(function (data, textStatus, jqXHR) {
                console.log(data);
    
                if (data == 1) {
                  dialog.init(function () {
                    setTimeout(function () {
                      dialog.modal("hide");
                      bootbox.alert({
                        title: "Warning",
                        message: "Added to shopping cart successfully",
                        centerVertical: true,
                        callback: function (response) {
                          location.reload();
                        },
                      });
                    }, 1000);
                  });
                }
                if (data == 2) {
                  dialog.init(function () {
                    setTimeout(function () {
                      dialog.modal("hide");
                      bootbox.alert({
                        title: "Warning",
                        message: "Some error occurred, try again",
                        centerVertical: true,
                        callback: function (response) {},
                      });
                    }, 1000);
                  });
                }
              })
              .fail(function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 0) {
                  dialog.init(function () {
                    setTimeout(function () {
                      dialog.modal("hide");
                      // alert("Not connect: Verify Network.");
                      bootbox.alert({
                        title: "Warning",
                        message:
                          "Internet connection error, please try again",
                        centerVertical: true,
                        callback: function (response) {},
                      });
                    }, 1000);
                  });
                } else if (jqXHR.status == 404) {
                  dialog.init(function () {
                    setTimeout(function () {
                      dialog.modal("hide");
                      // alert("Requested page not found [404]");
                      bootbox.alert({
                        title: "Warning",
                        message: "Error, page not found",
                        centerVertical: true,
                        callback: function (response) {},
                      });
                    }, 1000);
                  });
                } else if (jqXHR.status == 500) {
                  dialog.init(function () {
                    setTimeout(function () {
                      dialog.modal("hide");
                      // alert("Internal Server Error [500].");
                      bootbox.alert({
                        title: "Warning",
                        message: "Internal Server Error",
                        centerVertical: true,
                        callback: function (response) {},
                      });
                    }, 1000);
                  });
                } else if (textStatus === "parsererror") {
                  dialog.init(function () {
                    setTimeout(function () {
                      dialog.modal("hide");
                      // alert("Requested JSON parse failed.");
                      bootbox.alert({
                        title: "Warning",
                        message: "Requested JSON parsing failed",
                        centerVertical: true,
                        callback: function (response) {},
                      });
                    }, 1000);
                  });
                } else if (textStatus === "timeout") {
                  dialog.init(function () {
                    setTimeout(function () {
                      dialog.modal("hide");
                      // alert("Time out error.");
                      bootbox.alert({
                        title: "Warning",
                        message: "Timeout error",
                        centerVertical: true,
                        callback: function (response) {},
                      });
                    }, 1000);
                  });
                } else if (textStatus === "abort") {
                  dialog.init(function () {
                    setTimeout(function () {
                      dialog.modal("hide");
                      // alert("Ajax request aborted.");
                      bootbox.alert({
                        title: "Warning",
                        message: "Ajax request aborted",
                        centerVertical: true,
                        callback: function (response) {},
                      });
                    }, 1000);
                  });
                } else {
                  dialog.init(function () {
                    setTimeout(function () {
                      dialog.modal("hide");
                      // alert("Uncaught Error: " + jqXHR.responseText);
                      bootbox.alert({
                        title: "Warning",
                        message: "Undetected error : " + jqXHR.responseText,
                        centerVertical: true,
                        callback: function (response) {},
                      });
                    }, 1000);
                  });
                }
              })
              .always(function () {});
          }
        },
      });
    }
}

  $('.select-option').change(function() {
    // Obtén el valor y el ID de la card actual
    var selectedValue = $(this).find('option:selected').text();
    var extractedNumber = selectedValue.match(/\d+/)[0];
    console.log(extractedNumber);

    var cardId = $(this).closest('.card').attr('id');
    console.log(cardId);

    // Obtén el elemento input correspondiente
    var quantityInput = $('#quantity' + cardId);

    // Actualiza el max y el valor del input correspondiente
    quantityInput.attr('max', extractedNumber);
    quantityInput.val('1');
  });

  // Agregar un manejador de evento para el evento de entrada (input)
  // para validar manualmente el valor ingresado por el usuario
  $('.form-control').on('input', function() {
    var maxValue = parseInt($(this).attr('max'));
    var enteredValue = parseInt($(this).val());

    // Validar si el valor ingresado es mayor que el valor máximo
    if (enteredValue > maxValue) {
        $(this).val(maxValue);
    }
  });

  function searchProducts() {
    var searchInput = $('#productSearch').val().toLowerCase();
    var resultsFound = false;

    $('.card').each(function () {
        var productName = $(this).find('.fw-bolder').text().toLowerCase();

        if (productName.includes(searchInput)) {
            $(this).show();
            resultsFound = true;
        } else {
            $(this).hide();
        }
    });

    if (!resultsFound) {
        $('#noResultsMessage').show();
    } else {
        $('#noResultsMessage').hide();
    }
}

