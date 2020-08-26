$(document).ready(function() {
    var product_table = $("#product_table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        dom: "Bfrtip",
        buttons: [
            {
                text: "Create New Product",
                className: "btn btn-primary",
                action: function(e, dt, node, config) {
                    window.location.href = "{{URL::current()}}" + "/create";
                }
            },
            {
                text: "Reload",
                action: function(e, dt, node, config) {
                    dt.ajax.reload();
                }
            },
            {
                text: '<i class="fa fa-trash"></i>',
                className: "btn btn-danger delBtn"
            },
            "colvis",
            "excel",
            "print",
            "pdf"
        ],
        ajax: "{{aurl('products')}}",
        columnDefs: [
            {
                targets: 3,
                orderable: false,
                searchable: false
            }
        ],
        columns: [
            {
                data: "checkbox",
                name: "checkbox",
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false
            },
            { data: "id", name: "id" },
            { data: "title", name: "title" },
            { data: "price", name: "price" },
            { data: "stock", name: "stock" },
            { data: "offer_price", name: "offer_price" },
            {
                data: "actions",
                name: "actions",
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false
            }
        ]
    });
});
