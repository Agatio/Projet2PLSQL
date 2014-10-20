var txtName = document.getElementById("name");


function txtName_onKeyUp()
{
	$.ajax({
		type : "POST",
		url : "index.php?section=ville&action=verif_v&name="+txtName.value,
		success : function(msg){traiter_reponse(msg)}
		//failure : function(){alert("Le serveur a retourné l'erreur " + jqXHR.status);}
	});
}

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
			var sec=document.getElementById("formville");
			document.body.insertBefore(p,sec);
			
			p.innerHTML=jqXHR;
			
			fonc();
}

txtName.onkeyup = txtName_onKeyUp;
txtName_onKeyUp();