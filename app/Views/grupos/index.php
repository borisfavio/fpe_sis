<h2>Lista de Grupos</h2>
<a href="/grupos/create">Crear nuevo grupo</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>ID Tutor</th>
        <th>Tutor</th>
        <th>ID Programa</th>
        <th>Status</th>
        <th>Días</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($grupos as $grupo): ?>
        <tr>
            <td><?= $grupo['id'] ?></td>
            <td><?= $grupo['nombres'] ?></td>
            <td><?= $grupo['id_tutor'] ?></td>
            <td><?= $grupo['nombre_tutor'] ?></td>
            <td><?= $grupo['id_programa'] ?></td>
            <td><?= $grupo['status'] ?></td>
            <td><?= $grupo['dias'] ?></td>
            <td>
                <a href="<?= site_url('/grupos/edit/' . $grupo['id']) ?>">Editar</a>
                <a href="/grupos/delete/<?= $grupo['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este grupo?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
