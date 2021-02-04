<div class="addMatch admin" style="text-align: left;">

<fieldset style="border: 2px solid rgba(45, 81, 92, 0.95);">  
<legend><h2 id="addBtn">Add Match</h2></legend>
  <form id="formAddMatch">

    <span class="previewTour"> Click here to get Tournament name</span><br><br>     
    <select name="tourid" class="selectTour">
        <option value="0">---</option>
    </select> <br><br>

    <span class="previewTeam">Click here to get Team 1 & 2 Name</span><br><br>
    
    <div style="display: inline">
      Team 1
      <select name="team1" class="selectTeam 1">
        <option value="0">---</option>
      </select>
      
    </div>
    
    <div style="display: inline">
      Team 2
      <select name="team2" class="selectTeam 2">
        <option value="0">---</option>
      </select>
    </div> <br><br>

    Select BO -->   
    <select class="bo "name="bo">
    <option value="0">---</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="5">5</option>
    </select><br><br>

    <span class="previewTime">Select Time </span>
    <input style="background: white" type="datetime-local" name="matchtime"><br><br>
    
    
  </form>
  <legend><button id="addMatchBtn">Click to add match</button></legend>
  </fieldset>
</div>


<script>

$(function(){

  $('.previewTeam').click(() => {
      $.post(
        'add_match_select_team_db.php', 
        {data: "Team"},
        (result)=>{
          $('.selectTeam').append( result );
          $('.previewTeam').html("Select Team").unbind('click');;
      });
  });

  $('.previewTour').click(() => {
      $.post(
        'add_match_select_team_db.php',
        {data: "Tournament"},
        (result)=>{
          $('.selectTour').append( result );
          $('.previewTour').html("Select Tournament").unbind('click');
    });
  })

  $('#addMatchBtn').click(()=>{
       
    // if ( $('.1 option:selected').val() == $('.2 option:selected')){
    //   alert("Team 1 และ Team 2 เป็นทีมเดียวกัน");
    //   event.preventDefault(event);
    // }
    // if( 
    //     $('.1 option:selected').val() == 0 || 
    //     $('.2 option:selected').val() == 0 ||
    //     $('.selectTour option:selected').val(event) == 0 ||
    //     $('.bo option:selected') == 0
    //   )
    // {
    //   alert("ใส่ข้อมูลไม่ครบ กรุณาตรวจสอบ");
    //   event.preventDefault(event);
    // }
    
    $.ajax({
      url: 'add_more_match_db.php',
      type: "POST",
      data: $('form').serializeArray(),
      success: (result) => {
        $('#match').fadeOut(777,()=>{
          $('#match').append(result);
          $('#match').fadeIn().delay(777);
        })        
      }
    });
  });
});

</script>