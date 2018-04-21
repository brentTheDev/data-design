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
 * constructor for this Fan
 *
 * @param string|Uuid $newFanId id of this Fan or null if a new Fan
 * @param string|Uuid $newTweetProfileId id of the Profile that sent this Tweet
 * @param string $newTweetContent string containing actual tweet data
 * @param string $newFanUsername string containing Fan username
 * @throws \InvalidArgumentException if data types are not valid
 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
 * @throws \TypeError if data types violate type hints
 * @throws \Exception if some other exception occurs
 * @Documentation https://php.net/manual/en/language.oop5.decon.php
 **/
public function __construct($newFanId, $newFanActivationToken, string $newFanEmail, $newFanHash, string $newFanUsername) {
	try {
		$this->setFanId($newFanId);
		$this->setFanActivationToken($newFanActivationToken);
		$this->setFanEmail($newFanEmail);
		$this->setFanHash($newFanHash);
		$this->setFanUsername($newFanUsername);
	}
		//determine what exception type was thrown
	catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
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
