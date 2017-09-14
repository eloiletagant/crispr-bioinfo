<?php
include 'inc/header.php';
//reset $session res to avoid get last query res
$_SESSION['res'] = 'NULL';
?>

    <div class="container">
        <div class="row">
         <div class="col s12">
           <ul class="tabs">
             <li class="tab col s3"><a id="tab1" href="#div1">home</a></li>
             <li class="tab col s3"><a id="tab2" class="active" href="#div2">how to use</a></li>
             <li class="tab col s3"><a id="tab3" href="#div3">my searches</a></li>
             <li class="tab col s3"><a id="tab4" href="#div4">about</a></li>
           </ul>
         </div>
         <div id="div1" class="col s12"></div>
         <div id="div2" class="col s12"></div>
         <div id="div3" class="col s12"></div>
         <div id="div4" class="col s12"></div>
       </div>
    </div>


    <div class="container">

      <form method="POST" action="">
           <div class="row">
             <form class="col s12">
                 <div class="row">
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
             </form>
           </div>

           <div class="row center">
             <a id="submit_seq" href="test1.php" type="submit" class="btn-large waves-effect waves-light orange">Envoyer</a>
           </div>
      </form>

    </div>


<script>
    $('#submit_seq').click(function() {

        var seq = $('#seq').val()
        if (seq === '') {
            seq = document.getElementById('seq').placeholder
        }
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
