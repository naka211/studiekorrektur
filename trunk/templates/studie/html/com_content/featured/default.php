<?php
defined('_JEXEC') or die;
$tmpl = JURI::base().'templates/studie/';
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
		formatMoney = function(num){
			var p = num.toFixed(2).split(".");
			return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
				return  num + (i && !(i % 3) ? "." : "") + acc;
			}, "") + "," + p[1];
		}
		
		openPopup = function(){
			var wordNum = jQuery("#wordNum").val();
			if(!wordNum){
				alert("Indtast venligst det antal tegn inkl. mellemrum");
				return false;
			}
			var pages = Math.ceil(parseFloat(wordNum)/2400);
			jQuery(".pages").text(pages);
			jQuery("#standard_price").text(formatMoney(pages*24.95)+' DKK');
			jQuery("#premium_price").text(formatMoney(pages*29.95)+' DKK');
			jQuery("#calBtn").click();
		}
    });
</script>
<section class="banner" id="index">
	<div class="banner-fix"> <img class="img-responsive" src="<?php echo $tmpl;?>img/slider01.jpg" alt="">
			<div class="caption">
				<!--<h3>Korrekturlæsning af opgaver og afhandlinger<br>
					til markedets laveste priser!</h3>
				<p class="mb30">- Hæv karakteren på din opgave uden at løfte en finger.</p>-->
				{article 1}{introtext}{/article}
			</div>
	</div>
</section>

<!-- About Section -->
<section class="hvordan">
	<div class="container">
		<div class="row mb20"> <img class="img-responsive hvordan-img" src="<?php echo $tmpl;?>img/info.png" alt=""> </div>
		<div class="row text-center"> <a class="btn btnBooknow3" href="index.php?option=com_virtuemart&view=virtuemart&Itemid=2">Bestil nu</a> </div>
	</div>
</section>

<!-- Contact Section -->
<div id="info" class="position"></div>
<section class="info">
	<div class="container">
		<div class="row">
			<div class="text-center col-sm-12 col-lg-12 mb20">
				<hgroup>
					<h3>Info om Studiekorrektur.dk</h3>
					<p class="f18">Vi tilbyder korrekturlæsning på både dansk og engelsk - prisen er den samme!<br>
						Bemærk - minimumsbestilling på 10 sider.</p>
				</hgroup>
			</div>
		</div>
		<div class="row mb20">
			<div class="col-sm-6 col-lg-6 mce_feature">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-desktop fa-4x mt10 f3-5"></i> </div>
					<div class="col-sm-10 col-lg-10 pl0">
						<h4>Kerneydelser</h4>
						<p>Korrekturlæsning: Tilretning af stave- og tegnsætningsfejl<br>
							Sproglig tilretning: Forbedring af sætningskonstruktioner og ordvalg</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-6 mce_feature">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-refresh fa-4x mt10"></i> </div>
					<div class="col-sm-10 col-lg-10 pad0">
						<h4>Leveringstid</h4>
						<p>Behandling af op til 20 sider: 2-3 arbejdsdage<br>
							Behandling af 20 sider og op efter: 3-4 arbejdsdage<br>
							Akut korrekturlæsning: 1-2 arbejdsdage (mod et gebyr på 50%)</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb20">
			<div class="col-sm-6 col-lg-6 mce_feature">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-file-text fa-4x mt10"></i> </div>
					<div class="col-sm-10 col-lg-10 pl0">
						<h4>Det færdige produkt</h4>
						<p>Ved levering efter endt korrekturlæsning får du som kunde 1 Word-dokument retur, hvor du enten kan godkende alle rettelserne med 1 klik eller godkende dem enkeltvist.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-6 mce_feature">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-search fa-4x mt10"></i> </div>
					<div class="col-sm-10 col-lg-10 pad0">
						<h4>Kvalitet</h4>
						<p>Kvaliteten af vores korrekturydelser sikres gennem samarbejde med yderst kompetente korrekturlæsere<br>
							Målsætningen er 100% fejlfrihed i korrekturlæsningen fra vores side</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-6 mce_feature mb0">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-repeat fa-4x mt10"></i> </div>
					<div class="col-sm-10 col-lg-10 pl0">
						<h4>Sådan gør du</h4>
						<p>Gennem bestillingssiden uploades opgaven som et <br>
							Word-dokument efter betaling. Dernæst godkender vi ordren,<br>
							og vores professionelle korrekturlæser læser korrektur på opgaven. Til sidst får du et Word-dokument retur, hvor du enten kan gennemgå og godkende rettelserne enkeltvis eller godkende dem alle med ét klik.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-6 mce_feature mb0">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-info-circle fa-4x mt10"></i> </div>
					<div class="col-sm-10 col-lg-10 pad0">
						<h4>Om os</h4>
						<p>Teamet bag Studiekorrektur.dk består af professionelle freelance korrekturlæsere med ma.nge års erfaring samt stifterne Jacob Cuculiza og Alexander Ilkjær, hvoraf de to sidstnævnte kun står for salg og markedsføring, mens korrekturlæsningen overlades til de professionelle.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div id="price" class="position"></div>
