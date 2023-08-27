      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Pending Tasks</div>

		<div class="portlet-content">
		<table width="100%" id="box-table-b">
		<?php
		for($i=0;$i<sizeof($id1);$i++){
			print '<tr><th width="20px"></th><th>Rejected Checklist</th><th><a href="index.php?components=checklist&action=show_edit&id='.$id1[$i].'">'.$submit_date[$i].'</a></th><th width="60px"></th></tr>';
		}	
		if(!$today_checklist){
			print '<tr><td height="8px" colspan="4"></td></tr>';
			print '<tr><th width="20px"></th><th colspan="2"><strong><a href="index.php?components=checklist&action=show">Today Checklist is pending.</a> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Checklist valid till '.$checklist_close[0].'</th><th width="60px"></th></tr>';
		}
		?>
		</table>
		  <p>&nbsp;</p>
		</div>
        </div>   
      <!--THIS IS A PORTLET--> 