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
                    <li><a href="upload.php">Upload</a></li>
                    <li><a href="payment.php">Betaling</a></li>
                    <li class="active"><a href="receipt.php">Kvittering</a></li>
                </ul>
            </div>
            <div class="row mb100">
                <div class="col-md-8 pr40">
                    <h3>Tak for din ordre </h3>
                    <p class="mb20">Kære Kim Hau,</p>
                    <p>Tak for din ordre!<br>
                    Vi har modtaget din bestilling og den uploadede fil.<br>
                    Dit ordrenr. er 275 - du modtager også denne ordrebekræftelse på mail.</p>
                    <p>Sprog: Dansk</p>
                    <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                    <table class="table mt20">
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
                            <tr class="bor-b0">
                                <td colspan="2"><strong>Rabat</strong></td>
                                <td colspan="2" class="text-right"><strong>- 15,20 DKK</strong></td>
                            </tr>
                            <tr class="bor-b">
                                <td colspan="2"><strong>Pris i alt (inkl. moms):</strong></td>
                                <td colspan="2" class="text-right"><strong>359,40 DKK</strong></td>
                            </tr>
                            <tr class="bor-b0">
                                <td colspan="4">
                                    <p>Du er velkommen til at kontakte os på info@studiekorrektur.dk eller +45 3029 6044, hvis du skulle have spørgsmål.<br>
                                    Du ønskes en god dag!</p><br>
                                    <p>De bedste hilsener,<br>
                                    Teamet bag Studiekorrektur.dk</p>
                                    <a class="btn btnHome" href="index.php">Til forside</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    
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
