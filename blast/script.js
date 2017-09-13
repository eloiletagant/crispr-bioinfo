function testBlast(){
	/*test function*/
	var seq = document.getElementById("input-seq"); //user sequence
	console.log(seq.value);
	// var db = document.getElementById("input-organism");
	var db = "nr";
	//var Tblast =
	blast(seq.value, db);
	console.log("Result that we are looking for : ", Tblast);
}

function blast(seq, db) {
	//blast execute a blastn through NCBI blast webservice thanks to a query sequence against a specified database
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
		//Get the results of the blast thanks to th RID
		if (rid !== undefined) {

			//Asking NCBI server for the blast results every 10 seconds
			var interval = setInterval (function() {
				//asking for the blast results
				r = getJSONResults(rid);
				console.log("R : " + r);
				//if we have results, stop the loop then retrun the JSON
				if (r !== undefined){
					console.log("End of the loop");
					clearInterval(interval); //stop the loop
					return r; //return the json string to the parent function (which is interval)
				}
			}, 10000)

		} else {
			console.log("RID is undefined");
		}
		return interval; //return the JSON string to the parent function (line 31 :/)
	}
}

function getJSONResults(rid) {
/*	This function ask NCBI server for a BLAST result;
	If the response is not "parsable", it means that NCBI servers don't have the blast resuls yet so we have to wait
	@param rid the request id
	@ return a json string containing blast results */
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "https://blast.ncbi.nlm.nih.gov/blast/Blast.cgi?CMD=Get&FORMAT_TYPE=JSON2_S&RID=" + rid, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			try {
				// try to parse the response string
				var resultJSON = JSON.parse(xhr.responseText);
				console.log("NCBI servers answered with the correct format, we now need to return these results");
				return resultJSON;
			} catch (e) {
				console.log("WAITING (blast results aren't available yet)");
			}
		}
	}
}
