<?php
include 'inc/header.php';
$data = $_SESSION['res'];
?>

<div class="container">
    <br /><br /><br />

<div class="center-align">
    <div id="loader" class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
</div>


    <div id="content">
    </div>
    <table id="jsonTable"></table>
</div>

<script src="js/tablebuilder.js"></script>

<script>
$(document).ready(function () {
    //"{"error":"","pam_sequence":"NGG","program_name":"CRISPRdirect","results":[],"sequence_name":"","specificity_check":"Human (Homo sapiens) genome, GRCh37/hg19 (Feb, 2009)","time":"2017-09-12 00:58:22"}"

    var data = '<?= $data ?>'
    console.log(data)
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
    console.log(json)



    console.log(json)
    if (json.error !== "") {
        $('#content').text("Une erreur est survenue : " + json.error)
    } else if (json.results.length === 0) {
        $('#content').text("Aucun résultat trouvé")

    } else {
        $('#content').html('PAM sequence : ' + json.pam_sequence + '<br />')
        $('#content').append('Espece : ' + json.specificity_check)

        var res = $.grep(json.results, function(n, i) {
          return n.hit_20mer == '1' && n.hit_12mer == '1' && n.tttt == '0'
        });

        if (res.length > 0) {
            ConvertJsonToTable(res, 'jsonTable', null, 'Download')
        } else {
            $('#content').append('Les résultats trouvés ne sont pas assez spécifiques.')
        }



    }
});
</script>


<?php include 'inc/footer.php'; ?>
