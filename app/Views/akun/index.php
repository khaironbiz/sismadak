<main id="main">

  <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg ">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h3 class="text-dark mt-5"><?= $title ?></h3>
            </div>
            <div class="row">
                <?php
                $x=1;
                while($x<100):
                ?>
                <div class="col-xl-2 col-md-3 col-sm-4 col-6 mt-3">
                    <div class="card">

                        <div class="card-header">
                            <?= $x; ?>

                        </div>
                    </div>
                </div>
                <?php
                    $x++;
                endwhile;
                ?>
            </div>
        </div>
    </section><!-- End Doctors Section -->


</main><!-- End #main -->