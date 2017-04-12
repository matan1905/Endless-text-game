<?php
include("connection.php");
$pid = mysqli_real_escape_string($conn,$_POST['pid']);
if(!isset($pid)) die("Error");
//CHECK IF PID EXIST
$action = mysqli_real_escape_string($conn,$_POST['action']);
$desc = mysqli_real_escape_string($conn,$_POST['outcome']);

$sql = "SELECT state FROM node WHERE id=$pid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc() ;
        $state= json_decode($row['state'],true);
       if(isset($_POST['stats'])){
		   for($i=0;$i<count($_POST['stats']);$i+=2){
			   $stat= mysqli_real_escape_string($conn,$_POST['stats'][$i]);
			   $amount= mysqli_real_escape_string($conn,$_POST['stats'][$i+1]);
			   if(isset($state['stats'][$stat])){
				   $state['stats'][$stat]+=$amount;
			   }
               else	$state['stats'][$stat]=$amount;
		   }
	   }
       if(isset($_POST['items'])){
		   for($i=0;$i<count($_POST['items']);$i+=2){
			   $item= mysqli_real_escape_string($conn,$_POST['items'][$i]);
			   $amount= mysqli_real_escape_string($conn,$_POST['items'][$i+1]);
			   if(isset($state['items'][$item]) && $state['items'][$item]>=$amount){
				   $state['items'][$item]+=$amount;
			   }
			   else{
				   if($amount>0){
					   $state['items'][$item]=$amount;
				   }else{
				   echo $amount;
			   echo "Can't have amount of items smaller than 0" ;
			   die();}}
		   } 
	   }
	   $st=json_encode($state);
       if(isset($pid) && isset($action) && isset($desc)&& isset($st) ){
	   newNode($pid,$action,$desc,$st,$conn);
	   //header("Location:story.php?pid="+$pid);
	   $URL="story.php?pid=$pid";
echo "<script type='text/javascript'>document.location.href='$URL';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        }else{
			echo "Something went wrong";
		}
    
} else die("Found nothing");


?>