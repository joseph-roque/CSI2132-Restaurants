SELECT loc.location_id, rest.name, loc.first_open_date, AVG(rate.food), AVG(rate.staff), AVG(rate.mood), AVG(rate.price), AVG((rate.food+rate.price+rate.mood+rate.staff)/4.0) avgRate, ct.description
	FROM Restaurant AS rest
	INNER JOIN Location as loc
		ON rest.restaurant_id=loc.restaurant_id
	INNER JOIN Rating rate
		ON loc.location_id=rate.location_id
	INNER JOIN CuisineType ct
		ON rest.cuisine=ct.cuisine_id
	GROUP BY loc.location_id, rest.name, loc.first_open_date, ct.description
	HAVING AVG(rate.RATING_REPLACE) >= ALL
		(SELECT rate2.RATING_REPLACE
			FROM Rating AS rate2
			INNER JOIN Rater AS use2
				ON rate2.user_id=use2.user_id
			WHERE use2.name= 'NAME_REPLACE' )
	ORDER BY avgRate DESC, rest.name;