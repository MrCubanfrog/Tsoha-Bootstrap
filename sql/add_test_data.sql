-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO site_user (name, password, admin) VALUES ('johtaja', 'johtaja', True);
INSERT INTO site_user (name, password, admin) VALUES ('pelaaja1', 'pelaaja', False);
INSERT INTO site_user (name, password, admin) VALUES ('pelaaja2', 'pelaaja', False);
INSERT INTO site_user (name, password, admin) VALUES ('pelaaja3', 'pelaaja', False);


INSERT INTO game (name, system, description_short, description, gm_note) VALUES ('Uinuvan Jumalan Saari', 'Shadow of the demon lord', 'lyhyt kuvays', 'Pitkä kuvaus pelistä joka lukee sen omalla sivulla', 'salaista');

INSERT INTO game_session (game_id, name, description_short, description, gm_note) VALUES (1, '1. Haakserikko', 'Pelaajat ovat haakserikkoutuneet saarelle', 'pitempi kuvaus siitä mitä pelin aikana on loppujen lopuksi tapahtunut','huonoja juttuja tulee tapahtumaan');

INSERT INTO player_character (user_id, game_id, name, description_short, description, history, gm_note) VALUES (1, 1, 'Carl', 'lyhyt kuvaus hahmosta', 'pidempi kuvaus hahmosta hahmon omalla sivulla', 'Mennyttä tausta hommaa jee.', 'tulevaisuudessa tapahtuu asioita');

INSERT INTO game_users(user_id, game_id, gamemaster) VALUES (1, 1, True); 
INSERT INTO game_users(user_id, game_id, gamemaster) VALUES (2, 1, False); 

INSERT INTO article (game_id, name, description_short, description, gm_note) VALUES (1, 'Ithrum', 'Saari jossa peli tapahtuu', 'Pelin tapahtuma paikka. Noin 300 neliökilometrin kokoinen saari, joka on löydetty ja asutettu jonkin aikaa sitten', 'Saaressa nukkuu Jumala. Jännää.');
