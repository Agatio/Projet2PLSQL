var txtLogin = document.getElementById("login");
//txtLogin.addEventListener("onkeyup",txtLogin_onKeyUp,false);

/*function txtLogin_onKeyUp()
{
	if(txtLogin.value!="")
	{
		var xhr = null;
		if (window.XMLHttpRequest)
		{
			xhr = new XMLHttpRequest();
		}
		else
		{
			if (window.ActiveXObject)
			{
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
			else
			{
				alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
			}
		}
		if (xhr != null)
		{
			xhr.onreadystatechange = function() {traiter_reponse(xhr)};
			xhr.open("POST", "index.php?section=user&action=verif&login="+txtLogin.value, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			var data = txtLogin.value;
			xhr.send(data);
		}
	}
}

function traiter_reponse (xhr)
{
	if (xhr.readyState == 4)
	{
		if (xhr.status == 200)
		{
			var anc = document.getElementById("message");
			var par=document.getElementById("p");
			var d=document.getElementById("div");
			if (anc != null && par!=null)
			{
				d.remove(0);
				par.remove(0);
				anc.remove(0);
			}
			
			//var mes=document.createElement("section");
			var p=document.createElement("div");
			p.setAttribute("id","div");
			//mes.appendChild(p);
			//mes.setAttribute("id","message");
			//mes.setAttribute("class","message");
			var sec=document.getElementById("form");
			document.body.insertBefore(p,sec);
			
			p.innerHTML=xhr.responseText;
			
			fonc();
			
		}
		else
		{
			alert("Le serveur a retourné l'erreur " + xhr.status);
		}
	}
	txtLogin.focus();
}*/

txtLogin.onkeyup = txtLogin_onKeyUp;
txtLogin_onKeyUp();

var mdp=document.getElementById("mdp");
var mdp_verif=document.getElementById("mdp_verif");

/*function txtMdp()
{
	if(mdp_verif.value!="" && mdp.value!="")
	{
		var xhr = null;
		if (window.XMLHttpRequest)
		{
			xhr = new XMLHttpRequest();
		}
		else
		{
			if (window.ActiveXObject)
			{
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
			else
			{
				alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
			}
		}
		if (xhr != null)
		{
			xhr.onreadystatechange = function() {traiter_mdp(xhr)};
			xhr.open("POST", "index.php?section=user&action=verif_m&mdp="+mdp.value+"&mdp_verif="+mdp_verif.value, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			var data = mdp_verif.value;
			xhr.send(data);
		}
	}
}

function traiter_mdp(xhr)
{
	if (xhr.readyState == 4)
	{
		if (xhr.status == 200)
		{
			var anc = document.getElementById("message");
			var par=document.getElementById("p");
			var d=document.getElementById("div");
			if (anc != null && par!=null)
			{
				d.remove(0);
				par.remove(0);
				anc.remove(0);
			}
			
			//var mes=document.createElement("section");
			var p=document.createElement("div");
			p.setAttribute("id","div");
			//mes.appendChild(p);
			//mes.setAttribute("id","message");
			//mes.setAttribute("class","message");
			var sec=document.getElementById("form");
			document.body.insertBefore(p,sec);
			
			p.innerHTML=xhr.responseText;
			
			fonc();
		}
		else
		{
			alert("Le serveur a retourné l'erreur " + xhr.status);
		}
	}
}*/

function traiter_reponse(jqXHR)
{
	var anc = document.getElementById("message");
			var par=document.getElementById("p");
			var d=document.getElementById("div");
			if (anc != null && par!=null)
			{
				d.remove(0);
				par.remove(0);
				anc.remove(0);
			}
			var p=document.createElement("div");
			p.setAttribute("id","div");
			var sec=document.getElementById("form");
			document.body.insertBefore(p,sec);
			
			p.innerHTML=jqXHR;
			
			fonc();
}

function traiter_mdp(jqXHR)
{
	var anc = document.getElementById("message");
			var par=document.getElementById("p");
			var d=document.getElementById("div");
			if (anc != null && par!=null)
			{
				d.remove(0);
				par.remove(0);
				anc.remove(0);
			}
			
			//var mes=document.createElement("section");
			var p=document.createElement("div");
			p.setAttribute("id","div");
			//mes.appendChild(p);
			//mes.setAttribute("id","message");
			//mes.setAttribute("class","message");
			var sec=document.getElementById("form");
			document.body.insertBefore(p,sec);
			
			p.innerHTML=jqXHR;
			
			fonc();
}

function txtLogin_onKeyUp()
{
	$.ajax({
		type : "POST",
		url : "index.php?section=user&action=verif&login="+txtLogin.value,
		success : function(msg){traiter_reponse(msg)}
		//failure : function(){alert("Le serveur a retourné l'erreur " + jqXHR.status);}
	});
}

function txtMdp()
{
	$.ajax({
		type : "POST",
		url : "index.php?section=user&action=verif_m&mdp="+mdp.value+"&mdp_verif="+mdp_verif.value,
		success : function(msg){traiter_mdp(msg)}
		//failure : function(){alert("Le serveur a retourné l'erreur " + jqXHR.status);}
	});
}

mdp_verif.onkeyup=txtMdp;
mdp.onkeyup=txtMdp;
txtMdp();