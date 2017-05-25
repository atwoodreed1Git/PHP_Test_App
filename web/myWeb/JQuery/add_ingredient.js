$(document).ready(function(e) {

alert("i am here");
	// add row of ingredient
	$("#ingredientRow1").on('click', '#addI', function(e) {

		// get the ingredientRow of the previous entry
		var $div = $('div[id^="ingredientRow"]:last');

		// Read the Number from that DIV's ID And increment that number by 1
		var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) + 1;

		// Clone it and assign the new ID 
		var $newRow = $div.clone().prop('id', 'ingredientRow'+num );

		// increment the button number
		$newRow.find("#btn" + (num - 1)).attr("id", "btn" +num);
		$newRow.find("input[type=text], textarea").val("");

		// add new row
		$div.after($newRow);

		// add remove button
		var $removeText = '<a href=\"#\" id=\"removeI' + num + '\" class=\"btn-floating btn-large waves-effect waves-light red right\" ';
		$removeText += 'onclick=\"removeIngredient(this.id);\"><i class=\"large material-icons\">delete</i></a>';

		// change the add button to a remove button
		$("#btn"+num).html($removeText);

	});
	
});

function removeIngredient(clicked_id) { 

	// remove row of ingredient
	var currentNum = '#ingredientRow' + parseInt( clicked_id.match(/\d+/g), 10 );
	$(currentNum).remove();
};
