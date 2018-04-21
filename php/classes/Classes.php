<?php
class fan {
	use ValidateUuid;
	/**
	 * id for the fan; this is the primary key
	 * @var Uuid $fanId
	 */
	private $fanId;
	/**
	 * activation token for the fan
	 * @var Uuid $fanActivationToken
	 */
	private $fanActivationToken;
	/**
	 * fan email address
	 * @var string $fanEmail
	 */
	private $fanEmail;
	/**
	 * hash encryption for fan
	 * @var
	 */
	private $fanHash;
	/**
	 * username of fan
	 * @var string $fanUsername
	 */
	private $fanUsername;
}

	/**
	 * accessor method for fan id
	 *
	 * @return Uuid value of fan id
	 */
	public function getFanId(): Uuid {
		return $this->fanId;
	}

	/**
	 * mutator method for fan id
	 *
	 * @param Uuid $fanId
	 */
	public function setFanId(Uuid $fanId) {
		$this->fanId = $fanId;
	}

	/**
	 * accessor method for fan activation token
	 *
	 * @return Uuid
	 */
	public function getFanActivationToken(): Uuid {
		return $this->fanActivationToken;
	}

	/**
	 * mutator method for fan activation token
	 *
	 * @param Uuid $fanActivationToken
	 */
	public function setFanActivationToken(Uuid $fanActivationToken) {
		$this->fanActivationToken = $fanActivationToken;
	}

	/**
	 * accessor method for fan email
	 *
	 * @return string
	 */
	public function getFanEmail(): string {
		return $this->fanEmail;
	}

	/**
	 * mutator method for fan email
	 *
	 * @param string $fanEmail
	 */
	public function setFanEmail(string $fanEmail) {
		$this->fanEmail = $fanEmail;
	}

	/**
	 * accessor method for fan hash
	 *
	 * @return mixed
	 */
	public function getFanHash() {
		return $this->fanHash;
	}

	/**
	 * mutator method for fan hash
	 *
	 * @param mixed $fanHash
	 */
	public function setFanHash($fanHash): void {
		$this->profileHash = $profileHash;
		}

	/**
	 * accessor method for fan username
	 *
	 * @return string
	 */
	public function getFanUsername(): string {
		return $this->fanUsername;
	}

	/**
	 * @param string $fanUsername
	 * @throw \IN
	 */
	public function setFanUsername(string $newFanUsername) : void {
		$newFanUsername = trim($newFanUsername);
		$newFanUsername = filter_var($newFanUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		if(empty($newFanUsername) === true) {
			throw(new \InvalidArgumentException("name is insecure"));
		}

		if(strlen($newFanUsername) > 32)
			throw(new \RangeException("name cannot fit in mySQL"));

		$this->fanUsername = $newFanUsername;
	}
