
	CREATE TABLE tblUser (
		intUserID INT NOT NULL AUTO_INCREMENT,
		intIsActive INT DEFAULT 1,
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
	CREATE TABLE tblEditor (
		intEditorID INT NOT NULL AUTO_INCREMENT,
		intParentID INT DEFAULT 0,
		intLevel INT DEFAULT 1,
		intSortOrder INT DEFAULT 0,
		intIsActive INT DEFAULT 1,
		vcSection VARCHAR (50) NULL,
		vcItem VARCHAR (50) NULL,
		vcNavName VARCHAR (50) NULL,
		vcTitle VARCHAR (50) NULL,
		ntBody TEXT NULL,
		UNIQUE id (intEditorID),
		KEY id_2 (intEditorID),
		INDEX (intParentID)
	);


