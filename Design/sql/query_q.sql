SELECT use.name, use.email, use.join_date, rt.description, COUNT(rate.user_id) ratingCount
	FROM Rater use
	LEFT JOIN RaterType rt
		ON use.type_id=rt.type_id
	LEFT JOIN Rating rate
		ON use.user_id=rate.user_id
	GROUP BY use.name, use.email, use.join_date, rt.description
	ORDER BY ORDER_REPLACE
