<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('head.php'); ?>
</head>

<body id="page-top" class="index">

    <?php require_once('nav2.php'); ?>

    <section class="main-content">
        <div class="container">
            <div class="row">
                <ul class="breadcrumb text-center">
                    <li><a href="bestilling.php">Bestilling</a></li>
                    <li><a href="cart.php">Indkøbskurv</a></li>
                    <li class="active"><a href="upload.php">Upload</a></li>
                    <li><a href="payment.php">Betaling</a></li>
                    <li><a href="receipt.php">Kvittering</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-6 pr40">
                    <div class="row">
                        <form action="" class="form-group">
                            <label><strong>Kommentar</strong></label>
                            <textarea class="form-control h195"></textarea>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 pl50">
                    <div class="row">
                        <form action="" class="form-group">
                            <label for=""><strong>Upload din opgave her</strong></label>
                            <div class="relative">
                                <input class="form-control custom-file-input" type="file" placeholder="Der er ikke valgt nogen fil">
                                <input class="input2" type="text" placeholder="Der er ikke valgt nogen fil">
                            </div>
                           
                        </form>
                    </div>
                    <div class="row">
                        <form action="" class="form-group">
                            <label for=""><strong>Upload dit abstract her</strong></label>
                            <div class="relative">
                                <input class="form-control custom-file-input" type="file" placeholder="Der er ikke valgt nogen fil">
                                <input class="input2" type="text" placeholder="Der er ikke valgt nogen fil">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row text-center mb300">
                <hr class="black">
                <a class="btn btnPayment" href="receipt.php">Gå til betaling</a>
            </div>
        </div>
    </section>

    <?php require_once('footer.php'); ?>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

</body>
 <?php require_once('js.php'); ?>
</html>
