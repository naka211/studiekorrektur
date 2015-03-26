<?php 
defined ('_JEXEC') or die('Restricted access');
JHTML::_('behavior.formvalidator');
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
		jQuery('input').on('change invalid', function() {
			var textfield = jQuery(this).get(0);
			textfield.setCustomValidity('');
			
			if (!textfield.validity.valid) {
			  textfield.setCustomValidity('Venligst udfyld dette felt');  
			}
		});
		
		jQuery('input#tos').on('change invalid', function() {
			var textfield = jQuery(this).get(0);
			textfield.setCustomValidity('');
			
			if (!textfield.validity.valid) {
			  textfield.setCustomValidity('Tjek venligst dette felt');  
			}
		});
	});
</script>
<section class="main-content">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb text-center">
				<li>Bestilling</li>
				<li class="active"><a>Indkøbskurv</a></li>
				<li>Upload</li>
				<li>Betaling</li>
				<li>Kvittering</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-8 pr40 bor-r">
				<div class="row">
					<h3 class="pull-left h3-">Gennemse venligst din ordre</h3>
					<a class="btnEdit pull-right" href="<?php echo JRoute::_( 'index.php?option=com_virtuemart&view=cart&task=deleteCart' ) ?>"><i class="fa fa-angle-left"></i> Rediger bestilling</a>
				</div>
				<div class="row">
					<table class="table">
						<thead>
							<tr>
								<th width="45%">Produkt</th>
								<th class="text-center" width="22%">Antal normalsider</th>
								<th class="text-center" width="15%">Stk. Pris</th>
								<th class="text-right" width="18%">Pris</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($this->cart->products as $pkey => $prow) {?>
							<tr class="bor-b">
								<td><?php echo $prow->product_name;?></td>
								<td class="text-center"><?php if($prow->virtuemart_product_id != 5) echo $prow->quantity;?></td>
								<td class="text-center"><?php if($prow->virtuemart_product_id != 5) echo number_format($prow->prices['salesPrice'],2,',','.').' DKK';?></td>
								<td class="text-right"><?php echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $prow->prices, FALSE, FALSE, $prow->quantity) ?></td>
							</tr>
							<?php }?>
							<tr class="bor-b">
								<td colspan="1"><strong>Evt. voucher</strong></td>
								<td colspan="3">
									<form method="post" id="userForm" name="enterCouponCode" action="<?php echo JRoute::_('index.php'); ?>">
										<input class="full-left" type="text" class="form-control" name="coupon_code">
										<button class="btnRefresh pull-right" type="submit" name="setcoupon">Opdater</button>
										<input type="hidden" name="option" value="com_virtuemart" />
										<input type="hidden" name="view" value="cart" />
										<input type="hidden" name="task" value="setcoupon" />
										<input type="hidden" name="controller" value="cart" />
									</form>
								</td>

							</tr>
							<?php if (!empty($this->cart->cartData['couponCode'])) { ?>
							<tr class="bor-b">
								<td colspan="2"><strong>Rabat:</strong></td>
								<td colspan="2" class="text-right"><?php echo number_format($this->cart->pricesUnformatted['salesPriceCoupon'],2,',','.').' DKK'; ?></td>
							</tr>
							<?php }?>
							<tr class="bor-b">
								<td colspan="2"><strong>Pris i alt (inkl. moms):</strong></td>
								<td colspan="2" class="text-right"><strong><?php echo $this->currencyDisplay->createPriceDiv ('billTotal', '', $this->cart->cartPrices, FALSE) ?></strong></td>
							</tr>
						</tbody>
					</table>
				</div>
				
			</div>
			<form method="post" id="checkoutForm" name="checkoutForm" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart' . $taskRoute, $this->useXHTML, $this->useSSL); ?>" class="form-validate">
				<div class="col-md-4 pl50">
					<div class="row">
						<h3 class="h3">Kontaktinformationer</h3>
					</div>
					<div class="row">
						<input type="text" class="form-control input required" placeholder="Fornavn *" name="first_name" id="first_name">
					</div>
					<div class="row">
						<input type="text" class="form-control input required" placeholder="Efternavn *" name="last_name">
					</div>
					<div class="row">
						<input type="text" class="form-control input required" placeholder="Adresse *" name="address_1">
					</div>
					<div class="row">
						<input type="text" class="form-control input required" placeholder="Postnr. *" name="zip" maxlength="4">
					</div>
					<div class="row">
						<input type="text" class="form-control input required" placeholder="By *" name="city">
					</div>
					<div class="row">
						<input type="text" class="form-control input required validate-email" placeholder="Email *" name="email">
					</div>
					<div class="row">
						<input type="text" class="form-control input required" placeholder="Telefonnummer *" name="phone_1">
					</div>
					<div class="row">
						<input type="checkbox" class="cb required" name="tos" id="tos"> Accepter <a class="link" target="_blank" href="index.php?option=com_content&view=article&id=3&Itemid=132">handelsbetingelserne</a> <span class="red">*</span>
					</div>
				</div>
			</div>
			<button type="submit" class="validate" id="submitBtn" style="display:none;">Submit form</button>
			<input type='hidden' name='task' value='saveData'/>
			<input type='hidden' name='option' value='com_virtuemart'/>
			<input type='hidden' name='view' value='cart'/>
		</form>
		<div class="row text-center">
			<hr class="black">
			<a class="btn btnPayment" onClick="jQuery('#submitBtn').click();">Gå til upload af opgaven</a>
		</div>

	</div>
</section>

