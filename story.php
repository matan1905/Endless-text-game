<?php
include("connection.php");
$pid = mysqli_real_escape_string($conn,$_GET['pid']);
if(!isset($pid)) die();
$sql = "SELECT action,outcome,state FROM node WHERE id=$pid";
$result = $conn->query($sql);
$state=null;
if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc() ;
        echo $row['action'];
		echo '<br>';
        echo $row['outcome'];

		$state=json_decode($row['state'],true);
    ?>
	<div>
<section>
  <h6>Items:</h6>
  <ul>
   <?php
     foreach($state['items'] as $item=>$amount)  
		 echo "<li>$item : $amount</li>"
   ?>
  </ul>
</section><section>
  <h6>Stats:</h6>
  <ul>
    <?php
     foreach($state['stats'] as $s=>$amount)  
		 echo "<li>$s : $amount</li>"
   ?>
  </ul>
</section>
</div>
<?php
}

$sql2 = "SELECT id,action FROM node WHERE pid=$pid";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
   
    while($row = $result2->fetch_assoc()) {
	echo '<a href="story.php?pid='.$row['id'].'">'.$row['action'].'</a>';
		echo '<br>';
    }
}

$conn->close();



?>


<a href="addnew.php?pid=<?php echo $pid; ?>"><button>Create new action</button></a>