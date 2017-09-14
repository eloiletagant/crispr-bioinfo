<?php
include 'inc/header.php';
$data = $_SESSION['res'];
$seq = $_SESSION['seq'];
$paramValues = json_encode($_SESSION['paramValues']);

?>

<div class="container">

    <div id="content"></div>

    <div class="row">
     <div class="col s12">
       <ul class="tabs">
         <li class="tab col s4"><a id="tab1" class="active" href="#results">raw results</a></li>
         <li class="tab col s4"><a id="tab2" href="#filteredContent">filtered results</a></li>
         <li class="tab col s4"><a id="tab3" href="#plasmid">plasmid</a></li>
       </ul>
     </div>
     <div id="results" class="col s12">
         <table id="jsonTable"></table>
    </div>
     <div id="filteredContent" class="col s12">
         <table id="filteredJsonTable"></table>
     </div>
     <div id="plasmid" class="col s12">
         <table id="finalJsonTable"></table>
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
            ConvertJsonToTable(finalRes, 'finalJsonTable', null, 'Download')
        } else {
            $('#plasmid').append('Aucun résultat.')
        }

    }
});
</script>


<?php include 'inc/footer.php'; ?>
