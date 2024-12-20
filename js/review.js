var MAX_CHAR = 1000; // inizializzato la prima volta


function ContaCaratteri()
{
    document.getElementById("counter").value = MAX_CHAR - document.getElementById("my_review").value.length;
    if (document.getElementById("my_review").value.length > MAX_CHAR){
		document.getElementById("my_review").value = document.getElementById("my_review").value.replace(/\s+/g, " ");
		if (document.getElementById("my_review").value.length > MAX_CHAR)
		{
			document.getElementById("my_review").value = document.getElementById("my_review").value.substr(0, MAX_CHAR);
			document.getElementById("counter").value = 0;
			document.getElementById("review_message").innerHTML = "massimo "+MAX_CHAR+" caratteri";
		}
	}
}
