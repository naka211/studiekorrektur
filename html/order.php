<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('head.php'); ?>
</head>

<body id="page-top" class="index">
    <section>
        <div class="container text-center">
            <a href="index.php"><img src="img/logo.png" alt=""></a>
        </div>
    </section>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pad0">
                    <div class="pull-right text-right box-right">
                        <p>Velkommen Kim Hau - <a class="btnLogout" href="login.php">Logout</a></p>
                        <p><a class="active" href="order.php">Igangværende</a> - <a href="finished.php">Færdig</a></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 275</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn: <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn:   <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 276</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn:  <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn:   <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 277</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn:  <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn:   <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 278</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn:  <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn:   <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 279</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn:  <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn:   <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 280</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn:  <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn:   <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 281</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse7" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn:  <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn: <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 282</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse8" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn: <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn: <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 283</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse9" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn:  <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn:   <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>Dit ordrenr. er 284</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Sprog: Dansk</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Leveringstidspunkt: Fre. d. 27. feb. 2015 kl. 14:00</p>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <p><i class="fa fa-angle-right fa-lg"></i></p>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse10" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Dansk: File navn:  <a class="btnDownload" href="#">Download</a></p>
                                        <p>English file: File navn:   <a class="btnDownload" href="#">Download</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input class="mb10" type="file">
                                        <p>File navn: <span>Premiumkorrektur</span></p>
                                        <input  class="mb10" type="file">
                                        <a class="btn btnUpload" href="#">Upload</a>
                                        <a class="btn btn-default disabled" href="#">Send færdig opgave til kunden</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</body>
 <?php require_once('js.php'); ?>
</html>
