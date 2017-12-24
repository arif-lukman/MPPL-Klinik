//JS Biasa
function CekForm(){
  if(confirm("Apakah anda yakin ingin melanjutkan?")){
    return true;
  } else {
    return false;
  }
}

function CekUsername(){
  var uname = document.getElementById("username").value;

  if(uname.length == 0){
    $("#uname-status").html("");
    return false;
  }

  //console.log("ajax/uname_status.php?uname=" + uname);

  $.get("ajax/uname_status.php?uname=" + uname, function(data, status){
    $("#uname-status").html(data);
  });

  if($("#uname-status").text().search("telah") != -1){
    return false;
  } else {
    return true;
  }
}

//cek konfirmasi password
function CekKonfirmasiPassword(){
  var pw = document.getElementById("password").value;
    var cnf_pw = document.getElementById("cnf_pw").value;

    if(pw != cnf_pw){
      $("#pw-status").html("<div class=\"col-sm-12 alert alert-danger\">" +
        "Password tidak sama." +
        "<span class=\"glyphicon glyphicon-remove\"></span>" +
      "</div>");
      return false;
    } else {
      $("#pw-status").html("");
      return true;
    }
}

//cek email
function CekEmail(){
  var mail = document.getElementById("email").value;
  var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  if (filter.test(mail)) {
    $("#vld-email").html("");
    return true;
  }
  else {
    $("#vld-email").html("<div class=\"col-sm-12 alert alert-danger\">" +
        "Email tidak valid." +
        "<span class=\"glyphicon glyphicon-remove\"></span>" +
      "</div>");
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

//JQUERY
$(document).ready(function(){
  //cek telpon valid apa enga
  $("#no_telp").keyup(function(){
    CekTelpon();
  });

  //cek email valid apa enga
  $("#email").keyup(function(){
    CekEmail();
  });

  //cek username ada apa enga
  $("#username").keyup(function(){
    CekUsername();
  });

  //cek pw sama apa enga
  $("#cnf_pw").keyup(function(){
    CekKonfirmasiPassword();
  });
  $("#password").keyup(function(){
    var pw = document.getElementById("password").value;

    if(pw == ""){
      $("#pw-status").html("");
    }
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
    if(count < Object.keys(formValues).length-1){
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
    var email = false;

    telp = CekTelpon();
    email = CekEmail();

    //console.log("telp : " + telp);
    //console.log("email : " + email);
    //console.log("username : " + username);
    //console.log("password : " + password);
    //console.log("formFull : " + formFull);

    //GABUNGIN!!!!!
    if(telp && email && username && password && formFull){
      $("#submit").prop("disabled", false);
      //console.log("BERHASIL");
    } else {
      $("#submit").prop("disabled", true);
      //console.log("ISI DULU FORMNYA");
    }

  });
});