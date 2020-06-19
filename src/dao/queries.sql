SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`title`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`, COUNT(`reviews`.`id`) AS `review_count`, AVG(`reviews`.`rating`) AS `rating_average`
FROM `experiences`
INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
left  JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
left JOIN  `reviews` ON `experiences`.`id` = `reviews`.`experience_id`
GROUP BY `reviews`.`experience_id`

SELECT `experiences`.`id`, `experiences`.`title`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`
FROM `experiences`
INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
INNER  JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`


SELECT * FROM `experiences`
INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
left OUTER JOIN `reviews` ON `experiences`.`id` = `reviews`.`experience_id`
ORDER BY `experiences`.`id` ASC
