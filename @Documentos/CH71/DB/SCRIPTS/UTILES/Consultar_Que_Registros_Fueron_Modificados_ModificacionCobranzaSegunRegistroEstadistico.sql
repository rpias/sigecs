


 set @tipo = 'CREAR RECIBO';
 set @fecha_ini = '2020-06-01';
 set @fecha_fin = '2020-06-01';

 SET @f_ini = CONCAT(@fecha_ini, ' 00:00:00');
 SET @f_fin = CONCAT(@fecha_fin, ' 23:59:00');
 

 
#	SELECT * FROM registro_sucesos WHERE creado BETWEEN @f_ini AND @f_fin;
 
	SELECT * FROM registro_sucesos WHERE SP = @tipo AND creado BETWEEN @f_ini AND @f_fin;
 
 

