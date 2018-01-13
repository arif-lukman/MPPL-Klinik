//JS Biasa
function CekForm(){
  if(confirm("Apakah anda yakin ingin melanjutkan?")){
    return true;
  } else {
    return false;
  }
}

function CekTelpon(){
  var telp = document.getElementById("no_telp").value;
  if(isNaN(telp) || telp === "" || telp === null){
    $("#vld-telp").html("<div class=\"col-sm-12 alert alert-danger\">" +
        "Nomor telpon tidak valid." +
        "<span class=\"glyphicon glyphicon-remove\"></span>" +
      "</div>");
    return false;
  } else {
    $("#vld-telp").html("");
    return true;
  }
}

function CekRekamMedis(){
  var rm = document.getElementById("no_rekam_medis").value;

  if(rm.length == 0){
    $("#vld-rm").html("");
    return false;
  }
  console.log(rm);
  $.get("ajax/no_rekam_medis.php?no=" + rm, function(data, status){
    $("#vld-rm").html(data);
  });

  if($("#vld-rm").text().search("telah") != -1){
    return false;
  } else {
    return true;
  }
}

function GetLatestRM(){
  $.get("ajax/rm_terkini.php", function(data, status){
    $("#rm-now").html(data);
  });
}

//JQUERY
$(document).ready(function(){
  //cek telpon valid apa enga
  $("#no_telp").keyup(function(){
    CekTelpon();
  });

  $("#no_rekam_medis").keyup(function(){
    CekRekamMedis();
  });

  //validasi form
  $("form").keyup(function(){
    var formFull = false;

    //CEK PENUH ENGGANYA FORM
    //jadiin data form jadi JSON object
    var formValues = $("form").serializeArray().reduce(function(obj, item){
      obj[item.name] = item.value;
      return obj;
    }, {});
    //console.log(formValues);

    //cek satu2 key value dari JSON objectnya
    var count = 0;
    Object.keys(formValues).forEach(function(key){
      //console.log("Key : " + key + ", Value : " + formValues[key]);
      if(formValues[key] != ""){
        count ++;
      }
    });

    //kasih true kalo udah penuh, kasih false kalo belum
    if(count < Object.keys(formValues).length){
      //console.log("count : " + count + ", formValues.length : " + Object.keys(formValues).length-1);
      //console.log("Form belum penuh");
      formFull = false;
    } else {
      //console.log("count : " + count + ", formValues.length : " + Object.keys(formValues).length-1);
      //console.log("Form sudah penuh");
      formFull = true;
    }

    //CEK BENER ENGGANYA FORM
    var telp = false;
    var rm = false;

    telp = CekTelpon();
    rm = CekRekamMedis();

    console.log("telp : " + telp);
    console.log("rm : " + rm);
    //console.log("username : " + username);
    //console.log("password : " + password);
    //console.log("formFull : " + formFull);

    //GABUNGIN!!!!!
    if(telp && rm && formFull){
      $("#submit").prop("disabled", false);
      //console.log("BERHASIL");
    } else {
      $("#submit").prop("disabled", true);
      //console.log("ISI DULU FORMNYA");
    }

  });
});