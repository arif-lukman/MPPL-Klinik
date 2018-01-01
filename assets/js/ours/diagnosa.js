$(document).ready(function(){

    //NAMBAH

	//APPEND DIAGNOSA
    $("#btn-diag").click(function(){
    	console.log($("#diag-num").val());
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
        $("#btn-diag-min").hide();
    	console.log($("#diag-num").val());
    });

    //APPEND TERAPI
    $("#btn-terapi").click(function(){
    	console.log($("#terapi-num").val());
    	var val = parseInt($("#terapi-num").val()) + 1;

        $("#field-terapi").append("" +
    	//isi
        "<div class=\"appterapi" + val + "\">" +
        	"<h5>" + val + " )</h5>" +
        	"<div class=\"form-group\">" +
    			"<label class=\"col-sm-2 control-label\">Terapi</label>" +
    			"<div class=\"col-sm-4\">" +
    				"<select class=\"form-control\" id=\"idt" + val + "\" name=\"idt" + val + "\">" +
    				  "<option value=\"tindakan 1\">tindakan 1</option>" +
    				  "<option value=\"tindakan 2\">tindakan 2</option>" +
    				  "<option value=\"tindakan 3\">tindakan 3</option>" +
    				"</select>" +
    			"</div>" +

    			"<label class=\"col-sm-2 control-label\">Tarif</label>" +
    			"<div class=\"col-sm-4\">" +
    				"<input type=\"text\" class=\"form-control\" name=\"tarift" + val + "\" id=\"tarift" + val + "\" >" +
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
    	console.log($("#terapi-num").val());
    });

    //APPEND OBAT
    $("#btn-obat").click(function(){
    	console.log($("#obat-num").val());
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
    	console.log($("#obat-num").val());
    });

    //KURANG
    
});