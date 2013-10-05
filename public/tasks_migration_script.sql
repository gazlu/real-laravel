-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: Tasks
-- Source Schemata: Tasks
-- Created: Sat Oct 05 01:17:13 2013
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;;

-- ----------------------------------------------------------------------------
-- Schema Tasks
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `Tasks` ;
CREATE SCHEMA IF NOT EXISTS `Tasks` ;

-- ----------------------------------------------------------------------------
-- Table Tasks.UserProfile
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `Tasks`.`UserProfile` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `UserID` INT NOT NULL,
  `FirstName` VARCHAR(50) NOT NULL,
  `LastName` VARCHAR(50) NOT NULL,
  `Address` VARCHAR(100) NOT NULL,
  `MobileNo` VARCHAR(13) NOT NULL,
  `WebSite` VARCHAR(60) NOT NULL,
  `IsActive` TINYINT(1) NULL,
  `IsArchived` TINYINT(1) NULL,
  `CreatedBy` INT NULL,
  `CreatedOn` DATETIME NULL,
  `ModifiedBy` INT NULL,
  `ModifiedOn` DATETIME NULL,
  PRIMARY KEY (`ID`));

-- ----------------------------------------------------------------------------
-- Table Tasks.UserManagementUser
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `Tasks`.`UserManagementUser` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `UserName` VARCHAR(100) NULL,
  `UserPassword` VARCHAR(20) NULL,
  `Email` VARCHAR(80) NULL,
  `IsAdmin` TINYINT(1) NULL,
  PRIMARY KEY (`ID`));

-- ----------------------------------------------------------------------------
-- Table Tasks.CommonRecycleBin
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `Tasks`.`CommonRecycleBin` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `RecycleTable` VARCHAR(50) NULL,
  `RecycleTableID` VARCHAR(50) NULL,
  `RecycleRows` LONGTEXT NULL,
  `CreatedBy` INT NULL,
  `CreatedOn` DATETIME NULL,
  `IsRestored` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`));

-- ----------------------------------------------------------------------------
-- Table Tasks.Tasks
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `Tasks`.`Tasks` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Title` VARCHAR(200) NOT NULL,
  `Description` VARCHAR(200) NOT NULL,
  `AssignedTo` INT NOT NULL,
  `DueDate` DATETIME NOT NULL,
  `IsActive` TINYINT(1) NULL,
  `IsArchived` TINYINT(1) NULL,
  `CreatedBy` INT NULL,
  `CreatedOn` DATETIME NULL,
  `ModifiedBy` INT NULL,
  `ModifiedOn` DATETIME NULL,
  PRIMARY KEY (`ID`));

