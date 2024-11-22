Create table loomad(
                       id int PRIMARY key AUTO_INCREMENT,
                       loomanimi varchar(20),
                       omanik varchar(20),
                       varv varchar(20));

insert into loomad(loomanimi, omanik, varv)
values ('kass Vassily', 'David', 'red');
select * from loomad

CREATE TABLE osalejad (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          nimi VARCHAR(20),
                          telefon VARCHAR(15),
                          pilt TEXT,
                          synniaeg DATE
);

insert into osalejad(nimi, telefon, pilt, synniaeg)
values ('John Doe', '555-1234', 'https://example.com/johndoe.jpg', '1990-05-15');

