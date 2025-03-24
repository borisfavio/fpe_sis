-- Modificar la tabla usurios para asignar roles

ALTER TABLE fundacion_db.usuarios ADD rol_id BIGINT NOT NULL ;

-- crear tabla de roles

CREATE TABLE roles (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- crear la tabla de permisos
CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

--crear la tabla de relacion entre permisos y roles
CREATE TABLE role_permissions (
    role_id BIGINT NOT NULL,
    permission_id INT NOT NULL,
    PRIMARY KEY (role_id, permission_id)
);

