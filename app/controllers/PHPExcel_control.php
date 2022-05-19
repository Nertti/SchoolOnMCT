<?php

if (isset($_GET['report_teach'])) {

    $objPHPExel = new PHPExcel();

    $objPHPExel->setActiveSheetIndex(0);

    $activ_sheet = $objPHPExel->getActiveSheet();

    $activ_sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    $activ_sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

    $activ_sheet->setTitle('Занятость преподавателей');

    $activ_sheet->getColumnDimension('A')->setWidth(30);
    $activ_sheet->getColumnDimension('B')->setWidth(15);

    $activ_sheet->getRowDimension('1')->setRowHeight(20);

    $activ_sheet->setCellValueByColumnAndRow(0, 1, 'Занятость преподавателей за предыдущий месяц');
    $activ_sheet->setCellValueByColumnAndRow(0, 2, 'Фамилия И.О.');
    $activ_sheet->setCellValueByColumnAndRow(1, 2, 'Кол-во часов');


    $teachers = selectALL('selectteachers');
    $count = 3;
    foreach ($teachers as $key => $teacher) {
        $activ_sheet->setCellValue("A$count", $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['last_name']);
        $activ_sheet->setCellValue("B$count", $teacher['count']);
        $count++;
    }

    $filename = 'report teachers.xlsx';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExel, 'Excel2007');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $objWriter->save($filename);
}