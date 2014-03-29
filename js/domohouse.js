function addZero(val)
{
	if(val < 10)
	{
		val = "0" + val;
	}
	
	return val;
}

function date(id)
{
	var date = new Date;
	
	annee = date.getFullYear();
	
	moi = date.getMonth();
	mois = new Array('Janvier', 'F&eacute;vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&ucirc;t', 'Septembre', 'Octobre', 'Novembre', 'D&eacute;cembre');
	
	j = date.getDate();
	jour = date.getDay();
	jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');

	var resultat = jours[jour] + ' ' + j + ' ' + mois[moi] + ' ' + annee;
	document.getElementById(id).innerHTML = resultat;
	setTimeout('date("'+id+'");','1000');
	return true;
}

function heure(id)
{
	var date = new Date;
	
	h = date.getHours();	
	h = addZero(h);
	
	m = date.getMinutes();
	m = addZero(m);
	
	s = date.getSeconds();
	s = addZero(s);
	
	var resultat = h + ':' + m;
	document.getElementById(id).innerHTML = resultat;
	setTimeout('heure("'+id+'");','1000');
	return true;
}