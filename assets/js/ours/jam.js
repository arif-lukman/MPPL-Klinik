function startTime() 
{
  var today = new Date();
  var d = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
  var D = today.getDate();
  var M = ["Desember","Januari","Februari","Maret","April","May","Juni","Juli","Agustus","September","Oktober","November"];
  var Y = today.getFullYear();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();

  D = checkTime(D);
  m = checkTime(m);
  s = checkTime(s);
  
  document.getElementById('waktu').innerHTML =
  d[today.getDay()] + " , " + D + " " + M[today.getMonth()] + " " + Y +  "  |  " + h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}

function checkTime(i) 
{
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}