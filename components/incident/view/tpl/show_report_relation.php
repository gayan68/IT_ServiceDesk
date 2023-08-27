    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["orgchart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        data.addRows([
          <?php print $relation_date; ?>
        ]);

        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        chart.draw(data, {allowHtml:true});
      }
   </script>
   
<div id="portlets">
	<div class="clear"></div>
<br />
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Incident Relation to System Changes </div>
		<div class="portlet-content nopadding">
		<br />
		<table width="100%" ><tr><td width="100%" align="center"><div id="chart_div"></div></td></tr></table>
		</div>
      </div>
      </div>
