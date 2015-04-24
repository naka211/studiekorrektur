<?php
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
		<?php if(JRequest::getVar("p") == "standard"){?>
			jQuery("#virtuemart_product_id").val(1);
			jQuery("#price").val(24.95);
			
			jQuery("#premium_en").addClass('btnUnChoose').text('Vælg');
			jQuery("#standard_en").addClass('btnChoose').text('Valgt');
			
			jQuery("#premium_da").addClass('btnUnChoose').text('Vælg');
			jQuery("#standard_da").addClass('btnChoose').text('Valgt');
		<?php } else {?>
			jQuery("#virtuemart_product_id").val(2);
			jQuery("#price").val(29.95);
			
			jQuery("#standard_en").addClass('btnUnChoose').text('Vælg');
			jQuery("#premium_en").addClass('btnChoose').text('Valgt');
			
			jQuery("#standard_da").addClass('btnUnChoose').text('Vælg');
			jQuery("#premium_da").addClass('btnChoose').text('Valgt');
		<?php }?>
		 jQuery('input[type="radio"]').click(function(){
            if(jQuery(this).attr("value")=="Dansk"){
                jQuery(".en").hide();
                jQuery(".dk").show();
				jQuery("#enImg").show();
            }
            if(jQuery(this).attr("value")=="Engelsk"){
                jQuery(".dk").hide();
                jQuery(".en").show();
				jQuery("#enImg").hide();
				
				if(jQuery("#abstract").hasClass('btnCheck')){
					jQuery("#abstract").click();
				}
            }
        });
		
		formatMoney = function(num){
			var p = num.toFixed(2).split(".");
			return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
				return  num + (i && !(i % 3) ? "." : "") + acc;
			}, "") + "," + p[1];
		}
		
		getDeliveryTime = function(day){
			jQuery(".btnAddcart").addClass("disabled");
			jQuery.post( "<?php echo JURI::base();?>index.php?option=com_virtuemart&controller=virtuemart&task=getTime&day="+day, function(date) {
				jQuery( "#delivery_time_txt" ).text( date );
				jQuery("#delivery_date").val(date);
				jQuery(".btnAddcart").removeClass("disabled");
			});
		}
	
		setProduct = function(e, id){
			if(parseInt(id) == 1 && e.hasClass('btnUnChoose')){
				jQuery("#premium_en").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#standard_en").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
				
				jQuery("#premium_da").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#standard_da").removeClass('btnUnChoose').addClass('btnChoose').text('Valgt');
				
				jQuery('#abstract').removeClass('btnCheck').addClass('btnUnCheck').text('Vælg');
				jQuery("#words").prop( "disabled", false );
				
				if(jQuery("#express").val() == 1){
					/*if(jQuery("#quantity").val() < 20){
						getDeliveryTime(1);
					} else {
						getDeliveryTime(2);
					}*/
					jQuery("#virtuemart_product_id").val("3");
					jQuery("#price").val("37.425");
				} else {
					/*if(jQuery("#quantity").val() < 20){
						getDeliveryTime(2);
					} else {
						getDeliveryTime(3);
					}*/
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
				
				jQuery('#abstract').removeClass('btnCheck').addClass('btnUnCheck').text('Vælg');
				jQuery("#words").prop( "disabled", false );
				
				if(jQuery("#express").val() == 1){
					//if(jQuery("#quantity").val() < 20){
//						getDeliveryTime(1);
//					} else {
//						getDeliveryTime(2);
//					}
					jQuery("#virtuemart_product_id").val("4");
					jQuery("#price").val("44.925");
				} else {
					/*if(jQuery("#quantity").val() < 20){
						getDeliveryTime(2);
					} else {
						getDeliveryTime(3);
					}*/
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
				jQuery('#abstract').removeClass('btnCheck').addClass('btnUnCheck').text('Vælg');
				jQuery("#words").prop( "disabled", false );
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
				
				/*if(jQuery("#quantity").val() < 20){
					getDeliveryTime(1);
				} else {
					getDeliveryTime(2);
				}*/
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
				
				/*if(jQuery("#quantity").val() < 20){
					getDeliveryTime(2);
				} else {
					getDeliveryTime(3);
				}*/
			}
		}
		
		setCheckAbstract = function(e, id){
			if(e.hasClass('btnUnCheck')){
				jQuery('#'+id).removeClass('btnUnCheck').addClass('btnCheck').text('Fravælg');
				
				jQuery("#standard_en").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#premium_en").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery('#express_en').removeClass('btnCheck').addClass('btnUnCheck').text('Tilvælg');
				
				jQuery("#standard_da").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery("#premium_da").removeClass('btnChoose').addClass('btnUnChoose').text('Vælg');
				jQuery('#express_da').removeClass('btnCheck').addClass('btnUnCheck').text('Tilvælg');
				
				jQuery(".productDisabled").addClass("disabled");
				
				getDeliveryTime(2);
				
				jQuery("#words").val(0);
				jQuery("#pages_txt").text(0);
				jQuery("#words").prop( "disabled", true );
				
				jQuery("#virtuemart_product_id").val("5");
				jQuery("#quantity").val("1");
				
				jQuery("#totalPrice").val(99);
				setTotalPriceTxt();
			} else {
				jQuery('#'+id).removeClass('btnCheck').addClass('btnUnCheck').text('Vælg');
				jQuery("#words").prop( "disabled", false );
				jQuery(".productDisabled").removeClass("disabled");
				jQuery("#premium_en").click();
				
				jQuery("#abstract_flag").val("0");
				jQuery("#virtuemart_product_id").val("0");
				jQuery("#quantity").val("0");
				
				jQuery("#totalPrice").val(0);
				setTotalPriceTxt();
			}
		}
		
		calPrice = function(){
			var words = parseFloat(jQuery("#words").val());
			if(!words) words = 0;
			var pages = Math.ceil(parseFloat(words)/2400);
			var price = jQuery("#price").val();
			
			if(pages < 20 && jQuery("#virtuemart_product_id").val()<3){
				getDeliveryTime(2);
			}
			if(pages > 20 && jQuery("#virtuemart_product_id").val()<3){
				getDeliveryTime(3);
			}
			if(pages < 20 && jQuery("#virtuemart_product_id").val()>=3){
				getDeliveryTime(1);
			}
			if(pages > 20 && jQuery("#virtuemart_product_id").val()>=3){
				getDeliveryTime(2);
			}
			
			jQuery("#pages_txt").text(pages);
			jQuery("#quantity").val(pages);
			
			setTotalPrice(pages, price);
		}
		
		setTotalPrice = function(pages, price){
			var totalPrice = parseInt(pages)*parseFloat(price);
			jQuery("#totalPrice").val(totalPrice);
			
			jQuery("#total_price_txt").text(formatMoney(parseFloat(jQuery("#totalPrice").val()))+" DKK");
		}
		
		setTotalPriceTxt = function(){
			var totalPrice = parseFloat(jQuery("#totalPrice").val());
			jQuery("#total_price_txt").text(formatMoney(totalPrice)+" DKK");
		}
		
		jQuery(".btnAddcart").click(function(){
			if(jQuery("#quantity").val() < 10 && jQuery("#virtuemart_product_id").val() != 5){
				jQuery(".btnAddcart1").click();
			} else {
				jQuery("#orderForm").submit();
			}
		});
		
		jQuery(".btnBook").click(function(e) {
			
		});
	});
