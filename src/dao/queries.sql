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


SELECT `int2_chats`.`id` AS 'chat_id', `int2_undercover_identities`.`undercover_name`, `int2_scammer_types`.`scammer_name`, `comment_counts`.`commentCount`, `averageRatings`.`averageRating`
FROM `int2_chats` 
    LEFT JOIN (SELECT `chat_id` , COUNT(`int2_comments`.id) as 'commentCount'
            FROM `int2_comments`
            GROUP BY `int2_comments`.`chat_id`)
            AS `comment_counts` ON `comment_counts`.`chat_id` = `int2_chats`.id
    LEFT JOIN (SELECT `chat_id`, AVG(`int2_ratings`.`rating`) as 'averageRating' FROM `int2_ratings` GROUP By `int2_ratings`.`chat_id`) AS `averageRatings`  ON `averageRatings`.`chat_id` = `int2_chats`.`id`
    LEFT JOIN `int2_undercover_identities` ON `int2_chats`.`undercover_id` = `int2_undercover_identities`.`id`
    LEFT JOIN `int2_scammer_types` ON `int2_chats`.`scammer_type_id` = `int2_scammer_types`.`id`


SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`,
COUNT(`reviews`.`id`) AS `review_count`, AVG(`reviews`.`rating`) AS `rating_average`
            FROM `experiences`
            INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
            INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
            LEFT OUTER JOIN (SELECT `experiences`.
              `reviews` ON `experiences`.`id` = `reviews`.`experience_id`";


                $sql .= " GROUP BY `reviews`.`experience_id`

SELECT `experiences`.`id`, `experiences`.`video`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`, `rating_average`,
  FROM `experiences`
  INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
  INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
  LEFT JOIN (SELECT `experience_id`, AVG(`rating`) AS `rating_average`
            FROM `reviews`
            GROUP BY `reviews`.`experience_id`) as `ratings` ON `experiences`.`id` = `ratings`.`experience_id`
         

SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`, `rating_average`, `review_count`
FROM `experiences`
INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
LEFT JOIN (SELECT `experience_id`, AVG(`rating`) AS `rating_average`
            FROM `reviews`
            GROUP BY `reviews`.`experience_id`
          ) AS `ratingsavg` ON `experiences`.`id` = `ratingsavg`.`experience_id`
LEFT JOIN (SELECT `experience_id`, COUNT(`reviews`.`id`) AS `review_count`
            FROM `reviews`
            GROUP BY `reviews`.`experience_id`
          ) AS `reviewcount` ON `experiences`.`id` = `reviewcount`.`experience_id`


SELECT `users`.`name`, `users`.`email`, COUNT(`experiences`.`id`) AS `experiences_count`, SUM(`experiences`.`likes`) AS `likes_count`
            FROM `users`
            LEFT OUTER JOIN `experiences` ON `experiences`.`user_id` = `users`.`id`
            WHERE `users`.`id` = :id
            GROUP BY `users`.`id`



SELECT `users`.`name`, `users`.`email`, SUM(`experiences`.`likes`) AS `likes_count`, AVG(`reviews`.`rating`)
FROM `users`
LEFT OUTER JOIN `experiences` ON `experiences`.`user_id` = `users`.`id`
LEFT OUTER JOIN `reviews` ON `experiences`.`user_id` = `users`.`id`
            LEFT JOIN (SELECT `experience_id`, AVG(`rating`) AS `rating_average`
            FROM `reviews`
            GROUP BY `reviews`.`experience_id`
          ) AS `ratingsavg` ON `experiences`.`id` = `ratingsavg`.`experience_id`
            WHERE `users`.`id` = 1
            GROUP BY `users`.`id`
            