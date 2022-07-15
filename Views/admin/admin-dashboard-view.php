
<?php if ( ! defined('ABSPATH')) exit; ?>

<?php if ( $this->login_required && ! $this->logged_in ) return; ?>

<!-- AJAX loader -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<div id="layoutSidenav">
    <!-- import sidebar -->
    <?php require ABSPATH . '/views/_includes/admin-sidebar.php'?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
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

                                    let LabelsArray3 = [], DataArray3 = [];
                                    <?php if (!empty($this->userdata['treesList'])) {
                                    //apanha coluna de datas
                                    $timeColumn = array_column($this->userdata['usersList'],"dateCreated");
                                    $monthsColumn = []; $monthsNumbers = []; $distMonths = []; $distMonthsFull = [];

                                    //para cada data em $timeColumn
                                    foreach ($timeColumn as $key => $value){
                                        $monthNumber = date("n", strtotime($value)); // apanha o numero do mes
                                        $monthsNumbers[] = $monthNumber; // adiciona no array de numeros de meses
                                        $monthsColumn[] = getMonth($monthNumber); // converte-o no mes escrito por extenso
                                    }

                                    $distMonths = array_unique($monthsNumbers);//apanha so 1 de cada mes
                                    sort($distMonths); //ordena os numeros dos meses

                                    $monthsNumbers = [];// limpa array de numeros de meses

                                    //para cada numero de mes distinto
                                    foreach ($distMonths as $key => $value){
                                        $distMonthsFull[] = getMonth($value);//converte-o no mes escrito por extenso
                                    }?>

                                    //cria array de Labels e Data de meses
                                    <?php foreach ($distMonthsFull as $key => $value){?>
                                    LabelsArray3.push("<?php echo $value ?>");
                                    <?php //conta quantos "janeiro" existem em $monthsColumn ?>
                                    DataArray3.push("<?php echo array_count_values($monthsColumn)[$value] ?>")
                                    <?php } ?>

                                    <?php } ?>

                                    // area/line chart
                                    const data3 = {
                                        labels: LabelsArray3,
                                        datasets: [{
                                            label: 'Utilizadores',
                                            data: DataArray3,
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0.1
                                        }]
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

                                    let LabelsArray2 = [], DataArray2 = [];
                                    <?php if (!empty($this->userdata['treesList'])) {
                                        //apanha coluna de datas
                                        $timeColumn = array_column($this->userdata['treesList'],"dateCreated");
                                        $monthsColumn = []; $monthsNumbers = []; $distMonths = []; $distMonthsFull = [];

                                        //para cada data em $timeColumn
                                        foreach ($timeColumn as $key => $value){
                                            $monthNumber = date("n", strtotime($value)); // apanha o numero do mes
                                            $monthsNumbers[] = $monthNumber; // adiciona no array de numeros de meses
                                            $monthsColumn[] = getMonth($monthNumber); // converte-o no mes escrito por extenso
                                        }

                                        $distMonths = array_unique($monthsNumbers);//apanha so 1 de cada mes
                                        sort($distMonths); //ordena os numeros dos meses

                                        $monthsNumbers = [];// limpa array de numeros de meses

                                        //para cada numero de mes distinto
                                        foreach ($distMonths as $key => $value){
                                            $distMonthsFull[] = getMonth($value);//converte-o no mes escrito por extenso
                                        }?>

                                        //cria array de Labels e Data de meses
                                        <?php foreach ($distMonthsFull as $key => $value){?>
                                            LabelsArray2.push("<?php echo $value ?>");
                                            <?php //conta quantos "janeiro" existem em $monthsColumn ?>
                                            DataArray2.push("<?php echo array_count_values($monthsColumn)[$value] ?>")
                                        <?php } ?>

                                    <?php } ?>

                                    // area/line chart
                                    const data2 = {
                                        labels: LabelsArray2,
                                        datasets: [{
                                            label: 'Árvores',
                                            data: DataArray2,
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0.1
                                        }]
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

                                    let LabelsArray1 = [], DataArray1 = [];
                                    <?php if (!empty($this->userdata['adoptedTreesList'])) {
                                        //apanha coluna de datas
                                        $timeColumn = array_column($this->userdata['adoptedTreesList'],"dateCreated");
                                        $monthsColumn = []; $monthsNumbers = []; $distMonths = []; $distMonthsFull = [];

                                        //para cada data em $timeColumn
                                        foreach ($timeColumn as $key => $value){
                                            $monthNumber = date("n", strtotime($value)); // apanha o numero do mes
                                            $monthsNumbers[] = $monthNumber; // adiciona no array de numeros de meses
                                            $monthsColumn[] = getMonth($monthNumber); // converte-o no mes escrito por extenso
                                        }

                                        $distMonths = array_unique($monthsNumbers);//apanha so 1 de cada mes
                                        sort($distMonths); //ordena os numeros dos meses

                                        $monthsNumbers = [];// limpa array de numeros de meses

                                        //para cada numero de mes distinto
                                        foreach ($distMonths as $key => $value){
                                            $distMonthsFull[] = getMonth($value);//converte-o no mes escrito por extenso
                                        }?>

                                        //cria array de Labels e Data de meses
                                        <?php foreach ($distMonthsFull as $key => $value){?>
                                            LabelsArray1.push("<?php echo $value ?>");
                                            <?php //conta quantos "janeiro" existem em $monthsColumn ?>
                                            DataArray1.push("<?php echo array_count_values($monthsColumn)[$value] ?>")
                                        <?php } ?>

                                    <?php } ?>

                                    // area/line chart
                                    const data1 = {
                                        labels: LabelsArray1,
                                        datasets: [{
                                            label: 'Árvores',
                                            data: DataArray1,
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0.1
                                        }]
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

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable Example
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>$170,750</td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>$86,000</td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>$162,700</td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>$372,000</td>
                            </tr>
                            <tr>
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012/08/06</td>
                                <td>$137,500</td>
                            </tr>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010/10/14</td>
                                <td>$327,900</td>
                            </tr>
                            <tr>
                                <td>Colleen Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009/09/15</td>
                                <td>$205,500</td>
                            </tr>
                            <tr>
                                <td>Sonya Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>23</td>
                                <td>2008/12/13</td>
                                <td>$103,600</td>
                            </tr>
                            <tr>
                                <td>Jena Gaines</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>30</td>
                                <td>2008/12/19</td>
                                <td>$90,560</td>
                            </tr>
                            <tr>
                                <td>Quinn Flynn</td>
                                <td>Support Lead</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2013/03/03</td>
                                <td>$342,000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>