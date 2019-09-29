#data
create table company (compid int AUTO_INCREMENT primary key, name varchar(100) not null);
create table goods (goodid int AUTO_INCREMENT primary key, name varchar(100) not null);
create table shipment (shipid int AUTO_INCREMENT primary key, compid int not null,
                       goodid int not null, quantity float not null, shipdate datetime not null);

insert company (compid, name) values (1, 'Intel');
insert company (compid, name) values (2, 'IBM');
insert company (compid, name) values (3, 'Compaq');

insert goods (goodid, name) values (1, 'Pentium IIV');
insert goods (goodid, name) values (2, 'IBM server');
insert goods (goodid, name) values (3, 'Compaq Presario');

insert shipment (compid, goodid, quantity, shipdate) values (1, 1, 100, STR_TO_DATE('11/04/2010','%m/%d/%Y'));
insert shipment (compid, goodid, quantity, shipdate) values (1, 1, 200, STR_TO_DATE('11/12/2010','%m/%d/%Y'));
insert shipment (compid, goodid, quantity, shipdate) values (1, 2, 300, STR_TO_DATE('12/02/2010','%m/%d/%Y'));
insert shipment (compid, goodid, quantity, shipdate) values (1, 2, 400, STR_TO_DATE('10/09/2010','%m/%d/%Y'));
insert shipment (compid, goodid, quantity, shipdate) values (2, 1, 100, STR_TO_DATE('10/29/2010','%m/%d/%Y'));
insert shipment (compid, goodid, quantity, shipdate) values (2, 1, 200, STR_TO_DATE('11/06/2010','%m/%d/%Y'));
insert shipment (compid, goodid, quantity, shipdate) values (2, 2, 300, STR_TO_DATE('12/29/2010','%m/%d/%Y'));
insert shipment (compid, goodid, quantity, shipdate) values (2, 2, 700, STR_TO_DATE('12/03/2010','%m/%d/%Y'));

#my answer #1
SELECT
    SUM(shipment.quantity) as cnt,
    MAX(shipment.shipdate) as date,
    goods.name as gn,
    company.name as cn
FROM shipment
         LEFT JOIN company ON shipment.compid = company.compid
         LEFT JOIN goods ON shipment.goodid = goods.goodid
GROUP by shipment.compid, shipment.goodid;

#my answer #1
SELECT
    IF(
        SUM(shipment.quantity) > 0,
        SUM(shipment.quantity),
        'no data'
    ) as cnt,
    MAX(shipment.shipdate) as date,
    goods.name as gn,
    company.name as cn
FROM company
    LEFT OUTER JOIN goods ON true
    LEFT JOIN shipment
        ON shipment.compid = company.compid
               AND goods.goodid = shipment.goodid
               AND shipment.shipdate > DATE_SUB(NOW(), INTERVAL 40 DAY)

GROUP by company.compid, goods.goodid