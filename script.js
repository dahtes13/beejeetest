$(document).ready(function() {
	
	// Ajax form handler
	
	$('#autorization-btn').click(
		function(){
			sendAutorizationForm('result_form', 'ajax_form', 'autarization.php');
			return false;
		}
	);
	$('#add-task-btn').click(
		function(){
			sendTaskForm('result_form', 'ajax_form', 'add-task.php');
			return false;
		}
	);
	$('.change').click (
		function() {
			tut = $(this);
			$('#taskid').val(parseInt(tut.parent('.task-string').attr('id').replace(/\D+/g,'')));
			$('#name-edit').val(tut.parent('.task-string').children('.name').html());
			$('#email-edit').val(tut.parent('.task-string').children('.email').html());
			$('#task-text-edit').val(tut.parent('.task-string').children('.text').html());
			if (tut.parent('.task-string').children('.status').hasClass('not-ready')) {
				$('#status-edit').prop('checked', false);
			} else {
				$('#status-edit').prop('checked', true);
			}
		}
	)
	$('#edit-task-btn').click(
		function(){
			sendEditForm('result_form', 'ajax_form', 'edit.php');
			return false;
		}
	)
	
	// Modal form handler
	
	$('#add-task').click( function(event){ 
		event.preventDefault(); 
		$('#overlay').fadeIn(400, 
			function(){ 
				$('#modal-form-add-task') 
				.css('display', 'block') 
				.animate({opacity: 1, top: '50%'}, 200); 
			});
	});
	
	$('#autorization').click( function(event){ 
		event.preventDefault(); 
		$('#overlay').fadeIn(400, 
			function(){ 
				$('#modal-form-login') 
				.css('display', 'block') 
				.animate({opacity: 1, top: '50%'}, 200); 
			});
	});
	
	$('.change').click( function(event){ 
		event.preventDefault(); 
		$('#overlay').fadeIn(400, 
			function(){ 
				$('#modal-form-edit-task') 
				.css('display', 'block') 
				.animate({opacity: 1, top: '50%'}, 200); 
			});
	});
 
	$('.close-modal-form, #overlay').click( function(){
		$('.modal-form')
		.animate({opacity: 0, top: '45%'}, 200,  
			function(){ 
				$(this).css('display', 'none'); 
				$('#overlay').fadeOut(400); 
			}
		);
	});
});

// Ajax form function

function sendAutorizationForm(result_form, ajax_form, url) {
	$.ajax({
		type: 'POST',
		url: 'autorization.php',
		data: {
			login: $('#login').val(),
			pass: $('#pass').val()
		},
		success: function(data) {
			if (data === '1') {
				window.location.replace('index.php');
			} else {
				alert(data);
			}
		}
	});
};

function sendTaskForm(result_form, ajax_form, url) {
	$.ajax({
		type: 'POST',
		url: 'add-task.php',
		data: {
			name: $('#name').val(),
			email: $('#email').val(),
			task_text: $('#task-text').val()
		},
		success: function(data) {
			if (data === '1') {
				alert('Ваша заявка принята');
				window.location.replace('index.php');
			} else {
				alert(data);
			}
		}
	});
};

function sendEditForm(result_form, ajax_form, url) {
	if ($('#status-edit').is(':checked')) {
		status_chek = 1;
	} else {
		status_chek = 0;
	}
	$.ajax({
		type: 'POST',
		url: 'edit.php',
		data: {
			taskid: $('#taskid').val(),
			name_edit: $('#name-edit').val(),
			email_edit: $('#email-edit').val(),
			task_text_edit: $('#task-text-edit').val(),
			status_edit: status_chek
		},
		success: function(data) {
			if (data === '1') {
				window.location.replace('index.php');
			} else {
				alert(data);
			}
		}
	});
};