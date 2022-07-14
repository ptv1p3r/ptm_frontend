
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
                <h1 class="mt-4 mb-4">Dashboard de árvores</h1>
                <!--<ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>-->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="text-white fs-5">Árvores</div>
                                <div class="text-white fs-4"><?php echo (!empty($this->userdata['treesTotal'])) ? $this->userdata['treesTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="text-white fs-5">Árvores adotadas</div>
                                <div class="text-white fs-4"><?php echo (!empty($this->userdata['adoptedTreesTotal'])) ? $this->userdata['adoptedTreesTotal'] : "0" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="text-white fs-5">?</div>
                                <div class="text-white fs-4">?</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4 text-center">
                            <div class="card-body">
                                <div class="text-white fs-5">?</div>
                                <div class="text-white fs-4">?</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Area Chart Example
                            </div>
                            <div class="card-body">
                                <canvas id="AreaChart" width="100%" height="40"></canvas>
                                <script>
                                    // area/line chart
                                    const labels = [50,60,70,80,90,100,110,120,130,140,150];
                                    const data = {
                                        labels: labels,
                                        datasets: [{
                                            label: 'My First Dataset',
                                            data: [7,8,8,9,9,9,10,11,14,14,15],
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0.1
                                        }]
                                    };

                                    const AreaChart = new Chart(document.getElementById('AreaChart'), {
                                        type: 'line',
                                        data: data,
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
                                Gráfico de barras
                            </div>
                            <div class="card-body">
                                <canvas id="BarChart" width="100%" height="40"></canvas>
                                <script>
                                    let LabelsArray = [], DataArray = [];
                                    <?php if (!empty($this->userdata['treesList'])) {
                                        $namesColumn = array_column($this->userdata['treesList'],"name");
                                        $distNames = array_unique($namesColumn);?>

                                        <?php foreach ($distNames as $key => $value){ ?>
                                            LabelsArray.push("<?php echo $value ?>");
                                            DataArray.push("<?php echo array_count_values(array_column($this->userdata['treesList'], 'name'))[$value] ?>")
                                        <?php }?>

                                    <?php } ?>
                                    //Bar chart
                                    const BarChart = new Chart(document.getElementById('BarChart'), {
                                        type: 'bar',
                                        data: {
                                            labels: LabelsArray,
                                            datasets: [{
                                                label: '# árvores por nome',
                                                data: DataArray,
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
                <!--<div class="card mb-4">
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
                </div>-->

            </div>
        </main>