<?php
require("includes/functions.php");

# Inicializa variáveis de menu
require_once ("includes/resetvars.php");
# Pega nome da página para ativar o menu CSS
$quem = active();

# Inclui cabeçalho
include_once("includes/header.php");
?>
	
	<!-- start content -->
	<div id="content">
		
		<div class="post">
			<h1 class="title">Quem Faz?</h1>
			<div class="entry">
				<p>This is StandardIssue 1.0, a free, fully standards-compliant CSS template designed by <a href="http://www.nodethirtythree.com/">NodeThirtyThree</a> for <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>. This free template is released under a <a href="http://creativecommons.org/licenses/by/2.5/">Creative Commons Attributions 2.5</a> license, so you’re pretty much free to do whatever you want with it (even use it commercially) provided you keep the links in the footer intact. Aside from that, have fun with it :)</p>
				<p>Be sure to check out some of my commercial work over at <a href="http://www.4templates.com/?aff=nodethirtythree">4Templates</a>. This template is also available as a <a href="http://www.freewpthemes.net/preview/standardissue/">WordPress theme</a> at <a href="http://www.freewpthemes.net/">Free WordPress Themes</a>.</p>
			</div>
		</div>
	</div>
	
	<!-- end content -->
	

<?php
# Inclui Rodapé
include("includes/footer.html")
?>