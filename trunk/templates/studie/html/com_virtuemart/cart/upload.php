<?php 
defined ('_JEXEC') or die('Restricted access');
$cart = VirtueMartCart::getCart();
//print_r($cart);exit;
?>
<section class="main-content">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb text-center">
				<li><a>Bestilling</a></li>
				<li><a>Indkøbskurv</a></li>
				<li class="active"><a>Upload</a></li>
				<li><a>Betaling</a></li>
				<li><a>Kvittering</a></li>
			</ul>
		</div>
		<form action="index.php" class="form-group" enctype="multipart/form-data" method="post">
		<div class="row">
			<div class="col-md-6 pr40">
				<div class="row">
					<label><strong>Kommentar</strong></label>
					<textarea class="form-control h195" name="comment"></textarea>
				</div>
			</div>
			<div class="col-md-6 pl50">
				
				<div class="row">
					<label for=""><strong>Upload din opgave her</strong></label>
					<div class="eachRowUpload">
						<input class="fakefile" type="text" placeholder="Der er ikke valgt nogen fil">
						<input class="input-upload" type="file" name="danish_file">
					</div>
				</div>
				<?php if(count($cart->products) > 1){?>
				<div class="row">
					<label for=""><strong>Upload dit abstract her</strong></label>
					<div class="eachRowUpload">
						<input class="fakefile" type="text" placeholder="Der er ikke valgt nogen fil">
						<input class="input-upload" type="file" name="english_file">
					</div>
				</div>
				<?php }?>
			</div>
		</div>
		<div class="row text-center mb300">
			<hr class="black">
			<a class="btn btnPayment" onClick="jQuery('#submitBtn').click();">Gå til betaling</a>
		</div>
			<button type="submit" class="validate" id="submitBtn" style="display:none;">Submit form</button>
			<input type='hidden' name='task' value='processOrder'/>
			<input type='hidden' name='option' value='com_virtuemart'/>
			<input type='hidden' name='view' value='cart'/>
		</form>
	</div>
</section>

