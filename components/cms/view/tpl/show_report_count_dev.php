<div id="portlets">
	<div class="clear"></div>
<br />
<p>Note: This report list down count of Change Request, which were Successfully Implemented </p>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Device', 'Number of Changes'],
        <?php
        	for($i=0;$i<sizeof($count);$i++){
        		print '["'.$device_name[$i].'",     '.$count[$i].'],';
        	}
        ?>
        ]);

        var options = {
          title: 'Number of Changes on Devices',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <table width="100%"><tr><td width="100%" align="center"><div id="donutchart" style="width: 900px; height: 500px;"></div></td></tr></table>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />CMS Report</div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet"><tr>
			<tr><th width="50px"></th><th  width="90px">Device Name</th><th></th><th width="120px">Number of Changes</th><th></th><th width="50px">Status</th><th width="50px"></th></tr>
		<?php for($i=0;$i<sizeof($count);$i++){
				$status1='<img title="Not Pending" width="15px" src="images/done.png" />'; 
				print '<tr><td width="50px"></td><td><a href="index.php?components=cms&action=get_report&type=by_device&year='.$_GET['year'].'&device='.$device_id[$i].'&filter=6" >'.$device_name[$i].'</a></td><td></td><td align="center"><a href="index.php?components=cms&action=get_report&type=by_device&year='.$_GET['year'].'&device='.$device_id[$i].'&filter=6" >'.$count[$i].'</a></td><td></td><td align="center">'.$status1.'</td><td width="50px"></td></tr>';
			}
		?>
		</table>
		</div>
      </div>
      </div>
