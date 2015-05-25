<?php
    if(!empty($data['data'])):
?>
<?php
    if($this->Mode == 'vertical') {
        $mode = 'Bar';
    } elseif ($this->Mode == 'horizontal') {
        $mode = 'HorizontalBar';
        $this->opts = array_merge($this->opts, array(
            'barShowStroke' => false
        ));
    }

    $jlabels = CJSON::encode($data['labels']);
    $jdata = CJSON::encode($data['data']);
    $jopts = CJSON::encode($this->opts);

    $script = <<<EOF
var data = {
    labels: $jlabels,
    datasets: [
    {
        data: $jdata,
        fillColor: "$this->fillColor",
        strokeColor: "$this->strokeColor",
        highlightFill: "$this->highlightFill",
        highlightStroke: "$this->highlightStroke",
    }
    ]
};
var ctx = document.getElementById("$this->chartId").getContext("2d");
var $this->varName = new Chart(ctx).$mode(data, $jopts);
EOF;
    Yii::app()->clientScript->registerScript($this->scriptId, $script);
?>
<canvas id="<?php echo $this->chartId; ?>" width="<?php echo $this->Width; ?>" height="<?php echo $this->Height; ?>"></canvas>
<?php else: ?>
<div class="no-data">Sin Información</div>
<?php endif; ?>