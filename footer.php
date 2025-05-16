</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
     <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"><a href="https://www.bishaltech.com/" target="_blank">Bishal Tech </a> Design and development company.</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © <?php echo date('Y') ?>. All rights are reserved.</span>
     </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>



</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.32/sweetalert2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Payment Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!-- plugins:js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/js/off-canvas.js"></script>
<script src="vendors/js/template.js"></script>
<script src="vendors/js/settings.js"></script>
<!-- End custom js for this page-->
<script src="assets/js/jQuery.print.js"></script>
<!-- Custom js -->
<script src="assets/js/action.js"></script>
<!-- <script src="assets/js/Toaster.js"></script> -->
<script src="assets/js/payment.js"></script>


<!-- Genarete PDF -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

<script type="text/javascript">

     var doc = new jsPDF('p', 'mm', 'a4');

     var specialElementHandlers = {
          '#editor': function(element, renderer) {
               return true;
          }
     };

    //  $('#DownloadBtn').click(function() {
    //       var pdfWidth = doc.internal.pageSize.width;
    //       var pdfHeight = doc.internal.pageSize.height;

    //       var source = $('#printSec')[0]; // Assuming #printSec is the container for your content

    //       doc.fromHTML(source, 15, 15, {
    //           'width': pdfWidth,
    //           'elementHandlers': specialElementHandlers,
    //           'pagesplit': true
    //       }, function() {
    //           doc.save('Admission_Form.pdf');
    //       });
    //  });
</script>
</body>

</html>