USE sigecs;

DROP TABLE IF EXISTS _cobranza_tmp;

CREATE TABLE _cobranza_tmp (
   
    fecha date NOT NULL,
    nro_recibo int NOT NULL,
    torre_letra varchar(20) NOT NULL,
    torre_nro varchar(10) NOT NULL,
    apt_nro varchar(10) NOT NULL,
    monto varchar(100) NOT NULL,
    concepto varchar(100) NOT NULL,
    cuota varchar(100) not null,
    anio varchar(50) not null,
    titular varchar (150) not null,
    rubrica varchar(10) not null,
    obs varchar(255) not null
   
    
);

#SET FOREIGN_KEY_CHECKS = 0; 
#TRUNCATE TABLE _cobranza_tmp;
#SET FOREIGN_KEY_CHECKS = 1;

LOAD DATA INFILE '/home/richard/Escritorio/HistoricoCobros.csv' INTO TABLE _cobranza_tmp 
CHARACTER SET 'latin1'
FIELDS TERMINATED BY ';' 
#ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;