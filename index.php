<!doctype html>
<?php
// fa da base per l'id_puntata

$first_episode = 1473033601;
function get_first() {return 1473033601;}
function get_id($episode) {return get_first()+$episode;}
function get_episode($id) {return $id - get_first(); }
 function getCurrentUri()
  {
      $routes = array();
      $uri = array();
      $routes = explode('/', $_SERVER['REQUEST_URI']);
      foreach($routes as $route)
      {
         if(trim($route) != '')
           array_push($uri, $route);
      }            
      return $uri;
  }
  $uri = getCurrentUri();
  function stampa($s){
    echo "<pre>" . print_r($s,true) . "</pre>";
  }
  /* Carico il file xml con l'elenco puntate */
  if (file_exists('umarell_puntate.xml')) {
      $xml = simplexml_load_file('umarell_puntate.xml');
  } else {
      exit('Failed to open umarell_puntate.xml.');
  }
  $ns = $xml->getNamespaces(true);
  $n_puntate= count($xml->channel->item)-1;
  // in condizioni normali ciclo tutte le puntate e le elenco nella homepage
  $init = $n_puntate;
  $end = 0;
  $tipo_lista = "normale";
  $puntata_scelta=0;
  // in caso l'url sia di tipo /puntata/# mostro la singola puntata e cambio anche titolo e descrizione della pagina
  if($uri[0]=="puntata" and count($uri)==2 and is_numeric($uri[1]))
  { 
    $tipo_lista = "dettaglio";
    $puntata_scelta = get_episode(intval($uri[1]));
   
    if($puntata_scelta>=0 and $puntata_scelta<=$n_puntate) {
      $init = $puntata_scelta;
      $end = $puntata_scelta;
    }
  }
  function link_puntata($episode,$txt)  {
    echo "<a href=https://www.piazzaumarell.it/puntata/".get_id($episode).">".$txt."</a>";
  }
?>
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
     <!-- prism -->
    <script async src="/javascripts/prism.js"></script>
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/themes/prism.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/plugins/line-numbers/prism-line-numbers.min.css" />
    <link rel="stylesheet" href="/stylesheets/style.css">
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
      <div class="page-header col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6">
          <h1 id="titolone">Piazza Umarell</h1>
          <p id="sottotiolone">Il podcast per pezzi di Nerd</p>
          <p id="frasetta">Prossimo episodio....Domenica! Ogni domenica!</p>
      </div>
      <?php if($tipo_lista=="dettaglio"){ ?>
      <nav class="navbar col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6">
        <div class="bordello row text-center" >
           <?php if($puntata_scelta>0) echo link_puntata($puntata_scelta-1,"<<");    ?>
           <a href="https://www.piazzaumarell.it/" rel="alternate" type="application/rss+xml">
              Indice
           </a>
           <?php  if($puntata_scelta<$n_puntate) echo link_puntata($puntata_scelta+1,">>");    ?>
            
        </div>
      </nav>
      <?php } ?>
      <section class="lista-puntate col-sm-offset-1 col-sm-8 col-md-6 col-md-offset-3">
     
        <?php
            for($i=$init;$i>=$end;$i--){
              $item = $xml->channel->item[$i];
              $url = str_replace('https://piazzaumarell.it/','',$item->enclosure['url']);
              $url_src = $item->enclosure['url'];
              $data = new DateTime($item->pubDate);
              $pos = strpos($item->description,'La lista degli argomenti');
              $title = str_replace('Piazza Umarell ','',$item->title);
              $sommario = $item->children($ns['piazza']);
              if ( $pos === false ) $description = $item->description;
              else $description = substr ($item->description, 0 , $pos);
              setlocale(LC_ALL,"it_IT");
        ?>
        <div class="row puntata">
            <div class="titolo-puntata">
              <h2><?php echo link_puntata($i,$title) ?> 
                
              </h2>
			        <span class="data">
                <?php echo utf8_encode(strftime("%A, %d %B %Y",$data->getTimestamp()) )?>
              </span>
            </div>
            <div class="contenuto-puntata">
                <?php echo $description ?>
               <?php if($tipo_lista=="dettaglio"){ ?>
               <p>
                    <a data-toggle="collapse" preload="none" href="#puntata<?php echo get_id($i)?>" aria-expanded="f" aria-controls="puntata<?php echo get_id($i) ?>">
                      Sommario
                    </a>
                </p>
              <audio id="audio<?php echo $i?>" src="<?php echo "/".$url?>" controls preload="none">       </audio>
      				<div <?php echo $tipo_lista=="dettaglio"?"class=''":"class='collapse'";?> id="puntata<?php echo get_id($i) ?>">
      					<pre class="line-numbers">
                  <code class="language-javascript">
                    <?php echo $sommario ?>
                  </code>
      					</pre>
               </div> <? } ?>
            </div>

          </div>
        <?php
          }
        ?>
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
