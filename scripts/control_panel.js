//============================================================================================================$(document).ready()
var ready=false;
$(function() {
  ready=true;
  setTimeout(update,Number(document.getElementById("timeout").value)*1000);
});

//============================================================================================================update pin states
function update(){
  console.log("Update all panels");

  var pin_data[];

  $(".box").each(
    function(num,elem){
      pin_data[num]=elem.dataset.pin;
    }
  );

  $.ajax({
    url:"scripts/update_port_info.php",
    type:"POST",
    data:{
      com:"get_states",
      pins:pin_data
    },
    success:function(response){
      console.log("Get states:"+response);
      var jsonData = JSON.parse(response);
      if(jsonData.success==1){
        $(".box").each(
          function(num,elem){
            elem.classList.toggle("on",(jsonData.result[elem.dataset.pin]==1));
            document.getElementById("switch-state-"+elem.dataset.pin).checked=(jsonData.result[elem.dataset.pin]==1);
          }
        );
      }
    }
  });

  setTimeout(update,Number(document.getElementById("timeout").value)*1000);
}

//============================================================================================================on state switch event
function onStateSwitch(element){
  if(ready){
    var cardElement=document.getElementById("box-"+element.dataset.pin);
    $.ajax({
      url: "scripts/update_port_info.php",
      type:"POST",
      data:{
        "com": "set_state",
        "pin": element.dataset.pin,
        "state": Number(element.checked)
      },
      success: function(response){
        console.log("Set states:"+response);
        var jsonData = JSON.parse(response);
        if(jsonData.success==1){
          cardElement.classList.toggle("on",(jsonData.result==1));
          element.checked=(jsonData.result==1);
        }
      }
    });
  }
}

//============================================================================================================on mode switch event
function onModeSwitch(element){
  if(ready){
    var switchElement=document.getElementById("switch-state-"+element.dataset.pin);
    $.ajax({
      url: "scripts/update_port_info.php",
      type:"POST",
      data:{
        "com": "set_mode",
        "pin": element.dataset.pin,
        "mode": Number(element.checked)
      },
      success: function(response){
        console.log("Set mode:"+response);
        var jsonData = JSON.parse(response);
        if(jsonData.success==1){
          switchElement.toggleAttribute("disabled",(jsonData.result==1));
          element.checked=(jsonData.result==1);
        }
      }
    });
  }
}
