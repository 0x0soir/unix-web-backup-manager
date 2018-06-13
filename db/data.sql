/* Password: rasmuslerdorf */
INSERT INTO `users` (`id`, `username`, `email`, `password`, `session`, `last_login`, `active`, `max_size`, `used_size`, `send_memory_mails`, `send_backup_done_mails`, `root_path`, `rgpd_status`)
VALUES
	(1, 'admin', 'admin@tfg.com', '$2y$12$3OahiXpTqjwSI4wJY4sT1OB1han4FDiPKe6WHBnQYXJ4k6VF0KQqy', '', NULL, 1, 500000, 0, 1, 1, NULL, 0);

INSERT INTO `user_perms` (`id`, `name`, `definition`)
VALUES
	(1, 'ADMIN', 'Website admin.');

INSERT INTO `user_perm_to_users` (`perm_id`, `user_id`)
VALUES
	(1, 1);
