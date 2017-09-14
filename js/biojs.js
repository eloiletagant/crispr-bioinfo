var interval;
var seq ;


// MANIPULATION DE SEQUENCES

/*@ANATOLE*/
function getFirstHalf(seq){
	/*@return the fust half of the string*/
	return seq.substr(0, seq.lenght/2);
}



function getCDS(seq){
	/*	 the coding sequence from a sequence
	@return cds the codin suequence*/
}

// BLAST
function testBlast(){
	/*test function*/
	var seq = document.getElementById("input-seq"); //user sequence
	console.log(seq.value);
	// var db = document.getElementById("input-organism");
	var db = "nr";
	var x = blast(seq.value, db, function(resultJSON){
		console.log("nn", resultJSON);
		return (resultJSON);
	})
	// var Tblast = blast(seq.value, db);
}

function blast(seq, db, callback) {
	//BLaster execute un Blastn grace a une sequence/un locus ID en parametre et retourne un JSON des résultats
	//@param seq needs to be only composed by "ATCG" (checked earlier)
	//@param db id of the database

	var rid; //request id
	var r; //string (Blast output formatted in a json string)

	//Create en send the Blast POST request
	var data = "CMD=Put&PROGRAM=blastn&QUERY=" + seq + "&DATABASE=" + db;
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "https://blast.ncbi.nlm.nih.gov/blast/Blast.cgi", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(data);



	//Listenning to the XHR then get the RID from the xhr response.
	xhr.onload = function() {
		//GET RID DU POST
		const parser = new DOMParser();
		var response = xhr.responseText;
		var htmlDoc = parser.parseFromString(response, "text/xml");
		var ridObject = htmlDoc.getElementsByName("RID");
		rid = ridObject[0].defaultValue;
		console.log("RID :", rid);
		loopGetJSON(rid,
			function(resultJSON){
				if (resultJSON!==undefined){
					console.log("resultJSON", resultJSON);
					callback(resultJSON);
				}
			}
		);
	}
}




function loopGetJSON(rid, callback){
	/*	Loop getJSON until a result is found
	@param rid request id*/
	var i = 0;
	//Asking NCBI server for the blast results every 10 seconds
	interval = setInterval (function() {
		i ++;
		console.log(i)
		//asking for the blast results
		callback(getJSON(rid, function(resultJSON){
			if (resultJSON!==undefined){
				return resultJSON;
			}
		}))
	},10000)
}


function getJSON(rid, callback) {
	/*	This function ask NCBI server for a BLAST result;
	If the response is not "parsable", it means that NCBI servers don't have the blast resuls yet so we have to wait
	@param rid the request id
	@param cb th callback
	*/
	var xhr = new XMLHttpRequest();
	const url = "https://blast.ncbi.nlm.nih.gov/blast/Blast.cgi?CMD=Get&FORMAT_TYPE=JSON2_S&RID=" + rid;
	xhr.open("GET", url, true);
	console.log("url", url);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send();
	xhr.onload = function() {

		try {
			// try to parse the response string
			var resultJSON = JSON.parse(xhr.responseText);
			clearInterval(interval);
			callback(resultJSON);
		} catch (e) {
			console.log("WAITING");
		}
	}
}



// CRISPERDIRECTfmg


//TRI

function filter(seq, crisprOuput){
	/*	permet d'iterer sur  les rsultats de crisper direct et de ne conserver que ceux :
	- position : dans le premier moitiée
	- nombre de target (sp"cificité (le plus petit possible) <4
	- trie sur le TM (doit etre incLu entre 60 et 80) ; plus on est porche de 77 mieux c'es
	@param seq sequence d'origine
	@param crisprOutput l'output de criper plant
	@return json json trié dees resultats*/

	var posHalf = seq.lenght/2 //position du nt a la moitiée de la sequence d'input
	var nbrMaxTarget20 = 1 //nombr de repetition de la sequence sible dans le genome d'interet
	var nbrMaxTarget12 = 1
	var nbrMaxTarget8 = 1
	var nbrMaxMaxTarget20= 3 //cf plus haut
	var TMexpect = 76 //meilleur TM attendu
	var TMerror = 3 // marge d'erreur du le meilleur tm
	var TMmin = TMexpect - TMerror //minimum du tm
	var TMmax = TMexpect+ TMerror // maximum tu tm

	crisprOuput = JSON.parse(crisprOuput); //recuperation des resultats
	var rows = crisprOuput.results //seq brute
	var rows1 =rows
	var passe2 = false;
	var passe3 = false;


	console.log("JSON pas filtré", rows)

	for ( var row in rows){//PREMIERE PASSE - 20 nt
		if (row.end <= posHalf && //ôsition
			row.hit_20mer == nbrMaxTarget20  //nombr de target pour 20
			(row.tm>= TMmin && row.tm <= TMmax))  //temperature
			{
				console.log("row kept", row)//filtres respectés on keep
			}
			else{
				console.log("row deleted", row);
				delete rows1[row];
			}
		}

		var rows2=rows1;

		if (Object.keys(rows1).length == 0){ //Apres une premere loop on check si on a des results,
			passe2 = true;
			for (var row in rows1){//DEUXIEME PASSE 12NT
				if (row.end <= posHalf && //ôsition
					row.hit_12mer == nbrMaxTarget12  //nombr de target pour 20
					(row.tm>= TMmin && row.tm <= TMmax))  //temperature
					{	console.log("row kept", row)
				}else{
					console.log("row deleted", row);
					delete rows2[row]
				}
			}
		}

		var rows3 = rows2;

		if (Object.keys(rows2).length == 0){//Apres une dexuime loop on check si on a des results,
			passe3=true;
			for (var row in rows){//DEUXIEME PASSE 8NT
				if (row.end <= posHalf &&
					row.hit_8mer == nbrMaxTarget8
					(row.tm>= TMmin && row.tm <= TMmax))
					{	console.log("row kept", row)
				}else{
					console.log("row deleted", row);
					delete rows3[row]
				}
			}
		}

		//On regarde quelle passe on a éxécuté
		if(passe3){
			console.log("passe 3", rows3)
		}
		else if (passe2) {
			console.log("passe 2", rows2)
		}
		else {
			console.log("passe", rows)
		}
		console.log("JSON filtré", rows) //affichage du json filtré
	}


	function addExtremities(seq1, seq2) {
		/*	fonction qui ajoute des bouts comme n veut sur la seq + et lal seq -
		@return fullSeq a combinaison of seq 1 and seq2*/


		seq1 = "ATTG" + seq1;
		seq2 = seq2 + "CAAA";
		seq2 = seq2.split("").reverse().join("");

		var  fullSeq = [seq1, seq2];

		return fullSeq;
	}