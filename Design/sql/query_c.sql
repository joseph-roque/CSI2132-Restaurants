SELECT loc.location_id, rest.name, loc.street_address, loc.manager_name, loc.first_open_date
	FROM Restaurant AS rest
	INNER JOIN Location AS loc
		ON rest.restaurant_id=loc.restaurant_id
	INNER JOIN CuisineType AS ct
		ON rest.cuisine=ct.cuisine_id
	WHERE ct.description='CUISINE_DESCRIPTION'
	ORDER BY loc.first_open_date DESC, rest.name;