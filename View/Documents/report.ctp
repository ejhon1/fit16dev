<?php
$this->PhpExcel->createWorksheet();
$this->PhpExcel->setDefaultFont('Calibri', 12);

// define table cells
$table = array(
    array('label' => __('Archive'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Client'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Type'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Filename'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Date'), 'width' => 'auto'),
);

// heading
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

// data
foreach ($data as $d) {
    if(empty($d['Employee']['first_name']))
    {
        $d['Employee']['first_name'] = $d['Applicant']['first_name'];
        $d['Employee']['surname'] = $d['Applicant']['surname'];
    }
    $this->PhpExcel->addTableRow(array(
        $d['Archive']['archive_name'],
        $d['Applicant']['first_name'].' '.$d['Applicant']['surname'],
        $d['Documenttype']['type'],
        $d['Document']['filename'],
        $this->Time->format('h:i d-m-Y', $d['Document']['created'])
    ));
}

$this->PhpExcel->addTableFooter();
$this->PhpExcel->output();

?>