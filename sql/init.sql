
	CREATE TABLE tblUser (
		intUserID INT NOT NULL AUTO_INCREMENT,
		intIsActive INT DEFAULT 0,
		vcPin VARCHAR (10) NULL,
		vcLevel VARCHAR (10) NULL,
		vcFName VARCHAR (50) NULL,
		vcLName VARCHAR (50) NULL,
		vcEmail VARCHAR (100) NULL,
		vcLogPW TEXT NULL,
		UNIQUE id (intUserID),
		KEY id_2 (intUserID),
		INDEX (intIsActive)
	);

