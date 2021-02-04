<?php

function checkRole($role){
    switch ($role) {
      case 1: return "Carry"; break;
      case 2: return "Solo Mid"; break; 
      case 3: return "Offlane"; break;
      case 4: return "Support"; break;
      case 5: return "Hard Support"; break;
      case 6: return "Coach"; break;
      default: return "";
    }
}

function getAge($birth){ 
    if($birth == 0000-00-00){
      return "";
    }else{
      $age = strtotime($birth);
      return(floor((time()-$age)/31556926));
    }
}

function getPrize($earning){
    return ($earning * 30) ." THB ( เร็วๆนี้ )";
}

?>