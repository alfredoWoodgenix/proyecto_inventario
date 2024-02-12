function listar(id_codigo_OC) {
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
          searchPanes: {
            show: true,
          },
          targets: [0, 1, 2],
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
                  columns: [0, 1, 2],
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
                  columns: [0, 1, 2],
                },
              },
        ],
      },
      ajax: {
        url: "../../ajax/carrito_compras/listar.php?op=3",
        data: {
            id_codigo_OC: id_codigo_OC
        },
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
    var id_codigo_OC = $("#id_codigo_OC").val();
  
    listar(id_codigo_OC);
  }

  init();