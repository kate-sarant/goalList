<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="goals.css">
      <script type="text/javascript">

</script>
      <title>Goal Tracker</title>
  </head>
  <body>
    <header>
      <h1>Set a new Goal! </h1>
      <?php   $new_time =  date("d/m/Y");
      echo "<p class='top_TodayDate'>".$new_time."</p>"; ?>

    </header>
    <div id="container">

      <center>

      <form  action="insert_goal.php" method="post">
        <label for="cat">Category</label>
        <select id="cat"class="form-select" name="cat">
          <option value="0">Personal</option>
          <option value="1">Profecional</option>
          <option value="2">Other</option>
        </select>
        <label for="text">Goal</label>
        <textarea class="form-control"name="text" id="text"></textarea>
        <label for="goaldate">Date</label>
        <input class="form control input-group date" type="date" name="goaldate" id="goaldate">
      <div class="group-goalcheck">

       <label class='GoalCheck'for="complete">Goal completed</label>
        <input class='input-group  GoalCheck'type="checkbox" name="complete" value="1" id="complete"></div> </br>
      <center><button class="btn"type="submit">Submit Goal</button></center>
      </form>
    </center>
      <?php

      require_once 'connect.php';
      $sql = "SELECT * FROM goals ORDER BY goal_date ASC";
      $result = mysqli_query($link,$sql) or die(mysqli_error($link));
            print("<h2>Incomplete Goals</h2>");

     ////Incomplete goals
      while($row = mysqli_fetch_array($result)){

      if($row['goal_complete'] == 0){

        $cat = $row['goal_category']== 0?"Personal":($row['goal_category']== 1?"Profecional":"Other");

        //"for today" indicator
         $d = (date("Y-m-d") == $row['goal_date'])? 'for today':((date("Y-m-d") > $row['goal_date'])?"past date":" ") ;
         $label = ($d !== " ")? "<p class= 'note' >".$d."</p>":'';

        echo "<div class='mygoals class".$row['goal_category']."'>";
        echo "<a href='complete.php?id=".$row['goal_id'] . "'><button class='btn btnComplete'>Complete</button></a><strong>";
        echo $cat . "</strong>";
        echo $label;
        echo  "<p>".$row['goal_text'] . "</br>Goal Date:" . $row['goal_date'] ."</p>";
        echo "</div>";
  }
}
      ////    complete goals
      print("<h2>Complete Goals</h2>");
      $result = mysqli_query($link,$sql) or die(mysqli_error($link));

      while($row = mysqli_fetch_array($result)){
        if($row['goal_complete'] == 1){
          $cat = $row['goal_category']== 0?"Personal":($row['goal_category']== 1?"Profecional":"Other");

        echo "<div class='class".$row['goal_category']."'>";
        echo "<a href='delete.php?id=".$row['goal_id']."'><button class='btn btnComplete'>Delete</button></a><strong>";
        echo $cat . "</strong><p>".$row['goal_text']."</br>Goal Date:".$row['goal_date']."</p></div>";

    }  }

      ?>

    </div>
    <footer><p>Project by Kate Sarant 2022</p></footer>
  </body>
</html>
