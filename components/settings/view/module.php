<?php
                include_once  'template/header.php';
?>
<!-- MENU END -->

</div>
<!---------Sub Menu----------->
<?php include_once  'components/settings/view/tpl/sub_menu.php';	?>

<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="user_profile">Module Activator</h1>
<?php if(isset($_REQUEST['message'])){ print '<p style="font-size:16pt; color:#709BE4; text-align:center;">'.$_REQUEST['message'].'</p>'; } ?>
    </div>
    <div class="clear">
    </div>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
    <div id="portlets">
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 10px">
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
    </div>
	<!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Modules</div>
		<div class="portlet-content nopadding">
        <form action="index.php?components=settings&action=general_activate" method="post" onsubmit="return limitModule()" >
		  <input type="hidden" name="id_list" id="id_list" value="<?php print $id_list; ?>" />
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <tbody>
				<tr><td width="150px"></td><th width="150px">Module Name</th><th width="10px"></th><th width="150px">Order</th><th width="10px"></th><th width="70px">Activate</th><td width="150px"></td></tr>
			<?php
				for($i=0;$i<sizeof($id);$i++){
					if($status[$i]==1) $check='checked="checked"'; else $check='';
					if($name[$i]=='Settings') $checkbox='Auto'; else $checkbox='<input type="checkbox" name="module'.$id[$i].'" id="module'.$id[$i].'" '.$check.'>';
					if($i==0) $up='&nbsp;&nbsp;&nbsp;&nbsp;'; else $up='<a href="index.php?components=settings&action=general_order_up&id='.$order[$i].'" ><img src="images/icons/Index-Up.png" /></a>';
					if($i<(sizeof($id)-1)) $down='<a href="index.php?components=settings&action=general_order_down&id='.$order[$i].'" ><img src="images/icons/Index-Down.png" /></a>'; else $down='';
					print '<tr><td></td><td>'.$name[$i].'</td><td></td><td>'.$order[$i].' &nbsp;&nbsp;&nbsp;'.$up.'&nbsp;&nbsp;'.$down.'</td><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;'.$checkbox.'</td><td></td></tr>';
				}	?>
				<tr><td width="300px"></td><td colspan="5" align="center"><input type="submit" value="Update" style="height:40px; width:130px;" /></td><td width="300px"></td></tr>
	        </tbody>
          </table>
        </form>
		</div>
      </div>
<!--  END #PORTLETS -->  
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
<?php
                include_once  'template/footer.php';
?>
