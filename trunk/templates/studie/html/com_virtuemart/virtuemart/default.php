<?php
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
		setProduct = function(e, id){
			if(parseInt(id) == 1 && e.hasClass('btnUnChoose')){
				jQuery("#premium_en").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#standard_en").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
				
				jQuery("#premium_da").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#standard_da").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
			}
			
			if(parseInt(id) == 2 && e.hasClass('btnUnChoose')){
				jQuery("#standard_en").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#premium_en").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
				
				jQuery("#standard_da").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#premium_da").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
			}
		};
		
		setCheckExpress = function(e){
			if(e.hasClass('btnUnCheck')){
				jQuery('#express_en').removeClass('btnUnCheck').addClass('btnCheck').text('Tilvalgt');
				jQuery('#express_da').removeClass('btnUnCheck').addClass('btnCheck').text('Tilvalgt');
			} else {
				jQuery('#express_en').removeClass('btnCheck').addClass('btnUnCheck').text('Tilvælg');
				jQuery('#express_da').removeClass('btnCheck').addClass('btnUnCheck').text('Tilvælg');
			}
		}
		
		setCheckAbstract = function(e, id){
			if(e.hasClass('btnUnCheck')){
				jQuery('#'+id).removeClass('btnUnCheck').addClass('btnCheck').text('Valgt');
			} else {
				jQuery('#'+id).removeClass('btnCheck').addClass('btnUnCheck').text('Vælg');
			}
		}
		/*jQuery('.btnChoose').click(function(){
            var $this = jQuery(this);
            $this.toggleClass('Valgt');
            if($this.hasClass('Valgt')){
                $this.text('Vælg');
                $this.addClass('b2ecc71');
            } else {
                $this.text('Valgt');
                $this.addClass('bfff');
            }
        });*/
	});
</script>
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
					<a class="btn btnUnChoose" onClick="setProduct(this, 1)" id="standard_en">Vælg</a>
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
					<a class="btn btnChoose" onClick="setProduct(this, 2)" id="premium_en">Valgt</a>
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
					<a class="btn btnUnCheck" onClick="setCheckExpress(this)" id="express_en">Tilvælg</a>
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
					<a class="btn btnChoose2 btnUnChoose" onClick="setProduct(this, 1)" id="standard_da">Vælg</a>
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
					<a class="btn btnChoose2 btnChoose" onClick="setProduct(this, 2)" id="premium_da">Valgt</a>
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
					<a class="btn btnChoose2 btnUnCheck" onClick="setCheckExpress(this)" id="express_da">Tilvælg</a>
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
					<a class="btn btnChoose2 btnUnCheck" onClick="setCheckAbstract(this, 'abstract')" id="abstract">Vælg</a>
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