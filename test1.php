<?php include 'inc/header.php';
$data = $_SESSION['res'];
?>

<div class="container">
    <br /><br /><br />
    <div id="content">
    </div>
    <table id="jsonTable">
    </table>
</div>

<script src="js/tablebuilder.js"></script>

<script>
$(document).ready(function () {
    //"{"error":"","pam_sequence":"NGG","program_name":"CRISPRdirect","results":[],"sequence_name":"","specificity_check":"Human (Homo sapiens) genome, GRCh37/hg19 (Feb, 2009)","time":"2017-09-12 00:58:22"}"

    var data = '<?= $data ?>'
    //console.log(data)
    var json = JSON.parse(data);
    console.log(json)
    if (json.error !== "") {
        $('#content').text("Une erreur est survenue : " + json.error)
    } else if (json.results.length === 0) {
        $('#content').text("Aucun résultat trouvé")

    } else {
        $('#content').html('PAM sequence : ' + json.pam_sequence + '<br />')
        $('#content').append('Espece : ' + json.specificity_check)


        ConvertJsonToTable(json.results, 'jsonTable', null, 'Download');
        /*for (var i = 0; i < data.results.length; i++) {
            data.results[i]
        }*/
    }
});
</script>


<?php include 'inc/footer.php'; ?>
