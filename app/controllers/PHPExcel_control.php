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

    $today = new DateTime('now');
    $month = $today->modify('-1 month')->format('F');
    $teachers = callProc('proc_teachers',
        '"' . date('Y-m-d', strtotime("first day of $month")) . '", "' .
        date('Y-m-d', strtotime("last day of $month")) . '"');
    $count = 3;
    foreach ($teachers as $key => $teacher) {
        $activ_sheet->setCellValue("A$count", $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['last_name']);
        $activ_sheet->setCellValue("B$count", $teacher['count']);
        $count++;
    }

    $filename = 'report.xlsx';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExel, 'Excel2007');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $objWriter->save($filename);
    function file_force_download($filename) {
        if (file_exists($filename)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            // читаем файл и отправляем его пользователю
            readfile($filename);
            exit;
        }
    }
    file_force_download($filename);
}
if (isset($_GET['report_stud'])) {

    $objPHPExel = new PHPExcel();

    $objPHPExel->setActiveSheetIndex(0);

    $activ_sheet = $objPHPExel->getActiveSheet();

    $activ_sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    $activ_sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

    $activ_sheet->setTitle('Посещаемость учащихся');

    $activ_sheet->getColumnDimension('A')->setWidth(30);
    $activ_sheet->getColumnDimension('B')->setWidth(15);

    $activ_sheet->getRowDimension('1')->setRowHeight(20);

    $activ_sheet->setCellValueByColumnAndRow(0, 1, 'Посещаемость учащихся за предыдущий месяц');
    $activ_sheet->setCellValueByColumnAndRow(0, 2, 'Фамилия И.О.');
    $activ_sheet->setCellValueByColumnAndRow(1, 2, 'Кол-во занятий');

    $today = new DateTime('now');
    $month = $today->modify('-1 month')->format('F');
    $students = callProc('proc_students',
        '"' . date('Y-m-d', strtotime("first day of $month")) . '", "' .
        date('Y-m-d', strtotime("last day of $month")) . '"');
    $count = 3;
    foreach ($students as $key => $student) {
        $activ_sheet->setCellValue("A$count", $student['surname'] . ' ' . $student['name'] . ' ' . $student['last_name']);
        $activ_sheet->setCellValue("B$count", $student['count']);
        $count++;
    }

    $filename = 'report2.xlsx';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExel, 'Excel2007');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $objWriter->save($filename);
    function file_force_download($filename) {
        if (file_exists($filename)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            // читаем файл и отправляем его пользователю
            readfile($filename);
            exit;
        }
    }
    file_force_download($filename);
}