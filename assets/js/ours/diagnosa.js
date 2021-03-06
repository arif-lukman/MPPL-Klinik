$(document).ready(function(){

    //NAMBAH

	//APPEND DIAGNOSA
    $("#btn-diag").click(function(){
    	var val = parseInt($("#diag-num").val()) + 1;
        var katOpts = "";
        var terapi = "";

        $.ajax({
            async:false,
            url:'ajax/kategori_terapi.php',
            success: function(data){
                katOpts = data;
            }
        });

        //data terapi
        $.ajax({
            async:false,
            url:'ajax/terapi.php',
            success: function(data){
                terapi = data;
            }
        });

        $("#field-diagnosa").append("" +
    	//isi
        "<div class=\"appdiag" + val + "\">" +
        	"<h5>" + val + " )</h5>" +
        	"<center>" +
                "<div class=\"form-group\">" +
                  "<div class=\"col-sm-6\">" +
                    "<label class=\"control-label\">Kuadran 1</label>" +
                    "<input type=\"text\" class=\"form-control\" name=\"k1d" + val + "\" id=\"k1d" + val + "\" autocomplete=\"off\">" +
                  "</div>" +
                  "<div class=\"col-sm-6\">" +
                    "<label class=\"control-label\">Kuadran 2</label>" +
                    "<input type=\"text\" class=\"form-control\" name=\"k2d" + val + "\" id=\"k2d" + val + "\" autocomplete=\"off\">" +
                  "</div>" +
                "</div>" +

                "<div class=\"form-group\">" +
                  "<div class=\"col-sm-6\">" +
                    "<label class=\"control-label\">Kuadran 3</label>" +
                    "<input type=\"text\" class=\"form-control\" name=\"k3d" + val + "\" id=\"k3d" + val + "\" autocomplete=\"off\">" +
                  "</div>" +
                  "<div class=\"col-sm-6\">" +
                    "<label class=\"control-label\">Kuadran 4</label>" +
                    "<input type=\"text\" class=\"form-control\" name=\"k4d" + val + "\" id=\"k4d" + val + "\" autocomplete=\"off\">" +
                  "</div>" +
                "</div>" +
          	"</center>" +

    		"<div class=\"form-group\">" +
    			"<label class=\"col-sm-2 control-label\">Diagnosa</label>" +
    			"<div class=\"col-sm-10\">" +
    				"<textarea class=\"form-control\" name=\"ketd" + val + "\" id=\"ketd" + val + "\" style=\"max-width: 100%; min-width: 100%\" autocomplete=\"off\" required></textarea>" +
    			"</div>" +
    		"</div>" +

            "<div class=\"form-group\">" +
              "<label class=\"col-sm-2 col-sm-2 control-label\">Kategori Terapi</label>" +
              "<div class=\"col-sm-10\">" +
                "<select class=\"form-control\" name=\"idk" + val + "\" id=\"idk" + val + "\" onclick=\"SetChildOpt(this);\" required>" +
                    "<option disabled selected hidden>-- Pilih Kategori Terapi --</option>" +
                    katOpts +
                "</select>" +
              "</div>" +
            "</div>" +

            "<div class=\"form-group\">" +
              "<label class=\"col-sm-2 col-sm-2 control-label\">Jenis Terapi</label>" +
              "<div class=\"col-sm-10\">" +
                "<!--DROPDOWN NAMA DOKTER-->" +
                "<select class=\"form-control\" name=\"idt" + val + "\" id=\"idt" + val + "\" onchange=\"LoadTarifTerapi(this);\" required>" +
                  "<option disabled selected hidden>Pilih kategori terlebih dahulu</option>" +
                "</select>" +
              "</div>" +
            "</div>" +
            
            "<div class=\"form-group\">" +
                "<label class=\"col-sm-2 control-label\">Tarif (Rp)</label>" +
                "<div class=\"col-sm-10\">" +
                    "<input type=\"number\" class=\"form-control\" name=\"tarift" + val + "\" id=\"tarift" + val + "\" onkeyup=\"CalcBiayaTotal()\" required autocomplete=\"off\">" +
                    "<div id=\"minmaxt" + val + "\"></div>" +
                "</div>" +
            "</div>" +

            "<div class=\"form-group\">" +
                "<label class=\"col-sm-2 control-label\">Keterangan Terapi</label>" +
                "<div class=\"col-sm-10\">" +
                    "<textarea class=\"form-control\" name=\"kett" + val + "\" id=\"kett" + val + "\" style=\"max-width: 100%; min-width: 100%\" required autocomplete=\"off\"></textarea>" +
                "</div>" +
            "</div>" +

        "</div>" +
    	"");

    	$("#diag-num").val(val);
        $("#btn-diag-").show();
    });

    //APPEND OBAT
    $("#btn-obat").click(function(){
    	var val = parseInt($("#obat-num").val()) + 1;
        var batOpts = "";

        $.ajax({
            async:false,
            url:'ajax/obat.php',
            success: function(data){
                batOpts = data;
            }
        });

        $("#field-obat").append("" +
    	//isi
        "<div class=\"appobat" + val + "\">" +
        	"<h5>" + val + " )</h5>" +

        	"<div class=\"form-group\">" +
                "<div class=\"col-sm-3\"></div>" +
    			"<label class=\"col-sm-2 control-label\">Pilih Obat</label>" +
    			"<div class=\"col-sm-4\">" +
    				"<select class=\"form-control\" id=\"ido" + val + "\" name=\"ido" + val + "\" onchange=\"CalcHargaObat(this);\">" +
                        "<option disabled selected hidden>Pilih Nama Obat</option>" +
    					batOpts +
    				"</select>" +
    			"</div>" +
    		"</div>" +

          	"<div class=\"form-group\">" +
    	        "<div class=\"col-sm-3\"></div>" +
    	        "<label class=\"control-label col-sm-2\">Jumlah</label>" +
    	        "<div class=\"col-sm-4\">" +
    	          	"<input type=\"number\" class=\"form-control\" name=\"jumo" + val + "\" id=\"jumo" + val + "\" onkeyup=\"CalcHargaObat(document.getElementById('ido" + val + "'));\">" +
                    "<div id=\"cekstok" + val + "\"></div>" +
                    "<input type=\"hidden\" name=\"hrgo" + val + "\" id=\"hrgo" + val + "\">" +
    	        "</div>" +
          	"</div>" +

            "<div class=\"form-group\">" +
              "<div class=\"col-sm-3\"></div>" +
              "<div class=\"col-sm-6\" id=\"hargao" + val + "\" style=\"text-align: center;\"></div>" +
            "</div>" +
        "</div>" +
    	"");

    	$("#obat-num").val(val);
        $("#btn-obat-").show();
    });

    //KURANG
    
    //DIAGNOSA
    $("#btn-diag-").click(function(){
        var val = parseInt($("#diag-num").val());

        $(".appdiag" + val).remove();

        val--;
        if(val === 1)
            $("#btn-diag-").hide();
        $("#diag-num").val(val);
    });

    //TERAPI
    $("#btn-terapi-").click(function(){
        var val = parseInt($("#terapi-num").val());

        $(".appterapi" + val).remove();

        val--;
        if(val === 1)
            $("#btn-terapi-").hide();
        $("#terapi-num").val(val);
    });

    //OBAT
    $("#btn-obat-").click(function(){
        var val = parseInt($("#obat-num").val());

        $(".appobat" + val).remove();

        val--;
        if(val === 1)
            $("#btn-obat-").hide();
        $("#obat-num").val(val);
    });
});

