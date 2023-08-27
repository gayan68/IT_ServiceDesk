      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Pending Tasks</div>

		<div class="portlet-content">
		<table width="100%" id="box-table-b">
		<?php
		if(!$today_checklist_apr){
			print '<tr><th width="20px"></th><th colspan="2"><strong>Today Checklist is pending.</strong></th><th width="60px"></th></tr>';
			print '<tr><td height="8px" colspan="4"></td></tr>';
		}
		if($checklist_reopen){
			print '<tr><th width="20px"></th><th colspan="2"><strong><a href="index.php?components=settings&action=cl_reopen&reopen=true">Re-open Today Checklist</a></strong></th><th width="60px"></th></tr>';
			print '<tr><td height="8px" colspan="4"></td></tr>';
		}
		if($reopen_sent){
			print '<tr><th width="20px"></th><th colspan="2"><strong>Checklist was Reopened!</strong></th><th width="60px"></th></tr>';
			print '<tr><td height="8px" colspan="4"></td></tr>';
		}
		?>
		</table>
		  <p>&nbsp;</p>
		</div>
        </div>   
      <!--THIS IS A PORTLET--> 