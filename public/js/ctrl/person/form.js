var FormPerson = function() {
    var swalInit = swal.mixin({
        buttonsStyling: false,
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-light'
    });

    // Select2 for length menu styling
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.form-control-select2').select2({
            allowClear: true,
            placeholder: '-- Please select --'
        });
    };

	var _componentUniform = function() {
	    if (!$().uniform) {
	        console.warn('Warning - uniform.min.js is not loaded.');
	        return;
	    }
        
        $('.form-input-styled').uniform({
            fileButtonClass: 'action btn btn-light'
        });
	}

    var _componentValidation = function() {
        if (!$().validate) {
            console.warn('Warning - validate.min.js is not loaded.');
            return;
        }

        $('#form-validate').validate({
            ignore: 'input[type=hidden]',
            errorClass: 'validation-invalid-label',
            errorMessage: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler:function(e) {
                swalInit.fire({
                    title: "Are you sure?",
                    text: "Save this data!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes!",
                    cancelButtonText: "Cancel"
                }).then(function(s) {
                    if (s.value) {
                        e.submit();
                    }
                })
            }
        });
    }

    return {
        init: function() {
            _componentSelect2();
            _componentUniform();
            _componentValidation();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    FormPerson.init();
})