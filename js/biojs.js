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

function filter(seq, crisprOuput, paramValues){
	/*	permet d'iterer sur  les rsultats de crisper direct et de ne conserver que ceux :
	- position : dans le premier moitiée
	- nombre de target (sp"cificité (le plus petit possible) <4
	- trie sur le TM (doit etre incLu entre 60 et 80) ; plus on est porche de 77 mieux c'es
	@param seq sequence d'origine
	@param crisprOutput l'output de criper plant
	@return json json trié dees resultats*/

	var posHalf = seq.length/2 //position du nt a la moitiée de la sequence d'input

	var nbrMaxTarget20 = paramValues[0] //nombr de repetition de la sequence sible dans le genome d'interet
	var nbrMaxTarget12 = paramValues[1]
	var nbrMaxTarget8 = paramValues[2]
	var TMexpect = paramValues[3] //meilleur TM attendu
	var TMerror = paramValues[4] // marge d'erreur du le meilleur tm
	var TMmin = TMexpect - TMerror //minimum du tm
	var TMmax = TMexpect + TMerror // maximum tu tm

	try {
		crisprOuput = JSON.parse(crisprOuput); //recuperation des resultats
	} catch (e) {
		console.log('slt')
	}
	var rows = crisprOuput //seq brute
	var rowsFiltred = [];
	var passe2 = false;
	var passe3 = false;


	console.log("JSON pas filtré", rows)

	for ( var i in rows){//PREMIERE PASSE - 20 nt
		// console.log("bite", rows[i]);
		// console.log("end", rows[i].end);
		// console.log("hit_20mer", rows[i].hit_20mer);
		// console.log("tm", rows[i].tm);
		if (rows[i].end <= posHalf && //ôsition
			(rows[i].hit_20mer <= nbrMaxTarget20 && rows[i].hit_20mer != 0) &&   //nombr de target pour 20
			(rows[i].tm>= TMmin && rows[i].tm <= TMmax))  //temperature
			{
				console.log("1row kept", rows[i])//filtres respectés on keep
				rowsFiltred.push(rows[i]);
			}
		}

		console.log("leght passe 1",Object.keys(rowsFiltred).length);
		if (Object.keys(rowsFiltred).length == 0){ //Apres une premere loop on check si on a des results,
			console.log("deuxieme passe");
			passe2 = true;
			for (var i in rows){//DEUXIEME PASSE 12NT

				if (rows[i].end <= posHalf && //ôsition
					(rows[i].hit_12mer <= nbrMaxTarget12 && rows[i].hit_12mer != 0) &&
					(rows[i].tm>= TMmin && rows[i].tm <= TMmax))  //temperature
					{	console.log("2row kept", rows[i])
					rowsFiltred.push(rows[i])
				}
			}
		}

		if (Object.keys(rowsFiltred).length == 0){//Apres une dexuime loop on check si on a des results,
			passe3=true;
			console.log("troisieme passe");
			for (var i in rows){//DEUXIEME PASSE 8NT
				if (rows[i].end <= posHalf &&
					(rows[i].hit_8mer <= nbrMaxTarget8 && rows[i].hit_8mer != 0) &&
					(rows[i].tm>= TMmin && rows[i].tm <= TMmax))
					{	console.log("3row kept", rows[i])
					rowsFiltred.push(rows[i])
				}
			}
		}


		console.log("JSON filtré", rowsFiltred) //affichage du json filtré
		return rowsFiltred;
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


	function buildPlasmid(filteredJSON) {
		// a partir d'un json filtré de sgrna
		// créer pour chaque resultat,  le brin + et le brin -
		// les ajoute au json et renvoi le tout
		// @param filterdJson le tableau detruncs filtré
		// @return finalJsonl eJson avec les brins + et -
		var seq;
		var v;
		var finalJSON = filteredJSON
		for ( i  in finalJSON){
			seq = finalJSON[i].sequence
			seqStrand = finalJSON[i].strand
			console.log("seq",seq)
			console.log("strand",seqStrand)

			if (seqStrand>0){//si le brun qu'on a est le plus
				v = addExtremities(seq, seq.split("").reverse().join(""))
			}
		else {//sile brin est le -
			v = addExtremities(seq.split("").reverse().join(""), seq)
		}
		finalJSON[i].sequence = v[0] +"<br>"+v[1]
	}
	return finalJSON
}
