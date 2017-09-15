<?php
include 'inc/header.php';
$data = $_SESSION['res'];
$seq = $_SESSION['seq'];
$paramValues = json_encode($_SESSION['paramValues']);

?>

<div class="container">

    <div id="content"></div>

    <div class="row">
     <div class="col s12" style="margin-bottom:20px;">
       <ul class="tabs">
         <li class="bg-grey tab col s3"><a id="tab1" class="active" href="#results">raw results</a></li>
         <li class="bg-grey tab col s3"><a id="tab2" href="#filteredContent">filtered results</a></li>
         <li class="bg-grey tab col s3"><a id="tab3" href="#sgrna">sgrna</a></li>
         <li class="bg-grey tab col s3"><a id="tab3" href="#plasmid">plasmid</a></li>
       </ul>
     </div>
     <div id="results" class="col s12 card-grey">
         <table id="jsonTable"></table>
    </div>
     <div id="filteredContent" class="col s12 card-grey">
         <table id="filteredJsonTable"></table>
     </div>
     <div id="sgrna" class="col s12 card-grey">
         <table id="finalJsonTable"></table>
    </div>
    <div id="plasmid" class="col s12 card-grey">
         <div class="row">
             <div class="col s12 center-align z-depth-5" style="padding-top: 10px; padding-bottom: 10px; background-color: #8bc34a;color: #ffffff" >Plasmid Viewer</div>
             <div class="input-field col m12" style="padding-top: 20px">
                 <select id="fichier">
                     <!--<option value="" disabled selected>Choose your option</option>-->
                     <option selected disabled value="">Choisir une option</option>
                     <option value="pEn_C1_1_modele.gb">pEn_C1_1_modele.gb - Vecteur de clonage pour E-coli</option><!-- vecteur pour e.coli contenant sweet 3-->
                     <option value="pDe_CAS9.gb">pDe_CAS9.gb - Plasmide Hôte possédant Cas9</option> <!-- hote de cas9 -->
                 </select>
                 <label>Specificity check</label>
             </div>
         </div>
         <div style="padding-bottom: 100px"></div>
         <div class="center-align" style="padding-bottom: 10px">
         <a target=_blank class="btn-large waves-effect waves-light orange" href="" id="url">Choisir une option</a></div>
         <div style="padding-bottom: 100px"></div>

    </div>
  </div>

</div>





<script>
$(document).ready(function () {

    //get data
    var data = '<?= $data ?>'
    var seq = '<?= $seq ?>'
    var paramValues = JSON.parse('<?= $paramValues ?>')
    for (var i = 0; i < paramValues.length; i++) {
        paramValues[i] = parseInt(paramValues[i])
    }

    // try to parse the response string (json)
    let done = false
    while (!done) {
        try {
            var json = JSON.parse(data);
            done = true
            $('#loader').css('display', 'none')
        } catch (e) {
            $('#loader').css('display', 'block')
        }
    }

    //manage different cases
    $('#content').empty()
    if (json.error !== "") {
        $('#content').text("Une erreur est survenue : " + json.error)
    } else if (json.results.length === 0) {
        $('#content').text("Aucun résultat trouvé")

    //if there are results
    } else {

        //first display raw results
        $('#content').html('<b>Espèce</b> : ' + json.specificity_check + '<br />')
        $('#content').append('<b>PAM sequence</b> : ' + json.pam_sequence)

        /*var res = $.grep(json.results, function(n, i) {
          return n.hit_20mer == '1' && n.hit_12mer == '1' && n.tttt == '0'
        });*/
        let res = json.results;

        if (res.length > 0) {
            ConvertJsonToTable(res, 'jsonTable', null, 'Download')
        } else {
            $('#content').append('Les résultats trouvés ne sont pas assez spécifiques.')
        }

        //then display filtered results
        var filteredJson = filter(seq, json.results, paramValues)

        if (filteredJson.length > 0) {
            ConvertJsonToTable(filteredJson, 'filteredJsonTable', null, 'Download')
        } else {
            $('#filteredContent').append('Aucun résultat après filtrage.')
        }

        //and finally display sgrna for plasmid construction
        var finalRes = buildPlasmid(filteredJson)
        if (finalRes.length > 0) {
            //make table
            ConvertJsonToTable(finalRes, 'finalJsonTable', null, 'Download')
            //make plasmid viewer
            $("#fichier").change(function(){
                var dbList = document.getElementById("fichier");
                var url = "https://designer.genomecompiler.com/plasmid_iframe?file_url=";
                var nom = dbList.options[dbList.selectedIndex].text;
                var url2 = url + /*location.host*/ "http://test.basicompta.fr" + "\/" + dbList.options[dbList.selectedIndex].value;
                $("#url").attr('href', url2).text(nom);
            })
        } else {
            $('#plasmid').append('Aucun résultat.')
        }

    }

});

</script>


<?php include 'inc/footer.php'; ?>
