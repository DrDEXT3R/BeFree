<?php

	function getKey($i) {
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		$connection	= new mysqli($host, $db_user, $db_password, $db_name);
		if ($connection->connect_errno != 0) {
			return 0;
		}
		else {
			if( $result = $connection->query("SELECT * FROM captcha WHERE id=1") ) {
				$no_of_users = $result->num_rows;
				if ($no_of_users>0) {
					$row = $result->fetch_assoc();
					if($i == 1) {
						$secret = $row['site-key'];
						return $secret;
					}
					else if ($i == 2) {
						$secret = $row['secret-key'];
						return $secret;
					}
				}
			}
			else {
				return 0;
			}
			$connection->close();
		}
	}

?>