var main_url = window.location.origin + "/";
var csrf_token = $('meta[name="csrf-token"]').attr('content');
var swalInit = swal.mixin({
    buttonsStyling: false,
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light'
});

var DatatableBasic = function() {
    var _componentDatatable = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            }
        });

        // Basic datatable
        $('.card-table').DataTable();
    }

    var _componentJs = function() {
        if ($("#alert-success").length > 0) {
            notyData($("#alert-success").html(), 'success');
        }
    }

    // Select2 for length menu styling
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
    };

    return {
        init: function() {
            _componentDatatable();
            _componentJs();
            _componentSelect2();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DatatableBasic.init();
});

function delete_data(ele) {
    var id = $(ele).data("id");
    var method = $(ele).data("method");
    swalInit.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
    }).then(function (s) {
        if (s.value) {
            var res;
            $.ajax({
                type: 'POST',
                url: main_url + method + "/" + id,
                data: '_token='+ csrf_token +'&_method=DELETE',
                async: false,
                success: function (data) {
                    res = data;
                    console.log(res)
                },
                error: function (e) {
                    console.log(e.responseText)
                }
            })
            window.location.href = main_url + method;
        }
    })
}