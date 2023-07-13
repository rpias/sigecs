# ICONOS
# https://fontawesome.com/v4.7.0/icon/eyedropper

INSERT INTO menu 
(menu, encabezado, padre, hijo_de, orden, ruta, icono, habilitado, id_usuario) 
VALUES 
('Historico IPC', 0,0,7,1,'historico_ipc','fa fa-circle-o nav-icon', 1,1);

INSERT INTO roles_menu (id_rol, id_menu, habilitado, id_usuario) VALUES (1,13,1,1);

UPDATE menu SET icono='fa fa-circle-o nav-icon', hijo_de=7, padre=0, orden=1 WHERE id_menu=13;

