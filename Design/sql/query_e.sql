SELECT it.description, AVG(item.price)
	FROM Restaurant rest
	INNER JOIN MenuItem item
		ON rest.restaurant_id=item.restaurant_id
	INNER JOIN CuisineType ct
		ON rest.cuisine=ct.cuisine_id
	INNER JOIN ItemType it
		ON item.type_id=it.type_id
	WHERE ct.description='CUISINE_DESCRIPTION'
	GROUP BY it.description
	ORDER BY it.description;