$(document).ready(function(){
	$('.update').click(function(){
		$(this).parents('tr').fadeOut(function(){
			$(this).next().fadeIn();
		});
	});
	$('.save').click(function(){
		var id = $(this).parent().siblings('.coverage-id').find('input');
		var coverageName = $(this).parent().siblings('.coverage-name').find('select');
		var coverageCost = $(this).parent().siblings('.coverage-cost').find('input');
		if(isValidCoverageName(coverageName) && isValidCoverageCost(coverageCost)){
			updateCoverageDetails(id, coverageName, coverageCost)
		}	
	});
	$('.create').click(function(){
		var coverageName = $('#add-new-coverage-name').val();
		var coverageCost = $('#add-new-coverage-cost').val();
		if(isValidCoverageName($('#add-new-coverage-name')) && isValidCoverageCost($('#add-new-coverage-cost'))){
			addCoverageDetail(coverageName, coverageCost);
		}
	});
	$('.deleteModal').click(function(){
		$('#deleteCoverage').modal('show');
		var rowId = $(this).attr('data-row-id');
		var editableRow = $(this).parents('tr');
		var nonEditableRow = $(this).parents('tr').next();
		//$('#deleteCoverage').find('.delete').attr('onclick', 'deleteCoverageDetail('+rowId+', '+editableRow+','+nonEditableRow+')');
		$('#deleteCoverage').find('.delete').click(function(){
			deleteCoverageDetail(rowId, editableRow,nonEditableRow);
		});
	});
	$('table thead tr th, table thead tr th a').addClass('lead');
});

function updateCoverageDetails(id, coverageName, coverageCost){
	$.ajax({
		type: 'POST',
		url: "coverage/edit/"+$(id).val(),
		data: {
			id:$(id).val(), 
			Coverage_Name: $(coverageName).val(),
			Cost: $(coverageCost).val()
		},
		success: function(result){
			$(id).parents('tr').fadeOut(function(){
				$(id).parent().parent().prev().find('.coverage-cost').text(result.Cost.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
				$(id).parent().parent().prev().find('.coverage-name').text(result.Coverage_Name);
				$(id).parents('tr').prev().fadeIn();
			});
			$('#success-alert').html('<span>Record Updated.</span>').show();
			$('#failure-alert').hide();
		},
		error: function(request, status, error){
			$('#success-alert').hide();
			$('#failure-alert').html('<span>Error Updating Insurance Coverage</span> : <b>' + request.responseJSON.error_message + '</b>').show();	
		}
	});
}
function addCoverageDetail(coverageName, coverageCost){
	$.ajax({
		type: 'POST',
		url: "coverage/add",
		data: {
			Coverage_Name: coverageName,
			Cost: coverageCost
		},
		success: function(){
			$('#success-alert').html('<span>New Coverage Created.</span>').show();
			$('#failure-alert').hide();
			$('#addCoverage').modal('hide');
		},
		error: function(request, status, error){
			$('#failure-alert').html('<span>Error Creating New Coverage.</span>').show();
			$('#success-alert').hide();
			$('#addCoverage').modal('hide');
		}
	});
}
function deleteCoverageDetail(id, editableRow, nonEditableRow){
	$.ajax({
		type: 'POST',
		url: "coverage/delete/"+id,
		data: {
			id: id
		},
		success: function(data){
			$('#success-alert').html('<span>Coverage Deleted.</span>').show();
			$('#failure-alert').hide();
			$(editableRow).remove();
			$(nonEditableRow).remove();
		},
		error: function (request, status, error){
			$('#failure-alert').html('<span>Error In Deleting Coverage.</span>').show();
			$('#success-alert').hide();
		}
	}).done(function(){
		$('#deleteCoverage').modal('hide');
	}).fail(function(){
		$('#deleteCoverage').modal('hide');
	});
}
function isValidCoverageName(coverageName){
	if(($(coverageName).val() == "Auto") || ($(coverageName).val() == "Property") || ($(coverageName).val() == "Legal Expense")){
		return true;
	}
	else{
		$(coverageName).parent().next('.error-message-container').html('Please Enter A Valid Coverage Name')
	}
}
function isValidCoverageCost(coverageCost){
	if(/^(0|[1-9][0-9]{0,2}(?:(,[0-9]{3})*|[0-9]*))$/.test($(coverageCost).val())){
		return true;
	}
	else{
		$(coverageCost).parent().next('.error-message-container').html('Please Enter A Valid Coverage Cost.')
	}
}