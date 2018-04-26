<?php


namespace Edu\Cnm\DataDesign;


require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class wishlist implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * id for the artist on the wishlist
	 * @var Uuid $wishlistArtistId
	 */
	private $wishlistArtistId;
	/**
	 * id for the profile on the wishlist
	 * @var string $wishlistProfileId
	 */
	private $wishlistProfileId;


	/**
	 * constructor for this Fan
	 *
	 * @param string|Uuid $newWishlistArtistId id of the artist on the wishlist
	 * @param string|Uuid $newWishlistProfileId id of the profile owner of the wishlist
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct(string $newWishlistArtistId, string $newWishlistProfileId) {
		try {
			$this->setWishlistArtistId($newWishlistArtistId);
			$this->setWishlistProfileId($newWishlistProfileId);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for wishlist artist id
	 *
	 * @return Uuid value of wishlist artist id
	 */
	public function getWishlistArtistId(): Uuid {
		return ($this->wishlistArtistId);
	}

	/**
	 * mutator method for wishlist artist id
	 *
	 * @param Uuid|string $newWishlistArtistId
	 */
	public function setWishlistArtistId($newWishlistArtistId) {
		try {
			$uuid = self::validateUuid($newWishlistArtistId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the wishlist artist id
		$this->wishlistArtistId = $uuid;
	}

	/**
	 * accessor method for wishlist profile id
	 *
	 * @return Uuid|string value of the wishlist profile id
	 */
	public function getWishlistProfileId(): Uuid {
		return ($this->wishlistProfileId);
	}

	/**
	 * mutator method for wishlist profile id
	 *
	 * @param string $newWishlistProfileId
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 16 characters
	 */
	public function setWishlistProfileId($newWishlistProfileId) {
		try {
			$uuid = self::validateUuid($newWishlistProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the wishlist profile id
		$this->wishlistProfileId = $uuid;
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
		$query = "DELETE FROM wishlist WHERE wishlistArtistId = :wishArtistId AND wishlistFanId = :wishlistFanId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["wishlistArtistId" => $this->wishlistArtistId->getBytes(), "wishlistProfileId" => $this->wishlistProfileId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["wishlistArtistId"] = $this->wishlistArtistId->toString;
		$fields["wishlistProfileId"] = $this->wishlistProfileId->toString;
		return ($fields);
	}
}
