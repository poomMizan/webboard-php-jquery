function checkTime(time){
  if(time < 10){
      return "0" + time;
  }
  return time;
}
function timeOutput(time){  
  let monthNames = [
    "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
    "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
  ];  
  let d = new Date(time);
  let month = monthNames[d.getMonth()];
  let hour = checkTime(d.getHours());
  let min = checkTime(d.getMinutes())
  return `${d.getDate()} ${month} ${d.getFullYear()} เวลา ${hour} ${min}`;
}

document.querySelectorAll('.normaltime').forEach( (time)=> {
    time.innerHTML =  timeOutput(time.innerHTML);
})