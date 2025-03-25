CREATE TABLE asistencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alumno_id INT NOT NULL,
    fecha DATE NOT NULL,
    estado ENUM('presente', 'ausente', 'justificado') NOT NULL,
    observaciones TEXT,
    FOREIGN KEY (alumno_id) REFERENCES alumnos(id),
    UNIQUE KEY (alumno_id, fecha)
);


