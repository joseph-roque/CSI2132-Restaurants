SELECT use.name, rate.food, rate.mood, rate.price, rate.staff, rate.comments
	FROM Rating rate
	INNER JOIN Rater use
		ON rate.user_id=use.user_id
	INNER JOIN Location loc
		ON rate.location_id=loc.location_id
	WHERE loc.location_id = 1 -- Replace with location_id of specific location
		AND (rate.food+rate.mood+rate.price+rate.staff) >= ALL
			(SELECT rate2.food+rate2.mood+rate2.price+rate2.staff
				FROM Rating rate2
				INNER JOIN Rater use2
					ON rate2.user_id=use2.user_id
				INNER JOIN Location loc2
					ON rate2.location_id=loc2.location_id
				WHERE loc2.location_id = 1)
