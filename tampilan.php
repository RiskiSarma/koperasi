<?php include 'header.php' ?>
<body id="body">
<!-- preloader -->
<!-- <div id="preloader">
    <img src="frontend/img/preloader.gif" alt="Preloader">
</div> -->
<!-- end preloader -->
<!-- Link CSS Bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Link CSS FontAwesome -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Link CSS WOW.js (untuk animasi) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<!-- Script jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Script Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Detail Produk</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Fixed Navigation -->
<header id="navigation" class="navbar-fixed-top navbar" style="min-height: 80px !important; background-color: #19af52 !important">
    <div class="container">
        <div class="navbar-header">
            <!-- responsive nav button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars fa-2x"></i>
            </button>
            <!-- /responsive nav button -->

            <!-- logo -->
            <a class="navbar-brand" href="#body">
                <h1 id="logo">
                    <img src="frontend/img/logoHW.png" class="img-circle" width="80" alt="Koperasi HW">
                </h1>
            </a>
            <!-- /logo -->
        </div> 
        <a href="http://localhost:81/koperasi/" target="_blank" class="btn btn-success" style="margin-top: 9px; float: right;">Login</a>
        <!-- main nav -->
        <nav class="collapse navbar-collapse navbar-right" role="navigation">
            <ul id="nav" class="nav navbar-nav">
                <li class="current"><a href="#body">Beranda</a></li>
                <li><a href="#works">Profil</a></li>
                <li><a href="#features">Layanan</a></li>                        
                <li><a href="#team">Pengurus</a></li>
                <li><a href="#gallery">Galeri</a></li> 
            </ul>
        </nav>
        <!-- /main nav -->
    </div>
</header>
<!-- End Fixed Navigation -->

<!-- Home Slider -->
<section id="slider">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">                        
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <!-- single slide -->
            <div class="item active" style="background-image: url('frontend/img/beranda.jpg');">
                <div class="carousel-caption">
                    <div class="wow bounceInDown animated" style="border-radius: 5px; background-color: #19af52">
                        <p class="wow bounceInDown animated" data-wow-duration="1000ms">Koperasi Syariah - HW</p>
                        <h2 class="wow bounceInDown animated" data-wow-duration="700ms" data-wow-delay="500ms">Kopsyah<span> Hikmah Wakilah</span></h2>
                    </div>
                    <ul class="social-links text-center">
                        <li><a href="mailto:info@bprshw.co.id"><i class="bi bi-envelope"></i> Email</a></li>
                        <li><a href="tel:(0651) 31055"><i class="fa fa-phone fa-lg"></i> Telepon</a></li>
                        <li><a href="#"><i class="fa fa-facebook fa-lg"></i> FB</a></li>
                        <li><a href="https://www.instagram.com/banksyariahhikmahwakilah/"><i class="fa fa-instagram fa-lg"></i> IG</a></li>
                    </ul>
                </div>
            </div>
            <!-- end single slide -->                 
        </div>
        <!-- End Wrapper for slides -->                
    </div>
</section>

<!-- End Home Slider -->

<!-- Our Works -->
<section id="works" class="works clearfix">
    <div class="container">
        <div class="row">                
            <div class="sec-title text-center">
                <h2>Profil</h2>
                <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
            </div>                                    
        </div>
    </div>

    <div class="project-wrapper">
        <div class="col-md-6">
            <div class="sec-title">
                <h3>Sejarah</h3><br>
                <p>Koperasi Syariah Hikmah Wakilah berdiri pada tahun 2020 dengan tujuan untuk membantu masyarakat dalam bidang keuangan sesuai prinsip syariah.</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="sec-title">
                <h3>Visi & Misi</h3><br>
                <p>Visi: Menjadi koperasi syariah terkemuka di Indonesia. Misi: Memberikan layanan keuangan yang adil dan transparan, serta mendukung pertumbuhan ekonomi umat.</p>
            </div>
        </div>                            
    </div>      
</section>
<!-- End Our Works -->

<!-- Features -->
<section id="features" class="features">
    <div class="container">
        <div class="row">                
            <div class="sec-title text-center mb50 wow bounceInDown animated" data-wow-duration="500ms">
                <h2>Jenis Produk</h2>
                <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
            </div>
            
            <!-- service item -->
            <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fa fa-github fa-2x"></i>
                    </div>
                    <div class="service-desc">
                        <h3>Tabungan</h3>
                        <p>Produk tabungan dengan berbagai keuntungan bagi anggota.</p>
                    </div>
                </div>
            </div>
            <!-- end service item -->
            
            <!-- service item -->
            <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fa fa-github fa-2x"></i>
                    </div>
                    <div class="service-desc">
                        <h3>Pembiayaan</h3>
                        <p>Produk pembiayaan untuk membantu anggota dalam berbagai kebutuhan finansial.</p>
                    </div>
                </div>
            </div>
            <!-- end service item -->
            
            <!-- service item -->
            <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="fa fa-github fa-2x"></i>
                    </div>
                    <div class="service-desc">
                        <h3>Investasi</h3>
                        <p>Produk investasi dengan keuntungan yang kompetitif.</p>
                    </div>
                </div>
            </div>
            <!-- end service item -->
        </div>
    </div>
