<?php
include 'inc/header.php';
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
                 <div class="input-field col s12">
                   <textarea id="seq" name="seq" class="materialize-textarea" placeholder="atgccgcgcgtcgtgcccgaccagagaagcaagttcgagaacgaggagttttttaggaagctgagccgcgagtgtgagattaagtacacgggcttcagggaccggccccacgaggaacgccaggcacgcttccagaacgcctgccgcgacggccgctcggaaatcgcttttgtggccacagaaccaatctgtctctccagttttttccggccagctggcagggagaacagcgacaaacacctagccgagagtatgtcgacttagaaagagaagcaggcaaggtatatttgaaggctcccatgattctgaatggagtctgtgttatctggaaaggctggattgatctccaaagactggatggtatgggctgtctggagtttgatgaggagcgagcccagcaggaggatgcattagcacaacaggcctttgaagaggctcggagaaggacacgcgaatttgaagatagagacaggtctcatcgggaggaaatggaggcaagaagacaacaagaccctagtcctggttccaatttaggtggtggtgatgacctcaaacttcgttaa"></textarea>
                   <label for="seq">Entrez une séquence</label>
                 </div>
               </div>
             </form>
           </div>

           <div class="row center">
             <a id="submit_seq" href="test1.php" type="submit" class="btn-large waves-effect waves-light orange">Envoyer</a>
           </div>
      </form>

    </div>

<script src="js/script.js"></script>

<?php include 'inc/footer.php'; ?>
