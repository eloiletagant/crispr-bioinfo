<?php
include 'inc/header.php';


/*echo"bite";
    copy("./pEn_C1_1_modele.gb","nouveau_fichier.gb");
echo"bite2";
     // 1 : on ouvre le fichier
     $monfichier = fopen('nouveau_fichier.gb', '777');
echo"bite3";
    // 2 : on lit la première ligne du fichier
    preg_replace("UUUUUUUUUUUUUUUUUUUUUUU", $_SESSION[], $monfichier);
echo"bite4";
    // 3 : quand on a fini de l'utiliser, on ferme le fichier
    fclose($monfichier);*/

?>
<script>
    $(document).ready(function(){
        $("#fichier").change(function(){
            var dbList = document.getElementById("fichier");
            var url = "https://designer.genomecompiler.com/plasmid_iframe?file_url=";
            var nom = dbList.options[dbList.selectedIndex].text;
            var url2 = url + /*location.host*/ "http://test.basicompta.fr" + "\/" + dbList.options[dbList.selectedIndex].value;
            $("#url").attr('href', url2).text(nom);
        })
    });
</script>
<div class="container">
<div class="row">
    <div class="col s12 center-align z-depth-5" style="padding-top: 10px; padding-bottom: 10px; background-color: #8bc34a;color: #ffffff" >Plasmid Viewer</div>
    <div class="input-field col m12" style="padding-top: 20px">
        <select id="fichier">
            <!--<option value="" disabled selected>Choose your option</option>-->
            <option selected value="">Choisir une option</option>
            <option value="pEn_C1_1_modele.gb">pEn_C1_1_modele.gb - Vecteur de clonage pour E-coli</option><!-- vecteur pour e.coli contenant sweet 3-->
            <option value="pDe_CAS9.gb">pDe_CAS9.gb - Plasmide Hôte possédant Cas9</option> <!-- hote de cas9 -->
        </select>
        <label>Specificity check</label>
    </div>

</div></div>
<div style="padding-bottom: 100px"></div>
<div class="center-align" style="padding-bottom: 10px">
<a target=_blank class="btn-large waves-effect waves-light orange" href="" id="url">Choisir une option</a></div>
<div style="padding-bottom: 100px"></div>
<!--<div class="col s12 center-align" style="padding-left: 10px; padding-right: 10px;">
<div style="display: block;"><iframe id="pv-iframe-demo" style="width: 100%; height: 800px;" src="https://designer.genomecompiler.com/plasmid_iframe?file_url=http://test.basicompta.fr/pEn_C1_1_SWEET3.ape" width="1100" height="1100" frameborder="0" scrolling="no"></iframe></div>
</div>-->
<!--<div style="align-content: center">
<iframe src="https://designer.genomecompiler.com/plasmid_iframe?file_url=<?php /*echo($url)*/?>"
        width="1024" height="768"/>
</div>-->
<?php
include 'inc/footer.php';
?>
