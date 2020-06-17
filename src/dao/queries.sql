SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` as `user_name`, `situations`.`name` as `situation_name`
FROM `experiences`
INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
ORDER BY `experiences`.`date` DESC


SELECT `reviews`.`experience_id`, COUNT(`reviews`.`id`)
FROM `reviews`
GROUP BY `reviews`.`experience_id`


SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` as `user_name`, `situations`.`name` as `situation_name`,
    (SELECT COUNT(`reviews`.`id`)
    FROM `reviews`
    GROUP BY `reviews`.`experience_id`) as `reviewcount`
FROM `experiences`
INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
ORDER BY `experiences`.`date` DESC



SELECT `experiences`.`id`, `experiences`.`likes`, `users`.`name` as `user_name`, `situations`.`name` as `situation_name`, COUNT(`reviews`.`id`)
FROM `experiences`
INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
JOIN `reviews` ON `experiences`.`id` = `reviews`.`experience_id`
GROUP BY `reviews`.`experience_id`
ORDER BY `experiences`.`date` DESC


SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`, COUNT(`reviews`.`id`) AS `review_count`
FROM `experiences`
INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
LEFT OUTER JOIN `reviews` ON `experiences`.`id` = `reviews`.`experience_id`
GROUP BY `reviews`.`experience_id`
ORDER BY `experiences`.`date` DESC


SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`, COUNT(`reviews`.`id`) AS `review_count`, AVG(`reviews`.`rating`) AS `rating_average`
FROM `experiences`
INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
LEFT OUTER JOIN `reviews` ON `experiences`.`id` = `reviews`.`experience_id`
GROUP BY `reviews`.`experience_id`
ORDER BY `experiences`.`date` DESC

SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`, COUNT(`reviews`.`id`) AS `review_count`, AVG(`reviews`.`rating`) AS `rating_average`
            FROM `experiences`
            INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
            INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
LEFT OUTER JOIN `reviews` ON `experiences`.`id` = `reviews`.`experience_id`
            WHERE `experiences`.`user_id` = 1

