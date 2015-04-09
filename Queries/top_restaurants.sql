SELECT rest.name, rest.restaurant_id AVG(temp.avgRating) avg
	FROM Restaurant rest
	INNER JOIN Location loc
		ON rest.restaurant_id=loc.restaurant_id
	INNER JOIN
		(SELECT loc2.location_id locid2, (rate2.food+rate2.staff+rate2.price+rate2.mood)/4.0 AS avgRating
			FROM Location loc2
			INNER JOIN Rating rate2
				ON loc2.location_id=rate2.location_id) temp
		ON loc.location_id=locid2
	GROUP BY rest.name
	ORDER BY avg DESC;

