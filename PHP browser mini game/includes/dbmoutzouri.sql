DROP DATABASE IF EXISTS moutzouri;

CREATE DATABASE moutzouri;

USE moutzouri;

DROP TABLE IF EXISTS status;

DROP TABLE IF EXISTS cards;

DROP TABLE IF EXISTS cardgame;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    `idUsers` int NOT NULL AUTO_INCREMENT,
    `uidUsers` varchar(255) NOT NULL,
    `is_logged_in` int(11) NOT NULL ,
    `nikes` int(11) NOT NULL,
    PRIMARY KEY (idUsers)
);

INSERT INTO `users` VALUES (DEFAULT, 'soto', 0, 0);

INSERT INTO `users` VALUES (DEFAULT, 'stauros', 0, 0);


CREATE TABLE cardgame (
    `idCards` int NOT NULL AUTO_INCREMENT,
    `number`    varchar(255),
    `type`      varchar(255),
    `imgs`      varchar(255),
    `idplayer`  int(11),
    
    PRIMARY KEY (idCards)
);

CREATE TABLE status (
    `id` int NOT NULL AUTO_INCREMENT,
    `player_turn` int NOT NULL DEFAULT 1,
    `winner` int(11) NOT NULL,
    `loser` int(11) NOT NULL,
    `last_change` timestamp,
    `number_of_players` int NOT NULL,
    PRIMARY KEY (id)
);
INSERT INTO `status` VALUES (default, 0, 0, 0, default, 0);

CREATE TABLE cards (
    `idCards` int NOT NULL,
    `number` varchar(255) NOT NULL,
    `type` varchar(255) NOT NULL,
    `imgs` varchar(255),
    PRIMARY KEY(idCards)
);

INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('1','1','spade','acespades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('2','2','spade','2spades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('3','3','spade','3spades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('4','4','spade','4spades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('5','5','spade','5spades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('6','6','spade','6spades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('7','7','spade','7spades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('8','8','spade','8spades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('9','9','spade','9spades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('10','10','spade','10spades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('11','K','spade','kingspades.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('12','1','club','aceclubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('13','2','club','2clubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('14','3','club','3clubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('15','4','club','4clubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('16','5','club','5clubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('17','6','club','6clubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('18','7','club','7clubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('19','8','club','8clubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('20','9','club','9clubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('21','10','club','10clubs.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('22','1','heart','acehearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('23','2','heart','2hearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('24','3','heart','3hearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('25','4','heart','4hearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('26','5','heart','5hearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('27','6','heart','6hearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('28','7','heart','7hearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('29','8','heart','8hearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('30','9','heart','9hearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('31','10','heart','10hearts.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('32','1','diamonds','acediamonds.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('33','2','diamonds','2diamonds.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('34','3','diamonds','3diamonds.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('35','4','diamonds','4diamonds.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('36','5','diamonds','5diamonds.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('37','6','diamonds','6diamonds.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('38','7','diamonds','7diamonds.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('39','8','diamonds','8diamonds.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('40','9','diamonds','9diamonds.png');
INSERT INTO `cards`(`idCards`, `number`, `type`,`imgs`) VALUES ('41','10','diamonds','10diamonds.png');