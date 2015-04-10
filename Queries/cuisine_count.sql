SELECT ct.description, COUNT(rest.restaurant_id) restCount
	FROM CuisineType ct
	LEFT JOIN Restaurant rest
		ON ct.cuisine_id=rest.cuisine
	GROUP BY ct.description
	ORDER BY ct.description