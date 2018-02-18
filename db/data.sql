/* Password: rasmuslerdorf */
INSERT INTO `users` (`id`, `username`, `email`, `password`, `session`)
VALUES
	(1, 'admin', 'admin@tfg.com', '$2y$12$3OahiXpTqjwSI4wJY4sT1OB1han4FDiPKe6WHBnQYXJ4k6VF0KQqy', '');

INSERT INTO `user_perms` (`id`, `name`, `definition`)
VALUES
	(1, 'ADMIN', 'Website admin.');

INSERT INTO `user_perm_to_users` (`perm_id`, `user_id`)
VALUES
	(1, 1);
