(function($){
  $(function(){

    $('.button-collapse').sideNav();

  }); // end of document ready
})(jQuery); // end of jQuery name space


$(document).ready(function(){
    $('select').material_select();
    $("#tab1").click(function(){
        $("#div1").load("inc/test1.php")
    });
    $("#tab2").click(function(){
        $("#div2").load("inc/test2.php")
    });
    $("#tab3").click(function(){
        $("#div3").load("inc/test3.php")
    });
    $("#tab4").click(function(){
        $("#div4").load("inc/test4.php")
    });

});

$('#submit_seq').click(function() {

    var seq = $('#seq').val()
    $.ajax({
        type: "POST",
        url: "some.php",
        data:{
            seq: seq
        }
    });

})



//"error":"","pam_sequence":"NGG","program_name":"CRISPRdirect","results":[],"sequence_name":"","specificity_check":"Human (Homo sapiens) genome, GRCh37/hg19 (Feb, 2009)","time":"2017-09-11 19:49:48"}
//{"end":"26","gc":"75.00","hit_12mer":"3","hit_20mer":"1","hit_8mer":"103","resite":["Bme1580I"],"sequence":"ccgcgcgtcgtgcccgaccagag","start":"4","strand":"-","tm":"82.34","tttt":"0"}

function getTable() {

        $('#content').empty()

        if (data.error !== '') {
            $('#content').text(data.error)
        } else {
            $('#content').text('PAM sequence : ' + data.pam_sequence + '<br />')
            /*for (var i = 0; i < data.results.length; i++) {
                data.results[i]
            */
            //}
        }

        //$_SESSION['res'] = NULL;
}


var objectArray = [{
        "Total": "34",
        "Version": "1.0.4",
        "Office": "New York"
    }, {
        "Total": "67",
        "Version": "1.1.0",
        "Office": "Paris"
    }];
//var data = '{"params": {"expect": 10,"sc_match": 2,"sc_mismatch": -3,"gap_open": 5,"gap_extend": 2,"filter": "L;m;"}}';
//var json = JSON.parse(data);
