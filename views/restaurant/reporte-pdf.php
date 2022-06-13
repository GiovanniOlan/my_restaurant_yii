<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h2 class="card-title">Ganacias Obtenidas</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Ganancias obtenidas
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?= $money_win['total'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Porcentaje de clientes Hombres o Mujeres -->
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h2 class="card-title"> Porcentaje De Clientes Hombres y Mujeres</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Generos
                                    </th>
                                    <th>
                                        Cantidad
                                    </th>
                                    <th>
                                        Porcentaje
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Hombres
                                    </td>
                                    <td>
                                        <?= $clients_men['mens'] ?>
                                    </td>
                                    <td>
                                        <?= (($clients_men['mens'] * 100) / ($clients_men['mens'] + $clients_woman['womans'])) ?>%
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Mujeres
                                    </td>
                                    <td>
                                        <?= $clients_woman['womans'] ?>
                                    </td>
                                    <td>
                                        <?= (($clients_woman['womans'] * 100) / ($clients_men['mens'] + $clients_woman['womans'])) ?>%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clasificación de edades de clientes -->
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h2 class="card-title"> Clasificación de Edades de Clientes</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Jovenes(1-30)
                                    </th>
                                    <th>
                                        Adultos(31-50)
                                    </th>
                                    <th>
                                        Mayores(>50)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?= $jovenes['jovenes'] ?>
                                    </td>
                                    <td>
                                        <?= $adultos['adultos'] ?>
                                    </td>
                                    <td>
                                        <?= $mayores['mayores'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clasificación de edades de clientes -->
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h2 class="card-title">Ranking de Paquetes Más Vendidos</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Puesto
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Cantidad Vendida
                                    </th>
                                </tr>
                            </thead>
                            <?php $con = 1;
                            foreach ($items_more_populate as $i) { ?>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?= $con ?>
                                        </td>
                                        <td>
                                            <?= $i['catmenite_name'] ?>
                                        </td>
                                        <td>
                                            <?= $i['total_ventas'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php $con++ ?>
                            <?php } ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>