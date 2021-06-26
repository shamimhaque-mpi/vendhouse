var app = angular.module("MainApp", ['angularUtils.directives.dirPagination','ngSanitize']);

var url = window.location.origin + '/ajax/';
var siteurl = window.location.origin + '/';

//var url = window.location.origin + '/ajax/';
//var siteurl = window.location.origin + '/';

// custom filter in Angular js
app.filter('removeUnderScore', function() {
	return function(input) {
		return input.replace(/_/gi, " ");
	}
});

app.filter('textToLower', function() {
	return function(input) {
		return input.replace(/_/gi, " ").toLowerCase();
	}
});

//remove underscore and ucwords
app.filter("textBeautify", function(){
	return function (str) {
		var str = str.replace(/_/gi, " ").toLowerCase(),
        	txt = str.replace(/\b[a-z]/g, function(letter) {
        		return letter.toUpperCase();
    		});

    	return txt;
    }
});

//remove dash and ucwords
app.filter("removeDash",function(){
	return function (str) {
	  var str = str.replace(/-/gi, " ").toLowerCase();
          txt = str.replace(/\b[a-z]/g, function(letter) {
         return letter.toUpperCase();
     });
    return txt;
   }
});


app.filter('join', function(){
	return function(input) {
		console.log(typeof input);
		return (typeof input==='object') ? "" : input.join();
	}
});


app.filter("showStatus",function(){
	return function(input){
        if(input == 1){
        	return "Available";
        }else{
        	return "Not Available";
        }
	}
});


app.filter("status",function(){
	return function(input){
        if(input == "active"){
        	return "Running";
        }else{
        	return "Blocked";
        }
	}
});


app.filter("fNumber",function(){
	return function(input){
		var myNum = new Intl.NumberFormat('en-IN').format(input);
		return  myNum;
	}
});
