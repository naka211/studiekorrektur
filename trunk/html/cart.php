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
                    <li class="active"><a href="cart.php">Indkøbskurv</a></li>
                    <li><a href="upload.php">Upload</a></li>
                    <li><a href="payment.php">Betaling</a></li>
                    <li><a href="receipt.php">Kvittering</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-8 pr40 bor-r">
                    <div class="row">
                        <h3 class="pull-left h3-">Gennemse venligst din ordre</h3>
                        <a class="btnEdit pull-right" href="bestilling.php"><i class="fa fa-angle-left"></i> Rediger bestilling</a>
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produkt</th>
                                    <th class="text-center">Antal normalsider</th>
                                    <th class="text-center">Stk. Pris</th>
                                    <th class="text-right">Pris</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Premiumkorrektur</td>
                                    <td class="text-center">12</td>
                                    <td class="text-center">29,95 DKK</td>
                                    <td class="text-right">359,40 DKK</td>
                                </tr>
                                <tr class="bor-b">
                                    <td colspan="4">Ekspreslevering (+50%)</td>
                                </tr>
                                <tr class="bor-b">
                                    <td>Engelsk abstract</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right">99 DKK</td>
                                </tr>
                                <tr class="bor-b">
                                    <td colspan="1"><strong>Evt. voucher</strong></td>
                                    <td colspan="3">
                                        <input class="full-left" type="text" class="form-control">
                                        <button class="btnRefresh pull-right">Opdater</button>
                                    </td>

                                </tr>
                                <tr class="bor-b">
                                    <td colspan="2"><strong>Pris i alt (inkl. moms):</strong></td>
                                    <td colspan="2" class="text-right"><strong>359,40 DKK</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="col-md-4 pl50">
                    <div class="row">
                        <h3 class="h3">Kontaktinformationer</h3>
                    </div>
                    <div class="row">
                        <form action="" class="form-group">
                            <input type="text" class="form-control input" placeholder="Fornavn *">
                        </form>
                    </div>
                    <div class="row">
                        <form action="" class="form-group">
                            <input type="text" class="form-control input" placeholder="Efternavn *">
                        </form>
                    </div>
                    <div class="row">
                        <form action="" class="form-group">
                            <input type="text" class="form-control input" placeholder="Adresse *">
                        </form>
                    </div>
                    <div class="row">
                        <form action="" class="form-group">
                            <input type="text" class="form-control input" placeholder="Postnr. *">
                        </form>
                    </div>
                    <div class="row">
                        <form action="" class="form-group">
                            <input type="text" class="form-control input" placeholder="By *">
                        </form>
                    </div>
                    <div class="row">
                        <form action="" class="form-group">
                            <input type="text" class="form-control input" placeholder="Email *">
                        </form>
                    </div>
                    <div class="row">
                        <form action="" class="form-group">
                            <input type="text" class="form-control input" placeholder="Telefonnummer *">
                        </form>
                    </div>
                    <div class="row">
                        <input type="checkbox" class="cb"> Accepter <a class="link" target="_blank" href="condition.php">handelsbetingelserne</a> <span class="red">*</span>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <hr class="black">
                <a class="btn btnPayment" href="upload.php">Gå til upload af opgaven</a>
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
