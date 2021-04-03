$(function(e) {

    //file export datatable
    var table = $('#example').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'colvis']
    });
    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

    //sample datatable
    $('#example-2').DataTable();

    //Details display datatable
    $('#example-1').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data();
                        return 'Details for ' + data[0] + ' ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        }
    });

    //form-input-datatable
    var table = $('#form-input-datatable').DataTable({
        columnDefs: [{
            orderable: false,
            targets: [1, 2, 3, 4, 5]
        }]
    });

    //Select2
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });
    $('table').on('draw.dt', function() {
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
    });


});