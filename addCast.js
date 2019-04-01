$(document).ready(function() {
    var wrapper1   		= $(".link_fields"); //Fields wrapper
	var add_button1      = $(".link_add_field"); //Add button ID
	
	$(add_button1).click(function(e){
        e.preventDefault();
		$(wrapper1).append('<div><input name="link[]" type="text" placeholder = "Link"><a href="#" class="remove_field1">X</a></div>'); //add input box
	});
	
	$(wrapper1).on("click",".remove_field1", function(e){
        e.preventDefault();
        $(this).parent('div').remove(); 
    });
});