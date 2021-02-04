let idcontent = document.querySelectorAll('.idcontent');
let topic_js = document.querySelectorAll('.topic');
let cb = document.querySelectorAll('.cb');

//to delete content

document.querySelectorAll('.delete').forEach((btn, index)=>{

  $(btn).click( () => {

    if(prompt(`ใส่ password เพื่อยืนยันการลบ ${$(topic_js[index]).html()}`) == 1150){
      $.ajax({
        url: "delete_content.php",
        type: "post",
        data: {id : $(idcontent[index]).text()},
        success: ()=>{
          $(cb[index]).fadeOut(777,()=>{
              $(cb[index]).remove();
          });
        } 
      });
    }   
    else {
      alert("คุณใส่ password ผิด");
    }

  });

});  

// to set color and text of public status

function set_text_color(element){
  element.style.color = (element.innerHTML == 0) ? "chartreuse" : "orange";
  element.innerHTML = (element.innerHTML == 0) ? "public" : "non public";
}

// to update public status

document.querySelectorAll('.public').forEach((ispublic, index)=>{

    let approve_js = (ispublic.innerHTML == 0) ? 1 : 0;

    set_text_color(ispublic);

    $(ispublic).click(() => {
      if(confirm("ต้องการเปลี่ยนสภานะ public ของ content ใช้หรือไม่")){ 
        $.ajax({
          url: 'update_content_status_dp.php',
          type: 'post',
          data: {
            id : $(idcontent[index]).text(),
            approve: approve_js
          },
          success: () => {
            $(ispublic).fadeOut(777,() =>{
                ispublic.innerHTML = (approve_js == 0) ? 0 : 1;
                set_text_color(ispublic);
                approve_js = (approve_js == 0) ? 1 : 0;
                $(ispublic).fadeIn().delay(777);
            });
          }          
        });
      }
    });
});