//Non jquery functions that will be called
//Nested option on terapi
function SetChildOpt(elm){
    $.get("ajax/terapi.php?id_kat=" + elm.value, function(data, status){
        $("#idt" + elm.id.slice(-1)).html(data);
    });
}

//Terapi price
function LoadTarifTerapi(elm){
    $.get("ajax/harga_terapi.php?id_terapi=" + elm.value, function(data, status){
        $("#tarift" + elm.id.slice(-1)).val(data);
        CalcBiayaTotal();
    });

    $.get("ajax/min_max_tarif.php?id_terapi=" + elm.value, function(data, status){
        $("#minmaxt" + elm.id.slice(-1)).html(data);
    });
}

function LoadChildOpt(elm, id_terapi){
    $.get("ajax/edit_terapi.php?id_kat=" + elm.value + "&id_terapi=" + id_terapi, function(data, status){
        $("#idt").html(data);
        CheckTarifTerapi(document.getElementById("idt"));
    });
}

function SetChildOpt2(elm){
    $.get("ajax/terapi.php?id_kat=" + elm.value, function(data, status){
        $("#idt").html(data);
    });
}

//Terapi price
function LoadTarifTerapi2(elm){
    $.get("ajax/harga_terapi.php?id_terapi=" + elm.value, function(data, status){
        $("#tarif").val(data);
    });

    $.get("ajax/min_max_tarif.php?id_terapi=" + elm.value, function(data, status){
        $("#minmax").html(data);
    });
}

function CheckTarifTerapi(elm){
    $.get("ajax/min_max_tarif.php?id_terapi=" + elm.value, function(data, status){
        $("#minmax").html(data);
    });
}

