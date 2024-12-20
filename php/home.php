<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "sessionUtil.php";
	if (isAdmin()){
		header('Location: ./luoghiAdmin.php');
		exit;
    }

?>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "PWEB">
		<link rel="stylesheet" href="./../css/menu.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/esploraLaMaremma.css" type="text/css" media="screen">
   	 	<link rel="shortcut icon" type="image/x-icon" href="./../css/img/favicon.ico" />
		<script  src="./../js/home.js"></script>	
		<meta name="viewport" content="width=device-width">
		<title>ViviLaMaremma - Home</title>
	</head>
	
	<?php
		echo '<body style="	background-color: rgb(255,255,140);" onload = "caricaImmagine()">';
			include DIR_LAYOUT . "menu.php";
	?>
	
	<script >
		document.getElementById("home_link").setAttribute("class", "selected_link");
	</script>
	
		<div class = "search_by_type">
			<a href = "luoghi.php?search_type=3">
				<img src = "../img/mare.jpg" alt = "mare">
			</a>
			<div class = "desc">Mare</div>
		</div>
		
		<div class = "search_by_type">
			<a href = "luoghi.php?search_type=4">
				<img src = "../img/montagna.jpg" alt = "montagna">
			</a>
			<div class = "desc">Montagna/Collina</div>
		</div>
		
		<div class = "search_by_type">
			<a href = "luoghi.php?search_type=5">
				<img src = "../img/storia.jpg" alt = "storia">
			</a>
			<div class = "desc">Storia/Archeologia</div>
		</div>
		
		<div class = "search_by_type">
			<a href = "luoghi.php?search_type=6">
				<img src = "../img/parco.jpg" alt = "parco">
			</a>
			<div class = "desc">Parco/Riserva</div>
		</div>

		
		<section id = "what_to_do">
			<h2 >Benvenuti</h2>				
				<p>Questo sito e' stato creato con lo scopo di promuovere le bellezze della Maremma grossetana. Qui potrai trovare luoghi da visitare basandoti sui tuoi interessi, potendo usufruire di una dettagliata descrizione luogo per luogo.
				Ci sono molteplici modi di ricerca, se invece vuoi semplicemente dare un'occhiata, consulta la lista completa dei luoghi.
				su 'luoghi'
				Potrai inoltre creare una lista dei luoghi che ti interessano in attesa di avere tempo per visitarli, o spuntare i luoghi gia' visitati per avere una panoramica
				dei posti in cui sei stato.
				Per una breve illustrazione puntuale delle funzioni del sito vedere il <a href = "../html/manuale.html">"Manuale utente"</a>.
				</p>
		</section>
		
		<hr style = "color:rgb(35, 54, 15);">
		
		<div class="row">
			<div class="column left">
				<h1 style = "text-align: center;">Cenni storici</h1>
				<p>Il toponimo Maremma deriva, per molti studiosi, dal latino maritima col il significato di "regioni costiere, zone di mare",
				anticamente nella forma di Maritima Regio. Una delle prime menzioni di "Marittima toscana" risale al 790 d.C. in epoca carolingia, 
				negli ultimi anni del Ducato di Tuscia.<br>Dante ne individuava i confini tra Cecina (Livorno) e Tarquinia (Viterbo), gi&agrave conosciuta come Corneto:<br><br>
				<q><cite>Non han s&igrave aspri sterpi n&eacute s&igrave folti<br>
				quelle fiere selvagge che 'n odio hanno<br>
				tra Cecina e Corneto i luoghi colti.</cite></q><br><br>
				Prima degli innumerevoli insediamenti medioevali, la Maremma ha conosciuto presenze preistoriche, etrusche e romane che hanno lasciato importanti testimonianze 
				storico-artistiche sparse nell'intero territorio.Gli Etruschi costruirono numerose citt&agrave che ebbero il periodo di massimo splendore intorno al VII secolo a.C., 
				delle quali rimangono numerosi resti archeologici di elevato interesse. Importanti furono le citta' etrusche di Populonia, Roselle e Vetulonia. Quest'ultima, appartenente alla 
				Dodecapoli etrusca, fu una delle prime a battere moneta, il vat. In epoca altomedievale la Maremma registra la presenza di una delle famiglie nobili 
				piu' importanti dell'Italia centrale, quella dei conti Aldobrandeschi, di probabile origine longobarda. Ildebrando di Soana, nel 1073, a furor 
				di popolo, viene addirittura eletto Papa con il nome di Gregorio VII. Un Papa "maremmano". I conti Aldobrandeschi sono ricordati anche per essere stati padroni di circa 100 castelli, 
				a testimonianza dello sviluppo di questa zona e del grado di conurbamento di queste terre, soprattutto nella fascia collinare, istituendo una prospera 
				economia curtense, basata sulla "corte", (in latino curtis) l'insieme di ville ed edifici dove il signore soggiornava ed espletava le sue funzioni di 
				controllo sul territorio.<br><br>
				Con la fine del feudalesimo e soprattutto con l'affermarsi delle signorie, la Maremma nel XIII secolo cade sotto l'influenza della Repubblica di Siena 
				che dopo pochi anni conquista militarmente anche Grosseto e trasforma la Maremma in un enorme pascolo a pagamento. Per lo sfruttamento dei pascoli viene 
				istituita la "Dogana dei paschi", da cui trae origine il Monte dei paschi di Siena, famosa banca. Il territorio maremmano, grazie al clima mite e alla 
				precoce primavera attira i transumanti del centro Italia: tuttavia la perdita dell'indipendenza e l'assoggettamento all'economia di sfruttamento di 
				Siena distruggera' l'economia locale e comportera' l'abbandono del territorio coltivato, con l'inevitabile aumento delle terre paludose. A partire dal 
				XIV secolo infatti la presenza dell'uomo in questa regione dovra' sempre piu' fare i conti con la malaria e la poverta', che saranno il tratto saliente 
				con cui sara' nota per molti secoli la Maremma, che di fatto finiranno soltanto con l'avvento delle pompe idrauliche a motore a cavallo della seconda 
				guerra mondiale, con le bonifiche avviate dal regime fascista e concluse con una poderosa opera dell'Ente Maremma a meta' degli anni '50 del secolo 
				scorso.
				</p>
			</div>
			<div class="column right">
				<h1 style = "text-align: center;"> Breve descrizione della Maremma</h1>
				<p>La Maremma  e' una vasta regione geografica compresa fra Toscana e Lazio, di circa 5000 km^2, che si affaccia 
				sul Mar Tirreno. Oltre a una parte centrale, corrispondente alla provincia di Grosseto fino alle pendici del Monte Amiata e delle Colline 
				Metallifere e fino alla media valle dell'Ombrone (Maremma Grossetana e, nella parte interna, Maremma Senese), comprende la fascia costiera 
				tra Piombino e il Cecina (Maremma Pisana, prov. di Livorno) e si spinge nel Lazio fin verso Civitavecchia. Il territorio e' in prevalenza 
				pianeggiante e alluvionale, ma in parte anche collinare.
				Erroneamente, spesso viene considerata Maremma soltanto quella grossetana, a causa della maggiore notorieta'.La Maremma e' un territorio 
				vasto e dai confini difficilmente definibili che si affaccia sul Mar Tirreno. Convenzionalmente, il territorio maremmano e' suddiviso in tre 
				zone, da nord a sud:<br><br>
				L'Alta Maremma o Maremma Settentrionale, interessa gran parte della provincia di Livorno e alcune aree pedecollinari della provincia di 
				Pisa, che si estendono nella parte settentrionale lungo la costa e l'immediato entroterra tra Rosignano Marittimo e Piombino, comprendente 
				le prime propaggini collinari della Val di Cecina, della Val di Cornia e del versante nord-occidentale delle Colline Metallifere.
				<br><br>La Maremma Grossetana, o Maremma propriamente detta, e' la parte centrale compresa nella provincia di Grosseto, lungo la costa tra il golfo 
				di Follonica e la foce del torrente Chiarone che si getta in mare a sud del promontorio dell'Argentario e comprende anche la bassa Valle 
				dell'Ombrone. Generalmente, il toponimo viene localmente esteso anche ad aree collinari interne, geograficamente non annoverabili nella 
				Maremma, come ad esempio le Colline Metallifere grossetane, le Colline dell'Albegna e del Fiora e l'Area del Tufo, fino a terminare di 
				fronte alla vasta area delle alture del monte Amiata. Tra le localita' principali Grosseto, Follonica, Castiglione della Pescaia, Porto 
				Santo Stefano e Orbetello, oltre a Massa Marittima che ha il centro storico nell'area delle Colline Metallifere ma buona parte del 
				territorio comunale geograficamente inclusa nella Maremma.
				La Maremma Grossetana si divide da nord a sud in quattro parti:<br>
				<ul>
				<li>La piana del fiume Pecora, attorno al golfo di Follonica, comprendente gran parte del territorio comunale di Follonica, l'area 
				pianeggiante dei comuni di Massa Marittima e Gavorrano e la fascia costiera del comune di Scarlino, limitata a sud dal promontorio 
				di Punta Ala.</li>
				
				<li>La piana del fiume Ombrone, che occupa i territori comunali di Castiglione della Pescaia e Grosseto, la parte meridionale dei comuni 
				di Gavorrano e Roccastrada e il tratto costiero, pianeggiante e pedecollinare del comune di Magliano in Toscana. Si estende tra il 
				promontorio di Punta Ala e i Monti dell'Uccellina e comprende la riserva naturale Diaccia Botrona.</li>
				
				<li>La piana del fiume Albegna, che interessa i comuni di Orbetello e la parte pianeggiante dei comuni di Magliano in Toscana e Manciano. 
				Si estende tra i Monti dell'Uccellina e il promontorio di Ansedonia e comprende il promontorio dell'Argentario e la Laguna di Orbetello.</li>
				
				<li>La piana del fiume Fiora, compresa tra il territorio comunale di Capalbio e il Lazio. Si estende oltre il promontorio di Ansedonia e non 
				presenta soluzioni di continuita' con la Maremma laziale; comprende il Lago di Burano.</li>
				</ul>
				<br>
				Maremma laziale, la parte meridionale, si estende nella parte occidentale della provincia di Viterbo e all'estremita' nord-occidentale 
				della provincia di Roma (Lazio), lungo la costa dell'Alto Lazio e nell'immediato retroterra pianeggiante e pedecollinare della Tuscia, 
				tra la foce del torrente Chiarone e Capo Linaro, promontorio che costituisce l'appendice occidentale dei Monti della Tolfa che la 
				dividono dall'Agro romano.<br><br>
				
				<q>La parola maremma nasce con la emme minuscola perche' sta a indicare una qualsiasi regione bassa e paludosa vicina al mare dove i tomboli, 
				ovvero le dune, ovvero i cordoni di terra litoranea, impediscono ai corsi d'acqua di sfociare liberamente in mare provocandone il ristagno.
				Con il risultato di creare acquitrini, paludi. Non Maremma, allora, bensi' maremma. E siccome la maremma piu' vasta della penisola, la piu' 
				nota, la piu' micidiale, quella dove la malaria ha imperversato spietata per secoli interi, era la zona costiera della Toscana meridionale 
				e del Lazio occidentale, al punto che nella storia della medicina, e anche della letteratura popolare, la malaria lego' il suo nome, il 
				teatro delle sue rabbrividenti nefandezze, a questo territorio, la maremma tosco-laziale prese la emme maiuscola. Divenne Maremma per 
				indicare la regione abitata un tempo dagli Etruschi. Una regione cosi' grande che Maremma passo' ben presto al plurale. Si parlo' di Maremme.</q>
				(Aldo Santini)
				</p>
			</div>
		</div>
		
		<hr>
		
		<div id = "gallery_container">
			<img id = "gallery" alt = "immagine0">
		</div>
			<button id = "button_image_left" onclick = "indietro()" >Indietro</button>
			<button id = "button_image_right" onclick = "avanti()" >Avanti</button>
		<div id ="descrizione">
			<p id = "p_desc"></p>		
		</div>
		<?php
			include DIR_LAYOUT . "footer.php";
		?>
		
	
		
	</body>
</html>