INSERT INTO fan (fanId, fanActivationToken, fanEmail, fanHash, fanUsername)
VALUES (UNHEX(REPLACE("01ceecf9-d01b-4af2-b5dcf1235891044f", "-", "")), "01234", "ajike@gmail.com", "h38whs8", "greatuser");

INSERT INTO fan (fanId, fanActivationToken, fanEmail, fanHash, fanUsername)
VALUES (UNHEX(REPLACE("f5ea6c2e-9d3c-4207-83c5-aa0009d130ea", "-", "")), "52637", "qwertt@qwerty.com", "a349r0", "thatuser");

UPDATE fan SET fanEmail = 'newguy@guy.com' WHERE fanUsername = 'greatuser';
UPDATE fan SET fanEmail = 'topgun@apex.com' WHERE fanUsername = 'thatuser';

SELECT fanActivationToken FROM fan WHERE fanActivationToken = '01234';

DELETE FROM fan WHERE fanUsername = 'thatuser';
DELETE FROM fan WHERE fanUsername = 'greatuser';

