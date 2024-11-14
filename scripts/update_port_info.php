<?php
  //============================================================================================================fail()
  function fail(){
    echo json_encode(array(
        'success'=>0
    ));
  }

  //============================================================================================================result($data)
  function result($data){
    echo json_encode(array(
      'success'=>1,
      'result'=>$data
    ));
  }

  //============================================================================================================getState($pin)
  function getState(){
    if(isset($_POST["pin"])){
      $pin=$_POST["pin"];
      exec("gpio read {(int)$pin}",$result);
      result((int)$result[0]);
    }else{
      fail();
    }
  }

  //============================================================================================================getStates()
  function getStates(){
    if(isset($_POST["pins"])){
      $pins=$_POST["pins"];
      $pin_result=array();

      foreach($pins as $current_pin){
        exec("gpio read {(int)$current_pin}",$result);
        $pin_result[$current_pin]=(int)$result[0];
        unset($result);
      }

      result($pin_result);

    }else{
      fail();
    }
  }

  //============================================================================================================setState($pin)
  function setState(){
    if(isset($_POST["state"])&&isset($_POST["pin"])){
      $state=$_POST["state"];
      $pin=$_POST["pin"];
      exec("gpio write {(int)$pin} {(int)$state}");
      getState($pin);
    }else{
      fail();
    }
  }

  //============================================================================================================setMode($pin)
  function setMode(){
    if(isset($_POST["mode"])&&isset($_POST["pin"])){
      $mode=$_POST["mode"];
      $pin=$_POST["pin"];
      exec("gpio mode {(int)$pin} {$mode==0?'out':'in'}");
      result($mode);
    }else{
      fail();
    }
  }

  //============================================================================================================parseCommand
  if(isset($_POST["com"])){
    $command=$_POST["com"];
    switch($command){
      case "get_state":
        getState();
        break;
      case "set_state":
        setState();
        break;
      case "set_mode":
        setMode();
        break;
      case "get_states":
        getStates();
        break;
      default:
        fail();
    }
  }else{
    fail();
  }
?>
