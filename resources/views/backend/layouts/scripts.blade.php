<!-- Bootstrap core JavaScript-->
<script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script>

<!-- Custom scripts -->
<script>
    // Enable tooltips everywhere
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    // Auto-hide alerts after 5 seconds
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);

    // Initialize any datepickers
    if($.fn.datepicker) {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
    }

    // Initialize select2 if available
    if($.fn.select2) {
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    }

    // Initialize DataTables if available
    if($.fn.DataTable) {
        $('.datatable').DataTable({
            "pageLength": 25,
            "responsive": true,
            "autoWidth": false,
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search...",
            },
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
        });
    }
</script>

<!-- Page specific scripts -->
@stack('scripts')
