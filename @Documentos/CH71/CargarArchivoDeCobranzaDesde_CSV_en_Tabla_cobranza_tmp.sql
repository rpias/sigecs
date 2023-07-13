USE sigecs;
/*
DROP TABLE IF EXISTS _cobranza_tmp;

CREATE TABLE _cobranza_tmp (
   
    fecha date NOT NULL,
    nro_recibo int NOT NULL,
    torre_letra varchar(2) NOT NULL,
    torre_nro int NOT NULL,
    apt_nro int NOT NULL,
    monto DECIMAL(10, 2 ) NOT NULL,
    concepto varchar(100) NOT NULL,
    mes_cuota varchar(100) not null,
    anio varchar(50) not null,
    titular varchar (150) not null,
    rubrica varchar(10) not null,
    obs varchar(255) not null
       
);

SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE _cobranza_tmp;
SET FOREIGN_KEY_CHECKS = 1;
*/
LOAD DATA INFILE '/home/richard/Escritorio/RECIBOS_CAC/PRONTO/E_GastosComunes.csv' INTO TABLE _cobranza_tmp 
CHARACTER SET 'utf8'
FIELDS TERMINATED BY ',' 
#ENCLOSED BY '"'
#LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(@fecha,nro_recibo,torre_letra,torre_nro,apt_nro,monto,concepto,mes_cuota,anio,titular,rubrica,obs)
SET fecha = STR_TO_DATE(@fecha,'%d/%m/%Y');
