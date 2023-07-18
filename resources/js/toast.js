import toastr from 'toastr';
window.$(document).ready(function () {
    toastr.options = {
    "positionClass": "toast-bottom-right",
    "progressBar": true
    };
    window.addEventListener('added', function (event) {
        toastr.success(event.detail.message, 'Validation');
        $('#formInscriptionModal').modal('hide');
        $('#newReinscription').modal('hide');
        $('#newPayment').modal('hide');
    });
    window.addEventListener('updated', function (event) {
        toastr.info(event.detail.message, 'Validation');
        $('#editClasseAnInscription').modal('hide');
        $('#formEditInscriptionModal').modal('hide');
        $('#editPayment').modal('hide');
    });
    window.addEventListener('error', function (event) {
        toastr.error(event.detail.message, 'Alert !');
        toastr.options.positionClass('top')
        $('#newReinscription').modal('hide');
    });


});

$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });

