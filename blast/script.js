var interval;
var seq;
var seq.lenght;

// MANIPULATION DE SEQUENCES

 

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
	//@return a json string containinn blast results

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

						//trie
						//ajout au 
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
				console.log("WAITING (blast results aren't available yet)");
			}
		}
	}



// CRISPERPLANT
