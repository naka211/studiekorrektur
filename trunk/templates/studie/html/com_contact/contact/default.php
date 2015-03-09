<?php
defined('_JEXEC') or die;
$layout = JRequest::getVar('layout');
if($layout == 'subscribe'){
?>
<section class="main-content">
	<div class="container">
		<h3>Kvittering</h3>
		<p>Du er hermed tilmeldt vores nyhedsbrev.<br>
        <br>
        Med venlig hilsen<br>
        Studiekorrektur</p>
	</div>
</section>
<?php }?>
<?php if($layout == 'success'){?>
<section class="main-content">
	<div class="container">
		<h3>Kontakt os</h3>
		<p>Kære bruger, <br>Tak for din henvendelse. Vi vil kontakte dig hurtigst muligt.<br><br>
        Med venlig hilsen<br>
        Studiekorrektur</p>
	</div>
</section>
<?php }?>