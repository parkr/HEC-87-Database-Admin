<?php

/* backup the db OR just a table */
function backup_tables($host, $user, $pass, $name, $tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*'){
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result)){
			$tables[] = $row[0];
		}
	}else{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table){
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return .= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) {
			while($row = mysql_fetch_row($result)){
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) {
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return .= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	mysql_close($link);
	
	//save file
	$filename = dirname(__FILE__) . '/' . $name . '-backup-' . time() . '-' . (md5(implode(',',$tables))) . '.sql', 'w+';
	return file_put_contents($return);
}

$tables = array(
	'mobile_app_events',
	'mobile_app_events_users',
	'mobile_app_faqs',
	'mobile_app_food_items',
	'mobile_app_hashes',
	'mobile_app_maps',
	'mobile_app_menus',
	'mobile_app_pages',
	'mobile_app_speakers',
	'mobile_app_sponsors',
	'mobile_app_thoughts',
	'mobile_app_users',
);

require(dirname(__FILE__) . "/../Config/database.php");
$dbconfig = new DATABASE_CONFIG();

backup_tables('localhost', $dbconfig->pmp['login'], $dbconfig->pmp['password'], $dbconfig->pmp['database'], $tables);	
	
?>