<section class="price">
	<div class="container fadeInUp">
		<div class="row mb20">
			<div class="text-center col-sm-12 col-lg-12">
				<hgroup>
					<h3>Priser på korrekturlæsning</h3>
					<p class="f20">Vi tilbyder korrekturlæsning på både dansk og engelsk - prisen er den samme! <br>
						Bemærk - minimumsbestilling på 10 sider.</p>
				</hgroup>
			</div>
		</div>
		<ul class="pricing-list clearfix list-unstyled col-xs-offset-0 col-sm-offset-2">
			<li class="pricing-table text-center no">
				<a href="index.php?option=com_virtuemart&view=virtuemart&Itemid=2&p=standard" style="z-index:100;">
				<div class="pricing-title bfd6740">
					<h4 class="light">Standardkorrektur</h4>
					<span class="caret-tomato"><i class="fa fa-caret-down fa-3x"></i></span> </div>
				<div class="pricing-price"> <span class="price2">24</span><sup class="decimal">.95</sup> </div>
				<ul class="pricing-features list-unstyled clearfix">
					<li><strong>Korrektur på stavning og tegnsætning.</strong></li>
					<li>Pris kun 24,95 DKK<br>
						pr. normalside á 2.400 tegn<br>
						(inkl. mellemrum).</li>
				</ul>
				<div class="pricing-action"><a href="index.php?option=com_virtuemart&view=virtuemart&Itemid=2&p=standard" class="btn btnBook4 bfd6740">Bestil nu</a></div>
				</a>
			</li>
			<li class="pricing-table text-center focus">
				<a href="index.php?option=com_virtuemart&view=virtuemart&Itemid=2&p=premium" style="z-index:100;">
				<div class="pricing-title">
					<h4 class="light">Premiumkorrektur</h4>
					<span class="caret-green"><i class="fa fa-caret-down fa-3x"></i></span> </div>
				<div class="pricing-price"><span class="price2">29</span><sup class="decimal">.95</sup></div>
				<ul class="pricing-features list-unstyled clearfix">
					<li>
						<p><strong>Korrektur på stavning og tegnsætning.<br>
							Inkl. sproglig tilretning af<br>
							sætningskonstruktioner.</strong></p>
					</li>
					<li>
						<p>Pris kun 29,95 DKK<br>
							pr. normalside á 2.400 tegn<br>
							(inkl. mellemrum).</p>
					</li>
				</ul>
				<div class="pricing-action"><a href="index.php?option=com_virtuemart&view=virtuemart&Itemid=2&p=premium" class="btn btnBook4">Bestil nu</a></div>
				</a>
			</li>
		</ul>
		<div class="row">
			<div class="text-left box2 clearfix">
				<div class="row">
					<div class="col-md-12">
						<h3>Beregn din pris </h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p class="f20" style="margin-bottom:2px;">Indtast antal tegn inkl. mellemrum</p>
						<input type="text" class="form-control input" id="wordNum">
					</div>
					<div class="col-md-6 pad0">
						<a style="display:none;" id="calBtn" href="#myModal" data-toggle="modal">BEREGN PRIS</a>
						<a class="btn btnBooknow3 mt32" onClick="openPopup();">BEREGN PRIS</a>
					</div>
				</div>
				
				<div id="myModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<div class="modal-body">
								<div class="row bor-b">
									<div class="col-md-4">
										<p>Standardkorrektur</p>
									</div>
									<div class="col-md-4">
										<form action="" class="form-group">
											<label for=""><strong>Antal normalsider:</strong></label>
											<p class="ml60 pages"></p>
										</form>
									</div>
									<div class="col-md-4">
										 <form action="" class="form-group">
											<label for=""><strong>Total pris:</strong></label>
											<p id="standard_price">24.351,20 DKK</p>
										</form>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<p>Premiumkorrektur</p>
									</div>
									<div class="col-md-4">
										<form action="" class="form-group">
											<label for=""><strong>Antal normalsider:</strong></label>
											<p class="ml60 pages"></p>
										</form>
									</div>
									<div class="col-md-4">
										 <form action="" class="form-group">
											<label for=""><strong>Total pris:</strong></label>
											<p id="premium_price">30.351,20 DKK</p>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div id="testimonials" class="position"></div>
