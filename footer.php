<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated" data-wow-duration="500ms">
                <div class="footer-single">
                    <h6>Koperasi Syariah HW</h6>
                    <p>Deskripsi singkat koperasi yang ditulis langsung di sini. Misalnya, "Koperasi Syariah HW adalah lembaga keuangan yang menyediakan berbagai layanan keuangan syariah untuk anggota kami."</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                <div class="footer-single">
                    <h6>Alamat</h6>
                    <div class="contact-address">
                        <p>Alamat lengkap koperasi yang ditulis langsung di sini, misalnya "Jalan Contoh No.123, Jakarta."</p>
                        <p>No WA: +62 812 3456 7890</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="600ms">
                <div class="footer-single">
                    <h6>Sosial Media</h6>
                    <ul>
                        <li><a href="https://facebook.com/koperasisyariahHW" target="_blank"> <i class="fa fa-facebook fa-2x"></i> Facebook HW</a></li>
                        <li><a href="https://instagram.com/koperasisyariahHW" target="_blank"><i class="fa fa-instagram fa-2x"></i> Instagram HW</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="copyright text-center">
                    Copyright © <?php echo date('Y') ?> <a href="http://themefisher.com/">Themefisher</a>. All rights reserved. Designed & developed by <a href="http://themefisher.com/">Themefisher</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<a href="javascript:void(0);" id="back-top"><i class="fa fa-angle-up fa-3x"></i></a>

<!-- Essential jQuery Plugins -->
<!-- Main jQuery -->
<script src="frontend/js/jquery-1.11.1.min.js"></script>
<!-- Single Page Nav -->
<script src="frontend/js/jquery.singlePageNav.min.js"></script>
<!-- Twitter Bootstrap -->
<script src="frontend/js/bootstrap.min.js"></script>
<!-- Datatables -->
<script src="frontend/js/datatables.min.js"></script>
<!-- jquery.fancybox.pack -->
<script src="frontend/js/jquery.fancybox.pack.js"></script>
<!-- jquery.mixitup.min -->
<script src="frontend/js/jquery.mixitup.min.js"></script>
<!-- jquery.parallax -->
<script src="frontend/js/jquery.parallax-1.1.3.js"></script>
<!-- jquery.countTo -->
<script src="frontend/js/jquery-countTo.js"></script>
<!-- jquery.appear -->
<script src="frontend/js/jquery.appear.js"></script>
<!-- Contact form validation -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
<!-- Google Map -->
<script type="frontend/text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!-- jquery easing -->
<script src="frontend/js/jquery.easing.min.js"></script>
<!-- jquery easing -->
<script src="frontend/js/wow.min.js"></script>
<script>
    var wow = new WOW ({
        boxClass: 'wow',      // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 120,          // distance to the element when triggering the animation (default is 0)
        mobile: false,       // trigger animations on mobile devices (default is true)
        live: true        // act on asynchronously loaded content (default is true)
    });
    wow.init();
</script>

<script>
    $(function(){
        $(document).on('click','.edit-record',function(e){
            e.preventDefault();
            $("#myModal").modal('show');
            $.post('detail_produk.php',
                {id:$(this).attr('data-id')},
                function(html){
                    $(".modal-body").html(html);
                }
            );
        });
    });
</script>

<!-- Custom Functions -->
<script src="frontend/js/custom.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        //datatables
        $('#Datatables').DataTable({
            columnDefs: [
                {
                    "searchable": false,
                    "orderable": false,
                    "scrollX": true,
                    "targets": [0,3]
                }
            ],
            "order": [],
            "lengthMenu": [[10, 25, 50, 100, 250, 500, 1000, -1], [10, 25, 50, 100, 250, 500, 1000, "All"]],
            "pageLength": 10,
            "language": {
                "zeroRecords": "Data Tidak Ada",
            },
        });

    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
        //datatables
        $('#Datatables2').DataTable({
            columnDefs: [
                {
                    "searchable": false,
                    "orderable": false,
                    "scrollX": true,
                    "targets": [0,3]
                }
            ],
            "order": [],
            "lengthMenu": [[10, 25, 50, 100, 250, 500, 1000, -1], [10, 25, 50, 100, 250, 500, 1000, "All"]],
            "pageLength": 10,
            "language": {
                "zeroRecords": "Data Tidak Ada",
            },
        });

    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
        //datatables
        $('#Datatables3').DataTable({
            columnDefs: [
                {
                    "searchable": false,
                    "orderable": false,
                    "scrollX": true,
                    "targets": [0,3]
                }
            ],
            "order": [],
            "lengthMenu": [[10, 25, 50, 100, 250, 500, 1000, -1], [10, 25, 50, 100, 250, 500, 1000, "All"]],
            "pageLength": 10,
            "language": {
                "zeroRecords": "Data Tidak Ada",
            },
        });

    });

</script>

<script type="text/javascript">
    $(function(){
        /* ========================================================================= */
        /* Contact Form */
        /* ========================================================================= */

        $('#contact-form').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "come on, you have a name don't you?",
                    minlength: "your name must consist of at least 2 characters"
                },
                email: {
                    required: "no email, no message"
                },
                message: {
                    required: "um...yea, you have to write something to send this form.",
                    minlength: "thats all? really?"
                }
            },
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    type:"POST",
                    data: $(form).serialize(),
                    url:"process.php",
                    success: function() {
                        $('#contact-form :input').attr('disabled', 'disabled');
                        $('#contact-form').fadeTo("slow", 0.15, function() {
                            $(this).find(':input').attr('disabled', 'disabled');
                            $(this).find('label').css('cursor','default');
                            $('#success').fadeIn();
                        });
                    },
                    error: function() {
                        $('#contact-form').fadeTo("slow", 0.15, function() {
                            $('#error').fadeIn();
                        });
                    }
                });
            }
        });
    });
</script>
</body>
</html>
