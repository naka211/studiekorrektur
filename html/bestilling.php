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
                    <li class="active"><a href="bestilling.php">Bestilling</a></li>
                    <li><a href="cart.php">Indkøbskurv</a></li>
                    <li><a href="upload.php">Upload</a></li>
                    <li><a href="payment.php">Betaling</a></li>
                    <li><a href="receipt.php">Kvittering</a></li>
                </ul>
            </div>
            <div class="row en">
                <div class="col-md-4 padr0">
                    <div class="box">
                        <i class="fa fa-caret-down fa-3x down1"></i>
                        <h3>Standardkorrektur</h3>
                        <p>Korrektur på stavning og tegnsætning.</p>
                        <div class="w-price2">
                            <p class="text-uppercase price3">Pris: 24,95 DKK</p>
                            <p>Pr. normalside á 2.400 tegn inkl. mellemrum</p>
                        </div>
                        <a class="btn btnChoose" href="#">Vælg</a>
                    </div>
                </div>
                <div class="col-md-4 padr0">
                    <div class="box">
                        <i class="fa fa-caret-down fa-3x down1"></i>
                        <h3>Premiumkorrektur</h3>
                        <p>Korrektur på stavning og tegnsætning.<br>
                        Lette sproglige tilretninger.</p>
                        <div class="w-price2">
                            <p class="text-uppercase price3">Pris: 29,95 DKK</p>
                            <p>Pr. normalside á 2.400 tegn inkl. mellemrum</p>
                        </div>
                        <a class="btn btnChoose active" href="#">Valgt</a>
                    </div>
                </div>
                <div class="col-md-4 padr0">
                    <div class="box">
                        <i class="fa fa-caret-down fa-3x down1"></i>
                        <h3>Ekspreslevering <sup>(+50%)</sup></h3>
                        <p>Under 20 sider: Leveringstid 1 arbejdsdag<br>
                        Over 20 sider: Leveringstid 2 arbejdsdage</p>
                        <div class="w-price2">
                            <p class="text-uppercase price3">Pris: +50%</p>
                        </div>
                        <a class="btn btnChoose" href="#">Vælg</a>
                    </div>
                </div>
            </div>

            <div class="row dk">
                <div class="col-md-3 padr0">
                    <div class="box">
                        <i class="fa fa-caret-down fa-3x down2"></i>
                        <h3>Standardkorrektur</h3>
                        <p>Korrektur på stavning og tegnsætning.</p>
                        <div class="w-price">
                            <p class="text-uppercase price3">Pris: 24,95 DKK</p>
                            <p>Pr. normalside á 2.400 tegn inkl. mellemrum</p>
                        </div>
                        <a class="btn btnChoose2" href="#">Vælg</a>
                    </div>
                </div>
                <div class="col-md-3 padr0">
                    <div class="box">
                        <i class="fa fa-caret-down fa-3x down2"></i>
                        <h3>Premiumkorrektur</h3>
                        <p>Korrektur på stavning og tegnsætning.<br>
                        Lette sproglige tilretninger.</p>
                        <div class="w-price">
                            <p class="text-uppercase price3">Pris: 29,95 DKK</p>
                            <p>Pr. normalside á 2.400 tegn inkl. mellemrum</p>
                        </div>
                        <a class="btn btnChoose2 active" href="#">Vælg</a>
                    </div>
                </div>
                <div class="col-md-3 padr0">
                    <div class="box">
                        <i class="fa fa-caret-down fa-3x down2"></i>
                        <h3>Ekspreslevering <sup>(+50%)</sup></h3>
                        <p>Under 20 sider: Leveringstid 1 arbejdsdag<br>
                        Over 20 sider: Leveringstid 2 arbejdsdage</p>
                        <div class="w-price">
                            <p class="text-uppercase price3">Pris: +50%</p>
                        </div>
                        <a class="btn btnChoose2" href="#">Tilvælg</a>
                    </div>
                </div>
                <div class="col-md-3 padr0">
                    <div class="box">
                        <i class="fa fa-caret-down fa-3x down2"></i>
                        <h3>Engelsk abstract</h3>
                        <p>Vi sørger for også at læse korrektur på dit engelske abstract.</p>
                        <div class="w-price">
                            <p class="text-uppercase price3">Pris: 99 DKK</p>
                        </div>
                        <a class="btn btnChoose2" href="#">Tilvælg</a>
                    </div>
                </div>
            </div>

            <div class="row mt20">
                <div class="col-md-2">
                    <form action="" class="form-group">
                        <label for=""><strong>Vælg sprog:</strong></label>
                        <div class="row">
                            <div class="col-md-6 col-xs-3">
                                <input type="radio" name="lang" checked value="en"> Dansk
                            </div>
                            <div class="col-md-6 col-xs-3 pad0">
                                <input type="radio" name="lang" value="dk"> Engelsk
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form action="" class="form-group">
                        <label for=""><strong>Indtast antal tegn inkl. mellemrum</strong></label>
                        <input type="text" class="form-control input">
                    </form>
                </div>
                <div class="col-md-2">
                    <form action="" class="form-group">
                        <label for=""><strong>Antal normalsider:</strong></label>
                        <p>0</p>
                    </form>
                </div>
                <div class="col-md-3">
                    <form action="" class="form-group">
                        <label for=""><strong>Leveringstidspunkt:</strong></label>
                        <p>Fre. d. 27. feb. 2015 kl. 14:00</p>
                    </form>
                </div>
                <div class="col-md-2">
                    <form action="" class="form-group">
                        <label for=""><strong>Total pris:</strong></label>
                        <p>24.351,20 DKK</p>
                    </form>
                </div>
            </div>
            <div class="row text-center">
                <hr class="black">
                <a class="btn btnAddcart" href="#myModal" data-toggle="modal" data-target="#smallModal">Læg bestilling i indkøbskurven</a>
            </div>

            <!-- Modal HTML -->
            <div id="smallModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <p>Du skal min. bestille 10 sider.</p>
                            <a class="btnClose" href="#" data-dismiss="modal"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                </div>
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
