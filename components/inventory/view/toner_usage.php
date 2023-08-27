<?php
                include_once  'template/header.php';
?>
<!-- MENU END -->

</div>
<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
<?php                    
														print '<li><a href="index.php?components=inventory&action=show_submit"><span>Home</span></a></li>';
														print '<li><a href="index.php?components=inventory&action=list_list&filter_type=1&filter_status=1"><span>List</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=one_asset" ><span>Asset Details</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_manage" ><span>Toner Manage</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_usage" class="current" ><span>Toner Usage</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_report" ><span>Toner Report</span></a></li>';
 ?>
           </ul>
        </div>
    </div>
<!-- TABS END -->   
</div>
<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="inventory">Inventory Management System</h1>
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
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
 
      <!--THIS IS A PORTLET-->        
        </div>   
      <!--THIS IS A PORTLET--> 
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
   
    
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Allocate Toner</div>
		<div class="portlet-content nopadding">
		<form method="post" action="index.php?components=inventory&action=allocate_toner"  onsubmit="return allocateToner()" > 
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
              <tr><td width="25" scope="col"></td><td width="100px" scope="col">Printer Location</td><td scope="col">
				<select name="location_id" id="location_id">
					<option value="">-SELECT-</option>
					<?php for($i=0;$i<sizeof($ass_location_id);$i++){
						print '<option value="'.$ass_location_id[$i].'">'.$ass_location_name[$i].'</option>';
					} ?>
				</select>
              </td><td width="25" scope="col"></td><td width="100px" scope="col">Toner</td><td scope="col">
				<select name="toner_id" id="toner_id">
					<option value="">-SELECT-</option>
					<?php for($i=0;$i<sizeof($toner_id);$i++){
						print '<option value="'.$toner_id[$i].'">'.$toner_name[$i].'</option>';
					} ?>
				</select>
              </td></tr>
              <tr><td width="25" scope="col"></td><td width="100px" scope="col">Allocated Date</td><td scope="col">
				<input type="date" name="date" id="date" />
              </td><td width="25" scope="col"></td><td width="100px" scope="col">Allocated Quantity</td><td scope="col">
				<input type="number" name="qty" id="qty" />
              </td></tr>
              <tr><td width="25" scope="col"></td><td width="100px" scope="col" colspan="5" align="center">
				<textarea name="comment" style="width:90%" placeholder="Comment"></textarea><br>
				<input type="submit" value="Allocate" style="height:40px; width:100px" />
              </td></tr>
            </thead>
            <tbody>
        
			</tbody>
          </table>
        </form>
		</div>
      </div>
     
<!--  END #PORTLETS -->  
    <!--THIS IS A WIDE PORTLET-->
   
    
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Remaing Toner Qty</div>
		<div class="portlet-content nopadding">
        <form action="" method="post">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
              <tr><th width="25" scope="col"></th><th width="100px" scope="col">Name of the Toner</th><th scope="col">Remaining Qty</th></tr>
		       <?php
				for($i=0;$i<sizeof($toner_id);$i++){
				if($toner_balance[$i]==0) $color1='style="color:red"'; else $color1='';
						print '<tr><td scope="col"></td><td scope="col">'.$toneru_name[$i].'</td><td width="75" scope="col" '.$color1.' ><strong>'.$toner_balance[$i].'</strong></td></tr>';
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
<!-- END CONTENT-->    
<?php
                include_once  'template/footer.php';
?>
