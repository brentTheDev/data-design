<?php


namespace Edu\Cnm\DataDesign;


require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/classes/autoload.php");

use Ramsey\Uuid\Uuid;

class Artist implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * id for the artist; this is the primary key
	 * @var string|Uuid $artistId
	 */
	private $artistId;
	/**
	 * genre of the artist
	 * @var string $artistGenre
	 */
	private $artistGenre;
	/**
	 * name of artist
	 * @var string $artistName
	 */
	private $artistName;


	/**
	 * constructor for this Fan
	 *
	 * @param string|Uuid $newArtistId id of this Artist or null if a new Artist
	 * @param string $newArtistGenre string containing musical genre of the Artist
	 * @param string $newArtistName string containing name of Artist
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct(string $newArtistId, string $newArtistGenre, string $newArtistName) {
		try {
			$this->setArtistId($newArtistId);
			$this->setArtistGenre($newArtistGenre);
			$this->setArtistName($newArtistName);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for artist id
	 *
	 * @return Uuid value of artist id
	 */
	public function getArtistId(): Uuid {
		return ($this->artistId);
	}

	/**
	 * mutator method for artist id
	 *
	 * @param Uuid|string $newArtistId
	 */
	public function setArtistId($newArtistId) {
		try {
			$uuid = self::validateUuid($newArtistId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the artist id
		$this->artistId = $uuid;
	}

	/**
	 * accessor method for artist genre
	 *
	 * @return string value of the artist genre
	 */
	public function getArtistGenre(): string {
		return ($this->artistGenre);
	}

	/**
	 * mutator method for artist genre
	 *
	 * @param string $newArtistGenre
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 16 characters
	 */
	public function setArtistGenre(string $newArtistGenre): void {
		$newArtistGenre = trim($newArtistGenre);
		$newArtistGenre = filter_var($newArtistGenre, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// verifies that the username is valid
		if(empty($newArtistGenre) === true) {
			throw(new \InvalidArgumentException("genre is insecure"));
		}

		//verifies if the fan username is less than 16 characters
		if(strlen($newArtistGenre) > 16)
			throw(new \RangeException("genre description cannot fit in mySQL"));

		// store the new fan username
		$this->artistName = $newArtistGenre;
	}

	/**
	 * accessor method for artist name
	 *
	 * @return string
	 */
	public function getArtistName(): string {
		return ($this->artistName);
	}

	/**
	 * mutator method for fan username
	 *
	 * @param string $newArtistName
	 * @throw \InvalidArgumentException if $newArtistName is not a valid object or string
	 * @throw \RangeException if $newArtistName is > 32 characters
	 */
	public function setArtistName(string $newArtistName): void {
		$newArtistName = trim($newArtistName);
		$newArtistName = filter_var($newArtistName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// verifies that the username is valid
		if(empty($newArtistName) === true) {
			throw(new \InvalidArgumentException("name is insecure"));
		}

		//verifies if the fan username is less than 32 characters
		if(strlen($newArtistName) > 32)
			throw(new \RangeException("name cannot fit in mySQL"));

		// store the new fan username
		$this->artistName = $newArtistName;
	}


	/**
	 * inserts this Artist profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {

		// create query template
		$query = "INSERT INTO artist(artistId, artistGenre, artistName) VALUES(:artistId, :artistGenre, :artistName)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["artistId" => $this->artistId->getBytes(), "artistGenre" => $this->artistGenre, "artistName" => $this->artistName];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Artist profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {

		// create query template
		$query = "DELETE FROM artist WHERE artistId = :artistId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["artistId" => $this->artistId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Fan profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {

		// create query template
		$query = "UPDATE artist SET artistGenre = :artistGenre, artistName = :artistName WHERE artistId = :artistId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["artistId" => $this->artistId->getBytes(), "artistGenre" => $this->artistGenre, "artistName" => $this->artistName];
		$statement->execute($parameters);
	}


	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["artistId"] = $this->artistId->toString();
		return ($fields);
	}
}
