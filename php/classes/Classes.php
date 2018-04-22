<?php
namespace Edu\Cnm\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class Fan implements \JsonSerializable {
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
 * @param string|Uuid $newFanActivationToken token of the fan signs up
 * @param string $newFanEmail string containing Fan email address
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
	 * @param Uuid|string $newFanId
	 */
	public function setFanId( $newFanId) {
		try {
				$uuid = self::validateUuid( $newFanId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				$exceptionType = get_class($exception);
				throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the fan activation token
		$this->fanId = $uuid;
	}

	/**
	 * accessor method for fan activation token
	 *
	 * @return Uuid
	 */
	public function getFanActivationToken() : Uuid {
		return $this->fanActivationToken;
	}

	/**
	 * mutator method for fan activation token
	 *
	 * @param Uuid $newFanActivationToken
	 */
	public function setFanActivationToken( $newFanActivationToken) : void {
		try {
			$uuid = self::validateUuid($newFanActivationToken);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the fan activation token
		$this->fanActivationToken = $uuid;
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
	 * @param string $newFanUsername
	 * @throw \InvalidArgumentException if $newFanUsername is not a valid object or string
	 * @throw \RangeException if $newFanUsername is > 32 characters
	 */
	public function setFanUsername(string $newFanUsername) : void {
		$newFanUsername = trim($newFanUsername);
		$newFanUsername = filter_var($newFanUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// verifies that the username is valid
		if(empty($newFanUsername) === true) {
			throw(new \InvalidArgumentException("name is insecure"));
		}

		//verifies if the fan username is less than 32 characters
		if(strlen($newFanUsername) > 32)
			throw(new \RangeException("name cannot fit in mySQL"));

		// store the new fan username
		$this->fanUsername = $newFanUsername;
	}
