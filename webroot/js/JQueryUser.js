// JavaScript Document

$(document).ready(function () 
{ 
$('#data').dataTable( { 
//don't sort on initial display 
"aaSorting": [], 
"sPaginationType": "full_numbers" 
} ); 
});