

	DROP TABLE IF EXISTS tblUser;
	DROP TABLE IF EXISTS tblEditor;
	DROP TABLE IF EXISTS tblDocument;
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
	CREATE TABLE tblPage (
		intPageID INT NOT NULL AUTO_INCREMENT,
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
		UNIQUE id (intPageID),
		KEY id_2 (intPageID),
		INDEX (intParentID),
		INDEX (intCreatedBy),
		INDEX (intModifiedBy)
	);
	CREATE TABLE tblDocument (
		intDocumentID INT NOT NULL AUTO_INCREMENT,
		vcDocTitle VARCHAR (50) NULL,
		vcDocFile VARCHAR (50) NULL,
		intCreatedBy INT DEFAULT 0 NOT NULL,
		intModifiedBy INT DEFAULT 0 NOT NULL,
		vcCreateDate VARCHAR (10) NULL,
		vcCreateTime VARCHAR (10) NULL,
		vcModifyDate VARCHAR (10) NULL,
		vcModifyTime VARCHAR (10) NULL,
		UNIQUE id (intDocumentID),
		KEY id_2 (intDocumentID),
		INDEX (intCreatedBy),
		INDEX (intModifiedBy)
	);

