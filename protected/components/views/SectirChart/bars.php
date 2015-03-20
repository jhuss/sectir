<?php
    if(!empty($data)):
?>
<?php
    $jlabels = CJSON::encode($data['labels']);
    $jdata = CJSON::encode($data['data']);

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
var $this->varName = new Chart(ctx).Bar(data);
EOF;
    Yii::app()->clientScript->registerScript($this->scriptId, $script);
?>
<canvas id="<?php echo $this->chartId; ?>" width="<?php echo $this->Width; ?>" height="<?php echo $this->Height; ?>"></canvas>
<?php else: ?>
<div class="no-data">Sin Información</div>
<?php endif; ?>