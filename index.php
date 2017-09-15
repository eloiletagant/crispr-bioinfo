<?php
include 'inc/header.php';
//reset $session res to avoid get last query res
$_SESSION['res'] = 'NULL';
?>

    <div class="container">
      <form method="POST" action="">
           <div class="row">
             <form class="col s12">
                  <h3>INPUTS</h3>
                  <div class="card-grey row">
                     <div class="input-field col s12">
                       <textarea id="seq" name="seq" class="materialize-textarea" placeholder="ATGGGTGATAAACTTCGATTATCCATCGGAATTTTGGGAAACGGAGCTTCTCTGTTGCTATATACAGCTCCAATAGTAACATTTTCAAGGGTGTTTAAGAAGAAAAGCACAGAGGAATTCTCATGTTTTCCTTACGTTATGACACTCTTTAACTGTTTGATATATACTTGGTACGGTTTACCGATTGTGAGTCATCTTTGGGAGAATCTTCCTCTCGTCACCATTAATGGAGTCGGCATCCTTCTCGAATCTATCTTCATTTTCATATATTTCTACTACGCATCACCAAAAGAAAAGATTAAGGTTGGTGTTACATTTGTTCCGGTGATCGTTGGGTTCGGCTTAACGACAGCAATCTCAGCCTTGGTATTTGACGACCATCGTCACCGAAAATCATTCGTCGGAAGTGTTGGCCTCGTGGCTTCCATCTCTATGTATGGTTCTCCTCTCGTCGTTATGAAGAAAGTGATAGAGACAAGAAGTGTGGAATACATGCCGTTTTACTTGTCCTTCTTCTCATTTCTGGCTAGTTCCCTTTGGTTGGCATATGGCTTACTCAGCCATGATCTCTTTCTTGCGTCACCTAATATGGTTGCGACTCCATTGGGAATTCTCCAACTTATCCTCTACTTCAAGTACAAGAATAAGAAGGATTTAGCACCAACAACAATGGTGATCACCAAACGAAATGATCATGATGACAAGAACAAAGCCACACTTGAGTTTGTTGTTGACGTTGATCGTAATAGTGATACCAATGAGAAGAATTCTAACAATGCCTCATCGATCTAA"></textarea>
                       <label for="seq">Paste a nucleotide sequence</label>
                     </div>

                 </div>


                 <div class="card-grey row">
                     <div class="input-field col s12">
                        <select id="species">
                          <!--<option value="" disabled selected>Choose your option</option>-->
                          <option value="TAIR10" selected>Thale cress (Arabidopsis thaliana) genome, TAIR10 (Nov, 2010)</option>
                          <option value="IGGP_12x">Grape (Vitis vinifera) genome, IGGP_12x (Jun, 2011)</option>
                          <option value="hg19">Human (Homo sapiens) genome, GRCh37/hg19 (Feb, 2009)</option>
                        </select>
                        <label>Species</label>
                      </div>
                  </div>
                 <h3>FILTERS</h3>
                 <div class="card-grey row">
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
             <a id="submit_seq" href="res.php" type="submit" class="btn-large waves-effect waves-light light-green">submit</a>
           </div>
      </form>

    </div>


<script>

    function getValue(id) {
        var value = $('#' + id).val()
        if (value === '') {
            value = document.getElementById(id).placeholder
        }
        return value
    }

    $('#submit_seq').click(function() {

        var seq = getValue('seq')
        seq = seq.replace(/(\r\n|\n|\r)/gm,"");
        console.log("seq sans saut de ligne", seq);
        //nombr de repetition de la sequence sible dans le genome d'interet
        var nbrMaxTarget20 = getValue('nbrMaxTarget20')
    	var nbrMaxTarget12 = getValue('nbrMaxTarget12')
    	var nbrMaxTarget8 = getValue('nbrMaxTarget8')
    	var TMexpect = getValue('TMexpect') //meilleur TM attendu
    	var TMerror = getValue('TMerror') // marge d'erreur du le meilleur tm
        var paramValues = [nbrMaxTarget20, nbrMaxTarget12, nbrMaxTarget8, TMexpect, TMerror]

        var dbList = document.getElementById("species")
        var db = dbList.options[dbList.selectedIndex].value
        $.ajax({
            type: "POST",
            url: "some.php",
            data:{
                seq: seq,
                db: db,
                paramValues: paramValues
            }
        });
    })
</script>

<?php include 'inc/footer.php'; ?>
