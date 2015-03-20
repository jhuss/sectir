<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Recursoshumanos',
);
?>
<p class="cat-title">Recursos Humanos</p>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Talento humano por categoría PEI</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosPorCat,
            'chartId' => "chart_cat",
            "scriptId" => "chart_cat"
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Talento humano por experiencia PEI</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosExp,
            'chartId' => "chart_exp",
            "scriptId" => "chart_exp"
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Talento humano por formación universitaria</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosUni,
            'chartId' => "chart_uni",
            "scriptId" => "chart_uni"
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Talento humano por fuente de financiamiento</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosFuenteFin,
            'chartId' => "chart_fuentefin",
            "scriptId" => "chart_fuentefin"
        ));
        ?>
    </div>
</div>
