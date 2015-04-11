SELECT use.name, rate.comments, temp.rateCount
	FROM Rater use
	INNER JOIN Rating rate
		ON use.user_id=rate.user_id
	INNER JOIN Location loc
		ON rate.location_id=loc.location_id
	INNER JOIN
		(SELECT use2.user_id uuid, COUNT(rate2.user_id) rateCount
			FROM Rater use2
			INNER JOIN Rating rate2
				ON use2.user_id=rate2.user_id
			GROUP BY use2.user_id) temp
		ON use.user_id=temp.uuid
	WHERE rate.location_id = LOCATION_REPLACE
	ORDER BY temp.rateCount DESC, use.name