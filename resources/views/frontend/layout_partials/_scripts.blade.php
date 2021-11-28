
<!-- COMMON SCRIPTS -->
{{--<script src="{!! asset('assets/frontend/js/jquery-3.5.1.min.js') !!}"></script>--}}
<script src="{!! asset('assets/frontend/js/common_scripts.min.js') !!}"></script>

@yield('page_level_js_plugins')
<!-- Toastr SCRIPTS -->
<script src="{!! asset('assets/frontend/plugins/toastr/toastr.min.js') !!}"></script>


<script src="{!! asset('assets/frontend/js/main.js') !!}"></script>

<script>
    $(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @if (Session::has('open_modal'))
            // Display an error toast, with a title
            @if(Session::get('open_modal') == 'login')
                $("#signInModal").modal('show');
            @endif
        @endif
        @if (Session::has('failed'))
            // Display an error toast, with a title
            toastr.error("{!! Session::get('failed') !!}", 'Failed!');
        @endif
        @if (Session::has('success'))
            // Display an error toast, with a title
            toastr.success("{!! Session::get('success') !!}", 'Success!');
        @endif
        @if (Session::has('warning'))
            // Display an error toast, with a title
            toastr.warning("{!! Session::get('warning') !!}", 'Warning!');
        @endif
        getTopCartContent();
    });
    function getTopCartContent() {
        var csrf_token = "{!! csrf_token() !!}";
        var post_url = "{!! route('frontend.cart.get-top-cart-content') !!}";

        $.ajax({
            type: "POST",
            url: post_url,
            data: {_token: csrf_token},
            beforeSend: function() {
                $("#loading").show();
            },
            success: function( data ) {
                $("#top-cart-content-qty").html(data.totalQty);
                $("#top-cart-content-wrapper").html(data.view);
            },
            complete: function () {
                $("#loading").hide();
            }
        });
    }
    function removeTopCartContent(row_id) {
        var csrf_token = "{!! csrf_token() !!}";
        var post_url = "{!! route('frontend.cart.remove-top-cart-content') !!}";

        $.ajax({
            type: "POST",
            url: post_url,
            data: {_token: csrf_token, row_id: row_id},
            beforeSend: function() {
                $("#loading").show();
            },
            success: function( data ) {
                getTopCartContent();
            },
            complete: function () {
                $("#loading").hide();
            }
        });
    }
</script>
@yield('page_level_js_files')