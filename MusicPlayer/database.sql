-- Active: 1678687549404@@127.0.0.1@3306@musicRaw
create DATABASE musicRaw;
use musicRaw;
CREATE TABLE UserInfo (userId int NOT NULL AUTO_INCREMENT PRIMARY KEY, userName VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, phoneNumber VARCHAR(50), genre VARCHAR(255), pword VARCHAR(50));

SELECT * from UserInfo;
-- drop TABLE UserInfo;

-- insert into UserInfo VALUES
-- ("aritri","dey.aritri209@gmail.com","8585033847","Folk","aritri");

CREATE TABLE musicTable (id int, title VARCHAR(50) NOT NULL, audioPath VARCHAR(50) NOT NULL,  imgPath VARCHAR(50));
insert into musicTable VALUES
(1,'Aro Ekbar','audio/AroEkbaarFossils.mp3','image/fossils.jpg'),
(2,'Choo Lo','audio/ChooLo.mp3','image/localtrain.jpg'),
(3,'Ekla Ghor','audio/EklaGhorFossils.mp3','image/fossils.jpg'),
(4,'Hasnuhana','audio/HasnuhanaFossils.mp3','image/fossils.jpg'),
(5,'Khairiyat','audio/Khairiyat.mp3','image/khairiyat.jpg'),
(6,'Nazm Nazm','audio/NazmNazm.mp3','image/nazm.jpg'),
(7,'Pasoori','audio/Pasoori.mp3','image/pasoori.jpg'),
(8,'Tum Jab Paas','audio/TumJabPass.mp3','image/prateek.jpg'),
(9,'Apna bana le','audio/ApnaBanaLe.mp3','image/apnabanale.jpg');
select * from musicTable;

CREATE TABLE uploads (title VARCHAR(50) NOT NULL,artist VARCHAR(50) NOT NULL, audioPath VARCHAR(50) NOT NULL);
select * from uploads;
CREATE TABLE favTable (id int, title VARCHAR(50) NOT NULL, audioPath VARCHAR(50) NOT NULL,  imgPath VARCHAR(50), userId int, FOREIGN KEY (userId) REFERENCES UserInfo(userId));
select * from favTable;
-- drop table favTable;


show Tables;