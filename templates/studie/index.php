<?php 
defined('_JEXEC') or die;
$tmpl = JURI::base().'templates/studie/';
JHtml::_('behavior.formvalidation');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<script src="<?php echo $tmpl;?>js/jquery.js"></script>

<?php unset($this->_scripts[JURI::root(true).'/media/jui/js/jquery.min.js']); ?>
<?php unset($this->_scripts[JURI::root(true).'/media/jui/js/jquery-noconflict.js']); ?>
<?php unset($this->_scripts[JURI::root(true).'/media/jui/js/jquery-migrate.min.js']); ?>
<jdoc:include type="head" />

<link rel="shortcut icon" href="<?php echo $tmpl;?>favicon.ico">
<link rel="shortcut icon" href="<?php echo $tmpl;?>favicon.png">
<link href="<?php echo $tmpl;?>css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="<?php echo $tmpl;?>css/style.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="<?php echo $tmpl;?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- jQuery -->

<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Open+Sans:400,600,700:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>
</head>

<body id="page-top" class="index">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" id="fixedNav">
	<div class="container"> 
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header page-scroll">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<a class="navbar-brand" href="index.php"><img class="img-responsive" src="<?php echo $tmpl;?>img/logo.png" alt=""></a> </div>
		
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li class="hidden"><a href="#page-top"></a></li>
				<li class="page-scroll active"><a href="#index">Forside</a></li>
				<li class="page-scroll"><a href="#info">Info</a></li>
				<li class="page-scroll"><a href="#price">Priser</a></li>
				<li class="page-scroll"><a href="#testimonials">Udtalelser</a></li>
				<li class="page-scroll"><a href="#contact">Kontakt</a></li>
				<li><a class="btn btnBooknow" href="bestilling.php">Bestil nu</a></li>
			</ul>
		</div>
		<!-- /.navbar-collapse --> 
	</div>
	<!-- /.container-fluid --> 
</nav>
<jdoc:include type="component" />
<footer class="text-center">
	<div class="footer-above">
		<div class="container">
			<div class="row">
				<div class="footer-col col-md-3">
					<h3>Studiekorrektur</h3>
					<div class="col-md-6 pad0">
						<ul>
							<li><a href="index.php">Forside</a></li>
							<li><a href="#info">Info</a></li>
							<li><a href="#price">Priser</a></li>
							<li><a href="#testimonials">Udtalelser</a></li>
						</ul>
					</div>
					<div class="col-md-6 pad0">
						<ul>
							<li><a href="#contact">Kontakt</a></li>
							<li><a href="cookiepolicy.php">Cookiepolitik</a></li>
							<li><a href="term.php">Betingelser</a></li>
						</ul>
					</div>
				</div>
				<div class="footer-col col-md-5 bor-l2">
					<h3>nyhedsbrev</h3>
					<p>Tilmeld dig nyheder og modtag aktuelle tilbud</p>
					<div class="form-group newsletter row">
						<form action="index.php" method="get" class="form-validate">
							<input type="text" class="form-control float-left required validate-email" name="email" placeholder="Indtast din e-mail...." id="subscribe_email">
							<button class="btn btnSignup float-right validate" type="submit">Tilmeld</button>
							<input type="hidden" name="option" value="com_virtuemart" />
							<input type="hidden" name="controller" value="virtuemart" />
							<input type="hidden" name="task" value="subscribe" />
						</form>
					</div>
				</div>
				<div class="footer-col col-md-4 bor-l2">
					<div class="pull-left"> <a target="_blank" href="https://www.facebook.com/studiekorrektur?fref=ts"><img src="<?php echo $tmpl;?>img/facebook.png" alt=""></a> </div>
					<div class="pull-left ml10 mt20"> <a target="_blank" href="https://www.trustpilot.dk/review/studiekorrektur.dk"><img src="<?php echo $tmpl;?>img/trustpilot.png" alt=""></a> </div>
					<div class="clearfix"></div>
					<p class="ml17 pull-left mt10"><img src="<?php echo $tmpl;?>img/cart.png" alt=""></p>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-below">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="pull-left">© <a href="index.php">Studiekorrektur.dk</a> 2015 &nbsp;&nbsp;CVR: 35321330 - All Right Reserved.</p>
					<p class="full-right text-right">Design af <a target="_blank" href="http://mywebcreations.dk/">My Web Creations</a></p>
				</div>
			</div>
		</div>
	</div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visble-sm"> <a class="btn btn-primary" href="#page-top"> <i class="fa fa-chevron-up"></i> </a> </div>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $tmpl;?>js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo $tmpl;?>js/classie.js"></script>
<script src="<?php echo $tmpl;?>js/cbpAnimatedHeader.js"></script>

<script src="<?php echo $tmpl;?>js/freelancer.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="en"){
                $(".en").hide();
                $(".dk").show();
            }
            if($(this).attr("value")=="dk"){
                $(".dk").hide();
                $(".en").show();
            }
        });

        $('.btnChoose').click(function(){
            var $this = $(this);
            $this.toggleClass('Valgt');
            if($this.hasClass('Valgt')){
                $this.text('Vælg');
                $this.addClass('b2ecc71');
            } else {
                $this.text('Valgt');
                $this.addClass('bfff');
            }
        });

		$('input#subscribe_email,input#email').on('change invalid', function() {
			var textfield = $(this).get(0);
			textfield.setCustomValidity('');
			
			if (!textfield.validity.valid) {
			  textfield.setCustomValidity('Venligst indtast din e-mail');  
			}
		});
		
		$('input#name').on('change invalid', function() {
			var textfield = $(this).get(0);
			textfield.setCustomValidity('');
			
			if (!textfield.validity.valid) {
			  textfield.setCustomValidity('Venligst indtast din navn');  
			}
		});
		
		$('input#title').on('change invalid', function() {
			var textfield = $(this).get(0);
			textfield.setCustomValidity('');
			
			if (!textfield.validity.valid) {
			  textfield.setCustomValidity('Venligst indtast din emne');  
			}
		});
		
		$('textarea#content').on('change invalid', function() {
			var textfield = $(this).get(0);
			textfield.setCustomValidity('');
			
			if (!textfield.validity.valid) {
			  textfield.setCustomValidity('Venligst indtast din besked');  
			}
		});
    });
</script>
</body>
</html>