-- ----------------------------------------------------------------------------
-- View Tasks.SplitTable2
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- CREATE  OR REPLACE FUNCTION [dbo].[SplitTable2](@input AS Varchar(4000))
-- RETURNS
--       @Result TABLE(Value BIGINT)
-- AS
-- BEGIN
--       DECLARE @str VARCHAR(20)
--       DECLARE @ind Int
--       IF(@input is not null)
--       BEGIN
--             SET @ind = CharIndex(',',@input)
--             WHILE @ind > 0
--             BEGIN
--                   SET @str = SUBSTRING(@input,1,@ind-1)
--                   SET @input = SUBSTRING(@input,@ind+1,LEN(@input)-@ind)
--                   INSERT INTO @Result values (@str)
--                   SET @ind = CharIndex(',',@input)
--             END
--             SET @str = @input
--             INSERT INTO @Result values (@str)
--       END
--       RETURN
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.SplitTable
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- CREATE  OR REPLACE FUNCTION [dbo].[SplitTable](@input AS Varchar(4000))
-- RETURNS
--       @Result TABLE(Value BIGINT)
-- AS
-- BEGIN
--       DECLARE @str VARCHAR(20)
--       DECLARE @ind Int
--       IF(@input is not null)
--       BEGIN
--             SET @ind = CharIndex(',',@input)
--             WHILE @ind > 0
--             BEGIN
--                   SET @str = SUBSTRING(@input,1,@ind-1)
--                   SET @input = SUBSTRING(@input,@ind+1,LEN(@input)-@ind)
--                   INSERT INTO @Result values (@str)
--                   SET @ind = CharIndex(',',@input)
--             END
--             SET @str = @input
--             INSERT INTO @Result values (@str)
--       END
--       RETURN
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.UserManagementLogin
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 01/02/2011
-- -- Description:	Login Details
-- -- =============================================
-- CREATE  OR REPLACE PROCEDURE [dbo].[UserManagementLogin]
-- 	@username varchar(100)
-- 	,@password varchar(100)
-- AS
-- BEGIN
-- 		
-- 	if(EXISTS(SELECT * FROM [UserManagementUser] WHERE UserName = @username AND UserPassword = @password))
-- 	BEGIN
-- 		SELECT * FROM [UserManagementUser] WHERE UserName = @username AND UserPassword = @password		
-- 	END
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.UpdateUserPassword
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 19/06/2012
-- -- Description:	Read user with password
-- -- =============================================
-- CREATE  OR REPLACE PROCEDURE [dbo].[UpdateUserPassword] 
-- 	(
-- 		@ID	int,
-- 		@newpassword varchar(200)
-- 	)
-- AS
-- BEGIN
-- 	UPDATE	UserManagementUser
-- 	SET		UserPassword = @newpassword
-- 	WHERE	ID = @ID
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.RecycleRecord
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 17/02/2012
-- -- Description:	Recycle Table Record
-- -- =============================================
-- CREATE  OR REPLACE PROCEDURE [dbo].[RecycleRecord]
-- 	(
-- 		@RecycleTable varchar(50)
-- 		,@RecycleTableID varchar(50)
-- 		,@RecycleRows text
-- 		,@CreatedBy int
-- 		,@IsRestored bit = 0
-- 	)
-- AS
-- BEGIN
-- 	SET NOCOUNT ON;
-- 	
-- 	Declare
-- 		@archiveSql	varchar(MAX)
-- 		
-- 	SET @archiveSql	= 'DELETE FROM '+@RecycleTable+' WHERE ID = '+@RecycleTableID
-- 	
-- 	EXEC(@archiveSql)
-- 	
-- 	INSERT INTO [CommonRecycleBin]
-- 	(
-- 		[RecycleTable]
-- 		,[RecycleTableID]
-- 		,[RecycleRows]
-- 		,[CreatedBy]
-- 		,[CreatedOn]
-- 		,[IsRestored]
-- 	)
-- 	VALUES
-- 	(
-- 		@RecycleTable
-- 		,@RecycleTableID
-- 		,@RecycleRows
-- 		,@CreatedBy
-- 		,getdate()
-- 		,@IsRestored
-- 	)
-- 	
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.ReadUsers
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 12/06/2012
-- -- Description:	Read Tasks
-- -- =============================================
-- CREATE  OR REPLACE PROCEDURE [dbo].[ReadUsers] 
-- 	(
-- 		@ID	int = 0
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 
--     IF @ID = 0
-- 		BEGIN
-- 			SELECT	*
-- 			FROM	[UserManagementUser]
-- 		END
--     ELSE
-- 		BEGIN
-- 			SELECT	*
-- 			FROM	[UserManagementUser]
-- 			WHERE	ID = @ID
-- 		END
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.ReadUserProfile
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- --===================================================================================
-- 
--                             CREATE  OR REPLACE PROCEDURE [dbo].[ReadUserProfile]
-- 	                            (
--                                     @ID   int
-- 	                            )
--                             AS
--                             BEGIN
-- 	                            SET NOCOUNT ON;
--                                 IF @ID = 0
-- BEGIN
-- SELECT ID
-- ,UserID
-- ,FirstName
-- ,LastName
-- ,Address
-- ,MobileNo
-- ,WebSite
-- ,IsActive
-- ,IsArchived
-- ,CreatedBy
-- ,CreatedOn
-- ,ModifiedBy
-- ,ModifiedOn
--  FROM UserProfile
-- END
-- 
-- ELSE
-- BEGIN
-- SELECT ID
-- ,UserID
-- ,FirstName
-- ,LastName
-- ,Address
-- ,MobileNo
-- ,WebSite
-- ,IsActive
-- ,IsArchived
-- ,CreatedBy
-- ,CreatedOn
-- ,ModifiedBy
-- ,ModifiedOn
--  FROM UserProfile WHERE ID = @ID
-- END
-- 
--                             END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.ReadUserData
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 19/06/2012
-- -- Description:	Read user with password
-- -- =============================================
-- CREATE  OR REPLACE PROCEDURE [dbo].[ReadUserData] 
-- 	(
-- 		@ID	int,
-- 		@password varchar(200)
-- 	)
-- AS
-- BEGIN
-- 	SELECT	*
-- 	FROM	UserManagementUser
-- 	WHERE	ID = @ID
-- 	AND		UserPassword = @password
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.ReadTrash
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 18/02/2012
-- -- Description:	Read Recycle Rows
-- -- =============================================
-- CREATE  OR REPLACE PROCEDURE [dbo].[ReadTrash] 
-- 	(
-- 		@ID int = 0
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 	
-- 	IF @Id = 0
-- 		BEGIN
-- 			SELECT	R.*,
-- 					U.UserName CreatedByValue
-- 			FROM	CommonRecycleBin R
-- 			INNER JOIN [UserManagementUser] U
-- 			ON		R.CreatedBy = U.ID
-- 		END
-- 	ELSE
-- 		BEGIN
-- 			SELECT	R.*,
-- 					U.UserName CreatedByValue
-- 			FROM	CommonRecycleBin R
-- 			INNER JOIN [UserManagementUser] U
-- 			ON		R.CreatedBy = U.ID
-- 			WHERE	R.ID = @ID
-- 		END
-- 
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.ReadTasks
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 12/06/2012
-- -- Description:	Read Tasks
-- -- =============================================
-- CREATE  OR REPLACE PROCEDURE [dbo].[ReadTasks] 
-- 	(
-- 		@ID	int = 0
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 
--     IF @ID = 0
-- 		BEGIN
-- 			SELECT	T.*, U.username
-- 			FROM	[Tasks] T
-- 			INNER JOIN
-- 					UserManagementUser U
-- 			ON		T.AssignedTo = U.ID
-- 		END
--     ELSE
-- 		BEGIN
-- 			SELECT	T.*, U.username
-- 			FROM	[Tasks] T
-- 			INNER JOIN
-- 					UserManagementUser U
-- 			ON		T.AssignedTo = U.ID
-- 			WHERE	T.ID = @ID
-- 		END
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.ManageUserProfile
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- CREATE  OR REPLACE PROCEDURE [dbo].[ManageUserProfile]
-- 	                            (
--                                     				@ID    int
-- 				,@UserID    int
-- 				,@FirstName    varchar(50)
-- 				,@LastName    varchar(50)
-- 				,@Address    varchar(100)
-- 				,@MobileNo    varchar(13)
-- 				,@WebSite    varchar(60)
-- 				,@IsActive    bit
-- 				,@IsArchived    bit
-- 				,@CreatedBy    int
-- 				,@CreatedOn    datetime
-- 				,@ModifiedBy    int
-- 				,@ModifiedOn    datetime
-- 
-- 	                            )
--                             AS
--                             BEGIN
-- 	                            SET NOCOUNT ON;
--                                 IF @ID = 0
-- BEGIN
-- INSERT INTO UserProfile
--                                 (
--                                     
-- 				UserID
-- 				,FirstName
-- 				,LastName
-- 				,Address
-- 				,MobileNo
-- 				,WebSite
-- 				,IsActive
-- 				,IsArchived
-- 				,CreatedBy
-- 				,CreatedOn
-- 				,ModifiedBy
-- 				,ModifiedOn
--                                 )
--                              VALUES
--                                 (
--                                     
-- 				@UserID
-- 				,@FirstName
-- 				,@LastName
-- 				,@Address
-- 				,@MobileNo
-- 				,@WebSite
-- 				,@IsActive
-- 				,@IsArchived
-- 				,@CreatedBy
-- 				,@CreatedOn
-- 				,@ModifiedBy
-- 				,@ModifiedOn
-- 	                            )
-- END
-- 
-- ELSE
-- BEGIN
-- Update UserProfile SET UserID = @UserID,FirstName = @FirstName,LastName = @LastName,Address = @Address,MobileNo = @MobileNo,WebSite = @WebSite,IsActive = @IsActive,IsArchived = @IsArchived,CreatedBy = @CreatedBy,CreatedOn = @CreatedOn,ModifiedBy = @ModifiedBy,ModifiedOn = @ModifiedOn WHERE ID = @ID
-- END
-- 
--                             END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.ManageUser
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 12/06/2012
-- -- Description:	Manage Task
-- -- =============================================
-- CREATE  OR REPLACE PROCEDURE [dbo].[ManageUser]
-- 	(
-- 		@ID	int
-- 		,@UserName varchar(100)
--         ,@UserPassword varchar(20)
--         ,@Email varchar(80)
--         ,@IsAdmin bit
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 
--     IF @ID = 0
-- 		BEGIN
-- 			INSERT INTO [UserManagementUser]
-- 				(
-- 					[UserName]
-- 					,[UserPassword]
-- 					,[Email]
-- 					,[IsAdmin]
-- 				)
-- 			VALUES
-- 				(
-- 					@UserName
-- 					,@UserPassword
-- 					,@Email
-- 					,@IsAdmin
-- 				)
-- 		END
--     ELSE
--     BEGIN
-- 		UPDATE [UserManagementUser]
-- 		SET [UserName] = @UserName
-- 		  ,[UserPassword] = @UserPassword
-- 		  ,[Email] = @Email
-- 		  ,[IsAdmin] = @IsAdmin
-- 		WHERE ID = @ID
--     END
-- END
-- ;

-- ----------------------------------------------------------------------------
-- View Tasks.ManageTasks
-- ----------------------------------------------------------------------------
-- USE `Tasks`;
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 12/06/2012
-- -- Description:	Manage Task
-- -- =============================================
-- CREATE  OR REPLACE PROCEDURE [dbo].[ManageTasks] 
-- 	(
-- 		@ID	int
-- 		,@Title varchar(200)
-- 		,@Description varchar(200)
-- 		,@AssignedTo int
-- 		,@DueDate datetime
-- 		,@IsActive bit
-- 		,@IsArchived bit
-- 		,@CreatedBy int
-- 		,@CreatedOn datetime
-- 		,@ModifiedBy int
-- 		,@ModifiedOn datetime
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 
--     IF @ID = 0
--     BEGIN
-- 		INSERT INTO [Tasks]
-- 			(
-- 				[Title]
-- 				,[Description]
-- 				,[AssignedTo]
-- 				,[DueDate]
-- 				,[IsActive]
-- 				,[IsArchived]
-- 				,[CreatedBy]
-- 				,[CreatedOn]
-- 				,[ModifiedBy]
-- 				,[ModifiedOn]
-- 			)
-- 		VALUES
-- 			(
-- 				@Title
-- 				,@Description
-- 				,@AssignedTo
-- 				,@DueDate
-- 				,@IsActive
-- 				,@IsArchived
-- 				,@CreatedBy
-- 				,@CreatedOn
-- 				,@ModifiedBy
-- 				,@ModifiedOn
-- 			)
--     END
--     ELSE
--     BEGIN
-- 		UPDATE	[Tasks]
-- 		SET		[Title] = @Title
-- 				,[Description] = @Description
-- 				,[AssignedTo] = @AssignedTo
-- 				,[DueDate] = @DueDate
-- 				,[IsActive] = @IsActive
-- 				,[IsArchived] = @IsArchived
-- 				,[ModifiedBy] = @ModifiedBy
-- 				,[ModifiedOn] = @ModifiedOn
-- 		 WHERE	ID = @ID
--     END
-- END
-- ;

-- ----------------------------------------------------------------------------
-- Routine Tasks.UserManagementLogin
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 01/02/2011
-- -- Description:	Login Details
-- -- =============================================
-- CREATE PROCEDURE [dbo].[UserManagementLogin]
-- 	@username varchar(100)
-- 	,@password varchar(100)
-- AS
-- BEGIN
-- 		
-- 	if(EXISTS(SELECT * FROM [UserManagementUser] WHERE UserName = @username AND UserPassword = @password))
-- 	BEGIN
-- 		SELECT * FROM [UserManagementUser] WHERE UserName = @username AND UserPassword = @password		
-- 	END
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.UpdateUserPassword
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 19/06/2012
-- -- Description:	Read user with password
-- -- =============================================
-- CREATE PROCEDURE [dbo].[UpdateUserPassword] 
-- 	(
-- 		@ID	int,
-- 		@newpassword varchar(200)
-- 	)
-- AS
-- BEGIN
-- 	UPDATE	UserManagementUser
-- 	SET		UserPassword = @newpassword
-- 	WHERE	ID = @ID
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.RecycleRecord
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 17/02/2012
-- -- Description:	Recycle Table Record
-- -- =============================================
-- CREATE PROCEDURE [dbo].[RecycleRecord]
-- 	(
-- 		@RecycleTable varchar(50)
-- 		,@RecycleTableID varchar(50)
-- 		,@RecycleRows text
-- 		,@CreatedBy int
-- 		,@IsRestored bit = 0
-- 	)
-- AS
-- BEGIN
-- 	SET NOCOUNT ON;
-- 	
-- 	Declare
-- 		@archiveSql	varchar(MAX)
-- 		
-- 	SET @archiveSql	= 'DELETE FROM '+@RecycleTable+' WHERE ID = '+@RecycleTableID
-- 	
-- 	EXEC(@archiveSql)
-- 	
-- 	INSERT INTO [CommonRecycleBin]
-- 	(
-- 		[RecycleTable]
-- 		,[RecycleTableID]
-- 		,[RecycleRows]
-- 		,[CreatedBy]
-- 		,[CreatedOn]
-- 		,[IsRestored]
-- 	)
-- 	VALUES
-- 	(
-- 		@RecycleTable
-- 		,@RecycleTableID
-- 		,@RecycleRows
-- 		,@CreatedBy
-- 		,getdate()
-- 		,@IsRestored
-- 	)
-- 	
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.ReadUsers
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 12/06/2012
-- -- Description:	Read Tasks
-- -- =============================================
-- CREATE PROCEDURE [dbo].[ReadUsers] 
-- 	(
-- 		@ID	int = 0
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 
--     IF @ID = 0
-- 		BEGIN
-- 			SELECT	*
-- 			FROM	[UserManagementUser]
-- 		END
--     ELSE
-- 		BEGIN
-- 			SELECT	*
-- 			FROM	[UserManagementUser]
-- 			WHERE	ID = @ID
-- 		END
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.ReadUserProfile
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- --===================================================================================
-- 
--                             CREATE PROCEDURE [dbo].[ReadUserProfile]
-- 	                            (
--                                     @ID   int
-- 	                            )
--                             AS
--                             BEGIN
-- 	                            SET NOCOUNT ON;
--                                 IF @ID = 0
-- BEGIN
-- SELECT ID
-- ,UserID
-- ,FirstName
-- ,LastName
-- ,Address
-- ,MobileNo
-- ,WebSite
-- ,IsActive
-- ,IsArchived
-- ,CreatedBy
-- ,CreatedOn
-- ,ModifiedBy
-- ,ModifiedOn
--  FROM UserProfile
-- END
-- 
-- ELSE
-- BEGIN
-- SELECT ID
-- ,UserID
-- ,FirstName
-- ,LastName
-- ,Address
-- ,MobileNo
-- ,WebSite
-- ,IsActive
-- ,IsArchived
-- ,CreatedBy
-- ,CreatedOn
-- ,ModifiedBy
-- ,ModifiedOn
--  FROM UserProfile WHERE ID = @ID
-- END
-- 
--                             END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.ReadUserData
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 19/06/2012
-- -- Description:	Read user with password
-- -- =============================================
-- CREATE PROCEDURE [dbo].[ReadUserData] 
-- 	(
-- 		@ID	int,
-- 		@password varchar(200)
-- 	)
-- AS
-- BEGIN
-- 	SELECT	*
-- 	FROM	UserManagementUser
-- 	WHERE	ID = @ID
-- 	AND		UserPassword = @password
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.ReadTrash
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 18/02/2012
-- -- Description:	Read Recycle Rows
-- -- =============================================
-- CREATE PROCEDURE [dbo].[ReadTrash] 
-- 	(
-- 		@ID int = 0
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 	
-- 	IF @Id = 0
-- 		BEGIN
-- 			SELECT	R.*,
-- 					U.UserName CreatedByValue
-- 			FROM	CommonRecycleBin R
-- 			INNER JOIN [UserManagementUser] U
-- 			ON		R.CreatedBy = U.ID
-- 		END
-- 	ELSE
-- 		BEGIN
-- 			SELECT	R.*,
-- 					U.UserName CreatedByValue
-- 			FROM	CommonRecycleBin R
-- 			INNER JOIN [UserManagementUser] U
-- 			ON		R.CreatedBy = U.ID
-- 			WHERE	R.ID = @ID
-- 		END
-- 
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.ReadTasks
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 12/06/2012
-- -- Description:	Read Tasks
-- -- =============================================
-- CREATE PROCEDURE [dbo].[ReadTasks] 
-- 	(
-- 		@ID	int = 0
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 
--     IF @ID = 0
-- 		BEGIN
-- 			SELECT	T.*, U.username
-- 			FROM	[Tasks] T
-- 			INNER JOIN
-- 					UserManagementUser U
-- 			ON		T.AssignedTo = U.ID
-- 		END
--     ELSE
-- 		BEGIN
-- 			SELECT	T.*, U.username
-- 			FROM	[Tasks] T
-- 			INNER JOIN
-- 					UserManagementUser U
-- 			ON		T.AssignedTo = U.ID
-- 			WHERE	T.ID = @ID
-- 		END
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.ManageUserProfile
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- CREATE PROCEDURE [dbo].[ManageUserProfile]
-- 	                            (
--                                     				@ID    int
-- 				,@UserID    int
-- 				,@FirstName    varchar(50)
-- 				,@LastName    varchar(50)
-- 				,@Address    varchar(100)
-- 				,@MobileNo    varchar(13)
-- 				,@WebSite    varchar(60)
-- 				,@IsActive    bit
-- 				,@IsArchived    bit
-- 				,@CreatedBy    int
-- 				,@CreatedOn    datetime
-- 				,@ModifiedBy    int
-- 				,@ModifiedOn    datetime
-- 
-- 	                            )
--                             AS
--                             BEGIN
-- 	                            SET NOCOUNT ON;
--                                 IF @ID = 0
-- BEGIN
-- INSERT INTO UserProfile
--                                 (
--                                     
-- 				UserID
-- 				,FirstName
-- 				,LastName
-- 				,Address
-- 				,MobileNo
-- 				,WebSite
-- 				,IsActive
-- 				,IsArchived
-- 				,CreatedBy
-- 				,CreatedOn
-- 				,ModifiedBy
-- 				,ModifiedOn
--                                 )
--                              VALUES
--                                 (
--                                     
-- 				@UserID
-- 				,@FirstName
-- 				,@LastName
-- 				,@Address
-- 				,@MobileNo
-- 				,@WebSite
-- 				,@IsActive
-- 				,@IsArchived
-- 				,@CreatedBy
-- 				,@CreatedOn
-- 				,@ModifiedBy
-- 				,@ModifiedOn
-- 	                            )
-- END
-- 
-- ELSE
-- BEGIN
-- Update UserProfile SET UserID = @UserID,FirstName = @FirstName,LastName = @LastName,Address = @Address,MobileNo = @MobileNo,WebSite = @WebSite,IsActive = @IsActive,IsArchived = @IsArchived,CreatedBy = @CreatedBy,CreatedOn = @CreatedOn,ModifiedBy = @ModifiedBy,ModifiedOn = @ModifiedOn WHERE ID = @ID
-- END
-- 
--                             END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.ManageUser
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 12/06/2012
-- -- Description:	Manage Task
-- -- =============================================
-- CREATE PROCEDURE [dbo].[ManageUser]
-- 	(
-- 		@ID	int
-- 		,@UserName varchar(100)
--         ,@UserPassword varchar(20)
--         ,@Email varchar(80)
--         ,@IsAdmin bit
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 
--     IF @ID = 0
-- 		BEGIN
-- 			INSERT INTO [UserManagementUser]
-- 				(
-- 					[UserName]
-- 					,[UserPassword]
-- 					,[Email]
-- 					,[IsAdmin]
-- 				)
-- 			VALUES
-- 				(
-- 					@UserName
-- 					,@UserPassword
-- 					,@Email
-- 					,@IsAdmin
-- 				)
-- 		END
--     ELSE
--     BEGIN
-- 		UPDATE [UserManagementUser]
-- 		SET [UserName] = @UserName
-- 		  ,[UserPassword] = @UserPassword
-- 		  ,[Email] = @Email
-- 		  ,[IsAdmin] = @IsAdmin
-- 		WHERE ID = @ID
--     END
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.ManageTasks
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- -- =============================================
-- -- Author:		Sushant Kulkarni
-- -- Create date: 12/06/2012
-- -- Description:	Manage Task
-- -- =============================================
-- CREATE PROCEDURE [dbo].[ManageTasks] 
-- 	(
-- 		@ID	int
-- 		,@Title varchar(200)
-- 		,@Description varchar(200)
-- 		,@AssignedTo int
-- 		,@DueDate datetime
-- 		,@IsActive bit
-- 		,@IsArchived bit
-- 		,@CreatedBy int
-- 		,@CreatedOn datetime
-- 		,@ModifiedBy int
-- 		,@ModifiedOn datetime
-- 	)
-- AS
-- BEGIN
-- 	-- SET NOCOUNT ON added to prevent extra result sets from
-- 	-- interfering with SELECT statements.
-- 	SET NOCOUNT ON;
-- 
--     IF @ID = 0
--     BEGIN
-- 		INSERT INTO [Tasks]
-- 			(
-- 				[Title]
-- 				,[Description]
-- 				,[AssignedTo]
-- 				,[DueDate]
-- 				,[IsActive]
-- 				,[IsArchived]
-- 				,[CreatedBy]
-- 				,[CreatedOn]
-- 				,[ModifiedBy]
-- 				,[ModifiedOn]
-- 			)
-- 		VALUES
-- 			(
-- 				@Title
-- 				,@Description
-- 				,@AssignedTo
-- 				,@DueDate
-- 				,@IsActive
-- 				,@IsArchived
-- 				,@CreatedBy
-- 				,@CreatedOn
-- 				,@ModifiedBy
-- 				,@ModifiedOn
-- 			)
--     END
--     ELSE
--     BEGIN
-- 		UPDATE	[Tasks]
-- 		SET		[Title] = @Title
-- 				,[Description] = @Description
-- 				,[AssignedTo] = @AssignedTo
-- 				,[DueDate] = @DueDate
-- 				,[IsActive] = @IsActive
-- 				,[IsArchived] = @IsArchived
-- 				,[ModifiedBy] = @ModifiedBy
-- 				,[ModifiedOn] = @ModifiedOn
-- 		 WHERE	ID = @ID
--     END
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.SplitTable2
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- CREATE FUNCTION [dbo].[SplitTable2](@input AS Varchar(4000))
-- RETURNS
--       @Result TABLE(Value BIGINT)
-- AS
-- BEGIN
--       DECLARE @str VARCHAR(20)
--       DECLARE @ind Int
--       IF(@input is not null)
--       BEGIN
--             SET @ind = CharIndex(',',@input)
--             WHILE @ind > 0
--             BEGIN
--                   SET @str = SUBSTRING(@input,1,@ind-1)
--                   SET @input = SUBSTRING(@input,@ind+1,LEN(@input)-@ind)
--                   INSERT INTO @Result values (@str)
--                   SET @ind = CharIndex(',',@input)
--             END
--             SET @str = @input
--             INSERT INTO @Result values (@str)
--       END
--       RETURN
-- END
-- $$
-- 
-- DELIMITER ;
-- 
-- ----------------------------------------------------------------------------
-- Routine Tasks.SplitTable
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- 
-- DELIMITER $$
-- USE `Tasks`$$
-- CREATE FUNCTION [dbo].[SplitTable](@input AS Varchar(4000))
-- RETURNS
--       @Result TABLE(Value BIGINT)
-- AS
-- BEGIN
--       DECLARE @str VARCHAR(20)
--       DECLARE @ind Int
--       IF(@input is not null)
--       BEGIN
--             SET @ind = CharIndex(',',@input)
--             WHILE @ind > 0
--             BEGIN
--                   SET @str = SUBSTRING(@input,1,@ind-1)
--                   SET @input = SUBSTRING(@input,@ind+1,LEN(@input)-@ind)
--                   INSERT INTO @Result values (@str)
--                   SET @ind = CharIndex(',',@input)
--             END
--             SET @str = @input
--             INSERT INTO @Result values (@str)
--       END
--       RETURN
-- END
-- $$
-- 
-- DELIMITER ;
-- SET FOREIGN_KEY_CHECKS = 1;;
