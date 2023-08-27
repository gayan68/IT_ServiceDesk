      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Pending Tasks</div>

		<div class="portlet-content">
		<table width="100%" id="box-table-b">
		<?php
		if(!$today_checklist){
			print '<tr><th width="20px"></th><th><strong><a href="index.php?components=checklist&action=show">Today Checklist is pending.</a> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Checklist valid till '.$checklist_close[0].'</th><th width="60px"></th></tr>';
			print '<tr><td height="8px" colspan="3"></td></tr>';
		}
		if($checklist_reopen){
			print '<tr><th width="20px"></th><th><strong><a href="index.php?components=settings&action=cl_reopen&reopen=true">Re-open Today Checklist</a></strong></th><th width="60px"></th></tr>';
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