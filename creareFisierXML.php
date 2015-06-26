<?php
session_start();
?>


<?php
/** Error reporting */
error_reporting(E_ALL);

/*
in fisierul php.ini din locul instalat al phpului trebuie stearsa ; de la PHP extension php_zip enabled
*/
/** PHPExcel */
include 'PHPExcelLibrarie/PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'PHPExcelLibrarie/PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
echo date('H:i:s') . " Create new PHPExcel object\n<br/>";
$objPHPExcel = new PHPExcel();
echo"test<br/>";
// Set properties
echo date('H:i:s') . " Set properties\n<br/>";
//$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
//$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

  $uid =  $_SESSION["id"];  
  $con=mysqli_connect("localhost","root","lab223","test");
 if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
  $sql = "SELECT * from Users where id = " .$uid ;  
  $result = $con->query($sql);
  $row = $result->fetch_assoc();


// Add some data
echo date('H:i:s') . " Add some data\n<br/>";
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Nume');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', $row['Nume']);
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Prenume');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', $row['Prenume']);
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Id');
$objPHPExcel->getActiveSheet()->SetCellValue('C2', $row['id']);
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
$objPHPExcel->getActiveSheet()->SetCellValue('D2', $row['email']);
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Username');
$objPHPExcel->getActiveSheet()->SetCellValue('E2', $row['Username']);
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Prenume');
$objPHPExcel->getActiveSheet()->SetCellValue('F2', $row['Prenume']);
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Parola');
$objPHPExcel->getActiveSheet()->SetCellValue('H2', $row['Parola']);
// Rename sheet
echo date('H:i:s') . " Rename sheet\n<br/>";
$objPHPExcel->getActiveSheet()->setTitle('Simple');

		
// Save Excel 2007 file
echo date('H:i:s') . " Write to Excel2007 format\n<br/>";
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

// Echo done
echo date('H:i:s') . " Done writing file.\r\n<br/>";
echo "Create file";
echo '<a href="./creareFisierXML.xlsx">Download</a>';

?>



