
<?php if ( ! defined('ABSPATH')) exit; ?>

<?php if ( $this->login_required && ! $this->logged_in ) return; ?>

<!-- AJAX loader -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<div id="layoutSidenav">
    <!-- import sidebar -->
    <?php require ABSPATH . '/views/_includes/admin-sidebar.php' ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Dashboard</h1>
                <h3 class="mt-4 mb-4">Árvores</h3>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Árvores</div>
                                <div class="fs-4"><?php echo (!empty($this->userdata['treesTotal'])) ? $this->userdata['treesTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Árvores adotadas</div>
                                <div class="fs-4"><?php echo (!empty($this->userdata['adoptedTreesTotal'])) ? $this->userdata['adoptedTreesTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4 text-center">
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
                        <div class="card bg-success text-white mb-4 text-center">
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
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Árvores adotadas ao longo do tempo
                            </div>
                            <div class="card-body">
                                <canvas id="AreaChart1" width="100%" height="40"></canvas>
                                <script>
                                    let DataByYear = {}, months, values, monthCount, monthIndex, dataset;
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
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Árvores por nome
                            </div>
                            <div class="card-body">
                                <canvas id="BarChart2" width="100%" height="40"></canvas>
                                <script>
                                    //arvores adotadas por nome
                                    let LabelsArray2 = [], DataArray2 = [];
                                    <?php if (!empty($this->userdata['treesList'])) {
                                        $namesColumn = array_column($this->userdata['treesList'],"name");
                                        $distNames = array_unique($namesColumn);?>

                                        <?php foreach ($distNames as $key => $value){ ?>
                                            LabelsArray2.push("<?php echo $value ?>");
                                            <?php //conta quantos "pinheiro" existem em $namesColumn ?>
                                            DataArray2.push("<?php echo array_count_values($namesColumn)[$value] ?>")
                                        <?php }?>

                                    <?php } ?>
                                    //Bar chart
                                    const BarChart2 = new Chart(document.getElementById('BarChart2'), {
                                        type: 'bar',
                                        data: {
                                            labels: LabelsArray2,
                                            datasets: [{
                                                label: 'Árvores',
                                                data: DataArray2,
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
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

                <h3 class="mt-4 mb-4">Intervenções</h3>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-purple text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Intervenções</div>
                                <div class="fs-4"><?php echo (!empty($this->userdata['treeInterventionTotal'])) ? $this->userdata['treeInterventionTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-purple text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Intervenções ativas</div>
                                <div class="fs-4">
                                    <?php if (!empty($this->userdata['treeInterventionList'])) {
                                        $count = 0;
                                        foreach ($this->userdata['treeInterventionList'] as $key => $intervention){
                                            if ($intervention["active"] === 1) {
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
                        <div class="card bg-purple text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Intervenções inativas</div>
                                <div class="fs-4">
                                    <?php if (!empty($this->userdata['treeInterventionList'])) {
                                        $count = 0;
                                        foreach ($this->userdata['treeInterventionList'] as $key => $intervention){
                                            if ($intervention["active"] === 0) {
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
                        <div class="card bg-purple text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Intervenções publicas</div>
                                <div class="fs-4">
                                    <?php if (!empty($this->userdata['treeInterventionList'])) {
                                        $count = 0;
                                        foreach ($this->userdata['treeInterventionList'] as $key => $intervention){
                                            if ($intervention["public"] === 1) {
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
                        <div class="card bg-purple text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="fs-5">Intervenções não publicas</div>
                                <div class="fs-4">
                                    <?php if (!empty($this->userdata['treeInterventionList'])) {
                                        $count = 0;
                                        foreach ($this->userdata['treeInterventionList'] as $key => $intervention){
                                            if ($intervention["public"] === 0) {
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
                                Intervenções ao longo do tempo
                            </div>
                            <div class="card-body">
                                <canvas id="AreaChart3" width="100%" height="40"></canvas>
                                <script>
                                    DataByYear = {};
                                    months = ["Janeiro", 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
                                    values = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                    monthCount = 0; monthIndex = 0;

                                    <?php if (!empty($this->userdata['treeInterventionList'])) {
                                        //apanha coluna de datas
                                        $timeColumn = array_column($this->userdata['treeInterventionList'],"interventionDate");
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
                                    let colorsArray = {
                                        color1: "#0080A2",
                                        color2: "#009294",
                                        color3: "#00A487",
                                        color4: "#00B679",
                                        color5: "#00C86C",
                                        color6: "#00DB5F",
                                        color7: "#00ED51",
                                        color8: "#00FF44",
                                        color9: "#12ED3F",
                                        color10: "#24DB3A",
                                        color11: "#37C835",
                                        color12: "#49B631",
                                        color13: "#5BA42C",
                                        color14: "#6D9227",
                                        color15: "#808022"
                                    }
                                    if(DataByYear !== {}){
                                        var last = Object.keys(DataByYear).pop()
                                        console.log(last)
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

                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Intervenções por nome de árvores
                            </div>
                            <div class="card-body">
                                <canvas id="BarChart4" width="100%" height="40"></canvas>
                                <script>
                                    //arvores adotadas por nome
                                    let LabelsArray4 = [], DataArray4 = [];
                                    <?php if (!empty($this->userdata['treesList']) && !empty($this->userdata['treeInterventionList']) ) {
                                        $interTreeIdColumn = array_column($this->userdata['treeInterventionList'],"treeId");
                                        $distInterTreeId = array_unique($interTreeIdColumn);?>

                                        <?php foreach ($distInterTreeId as $key => $value){ ?>
                                            <?php foreach ($this->userdata['treesList'] as $key => $tree) {
                                                if ($tree["id"] === $value) {?>
                                                    LabelsArray4.push("<?php echo $tree["name"] ?>");
                                                    <?php //conta quantos "pinheiro" existem em $namesColumn ?>
                                                    DataArray4.push("<?php echo array_count_values($interTreeIdColumn)[$value] ?>")
                                                <?php }
                                            }
                                        }?>

                                    <?php } ?>
                                    //Bar chart
                                    const BarChart4 = new Chart(document.getElementById('BarChart4'), {
                                        type: 'bar',
                                        data: {
                                            labels: LabelsArray4,
                                            datasets: [{
                                                label: 'Árvores',
                                                data: DataArray4,
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
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

            </div>
        </main>