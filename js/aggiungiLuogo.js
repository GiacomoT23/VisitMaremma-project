var MAX_CHAR = 6000; // inizializzato la prima volta


function ContaCaratteri()
{
    document.getElementById("counter").value = MAX_CHAR - document.getElementById("descrizione").value.length;
    if (document.getElementById("descrizione").value.length > MAX_CHAR){
		document.getElementById("descrizione").value = document.getElementById("descrizione").value.replace(/\s+/g, " ");
		if (document.getElementById("descrizione").value.length > MAX_CHAR)
		{
			document.getElementById("descrizione").value = document.getElementById("descrizione").value.substr(0, MAX_CHAR);
			document.getElementById("counter").value = 0;
			document.getElementById("aggiungi_luogo_message").innerHTML = "massimo "+MAX_CHAR+" caratteri";
		}
	}
}