<!----------------------------------------Calender--------------------------------------------------------------------------->			
<!-- #PORTLETS START -->
    <div id="portlets">
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed" style="font-size:16pt;"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /><strong><?php print $header; ?> - (Calender View)</strong></div>
		<div class="portlet-content nopadding">
			<br />
<p style="padding-left:10px;">Checklist are missing on Highlighted Dates</p>
<table width="100%"><tr><td align="center">
<center>
<script language="javascript" type="text/javascript">

function pad(num) {
    var s = num+"";
    while (s.length < 2) s = "0" + s;
    return s;
}

var day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
var $mis_day = [<?php print "'".implode("','",$missingdays)."'" ?>];
var $mis_month = [<?php print implode(",",$mis_month) ?>];
var $k=0;
  $today=10;

for($i=0;$i<12;$i++){
$k++;
//  DECLARE AND INITIALIZE VARIABLES
var Calendar = new Date();

var year = <?php print $year; ?>;     // Returns year
var month = $i;    // Returns month (0-11)
var today = 19;    // Returns day (1-31)
var weekday = Calendar.getDay();    // Returns day (1-31)

var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
var cal;    // Used for printing

Calendar.setDate(1);    // Start the calendar day at '1'
Calendar.setMonth(month);    // Start the calendar month at now


/* VARIABLES FOR FORMATTING
NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
      tags to customize your caledanr's look. */

var TR_start = '<TR>';
var TR_end = '</TR>';
var highlight_start = '<TD WIDTH="30"><TABLE CELLSPACING=0 style="background-color:#D2D2FF; border-color:CCCCCC; border-style:groove; border:1;"><TR><TD WIDTH=20><B><CENTER>';
var highlight_end   = '</CENTER></TD></TR></TABLE></B>';
var TD_start = '<TD WIDTH="30" height="30px"><CENTER>';
var TD_end = '</CENTER></TD>';

/* BEGIN CODE FOR CALENDAR
NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
tags to customize your calendar's look.*/
if($k==1){ cal =  '<TABLE CELLSPACING=0 CELLPADDING=0 style="border-color:BBBBBB; border:1; border-style:groove;"><TR height="230px"><TD>';
}else{
	if($k==5){ cal =  '</td></tr><tr><td align="center"><TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0 style="border-color:BBBBBB; border:1; border-style:groove;"><TR height="230px"><TD>';
	$k=1; 
	}else{	cal =  '</td><td align="center"><TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0 style="border-color:BBBBBB; border:1; border-style:groove;"><TR height="230px"><TD>'; }
}
cal += '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2>' + TR_start;
cal += '<TD COLSPAN="' + DAYS_OF_WEEK + '"  style="background-color:#EFEFEF; height:25px; vertical-align:middle"><CENTER><B>';
cal += month_of_year[month]  + '   ' + year + '</B>' + TD_end + TR_end;
cal += TR_start;

//   DO NOT EDIT BELOW THIS POINT  //

// LOOPS FOR EACH DAY OF WEEK
for(index=0; index < DAYS_OF_WEEK; index++)
{
// BOLD TODAY'S DAY OF WEEK
if(weekday == index)
cal += TD_start + '<B>' + day_of_week[index] + '</B>' + TD_end;

// PRINTS DAY
else
cal += TD_start + day_of_week[index] + TD_end;
}
cal += TD_end + TR_end;
cal += TR_start;

// FILL IN BLANK GAPS UNTIL TODAY'S DAY
for(index=0; index < Calendar.getDay(); index++)
cal += TD_start + '  ' + TD_end;

// LOOPS FOR EACH DAY IN CALENDAR
for(index=0; index < DAYS_OF_MONTH; index++)
{
if( Calendar.getDate() > index )
{
  // RETURNS THE NEXT DAY TO PRINT
  week_day =Calendar.getDay();

  // START NEW ROW FOR FIRST DAY OF WEEK
  if(week_day == 0)
  cal += TR_start;

  if(week_day != DAYS_OF_WEEK)
  {

  // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES
  var day  = Calendar.getDate();

  // HIGHLIGHT TODAY'S DATE
  $day='<?php print $year; ?>-'+pad($i+1)+'-'+pad(day);
//  window.alert($day);
	  if( $mis_day.indexOf($day) > -1 )
	  cal += highlight_start + day + highlight_end + TD_end;
	
	  // PRINTS DAY
	  else
	  cal += TD_start + day + TD_end;
  }

  // END ROW FOR LAST DAY OF WEEK
  if(week_day == DAYS_OF_WEEK)
  cal += TR_end;
  }

  // INCREMENTS UNTIL END OF THE MONTH
  Calendar.setDate(Calendar.getDate()+1);

}// end for loop

cal += '</TD></TR></TABLE></TABLE>';

//  PRINT CALENDAR
document.write(cal);
}
//  End -->
</script>
</center>
</td></tr></table>

		</div>
      </div>
<!--  END #PORTLETS -->

<!-------------------------------------------List View--------------------------------------------------------------->			
<!-- #PORTLETS START -->
<br /><hr /><br />
    <div id="portlets">
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed" style="font-size:16pt;"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /><strong><?php print $header; ?></strong></div>
		<div class="portlet-content nopadding">
			<br />
		<table width="100%"><tr><td align="center">
			<table>
				<?php 
				$quater=round((sizeof($missingdays)/4),0);
				$k=1;
				for($i=0;$i<sizeof($missingdays);$i++){
					print '<tr><td height="25px" align="center">'.$missingdays[$i].'</td></tr>';
					if($k==$quater){
						print '</table></td><td><table>';
						$k=0;
					}
					$k++;
				} ?>
			</table>
		</td></tr></table>
		</div>
      </div>
      </div>
<!--  END #PORTLETS -->
			
