window.onload = function(){

	var selectmenu = document.getElementById("selectmenu");
	selectmenu.onchange=function(){ //run some code when "onchange" event fires
	var page=this.options[this.selectedIndex] //this refers to "selectmenu"
 	if (page.value!=""){
  			window.location = page.value //open target site (based on option's value attr) in new window
 		}
	}

}