</section>
<!-- End Features -->

<!-- Meet Our Team -->
<section id="team" class="team">
    <div class="container">
        <div class="row">
            <div class="sec-title text-center wow fadeInUp animated" data-wow-duration="700ms">
                <h2>Pengurus</h2>
                <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
            </div>                
            <div class="sec-sub-title text-center wow fadeInRight animated" data-wow-duration="500ms">
                <p>Berikut Pengurus Inti BMT Mitra NU</p>
            </div>

            <!-- single member -->
            <figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" style="margin-bottom: 30px">
                <div class="member-thumb">
                    <img src="admin/dashboard/pengurus/poto/pengurus1.jpg" alt="Team Member" class="img-responsive" style="border-radius: 6px; width: 272px; height: 303px;">                                
                </div>
                <h4>Ahmad Zaky</h4>
                <span>Ketua</span>
            </figure>
            <!-- end single member -->
            
            <!-- single member -->
            <figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="500ms" style="margin-bottom: 30px">
                <div class="member-thumb">
                    <img src="admin/dashboard/pengurus/poto/pengurus2.jpg" alt="Team Member" class="img-responsive" style="border-radius: 6px; width: 272px; height: 303px;">
                </div>
                <h4>Nina Zatulini</h4>
                <span>Sekretaris</span>
            </figure>
            <!-- end single member -->
            
            <!-- single member -->
            <figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="1000ms" style="margin-bottom: 30px">
                <div class="member-thumb">
                    <img src="admin/dashboard/pengurus/poto/pengurus3.jpg" alt="Team Member" class="img-responsive" style="border-radius: 6px; width: 272px; height: 303px;">
                </div>
                <h4>Ahmad Syafiq</h4>
                <span>Bendahara</span>
            </figure>
            <!-- end single member -->
            
            <!-- single member -->
            <figure class="team-member col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="1500ms" style="margin-bottom: 30px">
                <div class="member-thumb">
                    <img src="admin/dashboard/pengurus/poto/pengurus4.jpg" alt="Team Member" class="img-responsive" style="border-radius: 6px; width: 272px; height: 303px;">
                </div>
                <h4>Farhan Ali</h4>
                <span>Pengawas</span>
            </figure>
            <!-- end single member -->
        </div>
    </div>
</section>
<!-- End Meet Our Team -->

<!-- Gallery -->
<section id="gallery" class="gallery">
    <div class="container">
        <div class="row">
            <div class="sec-title text-center wow fadeInUp animated" data-wow-duration="700ms">
                <h2>Galeri</h2>
                <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
            </div>
            
            <div class="sec-sub-title text-center wow fadeInRight animated" data-wow-duration="500ms">
                <p>Dokumentasi kegiatan BMT Mitra NU</p>
            </div>
        </div>
    </div>
    
    <div class="project-wrapper">
        <figure class="mix work-item branding col-md-3 col-xs-12" style="margin-bottom: 30px">
            <img src="admin/dashboard/galeri/foto/kegiatan1.jpg" alt="">
            <figcaption class="overlay">
                <a class="fancybox" rel="works" title="Kegiatan 1" href="admin/dashboard/galeri/foto/kegiatan1.jpg"><i class="fa fa-eye fa-lg"></i></a>
                <h4>Kegiatan 1</h4>
                <p>Kegiatan penyuluhan anggota</p>
            </figcaption>
        </figure>
        
        <figure class="mix work-item web col-md-3 col-xs-12" style="margin-bottom: 30px">
            <img src="admin/dashboard/galeri/foto/kegiatan2.jpg" alt="">
            <figcaption class="overlay">
                <a class="fancybox" rel="works" title="Kegiatan 2" href="admin/dashboard/galeri/foto/kegiatan2.jpg"><i class="fa fa-eye fa-lg"></i></a>
                <h4>Kegiatan 2</h4>
                <p>Kegiatan pelatihan anggota</p>
            </figcaption>
        </figure>
        
        <figure class="mix work-item design col-md-3 col-xs-12" style="margin-bottom: 30px">
            <img src="admin/dashboard/galeri/foto/kegiatan3.jpg" alt="">
            <figcaption class="overlay">
                <a class="fancybox" rel="works" title="Kegiatan 3" href="admin/dashboard/galeri/foto/kegiatan3.jpg"><i class="fa fa-eye fa-lg"></i></a>
                <h4>Kegiatan 3</h4>
                <p>Kegiatan sosial anggota</p>
            </figcaption>
        </figure>
        
        <figure class="mix work-item photography col-md-3 col-xs-12" style="margin-bottom: 30px">
            <img src="admin/dashboard/galeri/foto/kegiatan4.jpg" alt="">
            <figcaption class="overlay">
                <a class="fancybox" rel="works" title="Kegiatan 4" href="admin/dashboard/galeri/foto/kegiatan4.jpg"><i class="fa fa-eye fa-lg"></i></a>
                <h4>Kegiatan 4</h4>
                <p>Kegiatan pertemuan anggota</p>
            </figcaption>
        </figure>
    </div>
</section>
<!-- End Gallery -->
<?php include 'footer.php'?>