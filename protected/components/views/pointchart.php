<?php
$script = <<<EOF
var tt = document.createElement('div'),
  leftOffset = -(~~$('html').css('padding-left').replace('px', '') + ~~$('body').css('margin-left').replace('px', '')),
  topOffset = -32;
tt.className = 'ex-tooltip';
document.body.appendChild(tt);

var data = {
  "xScale": "time",
  "yScale": "linear",
  "main": $data,
};
var opts = {
  "dataFormatX": function (x) { return d3.time.format('%Y-%m-%d').parse(x); },
  "tickFormatX": function (x) { return d3.time.format('%A')(x); },
  "mouseover": function (d, i) {
    var pos = $(this).offset();
    $(tt).text($this->textMouseOver)
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
    <div id="<?php echo $this->chartId; ?>"></div>
