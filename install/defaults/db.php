<?php

$db_sql[]= "DROP TABLE IF EXISTS `users`";
$db_sql[]= "CREATE TABLE `users` (
        `id` int(11) NOT NULL,
        `name` text NOT NULL,
        `username` varchar(50) NOT NULL,
        `email` text NOT NULL,
        `password` text NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$db_sql[]= "ALTER TABLE `users`
ADD PRIMARY KEY (`id`)";


$db_sql[]= "ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";