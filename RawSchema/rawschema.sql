CREATE TABLE Rater
(
	user_id SERIAL,
	email VARCHAR(90) NOT NULL,
	name VARCHAR(70) NOT NULL,
	join_date TIMESTAMP NOT NULL,
	type TEXT NOT NULL, --not sure about this
	reputation SMALLINT NOT NULL DEFAULT 1,
	PRIMARY KEY (user_id),
	CONSTRAINT rep_bounds CHECK (reputation >= 1 AND reputation <= 5),
	CONSTRAINT valid_email CHECK (email ~* '^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+[.][A-Za-z]$'),
		--Alphanumeric (with dot, underscore dash), 1 or more
		--then @
		--then alphanumeric (with dot, dash), 1 or more
		--then .
		--then alphabetic domain end (com, ca, etc.)
	CONSTRAINT valid_name CHECK (name ~* '^[A-Za-z][A-Za-z0-9 _-]$')
		--Alphanumeric (with space, dash, underscore), starts with a letter
);

CREATE TABLE Restaurant
(
	restaurant_id SERIAL,
	name VARCHAR(70) NOT NULL,
	type TEXT NOT NULL, --not sure about this
	url TEXT NOT NULL, --not sure about this
	PRIMARY KEY (restaurant_id),
	CONSTRAINT valid_name CHECK (name ~* '^[A-Za-z][A-Za-z0-9 ]*$')
		--Stats with letter, then alphanumeric with spaces
);

CREATE TABLE Rating
(
	user_id INTEGER NOT NULL,
	post_date TIMESTAMP NOT NULL,
	price SMALLINT NOT NULL DEFAULT 0,
	food SMALLINT NOT NULL DEFAULT 0,
	mood SMALLINT NOT NULL DEFAULT 0,
	staff SMALLINT NOT NULL DEFAULT 0,
	comments TEXT, --not null?
	restaurant_id INTEGER NOT NULL,
	PRIMARY KEY (user_id, post_date),
	FOREIGN KEY (user_id) REFERENCES Rater(user_id)
		ON UPDATE CASCADE ON DELETE RESTRICT --What do we want?
	FOREIGN KEY (restaurant_id) REFERENCES Restaurant(restaurant_id)
		ON UPDATE CASCADE ON DELETE RESTRICT --What do we want?
);

CREATE TABLE Location
(
	location_id SERIAL,
	first_open_date TIMESTAMP NOT NULL,
	manager_name VARCHAR(70), --not sure about this
	phone_number CHAR(11), --not sure about this
	street_address TEXT, --not sure about this
	hour_open TEXT, --not sure about this
	hour_close TEXT, --not sure about this
	restaurant_id INTEGER NOT NULL,
	PRIMARY KEY (location_id),
	FOREIGN KEY (restaurant_id) REFERENCES Restaurant(restaurant_id)
		ON UPDATE CASCADE ON DELETE RESTRICT, --What do we want?
	CONSTRAINT valid_phone CHECK (phone_number ~* '^(1-|)(\d{3}|\(\d{3}\))[-]?\d{3}[-]?\d{4}$')
		--Starts with '1-' or not
		--Followed by either '(XYZ)' or 'XYZ'
		--Followed by 0 or 1 hyphens, 3 digits, 0 or 1 hyphens, 4 digits
);

CREATE TABLE MenuItem
(
	item_id SERIAL,
	name VARCHAR(70) NOT NULL,
	type VARCHAR(8),
	category TEXT, --not sure about this
	description TEXT, --not sure about this
	price DECIMAL(3,2),
	restaurant_id INTEGER NOT NULL,
	PRIMARY KEY (item_id),
	FOREIGN KEY (restaurant_id) REFERENCES Restaurant(restaurant_id)
		ON UPDATE CASCADE ON DELETE RESTRICT, --What do we want?
	CONSTRAINT food_or_bev CHECK (type='Food' OR type='Beverage')
);

CREATE TABLE RatingItem
(
	user_id INTEGER NOT NULL,
	post_date TIMESTAMP NOT NULL,
	item_id INTEGER NOT NULL,
	rating SMALLINT NOT NULL,
	comment TEXT, --not sure about this
	PRIMARY KEY (user_id, post_date, item_id),
	FOREIGN KEY (user_id) REFERENCES Rater(user_id)
		ON UPDATE CASCADE ON DELETE RESTRICT, --What do we want?
	FOREIGN KEY (item_id) REFERENCES MenuItem(item_id)
		ON UPDATE CASCADE ON DELETE RESTRICT, --What do we want?
	CONSTRAINT valid_rating CHECK (rating >= 1 AND rating <= 5)
);