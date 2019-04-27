CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `group_number` varchar(5) NOT NULL,
  `email` varchar(40) NOT NULL,
  `points` smallint(6) NOT NULL,
  `birth_year` year(4) NOT NULL,
  `habitation` enum('local','nonresident') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token` (`token`);

ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;