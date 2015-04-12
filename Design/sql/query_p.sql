SELECT rest.name, use.name, rt.description, rate.post_date, rate.comments, rate.food, rate.mood, rate.price, rate.staff, loc.location_id
	FROM Rater use
	INNER JOIN Rating rate
		ON use.user_id=rate.user_id
	INNER JOIN Location loc
		ON rate.location_id=loc.location_id
	INNER JOIN Restaurant rest
		ON loc.restaurant_id=rest.restaurant_id
	INNER JOIN RaterType rt
		ON use.type_id=rt.type_id
	ORDER BY rate.post_date DESC, use.name, rest.name
	LIMIT LIMIT_REPLACE;