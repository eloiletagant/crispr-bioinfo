<?php
include 'inc/header.php';
//reset $session res to avoid get last query res
$_SESSION['res'] = 'NULL';
?>

    <div class="container">

      <form method="POST" action="">
           <div class="row">
             <form class="col s12">
                 <div class="card row" style="margin-top: 50px;">
                     <div class="input-field col m12">
                        <select id="species">
                          <!--<option value="" disabled selected>Choose your option</option>-->
                          <option value="TAIR10" selected>Thale cress (Arabidopsis thaliana) genome, TAIR10 (Nov, 2010)</option>
                          <option value="IGGP_12x">Grape (Vitis vinifera) genome, IGGP_12x (Jun, 2011)</option>
                          <option value="hg19">Human (Homo sapiens) genome, GRCh37/hg19 (Feb, 2009)</option>
                        </select>
                        <label>Specificity check</label>
                      </div>

                     <div class="input-field col s12">
                       <textarea id="seq" name="seq" class="materialize-textarea" placeholder="ATGGGTGATAAACTTCGATTATCCATCGGAATTTTGGGAAACGGAGCTTCTCTGTTGCTATATACAGCTCCAATAGTAACATTTTCAAGGGTGTTTAAGAAGAAAAGCACAGAGGAATTCTCATGTTTTCCTTACGTTATGACACTCTTTAACTGTTTGATATATACTTGGTACGGTTTACCGATTGTGAGTCATCTTTGGGAGAATCTTCCTCTCGTCACCATTAATGGAGTCGGCATCCTTCTCGAATCTATCTTCATTTTCATATATTTCTACTACGCATCACCAAAAGAAAAGATTAAGGTTGGTGTTACATTTGTTCCGGTGATCGTTGGGTTCGGCTTAACGACAGCAATCTCAGCCTTGGTATTTGACGACCATCGTCACCGAAAATCATTCGTCGGAAGTGTTGGCCTCGTGGCTTCCATCTCTATGTATGGTTCTCCTCTCGTCGTTATGAAGAAAGTGATAGAGACAAGAAGTGTGGAATACATGCCGTTTTACTTGTCCTTCTTCTCATTTCTGGCTAGTTCCCTTTGGTTGGCATATGGCTTACTCAGCCATGATCTCTTTCTTGCGTCACCTAATATGGTTGCGACTCCATTGGGAATTCTCCAACTTATCCTCTACTTCAAGTACAAGAATAAGAAGGATTTAGCACCAACAACAATGGTGATCACCAAACGAAATGATCATGATGACAAGAACAAAGCCACACTTGAGTTTGTTGTTGACGTTGATCGTAATAGTGATACCAATGAGAAGAATTCTAACAATGCCTCATCGATCTAA"></textarea>
                       <label for="seq">Paste a nucleotide sequence</label>
                     </div>
                 </div>
                 <div class="card row">
                     <div class="input-field col s6">
                        <input placeholder="1" id="nbrMaxTarget20" type="number" class="validate">
                        <label for="first_name">Nb max de régions homologues au sgRNA de 20nt</label>
                     </div>
                     <div class="input-field col s6">
                        <input placeholder="1" id="nbrMaxTarget12" type="number" class="validate">
                        <label for="first_name">Nb max de régions homologues au sgRNA de 12nt</label>
                     </div>
                     <div class="input-field col s6">
                        <input placeholder="1" id="nbrMaxTarget8" type="number" class="validate">
                        <label for="first_name">Nb max de régions homologues au sgRNA de 8nt</label>
                     </div>
                     <div class="input-field col s3">
                        <input placeholder="75" id="TMexpect" type="number" class="validate">
                        <label for="first_name">Meilleur Tm attendu (°C)</label>
                     </div>
                     <div class="input-field col s3">
                        <input placeholder="6" id="TMerror" type="number" class="validate">
                        <label for="first_name">Marge d'erreur sur le Tm (°C)</label>
                     </div>
                 </div>

             </form>
           </div>

           <div class="row center">
             <a id="submit_seq" href="res.php" type="submit" class="btn-large waves-effect waves-light orange">Envoyer</a>
           </div>
      </form>

    </div>


<script>
    $('#submit_seq').click(function() {

        var seq = $('#seq').val()
        if (seq === '') {
            seq = document.getElementById('seq').placeholder
        }
        console.log('seq', seq)
        var dbList = document.getElementById("species")
        var db = dbList.options[dbList.selectedIndex].value
        $.ajax({
            type: "POST",
            url: "some.php",
            data:{
                seq: seq,
                db: db
            }
        });

    })
</script>

<?php include 'inc/footer.php'; ?>
