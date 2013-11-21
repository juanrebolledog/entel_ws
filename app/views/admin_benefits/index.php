<div class="row">
    <div class="large-12 columns">
        <table>
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Desc</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($benefits as $benefit): ?>
            <tr>
                <td><?= $benefit->name; ?></td>
                <td><?= $benefit->description; ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>