<!-- #PORTLETS START -->
    <div id="portlets">
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /><?php print $header; ?></div>
		<div class="portlet-content nopadding">
			<br />
		<table width="100%">
			<?php 
			for($i=0;$i<sizeof($cl_id);$i++){
			print '<tr><td width="20%"></td><td height="35px" align="center"><a style="font-size:12pt; font-weight:bold; color:#CC0000" href="index.php?components=checklist&action=show_checklist&id='.$cl_id[$i].'">'.$cl_dates[$i].'</a></td><td valign="bottom"></td><td width="20%"></td></tr>';
			} ?>
			</table>
		</div>
      </div>
<!--  END #PORTLETS -->