</script>
<section class="main-content">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb text-center">
				<li class="active"><a>Bestilling</a></li>
				<li>Indkøbskurv</li>
				<li>Upload</li>
				<li>Betaling</li>
				<li>Kvittering</li>
			</ul>
		</div>
		<div class="row dk">
			<div class="col-md-4 padr0">
				<div class="box">
					<i class="fa fa-caret-down fa-3x down1"></i>
					<h3>Standardkorrektur</h3>
					<p>Korrektur på stavning og tegnsætning.</p>
					<div class="w-price2">
						<p class="text-uppercase price3">Pris: 24,95 DKK</p>
						<p>Pr. normalside a 2.400 tegn inkl. mellemrum</p>
					</div>
					<a class="btn" onClick="setProduct(this, 1)" id="standard_da">Vælg</a>
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
						<p>Pr. normalside a 2.400 tegn inkl. mellemrum</p>
					</div>
					<a class="btn" onClick="setProduct(this, 2)" id="premium_da">Valgt</a>
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
					<a class="btn btnUnCheck" onClick="setCheckExpress(this)" id="express_da">Tilvælg</a>
				</div>
			</div>
		</div>

		<div class="row en">
			<div class="col-md-3 padr0">
				<div class="box productDisabled">
					<i class="fa fa-caret-down fa-3x down2"></i>
					<h3>Standardkorrektur</h3>
					<p>Korrektur på stavning og tegnsætning.</p>
					<div class="w-price">
						<p class="text-uppercase price3">Pris: 24,95 DKK</p>
						<p>Pr. normalside a 2.400 tegn inkl. mellemrum</p>
					</div>
					<a class="btn btnChoose2" onClick="setProduct(this, 1)" id="standard_en">Vælg</a>
				</div>
			</div>
			<div class="col-md-3 padr0">
				<div class="box productDisabled">
					<i class="fa fa-caret-down fa-3x down2"></i>
					<h3>Premiumkorrektur</h3>
					<p>Korrektur på stavning og tegnsætning.<br>
					Lette sproglige tilretninger.</p>
					<div class="w-price">
						<p class="text-uppercase price3">Pris: 29,95 DKK</p>
						<p>Pr. normalside a 2.400 tegn inkl. mellemrum</p>
					</div>
					<a class="btn btnChoose2" onClick="setProduct(this, 2)" id="premium_en">Valgt</a>
				</div>
			</div>
			<div class="col-md-3 padr0">
				<div class="box productDisabled">
					<i class="fa fa-caret-down fa-3x down2"></i>
					<h3>Ekspreslevering <sup>(+50%)</sup></h3>
					<p>Under 20 sider: Leveringstid 1 arbejdsdag<br>
					Over 20 sider: Leveringstid 2 arbejdsdage</p>
					<div class="w-price">
						<p class="text-uppercase price3">Pris: +50%</p>
					</div>
					<a class="btn btnChoose2 btnUnCheck" onClick="setCheckExpress(this)" id="express_en">Tilvælg</a>
				</div>
			</div>
			<div class="col-md-3 padr0">
				<div class="box">
					<i class="fa fa-caret-down fa-3x down2"></i>
					<h3>Engelsk abstract</h3>
					<p>Vi sørger for at læse korrektur på dit engelske abstract.</p>
					<p>Fast pris for op til 3 normalsiders abstract.</p>
					<p>Bestilles som separat ordre til dit danske speciale.</p>
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
						<input type="radio" name="lang" checked value="Dansk"> Dansk
					</div>
					<div class="col-md-6 col-xs-3 pad0">
						<input type="radio" name="lang" value="Engelsk"> Engelsk
					</div>
				</div>
				<div class="row" id="enImg">
					<div class="col-md-12">
						<div class="en-abs mt10">
							<img alt="" src="templates/studie/img/en-abstract.png">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<label for="" style="font-size:13px;"><strong>Indtast antal tegn inkl. mellemrum</strong></label>
				<input type="text" class="form-control input" id="words" onKeyUp="calPrice();" value="0">
				<button class="btn btnBook pull-right btn-default" type="button">Bestil nu</button>
				<img alt="" src="templates/studie/img/down2.png" class="iconDown">
			</div>
			<div class="col-md-2" style="text-align:center;">
				<label for=""><strong>Antal normalsider:</strong></label>
				<p id="pages_txt">0</p>
			</div>
			<div class="col-md-3">
				<label for=""><strong>Leveringstidspunkt:</strong></label>
				<p id="delivery_time_txt"></p>
			</div>
			<div class="col-md-2">
				<label for=""><strong>Total pris:</strong></label>
				<p id="total_price_txt">0,00 DKK</p>
			</div>
			<input type="hidden" name="task" value="add"/>
			<input type="hidden" value="com_virtuemart" name="option">
			<input type="hidden" value="cart" name="view">
			<input type="hidden" value="2" name="virtuemart_product_id[]" id="virtuemart_product_id">
			<input type="hidden" value="" name="" id="virtuemart_product_id1">
			<input type="hidden" value="129" name="Itemid">
			
			<input type="hidden" id="price" value="29.95" />
			<input type="hidden" id="totalPrice" value="0" />
			<input type="hidden" value="0" name="quantity[]" id="quantity">
			<input type="hidden" id="express" value="0" />
			<input type="hidden" id="delivery_date" value="" name="delivery_date" />
		</div>
		<div class="row text-center">
			<hr class="black">
			<!--<a class="btn btnAddcart" href="#myModal" data-toggle="modal" data-target="#smallModal">Læg bestilling i indkøbskurven</a>-->
			<a class="btn btnAddcart disabled">Læg bestilling i indkøbskurven</a>
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