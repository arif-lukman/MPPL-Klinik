$(document).ready(function(){

    //NAMBAH

	//APPEND DIAGNOSA
    $("#btn-diag").click(function(){
    	var val = parseInt($("#diag-num").val()) + 1;

        $("#field-diagnosa").append("" +
    	//isi
        "<div class=\"appdiag" + val + "\">" +
        	"<h5>" + val + " )</h5>" +
        	"<center>" +
                "<div class=\"form-group\">" +
                  "<div class=\"col-sm-6\">" +
                    "<label class=\"control-label\">Kuadran 1</label>" +
                    "<input type=\"text\" class=\"form-control\" name=\"k1d" + val + "\" id=\"k1d" + val + "\">" +
                  "</div>" +
                  "<div class=\"col-sm-6\">" +
                    "<label class=\"control-label\">Kuadran 2</label>" +
                    "<input type=\"text\" class=\"form-control\" name=\"k2d" + val + "\" id=\"k2d" + val + "\">" +
                  "</div>" +
                "</div>" +

                "<div class=\"form-group\">" +
                  "<div class=\"col-sm-6\">" +
                    "<label class=\"control-label\">Kuadran 3</label>" +
                    "<input type=\"text\" class=\"form-control\" name=\"k3d" + val + "\" id=\"k3d" + val + "\">" +
                  "</div>" +
                  "<div class=\"col-sm-6\">" +
                    "<label class=\"control-label\">Kuadran 4</label>" +
                    "<input type=\"text\" class=\"form-control\" name=\"k4d" + val + "\" id=\"k4d" + val + "\">" +
                  "</div>" +
                "</div>" +
          	"</center>" +

    		"<div class=\"form-group\">" +
    			"<label class=\"col-sm-2 control-label\">Keterangan</label>" +
    			"<div class=\"col-sm-10\">" +
    				"<textarea class=\"form-control\" name=\"ketd" + val + "\" id=\"ketd" + val + "\" style=\"max-width: 100%; min-width: 100%\"></textarea required>" +
    			"</div>" +
    		"</div>" +
        "</div>" +
    	"");

    	$("#diag-num").val(val);
        $("#btn-diag-").show();
    });

    //APPEND TERAPI
    $("#btn-terapi").click(function(){
    	var val = parseInt($("#terapi-num").val()) + 1;
        var katOpts = "";
        var terapi = "";

        //data kategori terapi
        //$.get("ajax/kategori_terapi.php", function(data, status){
         //   katOpts = data;
        //});

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

        //console.log(katOpts);
        $("#field-terapi").append("" +
    	//isi
        "<div class=\"appterapi" + val + "\">" +
        	"<h5>" + val + " )</h5>" +
            "<div class=\"form-group\">" +
              "<label class=\"col-sm-2 col-sm-2 control-label\">Kategori</label>" +
              "<div class=\"col-sm-10\">" +
                "<select class=\"form-control\" name=\"idk" + val + "\" id=\"idk" + val + "\" onclick=\"SetChildOpt(this);\">" +
                    "<option disabled selected hidden>-- Pilih Kategori Terapi --</option>" +
                    katOpts +
                "</select>" +
              "</div>" +
            "</div>" +

            "<div class=\"form-group\">" +
              "<label class=\"col-sm-2 col-sm-2 control-label\">Jenis Terapi</label>" +
              "<div class=\"col-sm-10\">" +
                "<!--DROPDOWN NAMA DOKTER-->" +
                "<select class=\"form-control\" name=\"idt" + val + "\" id=\"idt" + val + "\" onchange=\"LoadTarifTerapi(this);\">" +
                  "<option disabled selected hidden>Pilih kategori terlebih dahulu</option>" +
                "</select>" +
              "</div>" +
            "</div>" +
    		
            "<div class=\"form-group\">" +
                "<label class=\"col-sm-2 control-label\">Tarif (Rp)</label>" +
                "<div class=\"col-sm-10\">" +
                    "<input type=\"number\" class=\"form-control\" name=\"tarift" + val + "\" id=\"tarift" + val + "\">" +
                    "<div id=\"minmaxt" + val + "\"></div>" +
                "</div>" +
            "</div>" +

    		"<div class=\"form-group\">" +
    			"<label class=\"col-sm-2 control-label\">Keterangan</label>" +
    			"<div class=\"col-sm-10\">" +
    				"<textarea class=\"form-control\" name=\"kett" + val + "\" id=\"kett" + val + "\" style=\"max-width: 100%; min-width: 100%\"></textarea>" +
    			"</div>" +
    		"</div>" +
        "</div>" +
    	"");

    	$("#terapi-num").val(val);
        $("#btn-terapi-").show();
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

    //SELECT OPTION
    
    //TERAPI
    //$("select[id*='idk']").change(function(){
    //    SetChildOpt(this);
    //});

});

//Non jquery functions that will be called
//Nested option on terapi
function SetChildOpt(elm){
    //var idknum = elm.id.slice(-1);
    //var elmHtml = elm.innerHTML;
    //console.log(idknum);
    //console.log("#idt" + idknum + " > option");
    //console.log(elmHtml);
    //$("#idt" + elm).prop("disabled", false);

    //console.log(elm);
    $.get("ajax/terapi.php?id_kat=" + elm.value, function(data, status){
        $("#idt" + elm.id.slice(-1)).html(data);
        //LoadTarifTerapi($("#idt" + elm.id.slice(-1));
        //console.log("#idt"+elm);
        //console.log(status);
        //console.log(data);
    });
}

//Terapi price
function LoadTarifTerapi(elm){
    //console.log(elm);
    $.get("ajax/harga_terapi.php?id_terapi=" + elm.value, function(data, status){
        $("#tarift" + elm.id.slice(-1)).val(data);
        //console.log("#tarift"+elm);
        //console.log(status);
        //console.log(data);
    });

    $.get("ajax/min_max_tarif.php?id_terapi=" + elm.value, function(data, status){
        $("#minmaxt" + elm.id.slice(-1)).html(data);
        //console.log("#minmaxt1t"+elm);
        //console.log(status);
        //console.log(data);
    });
}

//Hitung harga obat
function CalcHargaObat(elm){
    $.get("ajax/harga_obat.php?id_obat=" + elm.value, function(data, status){
        $("#hargao" + elm.id.slice(-1)).html("Harga : Rp " + addCommas(data * $("#jumo" + elm.id.slice(-1)).val()));
        $("#hrgo" + elm.id.slice(-1)).val(data * $("#jumo" + elm.id.slice(-1)).val());
    });
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