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
                     <div class="input-field col m12">
                        <select id="species">
                          <!--<option value="" disabled selected>Choose your option</option>-->
                          <option value="TAIR10" selected>Thale cress (Arabidopsis thaliana) genome, TAIR10 (Nov, 2010)</option>
                          <option value="IGGP_12x">Grape (Vitis vinifera) genome, IGGP_12x (Jun, 2011)</option>
                        </select>
                        <label>Specificity check</label>
                      </div>

                     <div class="input-field col s12">
                       <textarea id="seq" name="seq" class="materialize-textarea" placeholder="atgccgcgcgtcgtgcccgaccagagaagcaagttcgagaacgaggagttttttaggaagctgagccgcgagtgtgagattaagtacacgggcttcagggaccggccccacgaggaacgccaggcacgcttccagaacgcctgccgcgacggccgctcggaaatcgcttttgtggccacagaaccaatctgtctctccagttttttccggccagctggcagggagaacagcgacaaacacctagccgagagtatgtcgacttagaaagagaagcaggcaaggtatatttgaaggctcccatgattctgaatggagtctgtgttatctggaaaggctggattgatctccaaagactggatggtatgggctgtctggagtttgatgaggagcgagcccagcaggaggatgcattagcacaacaggcctttgaagaggctcggagaaggacacgcgaatttgaagatagagacaggtctcatcgggaggaaatggaggcaagaagacaacaagaccctagtcctggttccaatttaggtggtggtgatgacctcaaacttcgttaa"></textarea>
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
<!--
    <div>
        Sed nulla cred Banksy jean shorts. Reprehenderit mumblecore incididunt anim accusamus. Keffiyeh Cosby sweater in cornhole elit, tote bag cillum banjo. Shabby chic YOLO banh mi sunt. Artisan blog Neutra, polaroid adipisicing Banksy +1 lo-fi umami distillery fixie seitan. Semiotics artisan flannel mollit craft beer Blue Bottle. Bespoke biodiesel banh mi literally.

YOLO Marfa drinking vinegar polaroid laborum veniam, est disrupt umami wayfarers try-hard before they sold out fap. Culpa bitters kitsch adipisicing, nesciunt brunch squid minim post-ironic assumenda irony. Qui bespoke organic, photo booth authentic PBR velit before they sold out fingerstache nostrud flannel. Leggings chillwave est sustainable, tofu raw denim sint 8-bit keffiyeh High Life. Nostrud Austin put a bird on it, typewriter Godard gastropub ennui mlkshk deserunt assumenda. Blog letterpress meggings, nihil Shoreditch Etsy try-hard vinyl Echo Park cray farm-to-table McSweeney's High Life. Qui stumptown ex Cosby sweater street art ethnic irure dolore.

In post-ironic umami, sint +1 gluten-free pickled disrupt vinyl jean shorts velit placeat est American Apparel. Flannel cupidatat deserunt master cleanse cornhole vinyl, Banksy 8-bit fugiat pariatur. Schlitz Intelligentsia incididunt ugh, literally minim skateboard ennui. Labore deep v placeat, mlkshk biodiesel church-key post-ironic Cosby sweater twee nesciunt Blue Bottle. Salvia vero esse, exercitation cliche chambray aliquip gluten-free yr post-ironic pug narwhal kale chips ennui hella. Consequat bitters salvia delectus esse. Fap kogi forage culpa Tumblr, accusamus PBR Thundercats PBR&B banjo ullamco 8-bit bitters minim you probably haven't heard of them.

Sed nulla cred Banksy jean shorts. Reprehenderit mumblecore incididunt anim accusamus. Keffiyeh Cosby sweater in cornhole elit, tote bag cillum banjo. Shabby chic YOLO banh mi sunt. Artisan blog Neutra, polaroid adipisicing Banksy +1 lo-fi umami distillery fixie seitan. Semiotics artisan flannel mollit craft beer Blue Bottle. Bespoke biodiesel banh mi literally.
    </div>-->

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
