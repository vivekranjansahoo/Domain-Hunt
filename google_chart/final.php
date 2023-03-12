<?php
$conn = mysqli_connect('localhost:3307','root','','fullstackphp');
$query="select * from graph";
$qresult=$mysqli_query($query);
$results=array();
while($res=$qresult->fetch_assoc()){
    $results[]=$res;
}

$pie_charts_data=array();
foreach($results as $result) {
    $pie_charts_data[]=array($result['fname'],(int)$result['number']);
}

$pie_charts_data=json_encode($pie_charts_data);
mysqli_free_result($qresult);

mysqli_close($mysql);


$HTML= <<<xyz
<script type="text/javascript src="https:/>/www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization','1.0',{'packages':['corechart']});
   google.setOnLoadCallback(drawChart);
   function drawChart(){
    var data=new google.visualization.DataTable();
    data.addColumn('string','Age range');
    data.addColumn('string','Age range');
    data.addRows({$pie_charts_data});

    var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);

        jQuery(document).ready(function() {
            jQuery(window).resize(function() {
                drawCharts();
            });
        });
    </script>
   }

   <table>
   <tr>
   <td id="pie_chart_div"></td>
   </tr>
   </table>

xyz;
echo $HTML;

?>