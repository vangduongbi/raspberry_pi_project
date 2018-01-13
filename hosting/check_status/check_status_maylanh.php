<?php

$v2 = exec("gpio -g read 12");?>
<script>
 		$(document).ready(function() {
 			$("#dv-4").show();
<?php
	if($v2 == 1) {
?>
	
 			$("#dv-4").text("ON");
 			
 		
		
	
<?php
	} else {
?>
			$("#dv-4").text("OFF");
 			
		
<?php 
	}
?>

});
		</script>

