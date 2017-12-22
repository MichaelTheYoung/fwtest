

	DROP TABLE IF EXISTS tblUser;
	DROP TABLE IF EXISTS tblEditor;
	CREATE TABLE tblUser (
		intUserID INT NOT NULL AUTO_INCREMENT,
		intIsActive INT DEFAULT 1 NOT NULL,
		vcPin VARCHAR (10) NULL,
		vcLevel VARCHAR (10) NULL,
		vcFName VARCHAR (50) NULL,
		vcLName VARCHAR (50) NULL,
		vcEmail VARCHAR (100) NULL,
		vcLogPW TEXT NULL,
		intCreatedBy INT DEFAULT 0 NOT NULL,
		intModifiedBy INT DEFAULT 0 NOT NULL,
		vcCreateDate VARCHAR (10) NULL,
		vcCreateTime VARCHAR (10) NULL,
		vcModifyDate VARCHAR (10) NULL,
		vcModifyTime VARCHAR (10) NULL,
		UNIQUE id (intUserID),
		KEY id_2 (intUserID),
		INDEX (intIsActive),
		INDEX (intCreatedBy),
		INDEX (intModifiedBy)
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
		intCreatedBy INT DEFAULT 0 NOT NULL,
		intModifiedBy INT DEFAULT 0 NOT NULL,
		vcCreateDate VARCHAR (10) NULL,
		vcCreateTime VARCHAR (10) NULL,
		vcModifyDate VARCHAR (10) NULL,
		vcModifyTime VARCHAR (10) NULL,
		UNIQUE id (intEditorID),
		KEY id_2 (intEditorID),
		INDEX (intParentID),
		INDEX (intCreatedBy),
		INDEX (intModifiedBy)
	);


