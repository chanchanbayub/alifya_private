<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="/assets/img/logo.png" rel="shortcut icon" type="image/png">
    <link href="/assets/img/logo.png" rel="apple-touch-icon" type="image/png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

    <!-- Flaticon Font -->
    <link href="/users/lib/flaticon/font/flaticon.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="/users/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="/users/lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/users/css/style.css" rel="stylesheet" />
</head>

<body>

    <?= $this->include('layout/navbar_users'); ?>
    <?= $this->renderSection('content'); ?>


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-6 col-md-6 mb-5">
                <a href="/" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0" style="font-size: 40px; line-height: 40px">
                    <!-- <i class="flaticon-043-teddy-bear"></i> -->
                    <span class="text-white">Alifya Private</span>
                </a>
                <p class="text-justify">
                    Alifya Private merupakan lembaga pendidikan nonformal yang dibangun untuk membantu dan bersinergi bersama orang tua dalam memfasilitasi kebutuhan pendampingan belajar anak dengan metode learning by playing.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-white mb-4">Social Media Kami</h3>
                <div class="d-flex">
                    <h4 class="fab fa-instagram text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Instagram</h5>
                        <p> Kunjungi Instagram <a href="https://www.instagram.com/alifyaprivate" target="_blank">Klik disini</a>
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-envelope text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Email</h5>
                        <p>Hubungi Kami <a href="mailto:privatealifya@gmail.com">Klik Disini</a></p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-phone-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Whatsapp</h5>
                        <p>Hubungi Kami <a target="_blank" href="https://wa.me/+6282116719291"> Klik Disini</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-white mb-4">Newsletter</h3>
                <form action="">
                    <div class="form-group">
                        <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" disabled />
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control border-0 py-4" placeholder="Your Email" required="required" disabled />
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block border-0 py-3" type="submit">
                            Comming Soon
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid pt-5" style="border-top: 1px solid rgba(23, 162, 184, 0.2) ;">
            <p class="m-0 text-center text-white">
                &copy;
                <a class="text-white font-weight-bold" href="/">Alifya Private</a>.
                All Rights Reserved.

                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                Designed by
                <a class="text-white font-weight-bold" href="/">Alifya Private</a>
            </p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/users/lib/easing/easing.min.js"></script>
    <script src="/users/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/users/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="/users/lib/lightbox/js/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/users/mail/jqBootstrapValidation.min.js"></script>
    <script src="/users/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/users/js/main.js"></script>
</body>

</html>