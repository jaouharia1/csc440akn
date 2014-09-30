<?php
	$pageType="sr";
	
	echo "<hr><h1>Service Requests</h1><hr>";
	echo "<form method=\"post\" action=\"$_SERVER[PHP_SELF]\">";
	echo "<label class=\"labelCol\" for=\"priority\">: </label>";
	//Create an array 
	$priority=array(1 => '1', '2', '3');
	echo '<select name="priority">';
	foreach ($priority as $value) {
		echo "<option value=\"$value\"";
		if(isset($_POST['priority']) && ($_POST['priority'] == $value) )
			echo 'selected="selected"';
		echo ">$value</option>\n";
	}
	echo '</select><input type="submit" value="Filter" /></form>';
	
	
	$q = new query($pageType, "SELECT * FROM sr_list WHERE 1=1");
	if($_POST['priority'] != NULL) {$q->filter("and priority = '".$_POST['priority']."' "); }
	if($q->filtered=="1") {
		$q->getResults();
	}
	else echo "This must be filtered before results are shown.";
?>