SELECT use.name, use.email, COUNT(rate.post_date), AVG((rate.food+rate.price+rate.mood+rate.staff) / 4.0) avgRate
	FROM Rater use
	INNER JOIN Rating rate
		ON use.user_id=rate.user_id
	WHERE (rate.food+rate.mood+rate.price+rate.staff) COMPARE_REPLACE ALL
		(SELECT (rate2.food+rate2.mood+rate2.price+rate2.staff) 
			FROM Rating rate2
			INNER JOIN Rater use2
				ON rate2.user_id=use2.user_id
			WHERE use2.name='NAME_REPLACE')
	GROUP BY use.name, use.email
	order by avgRate DESC, use.name