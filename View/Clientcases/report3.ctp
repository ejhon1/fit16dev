<?php
$this->PhpExcel->createWorksheet();
$this->PhpExcel->setDefaultFont('Calibri', 12);

// define table cells
$table = array(
    array('label' => __('Archive'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Applicant Name'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Status'), 'width' => 50, 'wrap' => true),
    array('label' => __('Date Created'), 'width' => 'auto')
);

// heading
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

// data
foreach ($data as $d) {
    $this->PhpExcel->addTableRow(array(
        $d['Archive']['archive_name'],
        $d['Applicant']['first_name'].' '.$d['Applicant']['surname'],
        $d['Status']['status_type'],
        $this->Time->format('h:i d-m-Y', $d['Clientcase']['created'])
    ));
}

$this->PhpExcel->addTableFooter();
$this->PhpExcel->output();

?>