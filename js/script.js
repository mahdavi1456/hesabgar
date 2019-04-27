$(document).ready(function() {
    
    $('.select2').select2();
    
    $('[data-name="disable-button"]').click(function() {
        $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable', true);
    });
    $('[data-name="enable-button"]').click(function () {
        $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable', false);
    });



    var el = document.querySelector('input.number');
		el.addEventListener('keyup', function (event) {
  		if (event.which >= 37 && event.which <= 40) return;
  			this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	});

});