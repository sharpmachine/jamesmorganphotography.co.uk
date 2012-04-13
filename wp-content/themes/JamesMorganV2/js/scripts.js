/* Author: 

*/

// Allows you to use the $ shortcut.  Put all your code  inside this wrapper
jQuery(document).ready(function($) {
	
		// Get the container that contains the articles
	var articleContainer = $('#container');
	
	// get the count of the articles within that container
	var articles = articleContainer.find('.photoessayshorts').length;
	
	// make sure there is more then one before proceeding to adjust the math
	if (articles > 1) { 
	  // do some magic like 
	  
	  // Define the new width of the container 
	  var newContainerWidth = articles * articleContainer.width();
	  
	  // adjust the container with the new width.
	  articleContainer.css({'width':newContainerWidth});
	  
	}
	 
});























