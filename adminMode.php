<h1 style='color: salmon'>Welcome Admin</h1><br>
<h2>
  <a class="edit">Console Visible</a><br><br>
  <a class="unedit">Console Invisible</a><br><br>
  <a href='create_content.php'>Create Content</a><br><br>
  <a class="logout" style='color:red' href='login.php?logout=1'>Log Out</a>
</h2>
    
<script>
  $(function(){
  
    $('.logout').click(()=>{
      if(confirm("ต้องการ Logout ใช่หรือไม่")){
			  alert("คุณได้ออกจากระบบแล้ว")
		  } else {
			  event.preventDefault();
      }    
    });

    $('.edit').click(()=>{
      $('.admin').show(777);
    });
    
    $('.unedit').click(()=>{
      $('.admin').hide(777);
    });

  });
</script>