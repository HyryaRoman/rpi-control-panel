<?php
$pins=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);//17 pins

foreach($pins as $pin){
  echo "<!-- Card  {$pin}-->
        <div class='box' id='box-{$pin}' data-pin='{$pin}'>
          <div class='content'>
            <h2>
              {$pin}
            </h2>
            <div class='control'>
              Output | Input
              <label><input id='switch-mode-{$pin}' type='checkbox' onchange='onModeSwitch(this)' data-pin='{$pin}'><span></span><i></i></label>
              Off | On
              <label><input id='switch-state-{$pin}' type='checkbox' onchange='onStateSwitch(this)' data-pin='{$pin}'><span></span><i></i></label>
            </div>
          </div>
        </div>";
}
?>
