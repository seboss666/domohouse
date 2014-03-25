function switchAction(Action, Data, Idx) {
	document.location.href = "index.php?page=switch&action=" + Action + "&data=" + Data + "&idx=" + Idx;
}

function check() {
	var msg = "";
	if (document.triForm.IP.value == "")	{
		msg += "Veuillez saisir l'adresse IP\n";
	}
	model = /^[0-9]{1,5}$/;
	if (document.triForm.Port.value.match(model) == null) {
		msg += "Le Port n'est pas au bon format";
		}
	//Si aucun message d'alerte a été initialisé on retourne TRUE
	if (msg == "") return(true);
	//Si un message d'alerte a été initialisé on lance l'alerte et renvoie FALSE
	else	{
		alert(msg);
		return(false);
  }
}