<?php
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
		formatMoney = function(num){
			var p = num.toFixed(2).split(".");
			return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
				return  num + (i && !(i % 3) ? "." : "") + acc;
			}, "") + "," + p[1];
		}
	
		setProduct = function(e, id){
			if(parseInt(id) == 1 && e.hasClass('btnUnChoose')){
				jQuery("#premium_en").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#standard_en").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
				
				jQuery("#premium_da").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#standard_da").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
				
				if(jQuery("#express").val() == 1){
					jQuery("#virtuemart_product_id").val("3");
					jQuery("#price").val("37.425");
				} else {
					jQuery("#virtuemart_product_id").val("1");
					jQuery("#price").val("24.95");
				}
				calPrice();
			}
			
			if(parseInt(id) == 2 && e.hasClass('btnUnChoose')){
				jQuery("#standard_en").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#premium_en").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
				
				jQuery("#standard_da").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#premium_da").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
				
				if(jQuery("#express").val() == 1){
					jQuery("#virtuemart_product_id").val("4");
					jQuery("#price").val("44.925");
				} else {
					jQuery("#virtuemart_product_id").val("2");
					jQuery("#price").val("29.95");
				}
				
				calPrice();
			}
		};
		
		setCheckExpress = function(e){
			var product_id = jQuery("#virtuemart_product_id").val();
			if(e.hasClass('btnUnCheck')){
				jQuery('#express_en').removeClass('btnUnCheck').addClass('btnCheck').text('Tilvalgt');
				jQuery('#express_da').removeClass('btnUnCheck').addClass('btnCheck').text('Tilvalgt');
				jQuery("#express").val("1");
				
				if(product_id == 1){
					jQuery("#virtuemart_product_id").val("3");
					jQuery("#price").val("37.425");
					calPrice();
				} else {
					jQuery("#virtuemart_product_id").val("4");
					jQuery("#price").val("44.925");
					calPrice();
				}
			} else {
				jQuery('#express_en').removeClass('btnCheck').addClass('btnUnCheck').text('Tilvælg');
				jQuery('#express_da').removeClass('btnCheck').addClass('btnUnCheck').text('Tilvælg');
				jQuery("#express").val("0");
				
				if(product_id == 3){
					jQuery("#virtuemart_product_id").val("1");
					jQuery("#price").val("24.95");
					calPrice();
				} else {
					jQuery("#virtuemart_product_id").val("2");
					jQuery("#price").val("29.95");
					calPrice();
				}
			}
		}
		
		setCheckAbstract = function(e, id){
			if(e.hasClass('btnUnCheck')){
				jQuery('#'+id).removeClass('btnUnCheck').addClass('btnCheck').text('Valgt');
				jQuery("#abstract_flag").val("1");
				
				jQuery("#totalPrice").val(parseFloat(jQuery("#totalPrice").val()) + 99);
				setTotalPriceTxt();
			} else {
				jQuery('#'+id).removeClass('btnCheck').addClass('btnUnCheck').text('Vælg');
				jQuery("#abstract_flag").val("0");
				
				jQuery("#totalPrice").val(parseFloat(jQuery("#totalPrice").val()) - 99);
				setTotalPriceTxt();
			}
		}
		
		calPrice = function(){
			var words = jQuery("#words").val();
			var pages = Math.ceil(parseFloat(words)/2400);
			var price = jQuery("#price").val();
			
			jQuery("#pages_txt").text(pages);
			jQuery("#quantity").val(pages);
			setTotalPrice(pages, price);
		}
		
		setTotalPrice = function(pages, price){
			if(jQuery("#abstract_flag").val() == 1){
				var totalPrice = parseInt(pages)*parseFloat(price) + 99;
				jQuery("#totalPrice").val(totalPrice);
			} else {
				var totalPrice = parseInt(pages)*parseFloat(price);
				jQuery("#totalPrice").val(totalPrice);
			}
			jQuery("#total_price_txt").text(formatMoney(parseFloat(jQuery("#totalPrice").val()))+" DKK");
		}
		
		setTotalPriceTxt = function(){
			var totalPrice = parseFloat(jQuery("#totalPrice").val());
			jQuery("#total_price_txt").text(formatMoney(totalPrice)+" DKK");
		}
		
		jQuery(".btnAddcart").click(function(){
			if(jQuery("#quantity").val() < 10){
				jQuery(".btnAddcart1").click();
			} else {
				alert("cho qua");
			}
		});
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
		<form action="index.php" class="form-group" method="post" id="orderForm">
		<div class="row mt20">
			<div class="col-md-2">
				<label for=""><strong>Vælg sprog:</strong></label>
				<div class="row">
					<div class="col-md-6 col-xs-3">
						<input type="radio" name="lang" checked value="en"> Dansk
					</div>
					<div class="col-md-6 col-xs-3 pad0">
						<input type="radio" name="lang" value="dk"> Engelsk
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<label for=""><strong>Indtast antal tegn inkl. mellemrum</strong></label>
				<input type="text" class="form-control input" id="words" onBlur="calPrice();" value="0">
			</div>
			<div class="col-md-2" style="text-align:center;">
				<label for=""><strong>Antal normalsider:</strong></label>
				<p id="pages_txt">0</p>
			</div>
			<div class="col-md-3">
				<label for=""><strong>Leveringstidspunkt:</strong></label>
				<p id="delivery_time_txt">Fre. d. 27. feb. 2015 kl. 14:00</p>
			</div>
			<div class="col-md-2">
				<label for=""><strong>Total pris:</strong></label>
				<p id="total_price_txt">0,00 DKK</p>
			</div>
			<input type="hidden" name="task" value="add"/>
			<input type="hidden" value="com_virtuemart" name="option">
			<input type="hidden" value="cart" name="view">
			<input type="hidden" value="" name="virtuemart_product_id[]" id="virtuemart_product_id">
			<input type="hidden" value="129" name="Itemid">
			
			<input type="hidden" id="price" value="29.95" />
			<input type="hidden" id="totalPrice" value="0" />
			<input type="hidden" value="0" name="quantity[]" id="quantity">
			<input type="hidden" id="express" value="0" />
			<input type="hidden" id="abstract_flag" value="0" />
		</div>
		<div class="row text-center">
			<hr class="black">
			<!--<a class="btn btnAddcart" href="#myModal" data-toggle="modal" data-target="#smallModal">Læg bestilling i indkøbskurven</a>-->
			<a class="btn btnAddcart">Læg bestilling i indkøbskurven</a>
			<a class="btnAddcart1" href="#myModal" data-toggle="modal" data-target="#smallModal"></a>
		</div>
		</form>
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