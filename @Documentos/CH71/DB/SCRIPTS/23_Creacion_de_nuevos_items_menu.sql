#DELETE FROM menu WHERE id_menu > 10;
#DELETE FROM roles_menu WHERE id_menu > 10;
#ALTER TABLE menu AUTO_INCREMENT = 10;
# ICONOS
# https://fontawesome.com/v4.7.0/icon/eyedropper

INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono, habilitado, id_usuario) VALUES ('Registro de Sucesos', 1,1,20,1,'#','fa fa-eye', 1,1);
INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono, habilitado, id_usuario) VALUES ('Consultar história de recibos', 0,0,11,1,'historia_recibo','fa fa-eyedropper', 1,1);

INSERT INTO roles_menu (id_rol, id_menu, habilitado, id_usuario) VALUES (1,11,1,1);
INSERT INTO roles_menu (id_rol, id_menu, habilitado, id_usuario) VALUES (1,12,1,1);

SELECT * FROM roles_menu;
SELECT * FROM menu;
