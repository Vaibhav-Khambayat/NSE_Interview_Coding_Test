USE `nse_test`;
DROP procedure IF EXISTS `usp_insert_userinfo`;
DELIMITER $$
USE `nse_test`$$
CREATE PROCEDURE `usp_insert_userinfo`(IN UserName varchar(45), IN UserMobile varchar(10), IN UserEmail varchar(45),
IN UserPassword varchar(100), IN UserFileName varchar(255))
BEGIN
	INSERT INTO userinfo
    (
		name,
        mobile,
        email,
        password,
        filename
    )
    VALUES
    (
		UserName,
        UserMobile,
        UserEmail,
        UserPassword,
        UserFileName
    );
	SELECT LAST_INSERT_ID() AS UserId;
END$$
DELIMITER ;



USE `nse_test`;
DROP procedure IF EXISTS `usp_get_login_info`;
DELIMITER $$
USE `nse_test`$$
CREATE PROCEDURE `usp_get_login_info` (IN UserName varchar(45), IN UserMobile varchar(10), IN UserEmail varchar(45))
BEGIN
	SELECT ui.userinfoid AS UserId, ui.password AS UserPassword
    FROM userinfo ui
    WHERE 
    (ui.name = UserName OR ui.mobile = UserMobile OR ui.email = UserEmail)
    AND ui.is_active = 1
    AND ui.is_soft_delete = 0;
END$$
DELIMITER ;