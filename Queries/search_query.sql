SELECT loc.location_id
	FROM Location loc
	INNER JOIN Restaurant rest
		ON loc.restaurant_id=rest.restaurant_id
	INNER JOIN CuisineType ct
		ON ct.cuisine_id=rest.cuisine
	INNER JOIN MenuItem item
		ON rest.restaurant_id=item.restaurant_id
	WHERE ct.description ~* '%*QUERY%*' --Replace QUERY with actual search terms
		OR rest.name ~* '%*QUERY%*' --Replace QUERY with actual search terms
		OR item.name ~* '%*QUERY%*' --Replace QUERY with actual search terms
		OR rest.url ~* '%*QUERY%*' --Replace QUERY with actual search terms
	GROUP BY loc.location_id