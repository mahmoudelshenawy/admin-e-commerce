   <!-- START: Footer-->
   <footer class="site-footer">© 2020 Pollo.</footer>
   <!-- END: Footer-->

   <!-- START: Back to top-->
   <a href="#" class="scrollup text-center"> 
       <i class="icon-arrow-up"></i>
   </a>
 
  <!-- START: Template JS-->
  <script src="{{ asset('dist/vendors/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('dist/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('dist/vendors/moment/moment.js') }}"></script>
  
  <script src="{{ asset('dist/vendors/slimscroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('dist/vendors/flag-select/js/jquery.flagstrap.min.js') }}"></script> 
  <!-- END: Template JS-->

<script src="{{ asset('dist/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>    

<!-- END: APP JS-->

<!-- START: Page Vendor JS-->
<script src="{{ asset('dist/vendors/datatable/js/jquery.dataTables.min.js') }}"></script> 

<script src="{{ asset('dist/vendors/datatable/js/dataTables.bootstrap4.min.js') }}"></script>



<script src="{{ asset('dist/vendors/datatable/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('dist/vendors/datatable/pdfmake/pdfmake.js') }}"></script>
<script src="{{ asset('dist/vendors/datatable/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('dist/vendors/datatable/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dist/vendors/datatable/buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('dist/vendors/datatable/buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('dist/vendors/datatable/buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dist/vendors/datatable/buttons/js/buttons.print.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- START: Page Script JS-->        
<script src="{{ asset('dist/js/datatable.script.js') }}"></script>
<script src="{{ asset('dist\src\jstree.js') }}"></script>
<script src="{{ asset('dist\src\jstree.checkbox.js') }}"></script>
<script src="{{ asset('dist\src\jstree.wholerow.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- END: Page Script JS-->
<script src="{{ asset('dist/js/app.js') }}"></script>

{{-- @endif --}}
 <script>
   $(document).ready(function(){
    toastr.options = {
        "debug": false,
        "newestOnTop": false,
        "positionClass": "toast-top-right",
        "closeButton": true,
        "progressBar": true
    };
   })
 </script>
  {{-- <script src="{{ asset('js/ajaxRequest.js') }}"></script> --}}
   <!-- START: APP JS-->
   {{-- <script src="{{ asset('dist/vendors/dropzone/dropzone.js') }}"></script> --}}