<div id="contenedor_odontograma">
       <?php if (isset($odontograma)) echo $odontograma?>
</div>
<div>
    <h3>Detalles del Odontograma</h3>
    <table style="border: solid 1px">
        <thead>
            <tr>
                <th>Pieza</th>
                <th>Cara</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($datos)): ?>
                <?php foreach ($datos['piezas'] as $pieza) : ?>
                    <?php foreach ($pieza['caras'] as $cara): ?>
                        <?php foreach ($cara['estados'] as $estado): ?>
                            <tr>
                                <th><?php echo $pieza['id'] ?></th>
                                <th><?php echo $cara['id'] ?></th>
                                <th><?php echo $estado['desc_estado'] ?></th>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
