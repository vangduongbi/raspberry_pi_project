<?php

$vl = exec("gpio -g read 16");?>
<script>
 		$(document).ready(function() {
 			$("#dv-3").show();
<?php
	if($vl == 1) {
?>
	
 			$("#dv-3").text("ON");
 			
 		
		
	
<?php
	} else {
?>
			$("#dv-3").text("OFF");
 			
		
<?php 
	}
?>

});
		</script>


