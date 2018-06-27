<?php

	  $url = "https://bitpay.com/api/rates";
	  $json = file_get_contents($url);
      $data = json_decode($json, TRUE);

      $rate = $data[1]["rate"];    


	$frasi_supporto = array(
							"Sei il più grande podcazzaro e lo sai!",
							"Dai! Dai! Dai",
							"No, non puoi fare wresling con bambini sotto i 5 anni... O forse si? In fondo è Natale!",
							"Adesso chiudi gli occhi e immagina che quel pigiama sotto l'albero sia un Gundam!",
							"Quei CD di Gigi D'Alessio che ti hanno regalato li puoi sempre vendere su Ebay... No, sai che non puoi!",
							"Se ti fai una foto molto espressiva ora che sei a cena con tutti, potrai rivenderla su IStockPhoto",
							"Sapevi che restare seduto troppo a lungo è dannoso per la salute? Dillo ad alta voce, alzati e vai a fare un giro.",
							"Guarda il lato positivo. La peperonata di Zia Pina ti darà innumerevoli occasioni di giocare con la Switch nei prossimi giorni.",
							"Prendersi una pausa di riflessione il 23 dicembre non è mai costato la vita a nessuno...",
							"Non sai cosa dire in questo momento per sembrare un tipo interessante? Prova con: Sapevate che durante l'anno mangiamo inconsapevolmente quasi un kg di insetti nascosti nel cibo?",
							"DOCG significa Denominazione di Origine Controllata e Garantita, così puoi leggerlo ad alta voce dalla bottiglia annuendo con gli occhi socchiusi.",
							"Al tavolo dei bambini qualcuno ha dato la tua scatola di HeroQuest. Si, puoi bestemmiare adesso!",
							"Hai trovato un capello nel piatto? Clikka <a href='https://img.gadgethacks.com/img/29/14/63533331273612/0/set-fake-incoming-calls-your-iphone-escape-bad-dates-boring-meetings.w1456.jpg'>qui</a> e allontanati dal tavolo per rispondere.",
							"Non accettano i BitCoin alla tombolata? Ma come è possibile? Doveva essere la moneta del secolo! Consolati, vale <b>$rate</b> dollarozzi!",
							"Fai un simpatico scherzo a sorpresa al cugino con la Mercedes e la fidanzata nuova: <a href='https://www.youtube.com/watch?v=Bt_kR7u6mM4'>link</a>",
							"Clikka <a href='https://www.sideshowtoy.com/wp-content/uploads/2016/10/a-nightmare-on-elm-street-freddy-krueger-premium-format-feature-300366.jpg'>qui</a> per un immagine che farà scappare via i bambini",
							"Vuoi pomiciare col cugino americano tanto... insomma... che male c'è? Però la sorellina di 4 anni ti si attacca al maglioncino con le renne e non molla? Ecco la <a href='https://www.youtube.com/results?search_query=peppa+pig'>soluzione</a>.",
							"Le cose a cui pensare mentre, a turno e non senza litigare, i 27 bambini della famiglia recitano le poesie di natale: PornHub è gratis ed esiste una discreta app per il VR, il video di Belen ancora si trova, tumblr è una miniera di amatoriale, lobstertube ha un'indicizzazione che manco Google!",
							"Le zie cominciano a chiedere: 'ma tu non eri a dieta?' mentre imbuchi il primo torntellino delle feste... la salvezza in due parole: <a href='https://www.projectinvictus.it/come-accelerare-il-metabolismo/'>Reset Metabolico.</a>",
							"Tua cognata, adorabilmente chiamata da tutti 'Scaldabagno Modificato' si è seduta sulla tua borsa. Chissà se Ifixit risponde il giorno di natale?",
							"Tuo nipote ti mostra come ad HeartStone ti apre in due anche giocando dallo smartwatch. Ricordagli che non ha mai giocato ad un cabinato!",
							"Eccolo lì, il cugino che sta a Londra e passa solo a salutare perchè deve andare a Dubai e il pilota privato poverino, pure lui deve festeggiare... Bucargli le ruote della macchina può essere visto come un modo per dargli l'opportunità di passare più tempo in famiglia",
							"Viene a cena anche la parente di cui si sa è stato publicato un video parecchio zozzo. Dire:'se me lo mostri, lo faccio cancellare dall'amico ingegnere' non è per forza una cattiveria.",
							"Il coniglio di tua cognata ha rosicchiato le tue cuffie da running da 200€, picchiarlo sarebbe davvero una brutta cosa. Picchiare lei invece è un modo per educarla",
							"Hai finalmente chiuso con gli MMO quando scarti l'abbonamento Blizzard che ti ha comprato la fidanzata. È il destino, gratta che ti passa!",
							"Dopo aver sputtanato su ogni forum, chat e piazza l'ultimo COD, ecco che ne spunta uno per te da parte del fratellone. Mortacci sua, del natale, dell'abbonamento PSN scaduto e delle patch da 60gb!",
							"La nonna si è fatta consigliare ma ha capito male e invece di un fumetto ti regala il Calgon, spera nel reso Amazon e vivi felice. Al massimo Torrent pareggerà i conti col karma",
							"La fidanzata del cugino, vegano, ti guarda malissimo mentre addenti pezzi di carne morta. Spiegale che te lo ha detto il dottor Lemme e sfidala a dargli torto!",
							"Ricorda sempre che se hai un telefono Android ci sono buone possibilità di cambiare canale discretamente alla TV e saltare il concerto di natale alla Camera",
							"Dire che la smart TV ha preso un virus e non è possibile sintonizzarsi sul discorso del Presidente è finalmente diventata un scusa plausibile. Grazie progresso.",
							"Sei appena arrivato alla tombolata e inizia a nevicare. Spiega che devi lasciare tutto e andare perchè sei reperibile. Si, vale pure se fai il commesso da FootLooker (oh, basta coi lacci di riserva! intesi?)",
							"Ti viene in mente che il tuo podcast preferito è Piazza Umarell e trovi anche un senso nelle parole di Francesco... Calmati e cerca di ricordare dove ti trovavi prima di aprire quella bottiglia di grappa artigianale.",
							"Hai superato un sacco di natali, dai! Puoi farcela anche con questo.",
							"Un buon modo per evitare di spalare la neve è mostrarsi subito doloranti con la schiena ai primi fiocchi. Sventolando un cerotto riscaldante ovviamente!",
							"La tisana della nonna ha reso tutti particolarmente allegri meno che il cugino adolescente...Ecco dove nascondeva l'erba!",
							"Stai per tagliare il Panettone di De Riso quando qualcuno inizia a nominare Salvini a ripetizione. No, a questo non c'è soluzione. Metti da parte una fettona e litiga finchè hai voce!",
							"Tra tutti i Blu Ray che potevano regalarti proprio quello di Batman Vs Superman! Subito.it-> Scambio con VHS di Space Jam.",
							"Se annuire difronte al nipotino che ti mostra il presepe fatto con Arduino non basta, prova a ripetere: 'e hai fatto tutto da solo?' ad ogni sua frase.",
							"Se finisci le novel da leggere vai su asianovel!",
							"Se Edge manca d'arrivare,  qualcosa su netflix non ti resta che guardare",
							"Sei triste che Naruto sia finito? Tranquillo, è un manga di merda. Leggi Boku no Hero Academia e ringrazia",
							"Sei giù di morale? Ti ricordo che la fuori c'è gente che guarda Dragonball Super. Guardi Dragonball Super? C'è gente che guarda i filler di Bleach.Guardi i filler di Bleach? Mai sentito parlare di Dragonball Super?",
							"Se guarda il film di super mario con te, è quella giusta",
							"La vita è come una bomboletta di antighiaccio, a un certo punto finisce. Tra l'altro pure il ghiaccio finisce, quindi la vita è come il ghiaccio..una bomboletta di spry antighiaccio fatta di ghiaccio, ecco cos'è la vita. Un fottuto casino e te stai ancora a pensare ai tuoi problemi",
							"Ricordati che su netflix c'è la sezione bambini, piena di cartoni animati CREATI APPOSITAMENTE per ipnotizzare i pargoli e riposarsi",
							"Ti sei mai chiesto perchè è così importante la matematica? Come mai credi di avere così tanti problemi irrisolti? Prova a usare geogebra, è opensource",
							"Oggi stai a letto, datti malato. Ci pensi poi domani, dai"
							
	);
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
          <p id="sottotiolone">Il podcast che ti supporta</p>
          <p id="frasetta">Prossimo episodio....Domenica! Ogni domenica!</p>
      </div>

      <section class="lista-puntate col-sm-offset-1 col-sm-8 col-md-6 col-md-offset-3">
		<h2 style="font-style:italic;"><?php echo $frasi_supporto[mt_rand(0, count($frasi_supporto) - 1)]; ?></h2>
		<br>
		<h1><b>!!!CLIKKA O TAPPA PER MAGGIORE SUPPORTO!!!</b></h1>
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
	$('html, body').click(function() {
    	location.reload();
	}
	);

</script>
