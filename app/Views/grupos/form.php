<h2><?= isset($grupo) ? 'Editar Grupo' : 'Crear Grupo' ?></h2>

<form method="post" action="<?= isset($grupo) ? '/grupos/update/'.$grupo['id'] : '/grupos/store' ?>">
    <label>Nombres:</label><br>
    <input type="text" name="nombres" value="<?= $grupo['nombres'] ?? '' ?>"><br>

    <label>ID Tutor:</label><br>
    <input type="number" name="id_tutor" value="<?= $grupo['id_tutor'] ?? '' ?>"><br>

    <label>ID Programa:</label><br>
    <input type="number" name="id_programa" value="<?= $grupo['id_programa'] ?? '' ?>"><br>

    <label>Status:</label><br>
    <input type="number" name="status" value="<?= $grupo['status'] ?? '' ?>"><br>

    <label>Días:</label><br>
    <textarea name="dias"><?= $grupo['dias'] ?? '' ?></textarea><br>

    <button type="submit"><?= isset($grupo) ? 'Actualizar' : 'Guardar' ?></button>
</form>
<a href="/grupos">Volver</a>
