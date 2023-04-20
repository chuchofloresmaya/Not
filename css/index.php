
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
                            <h2>Hola <?php echo $rowusu['u_nombre']; ?></h2>
                            <h1>Bienvenidos a esta pagina</h1>
                            <p>Gracias por ser parte de este equipo de capturación<br> a continuación podras ver la lista top de los capturadores</p>
                            <a href="#listatop" class="btn_hover btn_hover_two">Ver Lista TOP</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================banner Area =================-->
        
        <!--================Barra inicial =================-->
            <a name="listatop" id="listatop"></a>                 
                    <div class="section-top-border">
                        <div class="progress-table-wrap">
                            <div class="progress-table">
                                <div class="table-head">
                                    <div class="serial"><h3 class="mb-30 title_color">TOP</h3></div>
                                </div>
                                <div class="table-head">
                                    <div class="serial">#</div>
                                    <div class="country">Nombre</div>
                                    <div class="visit">Capturadas</div>
                                    <div class="percentage">Porcentaje</div>
                                </div>
                    <?php
                    $querycfam = "SELECT count(*) As Familias, u_nombre FROM familia
                    inner join usuario on familia.idusuario2 = usuario.idusuario group by idusuario2 order by Familias desc;";
                    $resultcfam = mysqli_query($con, $querycfam);
                    ?>

                            <?php
                            $top=1;
                            $cn=1;
                            while ($rowcfam = $resultcfam->fetch_array(MYSQLI_BOTH)){ 
                            if ($top==1) $porfm=$rowcfam['Familias'];
                            ?>
                        <div class="table-row">
                                    <div class="serial"><?php echo $cn;?></div>
                                    <div class="country"><?php if($top<=3){echo'<img src="image/elements/top'.$top.'.jpg" alt="flag">';}?><?php echo $rowcfam['u_nombre'] ?></div>
                                    <div class="visit"><?php echo $rowcfam['Familias'] ?></div>
                                    <?php $por=($rowcfam['Familias']*100)/$porfm;                                    
                                    ?>
                                    <div class="percentage">
                                        <div class="progress">
                                            <div class="progress-bar color-1" role="progressbar" style="width: <?php echo $por ?>%" aria-valuenow="<?php echo $por ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                        </div>
                            <?php
                            $cn++;
                            $top++;
                            }
                            ?>
                        </div>
                    </div>
        
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