--
-- categories テーブルの作成

CREATE TABLE admins
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  login_id VARCHAR(20) NOT NULL UNIQUE,
  login_pass CHAR(64)NOT NULL
);

INSERT INTO admins(login_id, login_pass) VALUES ('admin', SHA2('secretadmin',256));
INSERT INTO admins(login_id, login_pass) VALUES ('tippeln', SHA2('secrettippeln',256));

GRANT SELECT,INSERT,UPDATE,DELETE ON crescent.* TO sysuser@localhost IDENTIFIED BY 'secret';