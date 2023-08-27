<?php
                include_once  'template/header.php';
?>
<!-- --------------------------Google Charts-------------------------------- -->
<script type="text/javascript" src="js/google_chart/jsapi.js"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var countries = ['Incident','CMS'];
        var months = [<?php print $chart_date; ?>];
        var productionByCountry = [[<?php print $chart_inc_count; ?>],
       							   [<?php print $chart_cms_count; ?>]];
     
        // Create and populate the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        for (var i = 0; i < countries.length; ++i) {
          data.addColumn('number', countries[i]);
        }
        data.addRows(months.length);
        for (var i = 0; i < months.length; ++i) {
          data.setCell(i, 0, months[i]);
        }
        for (var i = 0; i < countries.length; ++i) {
          var country = productionByCountry[i];
          for (var month = 0; month < months.length; ++month) {
            data.setCell(month, i + 1, country[month]);
          }
        }
        // Create and draw the visualization.
        var ac = new google.visualization.AreaChart(document.getElementById('visualization'));
        ac.draw(data, {
          isStacked: true,
          width: 430,
          height: 350,
          colors:['red','#3366cc'],
          vAxis: {title: "Changes / Incidents"},
          hAxis: {title: 'Date',slantedText: true, slantedTextAngle: 90,  titleTextStyle: {color: '#333'}},
         });
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
<!-- --------------------------Google Charts End.-------------------------------- -->
</div>
<div class="grid_16">
  
</div>

<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="dashboard">Dashboard</h1>
    </div>
    <?php
    	if(isset($_GET['re'])){
    		if($_GET['re']=='true') $color='success'; else $color='error';
    		print '<p class="info" id="'.$color.'" style="margin-right:10px"><span class="info_inner">'.$_GET['message'].'</span></p>';
    	}
    ?>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
    <div id="portlets">
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 450px">
      <!--THIS IS A PORTLET-->
		<div class="portlet">
            <div class="portlet-header"><img src="images/icons/chart_bar.gif" width="16" height="16" alt="Reports" /> Current Activities</div>
            <div class="portlet-content">
            <!--THIS IS A PLACEHOLDER FOR FLOT - Report & Graphs -->
            <div id="placeholder" style="width:auto; height:350px;"><div id="visualization" style="width: 440; height: 350px;"></div></div>
            </div>
        </div>      
      <!--THIS IS A PORTLET-->
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
      <!--THIS IS A PORTLET-->        
      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Pending Tasks</div>

		<div class="portlet-content">
		<table width="100%" id="box-table-b">
		<?php
		//if($checkupdatenow) print 'Need to check update'; else print 'No need to check update';
		if(!$today_checklist){
			print '<tr><th width="20px"></th><th><strong><a href="index.php?components=checklist&action=show">Today Checklist is pending.</a> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Checklist valid till '.$checklist_close[0].'</th><th width="60px"></th></tr>';
			print '<tr><td height="8px" colspan="3"></td></tr>';
		}
		if($checklist_reopen){
			print '<tr><th width="20px"></th><th><strong><a href="index.php?components=dashboard&action=cl_reopen&reopen=true">Re-open Today Checklist</a></strong></th><th width="60px"></th></tr>';
			print '<tr><td height="8px" colspan="3"></td></tr>';
		}
		for($i=0;$i<sizeof($event_0id);$i++){
			if($event_0type[$i]==1){
			print '<tr><th width="20px"></th><th><a href="'.$event_0url[$i].'">'.$event_0des[$i].'</a></th><th width="60px"></th></tr>';
			print '<tr><td height="8px" colspan="3"></td></tr>';
			}
		}	
		?>
		</table>
		  <p>&nbsp;</p>
		</div>
        </div>   
      <!--THIS IS A PORTLET--> 
      <!--THIS IS A PORTLET--> 
    </div>
	<!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
   
    
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Recent Notifications</div>
		<div class="portlet-content nopadding">
        <form action="" method="post">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
              <tr><th width="25" scope="col"></th><th width="100px" scope="col">Date</th><th scope="col">Notification</th><th width="75" scope="col">Acknowledge</th></tr>
		       <?php
				if(!$today_checklist_apr)	print '<tr><td width="25" scope="col"></td><td scope="col">'.$date_apr.'</td><td scope="col"><a href="#">Today Checklist is not Submited yet by the user.</a></td><td width="75" scope="col"></td></tr>';
				if($reopen_sent)	print '<tr><td width="25" scope="col"></td><td scope="col">'.$date_apr.'</td><td scope="col"><a href="#">Today Checklist was Re-Opened!</a></td><td width="75" scope="col"></td></tr>';
				for($i=0;$i<sizeof($event_0id);$i++){
					if($event_0type[$i]==2)
						print '<tr><td width="25" scope="col"></td><td scope="col">'.$event_0date[$i].'</td><td scope="col"><a href="'.$event_0url[$i].'">'.$event_0des[$i].'</a></td><td width="75" scope="col"><a href="index.php?components=dashboard&action=acknowledge&id='.$event_0id[$i].'"><img src="images/icons/action_delete.gif" /></a></td></tr>';
				}	
				?>
            </thead>
            <tbody>
        
			</tbody>
          </table>
        </form>
		</div>
      </div>
     
<!--  END #PORTLETS -->  
   </div>
    <div class="clear"> </div>
<?php
                include_once  'template/footer.php';
?>
