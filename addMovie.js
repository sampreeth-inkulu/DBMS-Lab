$(document).ready(function() {
	//var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".genre_fields"); //Fields wrapper
	var add_button      = $(".genre_add_field"); //Add button ID
	
	// var x = 1; //inital text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		console.log("Hi");
		// if(x < max_fields){ //max input box allowed
			// x++; //text box increment
		$(wrapper).append('<div><input name="genre[]" type="text" placeholder = "Genre"><a href="#" class="remove_field">X</a></div>'); //add input box
		// }
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault();
		console.log("Hello");
        $(this).parent('div').remove(); 
        // x--;
    });
    
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

    var wrapper2   		= $(".collection_fields"); //Fields wrapper
	var add_button2      = $(".collection_add_field"); //Add button ID
	
	$(add_button2).click(function(e){
        e.preventDefault();
		$(wrapper2).append('<div><input name = "week[]" type = "number" placeholder = "No. of weeks"><input name = "collection[]" type = "number" placeholder = "Rs"><a href="#" class="remove_field2">X</a></div>'); //add input box
	});
	
	$(wrapper2).on("click",".remove_field2", function(e){
        e.preventDefault();
        $(this).parent('div').remove(); 
	});
	
	var wrapper3   		= $(".cast_fields"); //Fields wrapper
	var add_button3      = $(".cast_add_field"); //Add button ID
	
	$(add_button3).click(function(e){
		e.preventDefault();
		$(wrapper3).append('<div><input name = "cast[]" type = "text" placeholder = "Cast Name"><input name="role[]" type="text" placeholder="Cast Role"><a href="#" class="remove_field3">X</a></div>'); //add input box
	});
	
	$(wrapper3).on("click",".remove_field3", function(e){
		e.preventDefault();
        $(this).parent('div').remove(); 
    });
});
