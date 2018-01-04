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
                  katOpts +
                "</select>" +
              "</div>" +
            "</div>" +

            "<div class=\"form-group\">" +
              "<label class=\"col-sm-2 col-sm-2 control-label\">Jenis Terapi</label>" +
              "<div class=\"col-sm-10\">" +
                "<!--DROPDOWN NAMA DOKTER-->" +
                "<select class=\"form-control\" name=\"idt" + val + "\" id=\"idt" + val + "\">" +
                  terapi +
                "</select>" +
              "</div>" +
            "</div>" +
    		
            "<div class=\"form-group\">" +
                "<label class=\"col-sm-2 control-label\">Tarif</label>" +
                "<div class=\"col-sm-10\">" +
                    "<textarea class=\"form-control\" name=\"tarift" + val + "\" id=\"tarift" + val + "\" style=\"max-width: 100%; min-width: 100%\"></textarea>" +
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

        $("#field-obat").append("" +
    	//isi
        "<div class=\"appobat" + val + "\">" +
        	"<h5>" + val + " )</h5>" +

        	"<div class=\"form-group\">" +
                "<div class=\"col-sm-3\"></div>" +
    			"<label class=\"col-sm-2 control-label\">Pilih Obat</label>" +
    			"<div class=\"col-sm-4\">" +
    				"<select class=\"form-control\" id=\"ido" + val + "\" name=\"ido" + val + "\">" +
    					"<option value=\"tindakan 1\">tindakan 1</option>" +
    					"<option value=\"tindakan 2\">tindakan 2</option>" +
    					"<option value=\"tindakan 3\">tindakan 3</option>" +
    				"</select>" +
    			"</div>" +
    		"</div>" +

          	"<div class=\"form-group\">" +
    	        "<div class=\"col-sm-3\"></div>" +
    	        "<label class=\"control-label col-sm-2\">Jumlah</label>" +
    	        "<div class=\"col-sm-4\">" +
    	          	"<input type=\"number\" class=\"form-control\" name=\"jumo" + val + "\" id=\"jumo" + val + "\">" +
    	        "</div>" +
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
function SetChildOpt(elm){
    //var idknum = elm.id.slice(-1);
    //var elmHtml = elm.innerHTML;
    //console.log(idknum);
    //console.log("#idt" + idknum + " > option");
    //console.log(elmHtml);
    //$("#idt" + elm).prop("disabled", false);

    console.log(elm);
    $.get("ajax/terapi.php?id_kat=" + elm.value, function(data, status){
        $("#idt" + elm.id.slice(-1)).html(data);
        console.log("#idt"+elm);
        console.log(status);
        console.log(data);
    });
}