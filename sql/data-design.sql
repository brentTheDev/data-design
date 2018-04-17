ALTER bkie3 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS wishlist;
DROP TABLE IF EXISTS fan;
DROP TABLE IF EXISTS artist;

CREATE TABLE artist (
		artistId BINARY(16) NOT NULL,
		artistGenre VARCHAR(16) NOT NULL,
		artistName VARCHAR(32) NOT NULL,
		PRIMARY KEY(artistId)
);

CREATE TABLE fan (
		fanId BINARY(16) NOT NULL,
		fanActivationToken CHAR(32),
		fanEmail VARCHAR(128) NOT NULL,
		fanHash CHAR(97) NOT NULL,
		fanUsername VARCHAR(32) NOT NULL,
		UNIQUE(fanEmail),
		UNIQUE(fanUsername),
		PRIMARY KEY(fanId)
);

CREATE TABLE wishlist (
		wishlistArtistId BINARY(16) NOT NULL,
		wishlistFanId BINARY(16) NOT NULL,
		INDEX(wishlistArtistId),
		INDEX(wishlistFanId),
		FOREIGN KEY(wishlistArtistId) REFERENCES artist(artistId),
		FOREIGN KEY(wishlistFanId) REFERENCES fan(fanId),
		PRIMARY KEY(wishlistArtistId, wishlistFanId)
);