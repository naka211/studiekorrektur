<?php
defined('_JEXEC') or die;
$tmpl = JURI::base().'templates/studie/';
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
		jQuery('#myCarousel').carousel({
			pause: true,
			interval: false
        });
		
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
						Bemærk, minimumsbestilling på 10 normalsider a 2.400 tegn inkl. mellemrum.</p>
				</hgroup>
			</div>
		</div>
		<div class="row mb20">
			<div class="col-sm-6 col-lg-6 mce_feature">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-desktop fa-4x mt10 f3-5"></i> </div>
					<div class="col-sm-10 col-lg-10 pl0">
						<h4>Kerneydelser</h4>
						<p>Korrekturlæsning: Tilretning af stave- og tegnsætningsfejl.<br>
							Sproglig tilretning: Forbedring af sætningskonstruktioner og ordvalg.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-6 mce_feature">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-refresh fa-4x mt10"></i> </div>
					<div class="col-sm-10 col-lg-10 pad0">
						<h4>Leveringstid</h4>
						<p>Normal levering af op til 20 sider: 48 hverdagstimer.<br>
Normal levering af 20 sider og opefter: 72 hverdagstimer.<br><br>

Ekspreslevering af op til 20 sider: 24 hverdagstimer (+50% gebyr).<br>
Ekspreslevering af 20 sider og opefter: 48 hverdagstimer (+50% gebyr).
</p>
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
						<p>Ved levering efter endt korrekturlæsning får du som kunde et Word-dokument retur, hvor du enten kan godkende alle rettelserne med et klik eller godkende dem enkeltvist.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-6 mce_feature">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-search fa-4x mt10"></i> </div>
					<div class="col-sm-10 col-lg-10 pad0">
						<h4>Kvalitet</h4>
						<p>Kvaliteten af vores korrekturydelser sikres gennem samarbejde med yderst kompetente korrekturlæsere.<br>
							Målsætningen er 100% fejlfrihed i korrekturlæsningen fra vores side.</p>
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
						<p>Gennem bestillingssiden vælger du den ønskede korrekturydelse, får en leveringstid, uploader opgaven som et Word-dokument og indtaster til sidst dine betalingsoplysninger. Dernæst får du en ordrebekræftelse, og vores professionelle korrekturlæser læser korrektur på opgaven indenfor angivne deadline. Til sidst får du et Word-dokument retur, hvor du enten kan gennemgå og godkende rettelserne enkeltvis eller godkende dem alle med ét klik.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-6 mce_feature mb0">
				<div class="row">
					<div class="col-sm-2 col-lg-2"> <i class="fa fa-info-circle fa-4x mt10"></i> </div>
					<div class="col-sm-10 col-lg-10 pad0">
						<h4>Om os</h4>
						<p>Teamet bag Studiekorrektur.dk består af professionelle freelance korrekturlæsere med mange års erfaring samt stifterne Jacob Cuculiza og Alexander Ilkjær. De to sidstnævnte står kun for salg og markedsføring, mens korrekturlæsningen overlades til de professionelle.</p>
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
						Bemærk, minimumsbestilling på 10 normalsider a 2.400 tegn inkl. mellemrum.</p>
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
						pr. normalside a 2.400 tegn<br>
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
							pr. normalside a 2.400 tegn<br>
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
		<div class="row post">
			<span class="icon-open"></span>
			<span class="icon-close"></span>

			<div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
				<!-- Carousel indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
					<li data-target="#myCarousel" data-slide-to="3"></li>
				</ol>
				<!-- Carousel items -->
				<div class="carousel-inner">
					<div class="active item">
						<div class="people">
							<div class="text-center icon-people">
								<img class="img-circle" src="<?php echo $tmpl;?>img/men.png" alt="">
							</div>
							<div class="office">
								<p><strong>Jens K.</strong></p>
								<p>HD(r)-studerende</p>
							</div>
						</div>
						<div class="info-people">
							<p>Studiekorrektur stod for gennemgående korrekturlæsning ifm. min afsluttende afhandling på 2. del af
							HD-uddannelsen i regnskab, som resulterede i et 12-tal!</p>
						</div>
					</div>
					<div class="item">
						<div class="people">
							<div class="text-center icon-people">
								<img class="img-circle" src="<?php echo $tmpl;?>img/women.png" alt="">
							</div>
							<div class="office">
								<p><strong>Kristoffer P.</strong></p>
								<p>Cand.merc.-studerende</p>
							</div>
						</div>
						<div class="info-people">
							<p>Jeg har med stor tilfredshed benyttet Studiekorrekturs services til både mellemstore opgaver og større afhandlinger.
							Korrekturlæsningen har uden tvivl påvirket mine karakterer positivt!</p>
						</div>
					</div>
					<div class="item">
						<div class="people">
							<div class="text-center icon-people">
								<img class="img-circle" src="<?php echo $tmpl;?>img/men.png" alt="">
							</div>
							<div class="office">
								<p><strong>Camilla C.</strong></p>
								<p>Cand.jur.-studerende</p>
							</div>
						</div>
						<div class="info-people">
							<p>Da jeg skrev min bachelor på jurastudiet, sørgede teamet hos Studiekorrektur for at læse korrektur på min afhandling. Det var utrolig nemt, og det har klart påvirket min karakter i den rigtige retning, at opgaven stod fejlfri og strømlinet. Jeg vil ikke tøve med at bruge Studiekorrektur igen ved aflevering af mit kandidat speciale!</p>
						</div>
					</div>
					<div class="item">
						<div class="people">
							<div class="text-center icon-people">
								<img class="img-circle" src="<?php echo $tmpl;?>img/women.png" alt="">
							</div>
							<div class="office">
								<p><strong>Cecilie M.</strong></p>
								<p>HHX 3. års-studerende</p>
							</div>
						</div>
						<div class="info-people">
							<p>Ved udarbejdelsen af min SRP i 3.g sørgede Studiekorrektur for at korrekturlæse opgaven. Det har bestemt haft god
							indvirkning på karakteren, der vægter som et tilsvarende A-fag på eksamensbeviset! </p>
						</div>
					</div>
				</div>
				<!-- Carousel nav -->
				<a class="carousel-control left" href="#myCarousel" data-slide="prev">
					<span class="arrow-left glyphicon-chevron-left"></span>
				</a>
				<a class="carousel-control right" href="#myCarousel" data-slide="next">
					<span class="arrow-right glyphicon-chevron-right"></span>
				</a>
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
							  $publickey = "6LeyiQUTAAAAAEz5qhOBQncyBEQhDvGkANSH6maH"; // you got this from the signup page
							  echo recaptcha_get_html($publickey,'',true);
							  //echo recaptcha_get_html($publickey);
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
