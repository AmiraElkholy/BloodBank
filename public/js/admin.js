$(document).ready(function(){

	$('#myModal').on('show.bs.modal', function(e) {


		var button = $(e.relatedTarget);
		var id = button.attr('id');
		var modal = $(this);

      // console.log(button);
      // console.log(id);

      modal.find('.modal-footer #id').val(id);

 	});

	$("#example1").DataTable({
		"responsive": true,
		"autoWidth": false,
		"scrollX": true, 
	});
	$('#example2').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": true,
		"autoWidth": false,
		"responsive": true,
		"scrollX": true,
	});


});