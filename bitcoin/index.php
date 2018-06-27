<?php

	  $url = "https://bitpay.com/api/rates";
	  $json = file_get_contents($url);
      $data = json_decode($json, TRUE);

      $rate = $data[2]["rate"];    
	  $euro = floor($rate);
	  $centesimi = round($rate - $euro,2);

	  $venti_euro = floor($euro/20);
	  $dieci_euro = floor(($euro-$venti_euro*20)/10);	
	  $un_euro  = floor(($euro-($venti_euro*20)-($dieci_euro*10)));	

	  $totale_goleador = ($venti_euro*200) + ($dieci_euro*100) + ($un_euro*10) + floor($centesimi*10);
?>




<!doctype html>
<html lang="it">

  <head prefix="og: http://ogp.me/ns#">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="title" content="Piazza Umarell. Il podcast per pezzi di Nerd" >
  	<meta name="description" content="Due umarell si incontrano al bar per parlare di tutto e non concludere mai nulla. Ai microfoni Geralt e Francesco si cimentano in discorsi nerd.">
    <meta name="robots" content="index,follow">
    <meta name="author" content="Francesco and Geralt" >
    <meta name="keywords" content="podcast spazio morte nerd" >
    <meta property="og:title" content="Piazza Umarell. Il podcast per pezzi di Nerd" >
    <meta property="og:type" content="website" >
    <meta property="og:url" content="https://piazzaumarell.it" >
    <meta property="og:description" content="Il podcast per pezzi di nerd">
    <meta property="og:image" content="https://piazzaumarell.it/logo-min.jpg">
		
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@SeymourSuddenly" />
	<meta name="twitter:title" content="Piazza Umarell. Il podcast per pezzi di Nerd" />
	<meta name="twitter:description" content="Due umarell si incontrano al bar per parlare di tutto e non concludere mai nulla. Ai microfoni Geralt e Francesco." />
	<meta name="twitter:image" content="https://www.piazzaumarell.it/logo-min.jpg" />		
    
		<title>Piazza Umarell. Il podcast per pezzi di Nerd</title>

    <link rel="alternate" type="application/rss+xml" title="Piazza Umarell" href="http://feeds.feedburner.com/PiazzaUmarell/Cwoj">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32"/>
    <!-- JQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<!-- Bootstrap CDN-->
  	<script async  src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

  	<!-- Fontawesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- plyr CDN 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/2.0.11/plyr.css" />
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/plyr/2.0.11/plyr.js"></script>-->

    <link rel="stylesheet" href="../stylesheets/style.css">
  <script>
		$(document).ready(function(){
			$(document).on( 'scroll', function(){
				if ($(window).scrollTop() > 100) {
					$('.scroll-top-wrapper').addClass('show');
				} else {
					$('.scroll-top-wrapper').removeClass('show');
				}
			});
			$('.scroll-top-wrapper').on('click', scrollToTop);
		//	plyr.setup();
		});

	function scrollToTop() {
		verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
		element = $('body');
		offset = element.offset();
		offsetTop = offset.top;
		$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
	}
    </script>
  </head>
  <body style="text-align: center">
      <div class="page-header col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6">
          <h1 id="titolone">Piazza Umarell</h1>
          <p id="sottotiolone">Il podcast che ti spiega la finanza</p>
          <p id="frasetta">Prossimo episodio....Domenica! Ogni domenica!</p>
      </div>

      <section class="lista-puntate col-sm-offset-1 col-sm-8 col-md-6 col-md-offset-3" style="text-align: center;">
		<h2 style=""><?php echo 'un Bitcoin adesso vale ben <b>' .number_format($totale_goleador).  ' Goleador:</b>'; ?></h2>

	 </section>
      <div class="footer">
        <nav class="navbar navbar-default navbar-fixed-bottom  col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6">
          <div class="bordello row text-center" >
              <a href="http://feeds.feedburner.com/PiazzaUmarell/Cwoj" rel="alternate" type="application/rss+xml">
                <i class="fa fa-rss" aria-hidden="true"></i>
              </a>
              <a href="mailto:sedialibera@piazzaumarell.it">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </a>
              <a href="https://itunes.apple.com/it/podcast/piazza-umarell/id1147684863?mt=2">
                <i class="fa fa-podcast" aria-hidden="true"></i>
              </a>
							<a href="https://t.me/joinchat/AAAAAEHuCv9Q5UAwbnZlYA">
                <i class="fa fa-telegram" aria-hidden="true"></i>
              </a>
            </div>
        </nav>
      </div>
      <div class="scroll-top-wrapper">
        <span class="scroll-top-inner">
          <i class="fa fa-2x fa-arrow-circle-up"></i>
        </span>
      </div>
    </body>
</html>
<script>
	for (var i = 0; i< <?php echo $venti_euro;?>;i++){
		$(".lista-puntate").append('<img src="https://www.piazzaumarell.it/risorse/immagini/200-goleador.png" alt="goledor">');
	}
	for (var i = 0; i< <?php echo $dieci_euro;?>;i++){
		$(".lista-puntate").append('<img src="https://www.piazzaumarell.it/risorse/immagini/100-goleador.png" alt="goledor">');
	}
	for (var i = 0; i< <?php echo $un_euro;?>;i++){
		$(".lista-puntate").append('<img src="https://www.piazzaumarell.it/risorse/immagini/10-goleador.png" alt="goledor">');
	}
	for (var i = 0; i< <?php echo floor($centesimi*10);?>;i++){
		$(".lista-puntate").append('<img src="https://www.piazzaumarell.it/risorse/immagini/goleador.png" alt="goledor">');
	}

</script>
