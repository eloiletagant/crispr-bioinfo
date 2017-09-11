<?php
session_start();
$data = $_SESSION['res'];
?>

<script>

//"error":"","pam_sequence":"NGG","program_name":"CRISPRdirect","results":[],"sequence_name":"","specificity_check":"Human (Homo sapiens) genome, GRCh37/hg19 (Feb, 2009)","time":"2017-09-11 19:49:48"}
//{"end":"26","gc":"75.00","hit_12mer":"3","hit_20mer":"1","hit_8mer":"103","resite":["Bme1580I"],"sequence":"ccgcgcgtcgtgcccgaccagag","start":"4","strand":"-","tm":"82.34","tttt":"0"}

    $('#content').empty()
    var data = '<?= $data ?>'
    if (data.error !== '') {
        $('#content').text(data.error)
    } else {
        $('#content').text('PAM sequence : ' + data.pam_sequence + '<br />')
        for (var i = 0; i < data.results.length; i++) {
            data.results[i]
        }
    }

</script>

<div id="content">

</div>


<?php include 'inc/jsfiles.php'; ?>
