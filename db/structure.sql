DROP TABLE IF EXISTS users;

CREATE TABLE users(
  id int not null primary key auto_increment,
  username varchar(50),
  email varchar(64),
  password char(60),
  created_at datetime,
  updated_at datetime
);

DROP TABLE IF EXISTS user_logs;

CREATE TABLE user_logs(
  id int not null primary key auto_increment,
  user_id int,
  history varchar(200),
  ip varchar(64),
  created_at datetime,
  updated_at datetime
);
