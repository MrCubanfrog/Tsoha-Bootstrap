-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE creation_date(
	id SERIAL PRIMARY KEY,
	creation_date TIMESTAMP DEFAULT LOCALTIMESTAMP
);

CREATE TABLE site_user (
	id SERIAL PRIMARY KEY,
	name VARCHAR(32),
	password VARCHAR(64),
	admin BOOLEAN,
	creation_id INTEGER REFERENCES creation_date(id)	
);

CREATE TABLE game (
	id SERIAL PRIMARY KEY,
	name VARCHAR(64),
	system VARCHAR(32),
	description_short VARCHAR(128),
	description TEXT,
	gm_note TEXT,
	creation_id INTEGER REFERENCES creation_date(id)	
);

CREATE TABLE game_session (
	id SERIAL PRIMARY KEY,
	game_id INTEGER REFERENCES game(id),
	name VARCHAR(64),
	description TEXT,
	gm_note TEXT,
	creation_id INTEGER REFERENCES creation_date(id)	
);


CREATE TABLE player_character (
	id SERIAL PRIMARY KEY,
	user_id INTEGER REFERENCES site_user(id),
	game_id INTEGER REFERENCES game(id),
	name VARCHAR(64),
	description_short VARCHAR(128),
	description TEXT,
	history TEXT,
	gm_note TEXT,
	creation_id INTEGER REFERENCES creation_date(id)	
);

CREATE TABLE game_users(
	user_id INTEGER REFERENCES site_user(id),
	game_id INTEGER REFERENCES game(id),
	gamemaster BOOLEAN,
	creation_id INTEGER REFERENCES creation_date(id),
	PRIMARY KEY(user_id, game_id)
);

CREATE TABLE article (
	id SERIAL PRIMARY KEY,
	game_id INTEGER REFERENCES game(id),
	name VARCHAR(64),
	description TEXT,
	gm_note TEXT,
	creation_id INTEGER REFERENCES creation_date(id)	
);
