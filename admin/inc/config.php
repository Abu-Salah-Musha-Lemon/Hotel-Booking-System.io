<?php
$host = 'localhost';
$user ='root';
$pass = '';
$db_name = 'hotelBooking';
$con = mysqli_connect($host,$user,$pass,$db_name);

if (!$con) {
  die('connection Failed'. mysqli_connect_errno());
}
function filtration($data){
  foreach($data as $key=>$value){
   $value = trim($value);
   $value = stripslashes($value);
   $value = strip_tags($value);
   $value = htmlspecialchars($value);
   $data[$key] = $value;

  }
  return $data;
}

function selectAll($table){
  $con = $GLOBALS['con'];
  $res = mysqli_query($con, "SELECT * FROM $table");
  return $res;
}

function select($sql, $values, $datatype){
  $con = $GLOBALS['con'];
  if($stmt = mysqli_prepare($con, $sql)){
    mysqli_stmt_bind_param($stmt, $datatype, ...$values);
    if(mysqli_stmt_execute($stmt)){
      $res= mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      return $res;
    }else{
      mysqli_stmt_close($stmt);
      die('Query cannot be existed -select');
    }
  }else{
    die('Query cannot be prepared -Select');
  }
}


function update($sql, $values, $datatype){
  $con = $GLOBALS['con'];
  if($stmt = mysqli_prepare($con, $sql)){
    mysqli_stmt_bind_param($stmt, $datatype, ...$values);
    if(mysqli_stmt_execute($stmt)){
      $res= mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $res;
    }else{
      mysqli_stmt_close($stmt);
      die('Query cannot be existed -Update');
    }
  }else{
    die('Query cannot be prepared -update');
  }
}

function insert($sql, $values, $datatype){
  $con = $GLOBALS['con'];
  if($stmt = mysqli_prepare($con, $sql)){
    mysqli_stmt_bind_param($stmt, $datatype, ...$values);
    if(mysqli_stmt_execute($stmt)){
      $res= mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $res;
    }else{
      mysqli_stmt_close($stmt);
      die('Query cannot be existed -Insert');
    }
  }else{
    die('Query cannot be prepared -Insert');
  }
}

function delete($sql, $values, $datatype){
  $con = $GLOBALS['con'];
  if($stmt = mysqli_prepare($con, $sql)){
    mysqli_stmt_bind_param($stmt, $datatype, ...$values);
    if(mysqli_stmt_execute($stmt)){
      $res= mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $res;
    }else{
      die('Query cannot be existed -delete');
      mysqli_stmt_close($stmt);
    }
  }else{
    die('Query cannot be prepared -delete');
  }
}