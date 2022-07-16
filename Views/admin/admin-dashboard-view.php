
<?php if ( ! defined('ABSPATH')) exit; ?>

<?php if ( $this->login_required && ! $this->logged_in ) return; ?>

<!-- refresh page every 5 mins -->
<meta http-equiv="refresh" content="300">

<!-- AJAX loader -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<div id="layoutSidenav">
    <!-- import sidebar -->
    <?php require ABSPATH . '/views/_includes/admin-sidebar.php'?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard </h1> <p><small>*Página com recarregamento automático a cada 5 minutos.</small></p>
                <h3 class="mt-4 mb-4">Utilizadores</h3>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Utilizadores</div>
                                <div class="fs-4"><?php echo (!empty($this->userdata['usersTotal'])) ? $this->userdata['usersTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Utilizadores ativos</div>
                                <div class="fs-4">
                                    <?php if (!empty($this->userdata['usersList'])) {
                                        $count = 0;
                                        foreach ($this->userdata['usersList'] as $key => $user){
                                            if ($user["active"] === 1) {
                                                $count++;
                                            }
                                        }
                                        echo $count;
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Utilizadores inativos</div>
                                <div class="fs-4">
                                    <?php if (!empty($this->userdata['usersList'])) {
                                        $count = 0;
                                        foreach ($this->userdata['usersList'] as $key => $user){
                                            if ($user["active"] === 0) {
                                                $count++;
                                            }
                                        }
                                        echo $count;
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Utilizadores ao longo do tempo
                            </div>
                            <div class="card-body">
                                <canvas id="AreaChart3" width="100%" height="40"></canvas>
                                <script>
                                    let DataByYear, months, values, monthCount, monthIndex, dataset;
                                    DataByYear = {}
                                    months = ["Janeiro", 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
                                    values = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                    monthCount = 0; monthIndex = 0;

                                    <?php if (!empty($this->userdata['usersList'])) {
                                        //apanha coluna de datas
                                        $timeColumn = array_column($this->userdata['usersList'],"dateCreated");
                                        $monthsColumn = []; $monthsNumbers = []; $distMonths = []; $distMonthsFull = [];

                                        //apanha anos
                                        foreach ($timeColumn as $key => $value){
                                            $yearNumber = date("Y", strtotime($value));// apanha ano
                                            $yearNumbers[] = $yearNumber;// adiciona no array de numeros de anos
                                        }

                                        $distYears = array_unique($yearNumbers);//apanha so 1 de cada ano
                                        sort($distYears);//ordena os numeros dos anos

                                        //para cada ano
                                        foreach ($distYears as $yearKey => $year){
                                            $monthsColumn = []; $monthsNumbers = []; $distMonthsFull = [];

                                            foreach ($timeColumn as $key => $time){ // ve se o ano da data na $timeColumn é o mesmo do $year, se sim
                                                $timeyear = date("Y", strtotime($time));// apanha ano

                                                if($timeyear === $year){
                                                    $monthNumber = date("n", strtotime($time)); // apanha o numero do mes
                                                    $monthsNumbers[] = $monthNumber; // adiciona no array de numeros de meses
                                                    $monthsColumn[] = getMonth($monthNumber); // converte-o no mes escrito por extenso e adiciona ao array de meses
                                                }
                                            }

                                            $distMonths = array_unique($monthsNumbers);//apanha so 1 de cada mes
                                            sort($distMonths); //ordena os numeros dos meses

                                            //para cada numero de mes distinto
                                            foreach ($distMonths as $monthKey => $month){
                                                $distMonthsFull[] = getMonth($month);//converte-o no mes escrito por extenso e adiciona ao array de meses
                                            }?>

                                            //cria array de Labels e Data de meses
                                            monthCount = 0; monthIndex = 0; values = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                            <?php foreach ($distMonthsFull as $key => $monthFull){?>
                                                monthCount = "<?php echo array_count_values($monthsColumn)[$monthFull] ?>";
                                                monthIndex = months.indexOf("<?php echo $monthFull ?>");
                                                values[monthIndex] = monthCount;
                                            <?php } ?>

                                            DataByYear["<?php echo $year?>"] = (values);

                                        <?php }?>

                                    <?php } ?>

                                    dataset = [];
                                    if(DataByYear !== {}){
                                        var last = Object.keys(DataByYear).pop()
                                        for( let year in DataByYear){
                                            let empty = {hidden: (year === last) ? false : true, label: '', data: "", fill: false, borderColor: /*"rgb(36,203,159)"*/Colors.random().rgb, tension: 0.1};

                                            empty.label = year;
                                            empty.data = DataByYear[year];

                                            dataset.push(empty);
                                        }
                                    } else {
                                        dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                    }

                                    // area/line chart
                                    const data3 = {
                                        labels: months,
                                        datasets: dataset
                                    };

                                    const AreaChart3 = new Chart(document.getElementById('AreaChart3'), {
                                        type: 'line',
                                        data: data3,
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                </div>

                <h3 class="mt-4 mb-4">Árvores</h3>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Árvores</div>
                                <div class="fs-4"><?php echo (!empty($this->userdata['treesTotal'])) ? $this->userdata['treesTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Árvores adotadas</div>
                                <div class="fs-4"><?php echo (!empty($this->userdata['adoptedTreesTotal'])) ? $this->userdata['adoptedTreesTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Árvores ativas</div>
                                <div class="fs-4">
                                    <?php if (!empty($this->userdata['treesList'])) {
                                        $count = 0;
                                        foreach ($this->userdata['treesList'] as $key => $tree){
                                            if ($tree["active"] === 1) {
                                                $count++;
                                            }
                                        }
                                        echo $count;
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Árvores inativas</div>
                                <div class="fs-4">
                                    <?php if (!empty($this->userdata['treesList'])) {
                                        $count = 0;
                                        foreach ($this->userdata['treesList'] as $key => $tree){
                                            if ($tree["active"] === 0) {
                                                $count++;
                                            }
                                        }
                                        echo $count;
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Intervenções</div>
                                <div class="fs-4"><?php echo (!empty($this->userdata['treeInterventionTotal'])) ? $this->userdata['treeInterventionTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Árvores ao longo do tempo
                            </div>
                            <div class="card-body">
                                <canvas id="AreaChart2" width="100%" height="40"></canvas>
                                <script>
                                    DataByYear = {}
                                    months = ["Janeiro", 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
                                    values = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                    monthCount = 0; monthIndex = 0;

                                    <?php if (!empty($this->userdata['treesList'])) {
                                        //apanha coluna de datas
                                        $timeColumn = array_column($this->userdata['treesList'],"dateCreated");
                                        $monthsColumn = []; $monthsNumbers = []; $distMonths = []; $distMonthsFull = [];

                                        //apanha anos
                                        foreach ($timeColumn as $key => $value){
                                            $yearNumber = date("Y", strtotime($value));// apanha ano
                                            $yearNumbers[] = $yearNumber;// adiciona no array de numeros de anos
                                        }

                                        $distYears = array_unique($yearNumbers);//apanha so 1 de cada ano
                                        sort($distYears);//ordena os numeros dos anos

                                        //para cada ano
                                        foreach ($distYears as $yearKey => $year){
                                            $monthsColumn = []; $monthsNumbers = []; $distMonthsFull = [];

                                            foreach ($timeColumn as $key => $time){ // ve se o ano da data na $timeColumn é o mesmo do $year, se sim
                                                $timeyear = date("Y", strtotime($time));// apanha ano

                                                if($timeyear === $year){
                                                    $monthNumber = date("n", strtotime($time)); // apanha o numero do mes
                                                    $monthsNumbers[] = $monthNumber; // adiciona no array de numeros de meses
                                                    $monthsColumn[] = getMonth($monthNumber); // converte-o no mes escrito por extenso e adiciona ao array de meses
                                                }
                                            }

                                            $distMonths = array_unique($monthsNumbers);//apanha so 1 de cada mes
                                            sort($distMonths); //ordena os numeros dos meses

                                            //para cada numero de mes distinto
                                            foreach ($distMonths as $monthKey => $month){
                                                $distMonthsFull[] = getMonth($month);//converte-o no mes escrito por extenso e adiciona ao array de meses
                                            }?>

                                            //cria array de Labels e Data de meses
                                            monthCount = 0; monthIndex = 0; values = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                            <?php foreach ($distMonthsFull as $key => $monthFull){?>
                                                monthCount = "<?php echo array_count_values($monthsColumn)[$monthFull] ?>";
                                                monthIndex = months.indexOf("<?php echo $monthFull ?>");
                                                values[monthIndex] = monthCount;
                                            <?php } ?>

                                            DataByYear["<?php echo $year?>"] = (values);

                                        <?php }?>

                                    <?php } ?>

                                    dataset = [];
                                    if(DataByYear !== {}){
                                        var last = Object.keys(DataByYear).pop()
                                        for( let year in DataByYear){
                                            let empty = {hidden: (year === last) ? false : true, label: '', data: "", fill: false, borderColor: /*"rgb(36,203,159)"*/Colors.random().rgb, tension: 0.1};

                                            empty.label = year;
                                            empty.data = DataByYear[year];

                                            dataset.push(empty);
                                        }
                                    } else {
                                        dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                    }

                                    // area/line chart
                                    const data2 = {
                                        labels: months,
                                        datasets: dataset
                                    };

                                    const AreaChart2 = new Chart(document.getElementById('AreaChart2'), {
                                        type: 'line',
                                        data: data2,
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Árvores adotadas ao longo do tempo
                            </div>
                            <div class="card-body">
                                <canvas id="AreaChart1" width="100%" height="40"></canvas>
                                <script>
                                    DataByYear = {}
                                    months = ["Janeiro", 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
                                    values = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                    monthCount = 0; monthIndex = 0;

                                    <?php if (!empty($this->userdata['adoptedTreesList'])) {
                                        //apanha coluna de datas
                                        $timeColumn = array_column($this->userdata['adoptedTreesList'],"dateCreated");
                                        $monthsColumn = []; $monthsNumbers = []; $distMonths = []; $distMonthsFull = [];

                                        //apanha anos
                                        foreach ($timeColumn as $key => $value){
                                            $yearNumber = date("Y", strtotime($value));// apanha ano
                                            $yearNumbers[] = $yearNumber;// adiciona no array de numeros de anos
                                        }

                                        $distYears = array_unique($yearNumbers);//apanha so 1 de cada ano
                                        sort($distYears);//ordena os numeros dos anos

                                        //para cada ano
                                        foreach ($distYears as $yearKey => $year){
                                            $monthsColumn = []; $monthsNumbers = []; $distMonthsFull = [];

                                            foreach ($timeColumn as $key => $time){ // ve se o ano da data na $timeColumn é o mesmo do $year, se sim
                                                $timeyear = date("Y", strtotime($time));// apanha ano

                                                if($timeyear === $year){
                                                    $monthNumber = date("n", strtotime($time)); // apanha o numero do mes
                                                    $monthsNumbers[] = $monthNumber; // adiciona no array de numeros de meses
                                                    $monthsColumn[] = getMonth($monthNumber); // converte-o no mes escrito por extenso e adiciona ao array de meses
                                                }
                                            }

                                            $distMonths = array_unique($monthsNumbers);//apanha so 1 de cada mes
                                            sort($distMonths); //ordena os numeros dos meses

                                            //para cada numero de mes distinto
                                            foreach ($distMonths as $monthKey => $month){
                                                $distMonthsFull[] = getMonth($month);//converte-o no mes escrito por extenso e adiciona ao array de meses
                                            }?>

                                            //cria array de Labels e Data de meses
                                            monthCount = 0; monthIndex = 0; values = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                            <?php foreach ($distMonthsFull as $key => $monthFull){?>
                                                monthCount = "<?php echo array_count_values($monthsColumn)[$monthFull] ?>";
                                                monthIndex = months.indexOf("<?php echo $monthFull ?>");
                                                values[monthIndex] = monthCount;
                                            <?php } ?>

                                            DataByYear["<?php echo $year?>"] = (values);

                                        <?php }?>

                                    <?php } ?>

                                    dataset = [];
                                    if(DataByYear !== {}){
                                        var last = Object.keys(DataByYear).pop()
                                        for( let year in DataByYear){
                                            let empty = {hidden: (year === last) ? false : true, label: '', data: "", fill: false, borderColor: /*"rgb(36,203,159)"*/Colors.random().rgb, tension: 0.1};

                                            empty.label = year;
                                            empty.data = DataByYear[year];

                                            dataset.push(empty);
                                        }
                                    } else {
                                        dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                    }

                                    // area/line chart
                                    const data1 = {
                                        labels: months,
                                        datasets: dataset
                                    };

                                    const AreaChart1 = new Chart(document.getElementById('AreaChart1'), {
                                        type: 'line',
                                        data: data1,
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                </div>

                <h3 class="mt-4 mb-4">Transações</h3>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Transações</div>
                                <div class="fs-4"><?php echo (!empty($this->userdata['transactionTotal'])) ? $this->userdata['transactionTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Valor angariado</div>
                                <div class="fs-4">
                                    <?php if (!empty($this->userdata['transactionList'])) {
                                        $result = 0;
                                        foreach ($this->userdata['transactionList'] as $key => $transaction) {
                                            $result += $transaction["value"];
                                        }
                                    }
                                    echo $result . "€"?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Ultimas transações
                    </div>
                    <div class="card-body">
                        <table id="transactionsTable" class="table table-striped table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Identificador</th>
                                <th>Tipo</th>
                                <th>Método</th>
                                <th>Utilizador</th>
                                <th>Árvore</th>
                                <th>Valor</th>
                                <th>Data criado</th>
                                <th>Data atualizado</th>
                                <th>Data validado</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($this->userdata['transactionList'])) {
                                $count = 0;
                                foreach ($this->userdata['transactionList'] as $key => $transaction) {
                                    if ($count < 10) {?>
                                        <tr>
                                            <td id="bmpzvoeo4v-<?php echo $transaction["id"] ?>"
                                                onclick="copy('<?php echo $transaction["id"] ?>','bmpzvoeo4v-<?php echo $transaction["id"] ?>')"
                                                title="<?php echo $transaction["id"] ?>"
                                                class="table-text-truncate"
                                                style="cursor: pointer">
                                                <?php echo $transaction["id"] ?>
                                            </td>
                                            <?php if (!empty($this->userdata['transactionTypeList'])) { foreach ($this->userdata['transactionTypeList'] as $key => $type) { if ( $type["id"] == $transaction["transactionTypeId"]){ $typeName = $type["name"]; } } }?>
                                            <td id="bc3fn1e1hx-<?php echo $transaction["id"] ?>"
                                                onclick="copy('<?php echo $typeName ?>','bc3fn1e1hx-<?php echo $transaction["id"] ?>')"
                                                title="<?php echo $typeName ?>"
                                                class="table-text-truncate"
                                                style="cursor: pointer">
                                                <?php echo $typeName ?>
                                            </td>
                                            <?php if (!empty($this->userdata['transactionMethodList'])) { foreach ($this->userdata['transactionMethodList'] as $key => $method) { if ( $method["id"] == $transaction["transactionMethodId"]){ $methodName = $method["name"]; } } }?>
                                            <td id="qehnjmeopa-<?php echo $transaction["id"] ?>"
                                                onclick="copy('<?php echo $methodName ?>','qehnjmeopa-<?php echo $transaction["id"] ?>')"
                                                title="<?php echo $methodName ?>"
                                                class="table-text-truncate"
                                                style="cursor: pointer">
                                                <?php echo $methodName ?>
                                            </td>
                                            <td id="0dlquhlflz-<?php echo $transaction["id"] ?>"
                                                onclick="copy('<?php echo $transaction["userId"] ?>','0dlquhlflz-<?php echo $transaction["id"] ?>')"
                                                title="<?php echo $transaction["userId"] ?>"
                                                class="table-text-truncate"
                                                style="cursor: pointer">
                                                <?php echo $transaction["userId"] ?>
                                            </td>
                                            <td id="6efh5fxz3y-<?php echo $transaction["id"] ?>"
                                                onclick="copy('<?php echo $transaction["treeId"] ?>','6efh5fxz3y-<?php echo $transaction["id"] ?>')"
                                                title="<?php echo $transaction["treeId"] ?>"
                                                class="table-text-truncate"
                                                style="cursor: pointer">
                                                <?php echo $transaction["treeId"] ?>
                                            </td>
                                            <td id="8njps2d3he-<?php echo $transaction["id"] ?>"
                                                onclick="copy('<?php echo $transaction["value"] ?>','8njps2d3he-<?php echo $transaction["id"] ?>')"
                                                title="<?php echo $transaction["value"] ?>"
                                                class="table-text-truncate"
                                                style="cursor: pointer">
                                                <?php echo $transaction["value"] ?>
                                            </td>
                                            <td id="txq8n87681-<?php echo $transaction["id"] ?>"
                                                onclick="copy('<?php echo $transaction["dateCreated"] ?>','txq8n87681-<?php echo $transaction["id"] ?>')"
                                                title="<?php echo $transaction["dateCreated"] ?>"
                                                class="table-text-truncate"
                                                style="cursor: pointer">
                                                <?php echo $transaction["dateCreated"] ?>
                                            </td>
                                            <td id="iiqwvbo98y-<?php echo $transaction["id"] ?>"
                                                onclick="copy('<?php echo $transaction["dateModified"] ?>','iiqwvbo98y-<?php echo $transaction["id"] ?>')"
                                                title="<?php echo $transaction["dateModified"] ?>"
                                                class="table-text-truncate"
                                                style="cursor: pointer">
                                                <?php echo $transaction["dateModified"] ?>
                                            </td>
                                            <td id="r5bzfy57w7-<?php echo $transaction["id"] ?>"
                                                onclick="copy('<?php echo $transaction["dateValidated"] ?>','r5bzfy57w7-<?php echo $transaction["id"] ?>')"
                                                title="<?php echo $transaction["dateValidated"] ?>"
                                                class="table-text-truncate"
                                                style="cursor: pointer">
                                                <?php echo $transaction["dateValidated"] ?>
                                            </td>
                                        </tr>
                                        <?php $count++; ?>
                                    <?php }
                                }
                            } else { ?>
                                <tr>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>