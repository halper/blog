<script src="{{URL::asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap-growl.min.js')}}"></script>
<script src="{{URL::asset('js/prism.js')}}"></script>
<script src="js/materialize.js"></script>
<script>
    function notifyAsToast(message, type) {

        $.notify({
            message: message
        }, {
            element: 'body',
            type: 'pastel-' + (type == 'error' ? 'danger' : type),
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            template: '<div data-notify="container" class="col s3 alert alert-{0}" role="alert">' +
            '<span data-notify="message">{2}</span>' +
            '</div>'
        });
    }

</script>