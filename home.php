<?php include ('chart.php'); ?>
<?php 
  if ($_SESSION['level'] == "Super Admin") { ?>
    <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>WO Masuk</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="chartContainer" style="height:300px;"></div>

                  </div>
                </div>
              </div>
           
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Income</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="chartContainer2" style="height:300px;"></div>

                  </div>
                </div>
              </div>

          </div>

<script>
window.onload = function () {
 
var chart1 = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  
  legend:{
    cursor: "pointer",
    verticalAlign: "center",
    horizontalAlign: "right",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    indexLabel: "{y}",
    yValueFormatString: "#",
    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
  }]
});
chart1.render();
 
function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chart1.render();
}

var chart2 = new CanvasJS.Chart("chartContainer2", {
  theme: "light2",
  animationEnabled: true,

  axisY: {
    title: "Nilai Dalam (Rp.)"
  },
  legend:{
    cursor: "pointer",
    verticalAlign: "center",
    horizontalAlign: "right",
    itemclick: toggleDataSeries2
  },
  data: [{
    type: "line",
    indexLabel: "{y}",
    yValueFormatString: "Rp #,##0.##",
    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
  }]
});
chart2.render();

function toggleDataSeries2(b){
  if (typeof(b.dataSeries.visible) === "undefined" || b.dataSeries.visible) {
    b.dataSeries.visible = false;
  }
  else{
    b.dataSeries.visible = true;
  }
  chart2.render();
}
 
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php
  } else {
    
  }
?>
