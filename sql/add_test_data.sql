-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO creation_date DEFAULT VALUES;

INSERT INTO site_user (name, password, admin, creation_id) VALUES ('ilmo', 'salis', True, 1);

INSERT INTO game (name, system, description_short, description, gm_note, creation_id) VALUES ('Uinuvan Jumalan Saari', 'Shadow of the demon lord', 'lyhyt kuvays', 'Pitkä kuvaus pelistä joka lukee sen omalla sivulla', 'salaista', 1);

INSERT INTO game_session (game_id, name, description, gm_note, creation_id) VALUES (1, '1. Haakserikko', 'Pelaajat ovat haakserikkoutuneet saarelle', 'huonoja juttuja tulee tapahtumaan', 1);

INSERT INTO player_character (user_id, game_id, name, description_short, description, history, gm_note, creation_id) VALUES (1, 1, 'Carl', 'lyhyt kuvaus hahmosta', 'pidempi kuvaus hahmosta hahmon omalla sivulla', 'Mennyttä tausta hommaa jee.', 'tulevaisuudessa tapahtuu asioita', 1);

INSERT INTO game_users(user_id, game_id, gamemaster, creation_id) VALUES (1, 1, True, 1); 

INSERT INTO article (game_id, name, description, gm_note, creation_id) VALUES (1, 'Ithrum', 'Saari jossa peli tapahtuu', 'Saaressa nukkuu jumala. Jännää.', 1);
