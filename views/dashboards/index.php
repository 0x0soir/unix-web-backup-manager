<?php
$this->load->view('_/header', array(
    'menu_active' => 'dashboards_index'
));
?>
<div class="row">
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="database"></span> Espacio máximo</h5>
                <h1 class="card-text text-center">
                    <?= $max_size ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="copy"></span> Espacio usado</h5>
                <h1 class="card-text text-center">
                    <?= $used_size ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="database"></span> Backups programados</h5>
                <h1 class="card-text text-center">
                    <?= count($scripts) ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="clock"></span> Backups realizados</h5>
                <h1 class="card-text text-center">
                    <?= $backups ?>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="pull-left">Tamaño disponible</h3>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $size_percent ?>%;" aria-valuenow="<?= $size_percent ?>" aria-valuemin="0" aria-valuemax="100">
                        <?= round($size_percent) ?>%
                    </div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= 100-$size_percent ?>%" aria-valuenow="<?= round(100-$size_percent) ?>" aria-valuemin="0" aria-valuemax="100">
                        <?= round(100-$size_percent) ?>%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="pull-left">Estadísticas</h3>
            </div>
            <div class="card-body">
                <div id="main1" style="width: 100%;height:400px; <?= ( ! isset($chart_last_days)) ? 'display:flex;align-items:center;justify-content: center;' : '' ?>">
                    <?php if ( ! isset($chart_last_days)): ?>
                        <h2 class="text-center">No existen datos históricos</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($chart_last_days)): ?>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            {
                let myChart1 = echarts.init(document.getElementById('main1'));

                let option1 = {
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'cross',
                            crossStyle: {
                                color: '#999'
                            }
                        }
                    },
                    toolbox: {
                        feature: {
                            dataView: {show: false},
                            magicType: {show: true, type: ['line', 'bar']},
                            restore: {show: true},
                            saveAsImage: {show: true}
                        }
                    },
                    legend: {
                        data:['Memoria usada', 'Número de copias']
                    },
                    xAxis: [
                        {
                            type: 'category',
                            data: [<?= '\''. implode('\',\'', $chart_last_days['dates']).'\'' ?>],
                            axisPointer: {
                                type: 'shadow'
                            }
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                            name: 'Memoria usada',
                            min: 0,
                            axisLabel: {
                                formatter: '{value} bytes'
                            }
                        },
                        {
                            type: 'value',
                            name: 'Número de copias',
                            min: 0,
                            max: <?= round(max($chart_last_days['backups'])+max($chart_last_days['backups'])*20/100) ?>,
                            axisLabel: {
                                formatter: '{value}'
                            }
                        }
                    ],
                    series: [
                        {
                            name:'Memoria usada',
                            type:'bar',
                            data:[<?= '\''. implode('\',\'', $chart_last_days['used_sizes']).'\'' ?>]
                        },
                        {
                            name:'Número de copias',
                            type:'line',
                            yAxisIndex: 1,
                            data:[<?= '\''. implode('\',\'', $chart_last_days['backups']).'\'' ?>]
                        }
                    ]
                };
                myChart1.setOption(option1);
            }
        });
    </script>
<?php endif; ?>
<?php
$this->load->view('_/footer', array('js_charts' => TRUE));
?>
