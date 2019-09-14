CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL COMMENT 'unique identifier for cookie',
  `name` varchar(20) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `group_number` varchar(5) NOT NULL,
  `email` varchar(40) NOT NULL,
  `points` smallint(6) NOT NULL COMMENT 'sum of points for all for exams',
  `birth_year` year(4) NOT NULL,
  `habitation` enum('local','nonresident') NOT NULL
);

ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token` (`token`);

ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
