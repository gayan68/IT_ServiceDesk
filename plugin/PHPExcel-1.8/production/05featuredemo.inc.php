<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
//echo date('H:i:s') , " Create new PHPExcel object" , EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
//echo date('H:i:s') , " Set document properties" , EOL;
$objPHPExcel->getProperties()->setCreator($user)
							 ->setLastModifiedBy($user)
							 ->setTitle("$company IT Inventory")
							 ->setSubject("$company IT Inventory")
							 ->setDescription("$company | IT Inventory")
							 ->setKeywords("IT Inventory $company")
							 ->setCategory("IT Inventory");
							 
// Set thin black border outline around column
//echo date('H:i:s') , " Set thin black border outline around column" , EOL;
$styleThinBlackBorderOutline = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);


$objPHPExcel->getActiveSheet()->setCellValue('C1', $company.' - IT INVENTORY  ['.$type.']');
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->setCellValue('C2', ' ');
$objPHPExcel->getActiveSheet()->getStyle('C2')->getFont()->setSize(20);

// Create a first sheet, representing sales data
//echo date('H:i:s') , " Add some data" , EOL;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Generated Date:');
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Unmanaged Copy');
$objPHPExcel->getActiveSheet()->setCellValue('H1', PHPExcel_Shared_Date::PHPToExcel( gmmktime(0,0,0,date('m'),date('d'),date('Y')) ));
$objPHPExcel->getActiveSheet()->getStyle('H1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);

$objPHPExcel->getActiveSheet()->setCellValue('A3', 'No');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Asset ID');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Employee Name');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Location');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Device');
$objPHPExcel->getActiveSheet()->setCellValue('F3', 'Serial Number');
$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Comments');

$cat='';
$k=0;
for($j=0;$j<sizeof($tb_ass_id);$j++){
	$cell1=$k+4;
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$cell1, $j+1);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$cell1, $tb_asset_id[$j]);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$cell1, $tb_emp_name[$j]);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$cell1, $tb_location[$j]);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$cell1, $tb_ass_name[$j]);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$cell1, $tb_ass_sn[$j]);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$cell1, $st1[$j]);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$cell1, $tb_ass_comment[$j]);
	
	$objPHPExcel->getActiveSheet()->getStyle("A3:A$cell1")->applyFromArray($styleThinBlackBorderOutline);
	$objPHPExcel->getActiveSheet()->getStyle("B3:B$cell1")->applyFromArray($styleThinBlackBorderOutline);
	$objPHPExcel->getActiveSheet()->getStyle("C3:C$cell1")->applyFromArray($styleThinBlackBorderOutline);
	$objPHPExcel->getActiveSheet()->getStyle("D3:D$cell1")->applyFromArray($styleThinBlackBorderOutline);
	$objPHPExcel->getActiveSheet()->getStyle("E3:E$cell1")->applyFromArray($styleThinBlackBorderOutline);
	$objPHPExcel->getActiveSheet()->getStyle("F3:F$cell1")->applyFromArray($styleThinBlackBorderOutline);
	$objPHPExcel->getActiveSheet()->getStyle("G3:G$cell1")->applyFromArray($styleThinBlackBorderOutline);
	$objPHPExcel->getActiveSheet()->getStyle("H3:H$cell1")->applyFromArray($styleThinBlackBorderOutline);
	
	$k++;
}
$k++;



// Set column widths
//echo date('H:i:s') , " Set column widths" , EOL;
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);


$cell1=1+$k;

$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($styleThinBlackBorderOutline);



// Set fills
//echo date('H:i:s') , " Set fills" , EOL;
$objPHPExcel->getActiveSheet()->getStyle('A1:H3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1:H2')->getFill()->getStartColor()->setARGB('FFE0E0E0');
$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->getFill()->getStartColor()->setARGB('FFD0D0D0');

// Set style for header row using alternative method
//echo date('H:i:s') , " Set style for header row using alternative method" , EOL;
$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray(
		array(
			'font'    => array(
				'bold'      => true
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'top'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			)
		)
);


// Add a drawing to the worksheet
//echo date('H:i:s') , " Add a drawing to the worksheet" , EOL;
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('./images/logo2.jpg');
$objDrawing->setHeight(40);
$objDrawing->setCoordinates("A1");
$objDrawing->setOffsetX(10);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

$cell1=$k+3;

$objPHPExcel->getActiveSheet()->getStyle('F4:F'.$cell1)->applyFromArray(
		array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			)
		)
);
$objPHPExcel->getActiveSheet()->getStyle('G4:G'.$cell1)->applyFromArray(
		array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			)
		)
);


$cell1=$k+5;
$cell2=$k+6;
//-------------------------Signature----------------------------//
$objPHPExcel->getActiveSheet()->getStyle('A'.$cell1.':G'.$cell2)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$cell1,'..............................');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$cell2,'Fatma Al Hashmi');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$cell1,'..............................');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$cell2,'Gayan Pathirage');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$cell1,'..............................');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$cell2,'Noushad TP');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$cell1,'..............................');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$cell2,'Haitham Abdullah AbdulWali');

// Unprotect a cell
//echo date('H:i:s') , " Unprotect a cell" , EOL;
$objPHPExcel->getActiveSheet()->getStyle('B1')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

// Add a hyperlink to the sheet
//echo date('H:i:s') , " Add a hyperlink to an external website" , EOL;
// Add a drawing to the worksheet
//echo date('H:i:s') , " Add a drawing to the worksheet" , EOL;

// Play around with inserting and removing rows and columns
//echo date('H:i:s') , " Play around with inserting and removing rows and columns" , EOL;
$objPHPExcel->getActiveSheet()->insertNewRowBefore(6, 10);
$objPHPExcel->getActiveSheet()->removeRow(6, 10);
$objPHPExcel->getActiveSheet()->insertNewColumnBefore('E', 5);
$objPHPExcel->getActiveSheet()->removeColumn('E', 5);

// Set header and footer. When no different headers for odd/even are used, odd header is assumed.
//echo date('H:i:s') , " Set header/footer" , EOL;
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BInventory&RPrinted on &D');
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

// Set page orientation and size
//echo date('H:i:s') , " Set page orientation and size" , EOL;
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

// Rename first worksheet
//echo date('H:i:s') , " Rename first worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle($type);


// Create a new worksheet, after the default sheet
//echo date('H:i:s') , " Create a second Worksheet object" , EOL;
