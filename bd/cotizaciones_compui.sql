CREATE table clientes(
idcte int not null,
nomcte varchar(80),
domicilio varchar(80),
telefono varchar(15),
email varchar(80),
constraint pkcte PRIMARY key (idcte)
);

CREATE TABLE productos(
idprod int not null,
nomprod varchar(80),
precio numeric(12,2),
estado boolean,
CONSTRAINT pkprod PRIMARY KEY (idprod)
);

CREATE TABLE cotizaciones(
idcotizacion int not null,
idcte int not null,
total numeric(12,2),
CONSTRAINT pkcot PRIMARY KEY (idcotizacion),
constraint fkcte FOREIGN KEY (idcte) REFERENCES clientes(idcte)
);

CREATE TABLE detallecot(
idcotizacion int not null,
idprod int not null,
cantidad int,
importe numeric(12,2),
CONSTRAINT pkdetalle PRIMARY KEY (idcotizacion, idprod),
CONSTRAINT fkcot FOREIGN KEY(idcotizacion)  REFERENCES cotizaciones(idcotizacion),
CONSTRAINT fkprod FOREIGN KEY(idprod) REFERENCES productos(idprod)
);