<section class="testimonials">
	<div class="container">
		<div class="row mb20">
			<div class="text-center col-sm-12 col-lg-12">
				<h3>Udtalelser fra tidligere kunder</h3>
				<p>Nedenfor kan du se, hvad andre kunder synes om Studiekorrektur.dk.</p>
			</div>
		</div>
		<div class="row post"> <span class="icon-open"></span> <span class="icon-close"></span>
			<div class="col-sm-2 col-lg-2">
				<div class="text-center icon-people"> <img class="img-circle" src="<?php echo $tmpl;?>img/men.png" alt=""> </div>
			</div>
			<div class="col-sm-10">
				<p>Da jeg skrev min bachelor på jurastudiet, sørgede teamet hos Studiekorrektur for at læse korrektur på min afhandling. Det var utrolig nemt, og det har klart påvirket min karakter i den rigtige retning, at<br>
					opgaven stod fejlfri og strømlinet. Jeg vil ikke tøve med at bruge Studiekorrektur igen ved aflevering af mit kandidat speciale!</p>
			</div>
		</div>
	</div>
</section>
<div id="contact" class="position"></div>
<section class="contact">
	<div class="container">
		<div class="row mb10">
			<div class="text-center col-sm-12 col-lg-12">
				<h3>Kontakt os</h3>
				<p>Studiekorrektur.dk | CVR: 35321330 | info@studiekorrektur.dk | +45 30296044</p>
			</div>
		</div>
		<div class="row pad0">
			<div class="col-md-12">
				<script type="text/javascript">
                 var RecaptchaOptions = {
                    theme : 'white',
                    lang : 'da',
                    custom_translations : { instructions_visual : "Indtast koden" }
                 };
                 </script>
				<form class="col-md-10 col-md-offset-2 ml8p form-validate" action="index.php" method="post">
					<div class="row">
						<div class="col-md-6 form-group">
							<label for="">Navn</label>
							<input type="text" class="form-control input3 required" name="jform[contact_name]" id="name">
						</div>
						<div class="col-md-6 form-group pl0">
							<label for="">E-mail</label>
							<input type="text" class="form-control input3 required validate-email" name="jform[contact_email]" id="email">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label for="">Emne</label>
							<input type="text" class="form-control input3 required" name="jform[contact_subject]" id="subject">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label for="">Besked</label>
							<textarea class="form-control h158 input3 required" name="jform[contact_message]" id="content"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<?php
							  require_once('recaptchalib.php');
							  $publickey = "6LehjgMTAAAAANt2O-hrqTtVEd9q_3n-ZwZ7nfWX"; // you got this from the signup page
							  echo recaptcha_get_html($publickey);
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<button class="btn btnSend validate" type="submit">Send</button>
						</div>
					</div>
					<input type="hidden" name="option" value="com_contact" />
					<input type="hidden" name="task" value="contact.submit" />
					<input type="hidden" name="id" value="1" />
					<?php echo JHtml::_('form.token'); ?>
				</form>
			</div>
		</div>
	</div>
</section>