<?php
                include_once  'template/header.php';
?>
<!-- MENU END -->
<script type="text/javascript">
	function updatePrice($id){
		$uprice=document.getElementById('price_'+$id).value;
	  	document.getElementById('divprice_'+$id).innerHTML=document.getElementById('loading1').innerHTML;
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    var returntext=this.responseText;
		    	if(returntext=='Done'){
		    		document.getElementById('divprice_'+$id).innerHTML='<span style="color:green">Done</span>';
		    	}else{
		    		document.getElementById('divprice_'+$id).innerHTML='<span style="color:red">Error</span>';
		    	}
		    }
		  };
		  xhttp.open("GET", 'index.php?components=inventory&action=update_toner_price&id='+$id+'&uprice='+$uprice, true);
		  xhttp.send();
	}
</script>

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
                      									print '<li><a href="index.php?components=inventory&action=toner_usage"><span>Toner Usage</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_report" class="current"  ><span>Toner Report</span></a></li>';
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
		<form method="post" action="index.php?components=inventory&action=toner_report"  onsubmit="return allocateToner()" > 
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
              <tr><td width="25" scope="col"></td><td width="80px" scope="col">From Date</td><td scope="col">
				<input type="date" name="from_date" id="from_date" value="<?php print $from_date; ?>" />
              </td><td width="25" scope="col"></td><td width="50px" scope="col">To Date</td><td scope="col">
				<input type="date" name="to_date" id="to_date" value="<?php print $to_date; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" value="Search" style="height:40px; width:100px" />
              </td></tr>
            </thead>
            <tbody>
        
			</tbody>
          </table>
        </form>
   
    
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Purchased Toners</div>
		<div class="portlet-content nopadding">
        <form action="" method="post">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
              <tr><th width="25" scope="col"></th><th width="100px" scope="col">Date</th><th scope="col">Purchased Invoice No</th><th scope="col">Toner</th><th scope="col" width="60px" >Unit Price</th><th scope="col" width="50px" align="right" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty</th><th scope="col" align="right" >Action</th></tr>
		       <?php
		       $total_cost=0;
				for($i=0;$i<sizeof($ti_id);$i++){
					if($ti_uprice[$i]==0){
						$uprice='<input type="text" id="price_'.$ti_id[$i].'" value="0" style="width:50px; text-align:right; padding-right:5px"'; 
						$uaction='<div id="divprice_'.$ti_id[$i].'" ><input type="button" value="Update" onclick="updatePrice('.$ti_id[$i].');" /></div>';
					}else{
						$uprice='<strong>'.$ti_uprice[$i].'</strong>';
						$uaction='';
					}
					$total_cost+=$ti_uprice[$i]*$ti_qty[$i];
						print '<tr><td scope="col"></td><td scope="col">'.$ti_date[$i].'</td><td scope="col" >'.$ti_po[$i].'</td><td scope="col" >'.$ti_toner[$i].'</td><td scope="col" align="right" style="padding-right:15px;" >'.$uprice.'</td><td scope="col" align="right" style="padding-right:25px;"><strong>'.$ti_qty[$i].'</strong></td><td scope="col" align="center" >'.$uaction.'</td></tr>';
				}	
						print '<tr><td scope="col"></td><td scope="col"></td><td scope="col" ></td><td scope="col" ><strong>Total Cost</strong></td><td scope="col" align="center" style="padding-right:25px;" colspan="2"><strong>'.number_format($total_cost).'</strong></td><td></td></tr>';
				?>
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
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Utilized Toners</div>
		<div class="portlet-content nopadding">
        <form action="" method="post">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
              <tr><th width="25" scope="col"></th><th width="100px" scope="col">Date</th><th scope="col">Location</th><th scope="col">Toner</th><th scope="col">Qty</th><th scope="col">Allocated By</th><th scope="col">Comment</th></tr>
		       <?php
				for($i=0;$i<sizeof($tu_date);$i++){
						print '<tr><td scope="col"></td><td scope="col">'.$tu_date[$i].'</td><td scope="col" >'.$tu_location[$i].'</td><td scope="col" >'.$tu_toner[$i].'</td><td scope="col" ><strong>'.$tu_qty[$i].'</strong></td><td scope="col" >'.$tu_allocated[$i].'</td><td scope="col" >'.$tu_comment[$i].'</td></tr>';
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
