DELETE FROM grupybakterii;
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'VRE                         ','VRE',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'MBL                         ','MBL',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'KPC                         ','KPC',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'AMPC                        ','AMPC',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'ESA                         ','ESA',0,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'WAMPE                       ','AMPE',0,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'EMP                         ','EMP',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'MOP                         ','MOP- nazwa',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'ESBL                        ','ESBL',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'HLAR                        ','HLAR',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'MRSA                        ','MRSA',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'AOPIS                       ','AOPIS',0,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'MRS                         ','MRS',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'STAG                        ','STAG',0,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'BLNAR                       ','BLNAR',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'MLSB                        ','MLSB',1,'');
insert into grupybakterii (id, symbol, nazwa, mechanizmopornosciowy, opis) values (GEN_ID(GenSlowniki, 1),'PENAZ                       ','Penicylinaza',1,'');
DELETE FROM bakteriewgrupach;
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),2043,(select id from GRUPYBAKTERII where symbol='AMPC                        '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),2043,(select id from GRUPYBAKTERII where symbol='EMP                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),2043,(select id from GRUPYBAKTERII where symbol='ESBL                        '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1977,(select id from GRUPYBAKTERII where symbol='KPC                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1957,(select id from GRUPYBAKTERII where symbol='AMPC                        '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1977,(select id from GRUPYBAKTERII where symbol='MBL                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1979,(select id from GRUPYBAKTERII where symbol='MOP                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1979,(select id from GRUPYBAKTERII where symbol='AMPC                        '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1979,(select id from GRUPYBAKTERII where symbol='EMP                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1979,(select id from GRUPYBAKTERII where symbol='ESBL                        '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1957,(select id from GRUPYBAKTERII where symbol='VRE                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1957,(select id from GRUPYBAKTERII where symbol='HLAR                        '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),1979,(select id from GRUPYBAKTERII where symbol='MBL                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),2005,(select id from GRUPYBAKTERII where symbol='AMPC                        '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),2005,(select id from GRUPYBAKTERII where symbol='ESBL                        '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),2005,(select id from GRUPYBAKTERII where symbol='KPC                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),2039,(select id from GRUPYBAKTERII where symbol='EMP                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),2039,(select id from GRUPYBAKTERII where symbol='MBL                         '));
insert into bakteriewgrupach (id,bakteria,grupa) values (GEN_ID(GenSlowniki, 1),2039,(select id from GRUPYBAKTERII where symbol='MOP                         '));