//Hitung harga obat
function CalcHargaObat(elm){
    if(elm.value != "Pilih Nama Obat"){
        $.get("ajax/harga_obat.php?id_obat=" + elm.value, function(data, status){
            $("#hargao" + elm.id.slice(-1)).html("Harga : Rp " + addCommas(data * $("#jumo" + elm.id.slice(-1)).val()));
            $("#hrgo" + elm.id.slice(-1)).val(data * $("#jumo" + elm.id.slice(-1)).val());
            CalcBiayaTotal();
        });
    }
}

function CalcBiayaTotal(){
    var tarifTerapi = 0;
    var tarifObat = 0;
    var hrgDiskon = 0;

    $("[id*='tarift']").each(function(){
        tarifTerapi += parseInt(this.value);
    });

    $("[id*='hrgo']").each(function(){
        tarifObat += parseInt(this.value);
    });

    //console.log($("#diskon").val());

    if(!isNaN(tarifTerapi) || !isNaN(tarifObat)){
        if(!isNaN($("#diskon").val()) && $("#diskon").val() != "" && $("#diskon").val() != null){
            if(isNaN(tarifTerapi)){
                $("#biaya-total").html("<h4>Total Biaya (Sebelum Diskon): Rp " + addCommas(tarifObat) + "</h4>");
                $("#biaya_total").val(tarifObat);
                $("#biaya-total-diskon").html("<h4>Total Biaya (Sesudah Diskon): Rp " + addCommas(tarifObat - parseInt($("#diskon").val())) + "</h4>");
                $("#biaya_total_diskon").val(tarifObat - parseInt($("#diskon").val()));
            } else if(isNaN(tarifObat)){
                $("#biaya-total").html("<h4>Total Biaya (Sebelum Diskon): Rp " + addCommas(tarifTerapi) + "</h4>");
                $("#biaya_total").val(tarifTerapi);
                $("#biaya-total-diskon").html("<h4>Total Biaya (Sesudah Diskon): Rp " + addCommas(tarifTerapi - parseInt($("#diskon").val())) + "</h4>");
                $("#biaya_total_diskon").val(tarifTerapi - parseInt($("#diskon").val()));
            } else {
                $("#biaya-total").html("<h4>Total Biaya (Sebelum Diskon): Rp " + addCommas(tarifObat + tarifTerapi) + "</h4>");
                $("#biaya_total").val(tarifObat + tarifTerapi);
                $("#biaya-total-diskon").html("<h4>Total Biaya (Sesudah Diskon): Rp " + addCommas((tarifTerapi+tarifObat) - parseInt($("#diskon").val())) + "</h4>");
                $("#biaya_total_diskon").val((tarifTerapi+tarifObat) - parseInt($("#diskon").val()));
            }
        } else {
            if(isNaN(tarifTerapi)){
                $("#biaya-total").html("<h4>Total Biaya (Sebelum Diskon): Rp " + addCommas(tarifObat) + "</h4>");
                $("#biaya_total").val(tarifObat);
                $("#biaya-total-diskon").html("<h4>Total Biaya (Sesudah Diskon): Rp " + addCommas(tarifObat) + "</h4>");
                $("#biaya_total_diskon").val(tarifObat);
            } else if(isNaN(tarifObat)){
                $("#biaya-total").html("<h4>Total Biaya (Sebelum Diskon): Rp " + addCommas(tarifTerapi) + "</h4>");
                $("#biaya_total").val(tarifTerapi);
                $("#biaya-total-diskon").html("<h4>Total Biaya (Sesudah Diskon): Rp " + addCommas(tarifTerapi) + "</h4>");
                $("#biaya_total_diskon").val(tarifTerapi);
            } else {
                $("#biaya-total").html("<h4>Total Biaya (Sebelum Diskon): Rp " + addCommas(tarifObat + tarifTerapi) + "</h4>");
                $("#biaya_total").val(tarifObat + tarifTerapi);
                $("#biaya-total-diskon").html("<h4>Total Biaya (Sesudah Diskon): Rp " + addCommas((tarifTerapi+tarifObat)) + "</h4>");
                $("#biaya_total_diskon").val((tarifTerapi+tarifObat));
            }
        }
    }
}

//Validasi stok obat
function CekStok(elm, elm2){
    if(elm.value != "Pilih Nama Obat"){
        $.get("ajax/stok.php?id_obat=" + elm.value + "&jml=" + elm2.value, function(data, status){
            $("#cekstok" + elm.id.slice(-1)).html(data);
        });
    }
}

//Cek terapi price
//function 


function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}