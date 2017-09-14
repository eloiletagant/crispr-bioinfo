<?php
include 'inc/header.php';
$data = $_SESSION['res'];
$seq = $_SESSION['seq'];
var_dump($seq);
?>

<div class="container">

    <div class="row">
     <div class="col s12">
       <ul class="tabs">
         <li class="tab col s4"><a id="tab1" class="active" href="#results">raw results</a></li>
         <li class="tab col s4"><a id="tab2" href="#filteredContent">filtered results</a></li>
         <li class="tab col s4"><a id="tab3" href="#div3">plasmid</a></li>
       </ul>
     </div>
     <div id="results" class="col s12">
         <div id="content"></div>
         <table id="jsonTable"></table>
    </div>
     <div id="filteredContent" class="col s12">
         <table id="filteredJsonTable"></table>
     </div>
     <div id="div3" class="col s12"></div>
   </div>


</div>

<script>
$(document).ready(function () {
    //"{"error":"","pam_sequence":"NGG","program_name":"CRISPRdirect","results":[],"sequence_name":"","specificity_check":"Human (Homo sapiens) genome, GRCh37/hg19 (Feb, 2009)","time":"2017-09-12 00:58:22"}"

    var data = '<?= $data ?>'
    var seq = '<?= $seq ?>'
    console.log(seq)
    //console.log(data)
    let done = false
    while (!done) {
        try {
            // try to parse the response string
            var json = JSON.parse(data);
            done = true
            $('#loader').css('display', 'none')
        } catch (e) {
            $('#loader').css('display', 'block')
        }
    }

    $('#content').empty()
    if (json.error !== "") {
        $('#content').text("Une erreur est survenue : " + json.error)
    } else if (json.results.length === 0) {
        $('#content').text("Aucun résultat trouvé")

    } else {
        //first display raw results
        $('#content').html('Espece : ' + json.specificity_check + '<br />')
        $('#content').append('PAM sequence : ' + json.pam_sequence)

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
        var filteredJson = filter(seq, json.results)

        if (filteredJson.length > 0) {
            ConvertJsonToTable(filteredJson, 'filteredJsonTable', null, 'Download')
        } else {
            $('#filteredContent').append('Aucun résultat après filtrage.')
        }
    }
});
</script>


<?php include 'inc/footer.php'; ?>
