<?php
$this->PhpExcel->createWorksheet();
$this->PhpExcel->setDefaultFont('Calibri', 12);

// define table cells
$table = array(
    array('label' => __('Archive'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Author'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Client'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Subject'), 'width' => 'auto', 'filter' => true),
    array('label' => __('Date Created'), 'width' => 'auto'),
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
        $d['Employee']['first_name'].' '.$d['Employee']['surname'],
        $d['Applicant']['first_name'].' '.$d['Applicant']['surname'],
        $d['Casenote']['subject'],
        $this->Time->format('h:i d-m-Y', $d['Casenote']['created'])
    ));
}

$this->PhpExcel->addTableFooter();
$this->PhpExcel->output();

?>