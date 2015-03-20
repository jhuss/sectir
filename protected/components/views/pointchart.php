<?php
$_data = CJSON::decode($data);
if(!empty($_data)):
?>
<?php
$script = <<<EOF
var tt = document.createElement('div'),
  leftOffset = -(~~$('html').css('padding-left').replace('px', '') + ~~$('body').css('margin-left').replace('px', '')),
  topOffset = -32;
tt.className = 'ex-tooltip';
document.body.appendChild(tt);

var data = {
  "xScale": "ordinal",
  "yScale": "linear",
  "main": [{
        "className": ".test",
        "data": $data,
  }]
};
var opts = {
  "mouseover": function (d, i) {
    var pos = $(this).offset();
    $(tt).text("" + d.x + ":" + d.y )
      .css({top: topOffset + pos.top, left: pos.left + leftOffset})
      .show();
  },
  "mouseout": function (x) {
    $(tt).hide();
  }
};
var $this->varName = new xChart('line-dotted', data, '#$this->chartId', opts);
EOF;

    Yii::app()->clientScript->registerScript($this->scriptId,$script);
?>
<figure style="width: <?php echo $this->chartWidth; ?>; height: <?php echo $this->chartHeight; ?>;" id="<?php echo $this->chartId; ?>"></figure>
<?php else: ?>
<div class="no-data">Sin Información</div>
<?php endif; ?>