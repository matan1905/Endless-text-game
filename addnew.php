<?php 
include("connection.php");
$pid = mysqli_real_escape_string($conn,$_GET['pid']);
if(!isset($pid)) die();

?>
<!DOCTYPE html>
<html>
<body>
<script>
    var counter = 0;
    var limit = 5;

	function clearAll(){
		document.getElementById('stats').innerHTML ="";
		document.getElementById('items').innerHTML ="";
		counter=0;
	}
	
    function add(divName){
         if (counter == limit)  {

              alert("You have reached the limit of " + counter + " stats/items");

         }

         else if(divName=='stats'){

              var newdiv = document.createElement('div');

              newdiv.innerHTML = "Stat Name: <input type='text' name='stats[]'>"+
			  "<br>Stat Change: <input type='number' name='stats[]'>";

              document.getElementById(divName).appendChild(newdiv);
              counter++;

         }
		 else if(divName=='items'){

              var newdiv = document.createElement('div');

              newdiv.innerHTML = "Item Name: <input type='text' name='items[]'>"+
			  "<br>Item Change: <input type='number' name='items[]'>";

              document.getElementById(divName).appendChild(newdiv);
              counter++;

         }

    }
</script>
<form action="/add.php" method="POST">
<input type="hidden" name="pid" value="<?php echo $pid; ?>"/>
  Action:<br>
  <input type="text" name="action" required>
  <br>
  Outcome:<br>
  <textarea  type="text" name="outcome" required></textarea >
  <br><br>
       <div id="stats">
     </div> 
	 <div id="items">
     </div>
  <input type="submit" value="Submit">
</form> 

     <input type="button" value="Add/Subtract a stat" onClick="add('stats');">
     <input type="button" value="Give/Take an item" onClick="add('items');">
     <input type="button" value="Clear" onClick="clearAll();">
</body>
</html>
