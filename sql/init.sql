

	DROP TABLE IF EXISTS tblUser;
	DROP TABLE IF EXISTS tblPage;
	DROP TABLE IF EXISTS tblDocument;
	DROP TABLE IF EXISTS tblImage;
	DROP TABLE IF EXISTS tblGallery;
	DROP TABLE IF EXISTS tblGalleryItem;
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

	CREATE TABLE tblImage (
		intImageID INT NOT NULL AUTO_INCREMENT,
		intIsActive INT DEFAULT 0,
		vcPicFile VARCHAR (50) NULL,
		intCreatedBy INT DEFAULT 0 NOT NULL,
		intModifiedBy INT DEFAULT 0 NOT NULL,
		vcCreateDate VARCHAR (10) NULL,
		vcCreateTime VARCHAR (10) NULL,
		vcModifyDate VARCHAR (10) NULL,
		vcModifyTime VARCHAR (10) NULL,
		UNIQUE id (intImageID),
		KEY id_2 (intImageID),
		INDEX (intIsActive),
		INDEX (intCreatedBy),
		INDEX (intModifiedBy)
	);
	CREATE TABLE tblGallery (
		intGalleryID INT NOT NULL AUTO_INCREMENT,
		intIsActive INT DEFAULT 0,
		intGType INT DEFAULT 0,
		intSortNo INT DEFAULT 0,
		vcTitle VARCHAR (50) NULL,
		intCreatedBy INT DEFAULT 0 NOT NULL,
		intModifiedBy INT DEFAULT 0 NOT NULL,
		vcCreateDate VARCHAR (10) NULL,
		vcCreateTime VARCHAR (10) NULL,
		vcModifyDate VARCHAR (10) NULL,
		vcModifyTime VARCHAR (10) NULL,
		UNIQUE id (intGalleryID),
		KEY id_2 (intGalleryID),
		INDEX(intIsActive),
		INDEX(intGType),
		INDEX (intCreatedBy),
		INDEX (intModifiedBy)
	);
	CREATE TABLE tblGalleryItem (
		intGalleryItemID INT NOT NULL AUTO_INCREMENT,
		intGalleryID INT DEFAULT 0,
		intSortNo INT DEFAULT 0,
		vcVidTitle VARCHAR (50) NULL,
		vcCaption VARCHAR (50) NULL,
		vcPicFile VARCHAR (50) NULL,
		vcVidCode TEXT NULL,
		intCreatedBy INT DEFAULT 0 NOT NULL,
		intModifiedBy INT DEFAULT 0 NOT NULL,
		vcCreateDate VARCHAR (10) NULL,
		vcCreateTime VARCHAR (10) NULL,
		vcModifyDate VARCHAR (10) NULL,
		vcModifyTime VARCHAR (10) NULL,
		UNIQUE id (intGalleryItemID),
		KEY id_2 (intGalleryItemID),
		INDEX (intGalleryID),
		INDEX (intCreatedBy),
		INDEX (intModifiedBy)
	);




