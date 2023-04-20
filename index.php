
<?php
session_start();
//header('location: mantenimiento.php');
include ("nav.php");
?>
        
        <!--================banner Area =================-->
        <section class="banner_area d-flex text-center">
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner_content">
                            <h2>Hola <?php echo $rowusu['nickname']; ?></h2>
                            <h1>Bienvenido a SmartNOT</h1>
                            <p>La más noble función de un escritor es dar testimonio  <br> como acta notarial y como fiel cronista, <br> de lo que le ha tocado vivir
                                <br>-Camilo José Cela</p>
                            <a href="#listatop" class="btn_hover btn_hover_two">Ver Lista TOP</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================banner Area =================-->
        
        <!--================Barra inicial =================-->

        
        <!--================About Area =================-->
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="js/stellar.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="vendors/flipclock/timer.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>