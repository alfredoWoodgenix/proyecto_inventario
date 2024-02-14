function listar() {
    $("#table").DataTable({
      language: {
        url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
        ordering: true,
        select: {
          rows: {
            _: "%d Selected rows",
            0: "Click to select a row",
            1: "1 Selected row",
          },
        },
        buttons: {
          copyTitle: "Tabla Copiada",
          copySuccess: {
            _: "%d filas copiadas",
            1: "1 fila copiada",
          },
        },
        searchPanes: {
          clearMessage: "Borrar todo",
          collapse: {
            0: "Paneles de búsqueda",
            _: "Paneles de búsqueda (%d)",
          },
          count: "{total}",
          countFiltered: "{shown} ({total})",
          emptyPanes: "Sin paneles de búsqueda",
          loadMessage: "Cargando paneles de búsqueda",
          title: "Filtros Activos - %d",
          showMessage: "Mostrar Todo",
          collapseMessage: "Colapsar Todo",
        },
      },
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"],
      ],
      scrollY: "400px",
      scrollX: true,
      select: true,
      searchPanes: {
        layout: "auto",
        initCollapsed: true,
      },
      dom: '<"d-flex justify-content-between mx-auto"<"col-md-4 inline my-sm-3"B><"col-md-4 inline my-sm-3"f><"col-md-4 inline my-sm-3"l>>rt<"d-flex justify-content-center row"<"col-md-6 inline"i><"col-md-6 inline"p>>',
      columnDefs: [
        {
          targets: '_all', // Aplica la configuración a todas las columnas
          className: 'text-center',
          searchPanes: {
            show: true,
          },
          targets: [0, 1, 2, 3, 4, 5, 6, 7],
        },
      ],
      stateSave: true,
      buttons: {
        dom: {
          container: {
            tag: "div",
            className: "flexcontent",
          },
          buttonLiner: {
            tag: null,
          },
        },
        buttons: [
            {
                extend: "excel",
                text: '<i class="fa-solid fa-file-excel"></i> Excel',
                titleAttr: "Exportar a excel",
                className: "btn btn-success",
                title: "Shopping Cart",
                filename: "Shopping Cart",
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
              },
              {
                extend: "pdf",
                text: '<i class="fa-solid fa-file-pdf"></i> PDF',
                titleAttr: "Exportar a pdf",
                className: "btn btn-danger",
                title: "Shopping Cart",
                filename: "Shopping Cart",
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
              },
        ],
      },
      ajax: {
        url: "../../ajax/carrito_compras/listar.php?op=1",
        data: {},
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      destroy: true,
      pageLength: 10, // paginacion
      order: [[0, "asc"]], // ordenar (columna, orden)
    });
  }

  function init() {
    listar();

    $.post("../../ajax/carrito_compras/listar.php?op=5", function (r) {
    $("#warehouseList").html(r);
    });
  }
  
  init();

      //Función para elimina un Registro
function eliminar(id_carrito_compras) {
  var id_carrito_compras = id_carrito_compras;

  bootbox.confirm({
    title: "Confirmation",
    message: "Are you sure to delete the registry?",
    buttons: {
      cancel: {
        label: '<i class="fa fa-times"></i> Cancel',
        className: "btn-danger",
      },
      confirm: {
        label: '<i class="fa fa-check"></i> Delete',
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
          url: "../../ajax/carrito_compras/eliminar.php",
          type: "POST",
          data: {
            id_carrito_compras: id_carrito_compras
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
                    message: "Successfully removed",
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
                    message: "Some error occurred, please try again",
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
                    message: "Error de tiempo de espera",
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

// funcion para abrir el modal agregar
function abrir_modal_a() {
  // resetea el formulario
  $("#formulario_c")[0].reset();
  $("#modal_codigo").modal("show");
}

function cerrar_modal_a() {
  $("#modal_codigo").modal("hide");
  $("#formulario_c")[0].reset();
 
}

$("#formulario_c").submit(function (e) {
  e.preventDefault();
  var form_data = $(this).serialize();

  var warehouseListValue = document.getElementById("warehouseList").value;

  if (warehouseListValue === "") {
    bootbox.dialog({
        title: "Warning",
        message: "Please select a valid option from the warehouse.",
        buttons: {
          success: {
            label: "Close",
            className: "btn btn-danger",
          },
        },
      });

  }else{
    
  var dialog = bootbox.dialog({
      message:
        '<div style="justify-content:center; display:flex;"><div class="spinner-border spinner-border-lg text-info"></div></div><br><p class="text-center text-primary">Loading...</p>',
      size: "small",
  });

  $.ajax({
    type: "POST",
    url: "../../ajax/carrito_compras/agregar.php?op=1",
    data: form_data,
  })
    .done(function (data, textStatus, jqXHR) {
      console.log(data);

      if (data == 1) {
        dialog.init(function () {
          setTimeout(function () {
            dialog.modal("hide");
            bootbox.alert({
              title: "Warning",
              message: "Successfully registered",
              closeButton: false,
              size: "small",
              //centerVertical: true,
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
              message: "An error occurred, please try again",
              closeButton: false,
              size: "small",
              //centerVertical: true,
              callback: function (response) {
                location.reload();
              },
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
              message: "Internet connection error, please try again",
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
    
});

function ver_perfil(ruta_imagen, nombre) {
  var url = "../../" + ruta_imagen;

  $("#modal_perfil").modal("show");
  $("#perfil_empleado").show();
  $("#nombrecompleto_tres").text(nombre);
  $("#perfil_empleado").attr("src", "" + url + "");
}
  