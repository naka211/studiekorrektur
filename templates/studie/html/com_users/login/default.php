<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
		jQuery("nav.navbar").remove();
		jQuery("footer").remove();
		
		jQuery('input').on('change invalid', function() {
			var textfield = jQuery(this).get(0);
			textfield.setCustomValidity('');
			
			if (!textfield.validity.valid) {
			  textfield.setCustomValidity('Venligst udfyld dette felt');  
			}
		});
    });
</script>
<section>
	<div class="container text-center">
		<a href="index.php"><img src="templates/studie/img/logo.png" alt=""></a>
	</div>
</section>
<section class="main">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-offset-3">
				<div class="row">
					<div class="frm-login clearfix">
						<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate">
						<div class="col-md-12">
							<h3 class="text-center">Login</h3>
							<div class="form-group">
								<label for="inputEmail">Brugernavn</label>
								<input type="text" class="form-control required" name="username">
							</div>
							<div class="form-group">
								<label for="inputEmail">Password</label>
								<input type="password" class="form-control required" name="password">
							</div>
						</div>
						<div class="col-md-12 text-center">
							<button class="btn btnHome validate">Login</button>
						</div>
						<input type="hidden" name="return" value="<?php echo base64_encode("index.php?option=com"); ?>" />
						<?php echo JHtml::_('form.token'); ?>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>