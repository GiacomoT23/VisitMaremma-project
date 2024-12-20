var foto=new Array();
var descrizioni=new Array();
		/*src = "../img/immagine0.jpg"*/
foto[0]="../img/orbetello_da_argentario.jpg";
foto[1]="../img/colline_poggio_cavallo.jpg";
foto[2]="../img/panorama_scansano.jpg";
foto[3]="../img/rocca_montemassi.jpg";
foto[4]="../img/parco_maremma.jpg";

descrizioni[0]="Tombolo della Giannella visto dal Monte Argentario";
descrizioni[1]="Colline di Poggio Cavallo";
descrizioni[2]="Panorama nella zona di Scansano";
descrizioni[3]="Rocca di Montemassi";
descrizioni[4]="Foto dal Parco della Maremma";


var i=0;
var dim = 5;

function avanti(){
	i = (i+1)%dim;
	nextsrc = foto[i];
	document.getElementById('gallery').src = nextsrc;
	para = document.getElementById('p_desc');
	para.removeChild(para.firstChild);
	var node = document.createTextNode(descrizioni[i]);
	para.appendChild(node);
}
function indietro(){
	if(i==0)
		i=4;
	else
		i = (i-1)%dim;
	nextsrc = foto[i];
	document.getElementById('gallery').src = nextsrc;
	para = document.getElementById('p_desc');
	para.removeChild(para.firstChild);
	var node = document.createTextNode(descrizioni[i]);
	para.appendChild(node);	
}
	
function caricaImmagine(){
		document.getElementById('gallery').src = foto[0];
		para = document.getElementById('p_desc');
		var node = document.createTextNode(descrizioni[0]);
		para.appendChild(node);
}
