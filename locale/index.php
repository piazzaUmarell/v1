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
    <meta property="og:url" content="http://piazzaumarell.it" >
    <meta property="og:description" content="Il podcast per pezzi di nerd">
    <title>Piazza Umarell. Il podcast per pezzi di Nerd</title>

    <link rel="alternate" type="application/rss+xml" title="Piazza Umarell" href="http://feeds.feedburner.com/PiazzaUmarell">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32"/>
	<!-- Prism JS CDN-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/prism.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/components/prism-javascript.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/plugins/line-numbers/prism-line-numbers.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/plugins/line-numbers/prism-line-numbers.min.css" />	
	<!-- JQuery CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Bootstrap CDN-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<!-- Fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

	<link rel="stylesheet" href="stylesheets/stylesa.css">
	<link rel="stylesheet" href="stylesheets/prism.css">
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
  <body >
      <div class="page-header col-sm-offset-4 col-xs-offset-4 col-sx-offset-2">
          <h1 id="titolone">Piazza Umarell</h1>
          <p id="sottotiolone">Il podcast per pezzi di Nerd</p>
          <p id="frasetta">Prossimo episodio....Domenica! Ogni domenica!</p>
      </div>

      <section class="col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
          <?php
            function stampa($s){
              echo "<pre>" . print_r($s,true) . "</pre>";
            }
            if (file_exists('umarell_puntate.xml')) {
                $xml = simplexml_load_file('umarell_puntate.xml');
            } else {
                exit('Failed to open test.xml.');
            }
            $ns = $xml->getNamespaces(true);

            for($i=count($xml->channel->item)-1;$i>=0;$i--){
              $item = $xml->channel->item[$i];
              $url = str_replace('http://piazzaumarell.it/','',$item->enclosure['url']);
              $url_src = $item->enclosure['url'];
              $data = new DateTime($item->pubDate);
              $pos = strpos($item->description,'La lista degli argomenti');
              $title = str_replace('Piazza Umarell ','',$item->title);
			  $n_puntata = str_replace('#','',$title);
              $sommario = $item->children($ns['piazza']);//"In manutenzione, brah!";
              if ( $pos === false ) $description = $item->description;
              else $description = substr ($item->description, 0 , $pos);
              setlocale(LC_ALL,"it_IT");
          ?>
        <div class="row puntata">
            <div class="titolo-puntata">
              <span>
                <?php echo $title ?>
                <span class="download pull-right">
                  <a href="<?php echo $url ?>" download="<?php echo $url ?>">
                    <i class="fa fa-download" aria-hidden="true"></i>
                  </a>
                </span>
                <span class="play pull-right">
                  <a data-toggle="collapse" href="#puntata<?php echo $i?>">
                    <i class="fa fa-play" aria-hidden="true"></i>
                  </a>
                </span>
              </span>
			        <p class="data"><?php echo  htmlentities ( strftime("%A, %d %B %Y",$data->getTimestamp()) )?></p>
            </div>
            <div class="contenuto-puntata">
                <?php echo $description ?>
				<audio preload="none" id="audio<?php echo $i ?>">
                  <source src="puntate/PiazzaUmarell_22.mp3"  type="audio/mpeg"> <?php /*echo $url*/ ?>
                </audio>
				
                <p>
				
                    <a data-toggle="collapse" href="#puntata<?php echo $i?>" aria-expanded="false" aria-controls="puntata<?php echo $i ?>">
                      Sommario
                    </a>
                </p>
      				<div class="collapse" id="puntata<?php echo $i ?>">
                
				<pre class="line-numbers"><code class="language-javascript"><?php echo $sommario ?></code></pre>
      				</div>
            </div>

          </div>
        <?php
          }
        ?>
    </section>
      <div class="footer">
        <nav class="navbar navbar-default navbar-fixed-bottom col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
          <div class="bordello row text-center" >
              <a href="http://feeds.feedburner.com/PiazzaUmarell" rel="alternate" type="application/rss+xml">
                <i class="fa fa-rss" aria-hidden="true"></i>
              </a>
              <a href="mailto:sedialibera@piazzaumarell.it">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </a>
              <a href="https://itunes.apple.com/it/podcast/piazza-umarell/id1147684863?mt=2">
                <i class="fa fa-podcast" aria-hidden="true"></i>
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
