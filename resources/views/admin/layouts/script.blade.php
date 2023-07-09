<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
})
</script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('plugins/popper/popper.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script>
$.widget.bridge('uibutton', $.ui.button)
</script>

<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('dist/js/demo.js') }}"></script> -->
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>

<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>

<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>

<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- custom input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
$(function() {
    bsCustomFileInput.init();
});
</script>