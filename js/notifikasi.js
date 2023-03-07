var a = 1;

function cekk(){
    $.ajax({
        url: "include/cek.notifikasi.php",
        cache: false,
        success: function(mssg){
            $("#notifikasi1").html(mssg);
        }
    });
    var waktuu = setTimeout("cekk()",3000);
}

$(document).ready(function(){
    cekk();
    $("#pesan1").click(function(){
        $("#loading1").show();
        if(a==1){
            $("#pesan1").css("background-color","");
            a = 0;
        }else{
            $("#pesan1").css("background-color","");
            a = 1;
        }
        $("#info1").toggle();
        //ajax untuk menampilkan pesan yang belum terbaca
        $.ajax({
            url: "include/look.notifikasi.php",
            cache: false,
            success: function(mssg){
                $("#loading1").hide();
                $("#konten-info1").html(mssg);
            }
        });

    });
    $("#content1").click(function(){
        $("#info1").hide();
        $("#pesan1").css("background-color","#aaa");
        a = 1;
    });
});


