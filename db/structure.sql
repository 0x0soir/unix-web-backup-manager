SET foreign_key_checks = 0;

DROP TABLE IF EXISTS users;

CREATE TABLE users(
  id int(11) not null primary key auto_increment,
  username varchar(50),
  email varchar(64),
  password char(60),
  session char(60),
  last_login DATETIME,
  max_size bigint(20) DEFAULT '0',
  used_size bigint(20) DEFAULT '0',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS user_logs;

CREATE TABLE user_logs(
  id int not null primary key auto_increment,
  user_id int(11) NOT NULL,
  history varchar(200),
  ip varchar(64) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `FK_pk_user_logs_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS user_perms;

CREATE TABLE `user_perms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS user_perm_to_users;

CREATE TABLE `user_perm_to_users` (
  `perm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`perm_id`,`user_id`),
  CONSTRAINT `FK_pk_user_perm_to_users_perm` FOREIGN KEY (`perm_id`) REFERENCES `user_perms` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_pk_user_perm_to_users_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS backups;

CREATE TABLE `backups` (
  `id` int(11) not null auto_increment,
  `user_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `source_directory` varchar(4351) NOT NULL,
  `excluded_extensions` text NOT NULL,
  `excluded_directories` text NOT NULL,
  `cronjob` VARCHAR(4096) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_pk_backups_to_users_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS backup_logs;

CREATE TABLE backup_logs(
  id int not null primary key auto_increment,
  backup_id int(11) NOT NULL,
  history varchar(200),
  ip varchar(64) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `FK_pk_backup_logs_backup` FOREIGN KEY (`backup_id`) REFERENCES `backups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS backup_files;

CREATE TABLE backup_files(
  id int not null primary key auto_increment,
  backup_id int(11) NOT NULL,
  url varchar(300),
  type varchar(10),
  size int(12),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `FK_pk_backup_files_backup` FOREIGN KEY (`backup_id`) REFERENCES `backups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET foreign_key_checks = 1;
