<?php
include 'inc/header.php';
?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">sgRNA Finder</h1>
      <div class="row center">
        <h5 class="header col s12 light"></h5>
      </div>

      <form method="POST" action="index.php">
           <div class="row">
             <form class="col s12">
               <div class="row">
                 <div class="input-field col s12">
                   <textarea id="seq" name="seq" class="materialize-textarea" placeholder="atgccgcgcgtcgtgcccgaccagagaagcaagttcgagaacgaggagttttttaggaagctgagccgcgagtgtgagattaagtacacgggcttcagggaccggccccacgaggaacgccaggcacgcttccagaacgcctgccgcgacggccgctcggaaatcgcttttgtggccacagaaccaatctgtctctccagttttttccggccagctggcagggagaacagcgacaaacacctagccgagagtatgtcgacttagaaagagaagcaggcaaggtatatttgaaggctcccatgattctgaatggagtctgtgttatctggaaaggctggattgatctccaaagactggatggtatgggctgtctggagtttgatgaggagcgagcccagcaggaggatgcattagcacaacaggcctttgaagaggctcggagaaggacacgcgaatttgaagatagagacaggtctcatcgggaggaaatggaggcaagaagacaacaagaccctagtcctggttccaatttaggtggtggtgatgacctcaaacttcgttaa"></textarea>
                   <label for="seq">Textarea</label>
                 </div>
               </div>
             </form>
           </div>

           <div class="row center">
             <button name="submit_seq" id="submit_seq" type="submit" class="btn-large waves-effect waves-light orange">Envoyer</button>
           </div>
      </form>

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
  </div>
<!--
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#submit_seq').click(function() {
            console.log('test')
        });
    });


    </script>
-->
<?php include 'inc/footer.php'; ?>
