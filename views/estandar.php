        <div id="contenedor_odontograma">
            <h3>Odontograma solo con los cuadraditos</h3>
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
                    <?php if (isset($piezas)): ?>
                        <?php //echo var_dump($piezas); ?>
                        <?php foreach ($piezas as $pieza) : ?>
                            <tr>
                                <th><?php echo $pieza['id_pieza'] ?></th>
                                <th><?php echo $pieza['id_cara'] ?></th>
                                <th><?php echo $pieza['estado'] ?></th>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
