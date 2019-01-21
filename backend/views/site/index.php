<?php
/* @var $this yii\web\View */
$this->title = 'demblock';
?>


<div class="site-index">

    <div class="container row dashboard">

        <form class="form-inline" method="get">

            <label class="sr-only" for="inlineFormInput">Mjesec</label>
            <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"  id="inlineFormInput" placeholder="Mjesec" name="month" value='<?= $month;?>'>

            <label class="sr-only" for="inlineFormInputGroup">Godina</label>
            <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"  id="inlineFormInputGroup" placeholder="Godina" name="year" value='<?= $year;?>'>

            <button type="submit"  class="btn btn-primary">Trazi</button>

        </form>

    </div>

    <?php if ($data): ?>

        <table  class="table table-responsive table-striped table-bordered dashboard-table">

            <thead>

            <tr>
                <th>Datum</th>
                <th>Registrovanih posloprimaca</th>
                <th>Registrovanih poslodavaca</th>
                <th>Objavljenih oglasa</th>
                <th>Potroseno novca</th>
            </tr>

            </thead>

            <tbody>

                <?php foreach ($data as $d): ?>
                <tr>

                    <th><?= $d['date']; ?></th>
                    <td><?= $d['employees']; ?></td>
                    <td><?= $d['employers']; ?></td>
                    <td><?= $d['adverts']; ?></td>
                    <td><?= $d['money']['bam'] . " BAM - " . $d['money']['eur'] . " EUR"; ?></td>

                </tr>
                <?php endforeach; ?>
                <tr class="table-total">

                    <th ><?= 'UKUPNO'; ?></th>
                    <td ><?= $registeredEmployers; ?></td>
                    <td ><?= $registeredEmployees; ?></td>
                    <td><?= $adverts; ?></td>
                    <td><?= $moneyBam . " BAM - " . $moneyEur . " EUR"; ?></td>

                </tr>

            </tbody>

        </table>

    <?php endif; ?>

</div>
