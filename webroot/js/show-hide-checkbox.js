// JavaScript Document

/** Mother **/
$(document).ready(function(){
    	$("input[value='Mother']").change(function(){
        var checked = $(this).attr('checked');
        	if (checked) {
           		$('#mother').show();             
        	} else {
            	$('#mother').hide();
        	}
    	});        
		});

/** Father **/		
$(document).ready(function(){
    	$("input[value='Father']").change(function(){
        var checked = $(this).attr('checked');
        	if (checked) {
           		$('#father').show();             
        	} else {
            	$('#father').hide();
        	}
    	});        
		});

/** Maternal Grandmother **/
$(document).ready(function(){
    	$("input[value='Maternal Grandmother']").change(function(){
        var checked = $(this).attr('checked');
        	if (checked) {
           		$('#mat_grandmother').show();             
        	} else {
            	$('#mat_grandmother').hide();
        	}
    	});        
		});

/** Maternal Grandfather **/
$(document).ready(function(){
    	$("input[value='Maternal Grandfather']").change(function(){
        var checked = $(this).attr('checked');
        	if (checked) {
           		$('#mat_grandfather').show();             
        	} else {
            	$('#mat_grandfather').hide();
        	}
    	});        
		});

/** Paternal Grandmother **/
$(document).ready(function(){
    	$("input[value='Paternal Grandmother']").change(function(){
        var checked = $(this).attr('checked');
        	if (checked) {
           		$('#pat_grandmother').show();             
        	} else {
            	$('#pat_grandmother').hide();
        	}
    	});        
		});

/** Paternal Grandfather **/
$(document).ready(function(){
    	$("input[value='Paternal Grandfather']").change(function(){
        var checked = $(this).attr('checked');
        	if (checked) {
           		$('#pat_grandfather').show();             
        	} else {
            	$('#pat_grandfather').hide();
        	}
    	});        
		});
