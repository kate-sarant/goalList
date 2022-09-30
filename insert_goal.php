<?php

require_once 'connect.php';

$category = $_REQUEST['cat'];
$test = $_REQUEST['text'];
$goaldate = $_REQUEST['goaldate'];
$complete = $_REQUEST['complete'];


if($complete == '' || $complete == null ){
  $complete = 0;
}

$sql ="INSERT INTO goals (goal_category, goal_text, goal_date, goal_complete) VALUES ('$category', '$test', '$goaldate', '$complete')";

//print $sql ;

if(mysqli_query($link, $sql)){

  echo '<script>alert("Success")</script>';
}else{
  echo '<script>alert("Failed")</script>';
}

 header("Location: ./index.php?insert_goal=success");

?>
