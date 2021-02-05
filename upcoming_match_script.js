
let matchscores = document.querySelectorAll('.matchscores');
let times = document.querySelectorAll('.times');

//function to display match countdown timer
function checkTime(time, index){
  let match_time = time.innerHTML;
    
  setInterval((stop) => {
    
    let diff = new Date(match_time).getTime() - new Date().getTime();

      if (diff < 0) {
        clearInterval(stop);
        matchscores[index].style.color = "greenyellow";
        $(time).css("color", "darkorange").text("Match finished");
        return;
      }
      
      let d_str = " วัน ";
      let h_str = " ชั่วโมง";
      let d = Math.floor(diff / (1000 * 60 * 60 * 24));
      let h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      let m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)) + " นาที ";
      let s = Math.floor((diff % (1000 * 60)) / 1000) + " วินาที ";

      if (d == 0){
          d = "", d_str = "";
      }
      if(h == 0 && d == 0){
          h = "", h_str = "";
      }     
      time.innerHTML = `${d} ${d_str} ${h} ${h_str} ${m} ${s}`;
  }, 1000);
}
times.forEach((time, index) => {  
  checkTime(time, index);
});

let editTime = document.querySelectorAll('.editTime');
let matchid = document.querySelectorAll('.matchid');

// function to update the match time to SQL_DB using AJAX + jQuery

document.querySelectorAll('.btnEditTime').forEach((btn, index)=>{

  $(btn).click(()=> {
      
    if(confirm('ต้องการอัพเดตเวลาของทีม ใช่หรือไม่')){
      
      $.ajax({
        url: 'update_matchtime.php',
        type: 'post',
        data: { 
          matchid: matchid[index].value, 
          matchtime: $(editTime[index]).val()
        },
        success: () => {
            $(times[index]).fadeOut(777,() => {
              $(times[index]).html(checkTime( x )).fadeIn().delay(777);
            });
          }
        })
        
    }

  });

})

// checkScore

// a score detail is the string set which contains the detail of the winner 
// it looks like 11001, 110 or 10

// 0 = team_1 wins, 1 = team_2 wins 

// 101 = game 1 => team_1 wins score results in 1:0 
//       game 2 => team_2 wins score results in 1:1

// Showing the detail of the winner will be used in the future

function checkScore(score){
  let team_1_score = 0, team_2_score = 0;

  for(let count = 0; count < score.length; count++){
    if(score.charAt(count).match('0')){
      team_1_score++;
    }
    if(score.charAt(count).match('1')){
      team_2_score++;
    }
  }

  if(team_1_score == 0 && team_2_score == 0){
    return " - : - ";
  } else {
    return team_1_score + " : " + team_2_score;
  }
}


matchscores.forEach((ms)=>{
  ms.innerHTML = checkScore(ms.innerHTML);
});


//function to update a match score to SQL_DB using jQuery + AJAX + 

function updateScore(btn, team, matchid){

  btn.forEach((b1, index) => {

    $(b1).click((click) => {

      if(confirm('ต้องการ Update Score ของทีม หรือไม่')){
        $.ajax({
          url: 'update_score_db.php',
          type: 'post',
          data: {
            score: team,
            matchid: matchid[index].value
          },
          success: (result) => {
            $(matchscores[index]).fadeOut(777, ()=>{         
              $(matchscores[index]).html(checkScore(result)).fadeIn().delay(777);
            });
          }
        });
      }
    });
  });

}

let btn1 = document.querySelectorAll('.btn1');
let btn2 = document.querySelectorAll('.btn2');

//btn1 is used to update when team 1 is the winner and vice versa for btn2 
updateScore(btn1, "0", matchid);
updateScore(btn2, "1", matchid);


//to reset score in case we update the wrong information
document.querySelectorAll('.reset').forEach((resetbtn, index) => {
  $(resetbtn).click(()=>{
    if(confirm("ต้องการ RESET SCORE ใช่หรือไม่ ?")){
      $.post(
        "update_score_db.php",
        {score: "", match_id: matchid[index].value},
        (result)=>{
          alert(result);
          $(matchscores[index]).fadeOut(777, ()=>{         
            $(matchscores[index]).html(checkScore("")).fadeIn().delay(777);
          });
        }
      );
    }
  });
});

// function to change the match status 

// 1 = public // match detail is visible on the index page
// 0 = non public // match detail is invisible 

// document.querySelectorAll('.status').forEach((status, index) => {
  
//   status.innerHTML = (status.innerHTML == 1) ? "public": "none public";
  
//   $(status).click(()=>{

//     if(confirm("ต้องการเปลี่ยน Match Status ใช่หรือไม่ ?")){
//       $.post(
//         "update_score_db.php",
//         {matchstatus: 1, match_id: matchid[index].value},
//         ()=>{
//         }
//       );
//     }
//   });
// });
