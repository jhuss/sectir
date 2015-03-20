<?php
$_data = CJSON::decode($data);
if(!empty($_data)):
?>
<?php
$script = <<<EOF
   
    function loadChart(data){
         var valueLabelWidth = $this->valueLabelWidth; // space reserved for value labels (right)
         var barHeight = $this->barHeight; // height of one bar
         var barLabelWidth = $this->barLabelWidth; // space reserved for bar labels
         var barLabelPadding = $this->barLabelPadding; // padding between bar and bar labels (left)
         var gridLabelHeight = $this->gridLabelHeight; // space reserved for gridline labels
         var gridChartOffset = $this->gridChartOffset; // space between start of grid and first bar
         var maxBarWidth = $this->maxBarWidth; // width of the bar with the max value
 
        // accessor functions
        var barLabel = $this->barLabelFn;
        var barValue = $this->barValueFn; 
 
        // sorting
        var sortedData = data.sort(function(a, b) {
            return d3.descending(barValue(a), barValue(b));
        });
 
        // scales
        var yScale = d3.scale.ordinal().domain(d3.range(0, sortedData.length)).rangeBands([0, sortedData.length * (barHeight+4)]);
        var y = function(d, i) { return yScale(i); };
        var yText = function(d, i) { return y(d, i) + yScale.rangeBand() / 2; };
        var x = d3.scale.linear().domain([0, d3.max(sortedData, barValue)]).range([0, maxBarWidth]);
 
        // svg container element
        var chart = d3.select('#$this->chartId').append("svg")
            .attr('width', maxBarWidth + barLabelWidth + valueLabelWidth)
            .attr('height', gridLabelHeight + gridChartOffset + sortedData.length * (barHeight+4));
 
        // grid line labels
        var gridContainer = chart.append('g')
            .attr('transform', 'translate(' + barLabelWidth + ',' + gridLabelHeight + ')');
        gridContainer.selectAll("text").data(x.ticks(5)).enter().append("text")
            .attr("x", x)
            .attr("dy", -3)
            .attr("text-anchor", "middle")
            .attr("fill", "#666666")
            .text(function(String){
                str = d3.formatPrefix(String);
                return str.scale(String)+str.symbol;
            });
        // vertical grid lines
        gridContainer.selectAll("line").data(x.ticks(5)).enter().append("line")
            .attr("x1", x)
            .attr("x2", x)
            .attr("y1", 0)
            .attr("y2", yScale.rangeExtent()[1] + gridChartOffset)
            .style("stroke", "#EEEEEE");
 
            // bar labels
        var labelsContainer = chart.append('g')
            .attr('transform', 'translate(' + (barLabelWidth - barLabelPadding) + ',' + (gridLabelHeight + gridChartOffset) + ')')
            .attr('class','bars_user');
        labelsContainer.selectAll('text').data(sortedData).enter().append('text')
            .attr('y', yText)
            .attr('stroke', 'none')
            .attr('fill', 'black')
            .attr("dy", ".35em") // vertical-align: middle
            .attr('text-anchor', 'end')
            .text(barLabel);
        // bars
        var barsContainer = chart.append('g')
            .attr('transform', 'translate(' + barLabelWidth + ',' + (gridLabelHeight + gridChartOffset) + ')')
            .attr('class','bars_steps');
        barsContainer.selectAll("rect").data(sortedData).enter().append("rect")
            .attr('y', y)
            .attr('height', barHeight)
            .attr('width', function(d) { return x(barValue(d)); })
            .attr('stroke', 'white')
            .attr('fill', 'steelblue');
        // bar value labels
        barsContainer.selectAll("text").data(sortedData).enter().append("text")
            .attr("x", function(d) { return x(barValue(d)); })
            .attr("y", yText)
            .attr("dx", 3) // padding-left
            .attr("dy", ".35em") // vertical-align: middle
            .attr("text-anchor", "start") // text-align: right
            .attr("fill", "black")
            .attr("stroke", "none")
            .text(function(d) { return d3.round(barValue(d), 2) ; });
    }
   
    $(document).ready(function(){
        data = $data;
            loadChart(data);
    });
EOF;
Yii::app()->clientScript->registerScript($this->scriptId, $script);
?>
    <div id="<?php echo $this->chartId; ?>"></div>
<?php else: ?>
    <div class="no-data">Sin Información</div>
<?php endif; ?>