
ALTER TABLE roles
ADD nivel INT;

UPDATE roles SET nivel = 1 WHERE id_rol = 1;
UPDATE roles SET nivel = 2 WHERE id_rol = 2;
UPDATE roles SET nivel = 3 WHERE id_rol = 3;
SELECT * FROM roles;
