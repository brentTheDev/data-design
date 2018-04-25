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
	 * @var $fanHash
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
	 * @param string $newFanHash is used for password encryption
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
		return($this->fanId);
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

		// convert and store the fan id
		$this->fanId = $uuid;
	}

	/**
	 * accessor method for account activation token
	 *
	 * @return string value of the activation token
	 */
	public function getFanActivationToken(): string {
		return ($this->fanActivationToken);
	}
	/**
	 * mutator method for account activation token
	 *
	 * @param string $newFanActivationToken
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setFanActivationToken(string $newFanActivationToken): void {
		if($newFanActivationToken === null) {
			$this->fanActivationToken = null;
			return;
		}
		$newFanActivationToken = strtolower(trim($newFanActivationToken));
		if(ctype_xdigit($newFanActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newFanActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->fanActivationToken = $newFanActivationToken;
	}

	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 **/
	public function getFanEmail(): string {
		return $this->fanEmail;
	}
	/**
	 * mutator method for email
	 *
	 * @param string $newFanEmail new value of email
	 * @throws \InvalidArgumentException if $newFanEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 **/
	public function setFanEmail(string $newFanEmail): void {
		// verify the email is secure
		$newFanEmail = trim($newFanEmail);
		$newFanEmail = filter_var($newFanEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newFanEmail) === true) {
			throw(new \InvalidArgumentException("fan email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newFanEmail) > 128) {
			throw(new \RangeException("profile email is too large"));
		}
		// store the email
		$this->fanEmail = $newFanEmail;
	}

	/**
	 * accessor method for fanHash
	 *
	 * @freturn string value of hash
	 */
	public function getFanHash(): string {
		return $this->fanHash;
	}
	/**
	 * mutator method for profile hash password
	 *
	 * @param string $newFanHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 */
	public function setFanHash(string $newFanHash): void {
		//enforce that the hash is properly formatted
		$newFanHash = trim($newFanHash);
		$newFanHash = strtolower($newFanHash);
		if(empty($newFanHash) === true) {
			throw(new \InvalidArgumentException("profile password hash empty or insecure"));
		}
		//enforce that the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newFanHash)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the hash is exactly 128 characters.
		if(strlen($newFanHash) !== 128) {
			throw(new \RangeException("profile hash must be 128 characters"));
		}
		//store the hash
		$this->fanHash = $newFanHash;
	}


	/**
	 * accessor method for fan username
	 *
	 * @return string
	 */
	public function getFanUsername(): string {
		return($this->fanUsername);
	}

	/**
	 * mutator method for fan username
	 *
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


	/**
	 * inserts this Fan profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO fan(fanId, fanActivationToken, fanEmail, fanHash, fanUsername) VALUES(:fanId, :fanActivationToken, :fanEmail, :fanHash, :fanUsername)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["fanId" => $this->fanId->getBytes(), "fanActivationToken" => $this->fanActivationToken->getBytes(), "fanEmail" => $this->fanEmail, "fanHash" => $this->fanHash, "fanUsername" => $this->fanUsername];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Fan profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM fan WHERE fanId = :fanId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["fanId" => $this->fanId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Fan profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE fan SET fanActivationToken = :fanActivationToken, fanEmail = :fanEmail, fanHash = :fanHash, fanUsername = :fanUsename WHERE fanId = :fanId";
		$statement = $pdo->prepare($query);
	
		// bind the member variables to the place holders in the template
		$parameters = ["fanId" => $this->fanId->getBytes(), "fanActivationToken" => $this->fanActivationToken->getBytes(), "fanEmail" => $this->fanEmail, "fanHash" => $this->fanHash, "fanUsername" => $this->fanUsername];
		$statement->execute($parameters);
	}