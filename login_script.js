let nan_naja = NaN;
let errorMsg = (error) => infoMsg.innerHTML = error; 
let prevent = (event) => event.preventDefault();
  
$(function(){

  $('#regBtn').click((event)=>{
     prevent(event);
      errorMsg("ขออภัย ระบบสมาชิกยังไม่เปิดให้บริการ");
  });
  
  $('#userName').keypress((event)=>{  
    let isNumber = String.fromCharCode(event.which);
    if(!isNaN(isNumber)){
      prevent(event);
      errorMsg("username ใส่ตัวอักษรเท่านั้น");             
    }
  });   

  $('#userId').keypress((event)=>{  
    let isNumber = String.fromCharCode(event.which);
    if(isNaN(isNumber)){
      prevent(event);
      errorMsg("id ใส่ตัวเลขเท่านั้น");               
    }
  });

  $('#inputBtn').click((event)=>{
    if( $('#userId').val() == "") {
      prevent(event);
      errorMsg("ไม่มีช้อมูล id"); 
    }
    else if( $('#userName').val() == "" ) {
      prevent(event);
      errorMsg("ไม่มีข้อมูล username"); 
    }
    else if( $('#pwd').val() == "" ) {
      prevent(event);
      errorMsg("ไม่มีข้อมูล password"); 
    }
    else if( $('#userId').val() == nan_naja) {
      prevent(event);
      errorMsg("ข้อมูลที่ใส่เข้ามาใน id ต้องเป็นตัวเลขเท่านั้น"); 
    }
  });

  $('.textLogin').click(()=>{
    infoMsg.innerHTML = "";
  });

});