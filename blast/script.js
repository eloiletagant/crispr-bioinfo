function testBlast(){
	var seq = document.getElementById("input-seq");
	console.log(seq.value);
	// var db = document.getElementById("input-organism");
	var db = "nr";
	var Tblast = blast(seq.value, db);

	console.log("jaison", Tblast);

}

var resultJSON = undefined;

function blast(seq, db) {
	//BLaster execute un Blastn grace a une sequence/un locus ID en parametre et retourne un JSON des résultats
	//@param seq doit etre en majuscule et ne contenir que des ATCG
	//@param db corresponda un id d'organism (voir liste blast)


	//ENVOYER LA REQUETTE
	var data = "CMD=Put&PROGRAM=blastn&QUERY=" + seq + "&DATABASE=" + db;
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "https://blast.ncbi.nlm.nih.gov/blast/Blast.cgi", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(data);

	var rid = undefined; //request id
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			//GET RID DU POST
			var response = (xhr.responseText);
			var parser = new DOMParser();
			var htmlDoc = parser.parseFromString(response, "text/xml");
			var ridObject = htmlDoc.getElementsByName("RID");
			rid = ridObject[0].defaultValue;
			console.log("RID :", rid);
		}

		//RECUPERER LES INFO
		if (rid !== undefined) {

			//interogation du serveur en loop, exit quand result
			var interval = setInterval (function() {							//toutes les 10 secondes on execute :
				getJSONResults(rid);
				var r = resultJSON;
				console.log("R : " + r);
				if (r !== undefined){
					console.log("FIN DE LA BOUCLE");
					clearInterval(interval);
					return r;
				}
			}, 10000)

		} else {
			console.log("RID is undefined");
		}

		return interval;

	}
}

//RECUPERATION DE LA PAGE RESULTAT
function getJSONResults(rid) {

	var xhr = new XMLHttpRequest();
	xhr.open("GET", "https://blast.ncbi.nlm.nih.gov/blast/Blast.cgi?CMD=Get&FORMAT_TYPE=JSON2_S&RID=" + rid, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			try {
				//PARSING DE LA PAGE
				resultJSON = JSON.parse(xhr.responseText);
				console.log("On a trouvé un  resultat, on cherche a le return");
				//return resultJSON;
			} catch (e) {
				console.log("WAITING");
			}
		}
	}
}
