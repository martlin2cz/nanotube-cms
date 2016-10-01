<?php

define("STATIC_PASSWORD_SALT", "E415sSDjndi?Janca!546GLfjomqdkXSe*alni");
define("PASSWORD_HASH_ALGORITHM", "SHA1");


class Passwording {

	public function matches($password, $password_hash, $password_salt) {
		$hash = $this->hash_password($password, $password_salt);
		return $hash == $password_hash;		
	}


	public function generate_password_hash($password) {
		$dynamic_salt = $this->generate_dynamic_salt();
		$hashed = $this->hash_password($password, $dynamic_salt);
		return Array($hashed, $dynamic_salt);
	}

	public function hash_password($password, $dynamic_salt) {
		$salted = $dynamic_salt . $password . STATIC_PASSWORD_SALT;
		$hashed = hash(PASSWORD_HASH_ALGORITHM, $salted);
		return $hashed;
	}

	private function generate_dynamic_salt() {
		$salt = "";
		for ($i = 0; $i < 30; $i++) {
			$seed = 'q' . rand(11, 99);
			$until = rand(10, 900);
			for ($j = 0; $j < $until; $j++) {
				$seed++; 
			}	
			$salt .= $seed;
		}
		//is 30 x 3 chars long	
		return $salt;
	}

}
?>
