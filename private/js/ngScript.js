var app = angular.module("MainApp", ['angularUtils.directives.dirPagination','ngSanitize']);

//var url = window.location.origin + '/buyngain/ajax/';
//var siteurl = window.location.origin + '/buyngain/';

var url = window.location.origin + '/ajax/';
var siteurl = window.location.origin + '/';

app.filter('ucwords', function() {
	return function(input) {
		return input.toLowerCase().replace(/\b[a-z]/g, function(letter) {
			return letter.toUpperCase();
		});
	}
});


//relation filter
app.filter("relation",function(){
    var output = "";
    return function(input){
        if(input == "="){
            output = "Equal";
        }else if(input == "!="){
            output = "Not Equal";
        }else if(input == ">"){
            output = "Greater Than";
        }else if(input == "<"){
            output = "Less Than";
        }else if(input == ">="){
            output = "Greater Than or Equal";
        }else if(input == "<="){
            output = "Less Than or Equal";
        }else{
            output = "Unknown";
        }
        return output;
    };
});


// custom filter in Angular js
app.filter('removeUnderScore', function(){
	return function(input){
		return input.replace(/_/gi," ");
	}
});

// ucwords custom filter in Angular js
app.filter('textBeautify', function(){
	return function(input){
		var str = input.replace(/_|-/gi, " ").toLowerCase();

		return str.replace(/^([a-z])|\s+([a-z])/g, function($1){
			return $1.toUpperCase();
		});
	}
});

//show status filter
app.filter('showStatus',function(){
	return function(input){
		var status;
		if(input==1){
			status="Available";
		}else{
			status="Notavailable";
		}
	  return status;
	}
});



//show Godownctrl
app.controller('ShowGodownCtrl', function($scope, $http, $window){
	var loadData = function(){
		$http({
			method: 'POST',
			url: url + 'read',
			data: {table: 'godowns'}
		}).success(function(response){
			angular.forEach(response, function(item, key){
				item['sl'] = key + 1;
			});

			$scope.result = response;
			//Pre Loader
			  $("#loading").fadeOut("fast",function(){
				  $("#data").fadeIn('slow');
			 });
		});
	}

	$scope.deleteGodownFn = function(id){
		var condition = {
			table: 'godowns',
			cond: {id: id}
		};

		if ($window.confirm("তথ্যটি মুছে ফেলার জন্য নিশ্চিত করুন।")) {
			$http({
				method: 'POST',
				url: url + 'delete',
				data: condition
			}).success(function(response){
				loadData();
			});
		}
	}

	loadData();
});

//show all SR from the database controller
app.controller("allSrCtrl",function($scope, $http) {
   $scope.perPage 	= "50";
   $scope.reverse 	= false;
   $scope.allSr 	= [];

	var condition = {
		table: 'sr'
	};

	$http({
		method: "POST",
		url: url + "read",
		data: condition
	}).success(function(response) {
		if(response.length > 0) {
			angular.forEach(response, function(row, index) {
				row.sl = index + 1;

        		$scope.allSr.push(row);
				console.log($scope.allSr);
			});
		}
		// loading
		$("#loading").fadeOut("fast", function(){
	   	 	$("#data").fadeIn('slow');
	   	});
		console.log(response);
	});


});



//show all Category
/*app.controller("showcategoryCtrl", function($scope, $http, $log){
	$scope.reverse = false;
	$scope.perPage = "20";
	$scope.categories = [];

	var obj = { 'table': 'category' };

	$http({
		method:'POST',
		url:url+'read',
		data:obj
	}).success(function(response) {
		angular.forEach(response, function(values, index) {
			values['sl'] = index + 1;
			$scope.categories.push(values);
		});

		 //Pre Loader
			  $("#loading").fadeOut("fast",function(){
				  $("#data").fadeIn('slow');
			 });

		$log.log($scope.categories);
	});
});*/


app.controller("showcategoryCtrl", function($scope, $http, $log){
	$scope.reverse = false;
	$scope.perPage = "20";
	$scope.categories = [];

	$scope.$watchGroup(["privilege","user_id"],function(){
    	var obj = { 
    	    table:'category'
    	};
    	
    	/*if($scope.privilege =="user"){
    	    obj.cond = {
    	        user_id : $scope.user_id
    	        
    	    };
    	}*/
    	
    	
    	// console.log(obj);
    	
    	$http({
    		method  :'POST',
    		url     : url+'read',
    		data    : obj
    	}).success(function(response){
    		if(response.length>0){
    		    $scope.active=false;
    			angular.forEach(response,function(values,index){
    		    values['sl']=index+1;
    		    $scope.categories.push(values);
    		  });
    		}else{
    		  $scope.active=true;
    		  $scope.categories=[];
    		}
    
    	  //$log.log($scope.products);
    
    	  //Pre Loader
    	  $("#loading").fadeOut("fast",function(){
    		  $("#data").fadeIn('slow');
    	  });
    	});
   });
});








//show all Sub Category
/*app.controller("showsubcategoryCtrl",function($scope,$http,$log){
	$scope.reverse=false;
	$scope.perPage="20";
	$scope.subcategorys=[];
	var obj={'table':'subcategory'};
	$http({
		method:'POST',
		url:url+'read',
		data:obj
	}).success(function(response){
		angular.forEach(response,function(values,index){
		  values['sl']=index+1;
		  $scope.subcategorys.push(values);
		});

		 //Pre Loader
			  $("#loading").fadeOut("fast",function(){
				  $("#data").fadeIn('slow');
			 });

	  $log.log($scope.subcategorys);
	});

});*/

app.controller("showsubcategoryCtrl",function($scope,$http,$log){
	$scope.reverse=false;
	$scope.perPage="20";
	$scope.subcategorys=[];
	
	
	$scope.$watchGroup(["privilege","user_id"],function(){
    	var obj = { 
    	    table:'subcategory'
    	};
    	
    	/*if($scope.privilege =="user"){
    	    obj.cond = {
    	        user_id : $scope.user_id
    	        
    	    };
    	}*/
    	
    	
    	// console.log(obj);
    	
    	$http({
    		method  :'POST',
    		url     : url+'read',
    		data    : obj
    	}).success(function(response){
    		if(response.length>0){
    		    $scope.active=false;
    			angular.forEach(response,function(values,index){
    		    values['sl']=index+1;
    		    $scope.subcategorys.push(values);
    		  });
    		}else{
    		  $scope.active=true;
    		  $scope.subcategorys=[];
    		}
    
    	  //$log.log($scope.products);
    
    	  //Pre Loader
    	  $("#loading").fadeOut("fast",function(){
    		  $("#data").fadeIn('slow');
    	  });
    	});
   });

});




//show all brand
/*app.controller("showbrandCtrl",function($scope,$http,$log){
	$scope.reverse=false;
	$scope.perPage="20";
	$scope.brands=[];
	var obj={'table':'brand'};
	$http({
		method:'POST',
		url:url+'read',
		data:obj
	}).success(function(response){
		angular.forEach(response,function(values,index){
		  values['sl']=index+1;
		  $scope.brands.push(values);
		});

		 //Pre Loader
			  $("#loading").fadeOut("fast",function(){
				  $("#data").fadeIn('slow');
			 });

	  $log.log($scope.brands);
	});

});*/

app.controller("showbrandCtrl",function($scope,$http,$log){
	$scope.reverse=false;
	$scope.perPage="20";
	$scope.brands=[];
	
	$scope.$watchGroup(["privilege","user_id"],function(){
    	var obj = { 
    	    table:'brand'
    	};
    	
    	/*if($scope.privilege =="user"){
    	    obj.cond = {
    	        user_id : $scope.user_id
    	        
    	    };
    	}*/
    	
    	// console.log(obj);
    	
    	$http({
    		method  :'POST',
    		url     : url+'read',
    		data    : obj
    	}).success(function(response){
    		if(response.length>0){
    		    $scope.active=false;
    			angular.forEach(response,function(values,index){
    		    values['sl']=index+1;
    		    $scope.brands.push(values);
    		  });
    		}else{
    		  $scope.active=true;
    		  $scope.brands=[];
    		}
    
    	  //$log.log($scope.products);
    
    	  //Pre Loader
    	  $("#loading").fadeOut("fast",function(){
    		  $("#data").fadeIn('slow');
    	  });
    	});
   });

});














//show all members from the database controller
app.controller("showAllMembersCtrl",function($scope,$http,$log){
   $scope.perPage="20";
   $scope.reverse=false;
   $scope.members=[];
   var condition={table:'members'};

  $http({
  	method:'POST',
  	url:url+'read',
  	data:condition
  }).success(function(response){
  	 if(response.length>0){
  	 	angular.forEach(response,function(value,key){
  	 		value['sl']=key+1;
  	 		$scope.members.push(value);
  	 	});
   	 }
   	 $log.log($scope.members);
  });
});


//show all Product Controller
app.controller("showAllProductCtrl",function($scope,$http,$log){
    $scope.reverse=false;
	$scope.perPage="100";
	$scope.products=[];

   $scope.$watchGroup(["privilege","user_id"],function(){
    	var obj = { 
    	    table:'products',
    	    cond:{
    	        'status':1
    	    }
    	};
    	
    	/*if($scope.privilege =="user"){
    	    obj.cond = {
    	        user_id : $scope.user_id
    	    };
    	}*/

    	 //console.log(obj);
    	
    	$http({
    		method  :'POST',
    		url     : url+'read',
    		data    : obj
    	}).success(function(response){
    		if(response.length>0){
    		    //console.log(response);
    		    $scope.active=false;
    			angular.forEach(response,function(values,index){
        		    values['sl']=index+1;
        		    $scope.products.push(values);
        		    
        		    //Getting supplier info from user table 
        		    /*var condition = {
            			table: 'users',
            			cond: {'id' : response[index].user_id}
            		};
            		//console.log(condition);
            
            		$http({
            			method: 'POST',
            			url: url + 'read',
            			data: condition
            		}).success(function(result) {
            			//console.log(result);
            			if(result.length > 0) {
            			    values['supplier'] = result[0].name;
            			    $scope.products.push(values);
            			}
            		});*/

    		    });
    		    //console.log(response);
    		}else{
    		  $scope.active=true;
    		  $scope.products=[];
    		}
    
    	  //$log.log($scope.products);
    
    	  //Pre Loader
    	  $("#loading").fadeOut("fast",function(){
    		  $("#data").fadeIn('slow');
    	  });
    	  //console.log($scope.products[0]);
    	});
   });

});






// company transaction controller start here
app.controller('CompanyTransactionCtrl', ['$scope', '$http', function($scope, $http) {
	$scope.balance = 0.00;
	$scope.sign = "Receivable";

	$scope.payment = 0.00;
	$scope.csign = "Receivable";

	$scope.getCompanyInfo = function() {
		var condition = {
			table: 'partybalance',
			cond: {'code' : $scope.code}
		};

		$http({
			method: 'POST',
			url: url + 'read',
			data: condition
		}).success(function(response) {
			if(response.length > 0) {
				$scope.balance = Math.abs(parseFloat(response[0].balance));

				if(parseFloat(response[0].balance) < 0) {
					$scope.sign = "Payable";
				} else {
					$scope.sign = "Receivable";
				}
			} else {
				$scope.balance = 0.00;
				$scope.sign = "Receivable";
			}

			console.log(response);
		});
	}

	$scope.getTotalFn = function() {
		var total = 0.00;

		if($scope.sign == 'Receivable') {
			total = $scope.balance + $scope.payment;
			$scope.csign = "Receivable";
		} else {
			total = $scope.balance - $scope.payment;

			if(total > 0) {
				$scope.csign = "Payable";
			} else {
				$scope.csign = "Receivable";
			}
		}

		return Math.abs(total);
	}
}]);







/**
 * Working with purchase
 * controller name : Purchase
 *
 */
/*app.controller('PurchaseEntry', function($scope, $http) {
	$scope.warning = "";
	$scope.active = true;
	$scope.cart = [];
	$scope.amount = {
		total: 0,
		totalDiscount: 0,
		totalTransportCost: 0,
		grandTotal: 0,
		paid: 0,
		due: 0
	};

	$scope.setProductFn = function(){
		var condition = {
			table: 'products',
			cond: {bar_code: $scope.pcode}
		};

		$http({
			method: 'POST',
			url: url + 'read',
			data: condition
		}).success(function(response){
			if(response.length > 0){
				$scope.category = response[0].product_cat;
				$scope.subcategory = response[0].subcategory;
				$scope.product = response[0].product_name;
				$scope.price = parseFloat(response[0].purchase_price);
				$scope.sale_price = parseFloat(response[0].sale_price);

			}
			//console.log(response);
		});
	}

   $scope.codeList = [];
	$scope.addNewProductFn = function(){
		if(typeof $scope.product !== 'undefined'){
			if($scope.codeList.indexOf($scope.pcode) < 0){
				$scope.active = false;
				$scope.warning = "";

				var condition = {
					table: 'products',
					cond: {
						product_name : $scope.product,
						product_cat  : $scope.category,
						subcategory  : $scope.subcategory,
						bar_code     : $scope.pcode
					}
				};

				$http({
					method: 'POST',
					url: url+'read',
					data: condition
				}).success(function(response){
					if(response.length > 0){
						var item = {
							product: $scope.product,
							productCode: $scope.pcode,
							category: $scope.category,
							subcategory: $scope.subcategory,
							price: parseFloat($scope.price),
							sale_price: parseFloat($scope.sale_price),
							quantity: (typeof $scope.quantity === 'undefined') ? 0 : $scope.quantity,
							transport_cost: 0.00,
							discount: 0.00,
							subtotal: 0.00,
							godown: "Grandbazar",
							supplier : $scope.supplier
						};

						 $scope.cart.push(item);
						 $scope.codeList.push($scope.pcode);
						// console.log($scope.cart);

						 // to go the first tab index
	   				     $('#firstInput').focus();

						 // clear set info
						 $scope.pcode = "";
						 $scope.quantity = 1;
						 $scope.price = "";
						 $scope.sale_price = "";
						 $scope.supplier = "";
						 $scope.product = $scope.category = $scope.subcategory = "";

					}

					// console.log($scope.codeList);
				});

			}else{
				$scope.warning="This Item already added.Try another!";
			}
		}
	}

	$scope.setSubtotalFn = function(index){
		$scope.cart[index].subtotal = $scope.cart[index].price * $scope.cart[index].quantity;
		return $scope.cart[index].subtotal;
	}

	$scope.getTotalFn = function(){
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.subtotal);
		});

		$scope.amount.total = total;
		return $scope.amount.total;
	}

	$scope.getTotalDiscountFn = function() {
		var total = 0;
		angular.forEach($scope.cart, function(item) {
			if(item.discount != null){
				total += parseFloat(item.discount);
			}

			// console.log(item.discount);
		});

		$scope.amount.totalDiscount = total;
		return $scope.amount.totalDiscount;
	}

	$scope.getTotalTransportCostFn = function() {
		var total = 0;
		angular.forEach($scope.cart, function(item) {
			if(item.transport_cost != null){
				total += parseFloat(item.transport_cost);
			}

		});

		$scope.amount.totalTransportCost = total;
		return $scope.amount.totalTransportCost;
	}

	$scope.getGrandTotalFn = function(){
		$scope.amount.grandTotal = $scope.amount.total - $scope.amount.totalDiscount;
		return $scope.amount.grandTotal;
	}

	$scope.getTotalDueFn = function(){
		$scope.amount.due = $scope.amount.grandTotal - $scope.amount.paid;
		return $scope.amount.due;
	}

	$scope.deleteItemFn = function(index){
		$scope.cart.splice(index, 1);
	}
});*/










/*app.controller('EditPurchaseEntry', function($scope, $http){
	$scope.allProducts = [];
	$scope.amount = {
		total: 0,
		totalDiscount: 0,
		totalTransportCost: 0,
		grandTotal: 0,
		due: 0
	}

	$scope.$watch('vno', function(){
		var condition = {
			table: 'purchase',
			cond: {voucher_no: $scope.vno}
		};

		$http({
			method: 'POST',
			url: url + 'read',
			data: condition
		}).success(function(response){
			angular.forEach(response, function(item){
				var newItem = {
					productID: item.id,
					product: item.product_name,
					category: item.category,
					subcategory: item.subcategory,
					price: parseInt(item.purchase_price),
					quantity: parseInt(item.quantity),
					transport_cost: parseInt(item.transport_cost),
					discount: parseFloat(item.discount),
					subtotal: parseFloat(item.subtotal),
					godown: item.godown,
				};

				$scope.allProducts.push(newItem);
				$scope.oldRecord = response;
			});
		});
	});

	$scope.getSubtotalFn = function(index){
		angular.forEach($scope.allProducts, function(item){
			item.subtotal = item.price * item.quantity;
		});

		return $scope.allProducts[index].subtotal;
	}

	$scope.getTotalFn = function(){
		var total = 0;
		angular.forEach($scope.allProducts, function(item){
			total += item.subtotal;
		});

		$scope.amount.total = total;
		return $scope.amount.total;
	}

	$scope.getTotalDiscountFn = function(){
		var total = 0;
		angular.forEach($scope.allProducts, function(item){
			total += item.discount;
		});

		$scope.amount.totalDiscount = total;
		return $scope.amount.totalDiscount;
	}

	$scope.getTotalTransportCostFn = function() {
		var total = 0;
		angular.forEach($scope.allProducts, function(item) {
			if(item.transport_cost != null){
				total += parseFloat(item.transport_cost);
			}

		});

		$scope.amount.totalTransportCost = total;
		console.log($scope.amount.totalTransportCost);
		return $scope.amount.totalTransportCost;
	}

	$scope.getGrandTotalFn = function(){
		$scope.amount.grandTotal = $scope.amount.total - $scope.amount.totalDiscount;
		return $scope.amount.grandTotal;
	}

	$scope.getTotalDueFn = function(){
		$scope.amount.due = $scope.amount.grandTotal - $scope.amount.paid;
		return $scope.amount.due;
	}
});*/




// sale controller
app.controller('SaleEntryCtrl', function($scope, $http){
 $scope.warning = "";
 
 // create an empty object
 $scope.cart = [];
 $scope.quantity = 0;
 $scope.allProducts = [];
 $scope.sale_price = 0.00;



 // initialize all kind of amount
  $scope.amount = {
  total: 0.00,
  totalvat: 0.00,
  totalDiscount: 0.00,
  grandTotal: 0.00,
  paid: 0.00,
  realPaid : 0.00,
  return : 0.00,
  due: 0.00,
  totalQuantity: 0,
  quantity: 0
 };

 $scope.total_vat_amount = 0.0;


 // code list
 var codeList = [];

 // get default product
 var condition = {
  table: 'stock',
  cond: {
	   'quantity >' : 0
	  }
 };

 $http({
   method    : 'POST',
   url       : url + 'read',
   data      : condition
 }).success(function(response){
   if(response.length > 0) {
	   $scope.allProducts = response;
   }else{
	 $scope.allProducts = [];
   }
 });

 // getAllProductFN
 $scope.getAllProductFN = function(){
	 var condition = {
	  table: 'stock',
		  cond: {
			   'quantity >' : 0,
		       'category'   : $scope.product_category
		  }
	 };

	 $http({
	   method    : 'POST',
	   url       : url + 'read',
	   data      : condition
	 }).success(function(response){
	   if(response.length > 0) {
		   $scope.allProducts = response;
	   }else{
		 $scope.allProducts = [];
	   }
	 });
 };



  $scope.getProductNameFn= function() {
  $scope.product_name = "";
  $scope.product_purchase_price = "";
  $scope.product_sale_price = "";
  $scope.stock_quantity = "";
   var condition = {
    table: 'stock',

    cond: {
	    'code'       : $scope.code
    }
   };



   $http({
	    method    : 'POST',
	    url       : url + 'read',
	    data      : condition
   }).success(function(response){
	    if(response.length == 1) {
		    $scope.product_name =  response[0].product_name;
		    $scope.product_purchase_price = parseFloat(response[0].purchase_price);
		    $scope.product_sale_price =  $scope.sale_price = parseFloat(response[0].sell_price);
		    $scope.stock_quantity =  response[0].quantity;
	    }else{
	      $scope.product_name = "";
	      $scope.product_purchase_price = "";
		  $scope.product_sale_price = "";
		  $scope.sale_price = 0.00;
		  $scope.stock_quantity =  "";
	    }
   });

 }







 var counter = 0;
 $scope.getProductFn = function(sale_price,sale_quantity) {
  var position = codeList.indexOf($scope.code);
  

  // console.log(position);
 if(typeof $scope.code != "undefined" && $scope.code != ""){ counter++;
	 if(position < 0){
	     if(counter == 1){
	   
		  // get the data from stock table
		  var condition = {
		   from : 'stock',
		   join : 'products',
		   cond : "stock.code=products.bar_code",
		   where : {
			 'stock.code'       : $scope.code,
			 'stock.quantity >' : 0
		   }
		  };


		 //console.log(condition);

		  // set the old one and add a new one
		  $http({
			 method    : 'POST',
			 url       : url + 'readJoinData',
			 data      : condition
		  }).success(function(response){
			 if(response.length > 0) {
				  var newItem = {
					   productname    : response[0].product_name,
					   code           : response[0].code,
					   category       : response[0].category,
					   godown         : response[0].godown,
					   subcategory    : response[0].subcategory,
					   vat            : parseFloat(response[0].vat),
					   purchase_price : parseFloat(response[0].purchase_price),
					   price          : parseFloat(sale_price),
					   maxQuantity    : parseInt(response[0].quantity),
					   quantity       : parseInt(sale_quantity),
					   discount       : 0.00,
					   subtotal       : 0.00
				  };
				  
				  codeList.push(newItem.code);
				  $scope.cart.push(newItem);
				  
				  // get free product
				  $scope.getFreeProduct($scope.code,$scope.date,sale_quantity,response[0].category,response[0].godown,response[0].subcategory);
				  
				 console.log($scope.cart);
				  $scope.sale_date = $scope.date;
				  

				 // to clear product info
				 $scope.code = "";
				 $scope.sale_price = 0.00;
				 $scope.product_name = "";
				 $scope.product_sale_price = "";
				 $scope.sale_price = 0.00;
				 $scope.sale_quantity = 1;
				 $scope.stock_quantity =  "";

				  // to go the first tab index
				  $('#firstInput').focus();
				  counter = 0;
			 }
		  });
	     }
		}else{
		 /* angular.forEach($scope.cart,function(row,key){
			 var quantity = 0;
			 if(row.code == $scope.code){
				 quantity = parseInt($scope.cart[key].quantity);
				 $scope.cart[key].quantity = quantity + 1;
			 }
		 });*/

		 $scope.warning = "This Item already added.Try another!";
	   }
	   
	   
	   
	 }
	 
 }
 
 var freeCodeList = [];
 $scope.getFreeProduct = function(code,date,sale_quantity,category,godown,subcategory){
     var condition = {
           table : "free_product",
           cond  : {
               "from_date <= " : date,
               "to_date >= "   : date,
               "product_code"  : code,
               "quantity <= "  : sale_quantity,
               "status"        : "1"
           }
      };
      
      // console.log(condition);
      
      
      $http({
          method  : "POST",
          url     : url + "read",
          data    : condition
      }).success(function(freeproduct){
           if(freeproduct.length == 1){
                  var freeposition = freeCodeList.indexOf(freeproduct[0].free_product_code);
                  if(freeposition < 0){
                      var newItem = {
            			   productname    : freeproduct[0].free_product,
            			   code           : freeproduct[0].free_product_code,
            			   category       : category,
            			   godown         : godown,
            			   subcategory    : subcategory,
            			   vat            : 0.00,
            			   purchase_price : 0.00,
            			   price          : 0.00,
            			   free           : "yes",
            			   maxQuantity    : parseInt(sale_quantity/freeproduct[0].quantity),
            			   quantity       : parseInt(sale_quantity/freeproduct[0].quantity),
            			   discount       : 0.00,
            			   subtotal       : 0.00
            		  };
            		  
            		   freeCodeList.push(newItem.code);
            		   $scope.cart.push(newItem); 
                 }
           }
      });
 };


 // calculate the subtotal
 $scope.setSubtotalFn = function(index){
  var total = 0.00;

  if($scope.cart[index].selectedProduct !== ''){
	  total = $scope.cart[index].price * $scope.cart[index].quantity;
      $scope.cart[index].subtotal = total;
  }
  return total;
 }


 // calculate the vat
 $scope.setVatTotalFn = function(index){
  var total = 0.00;

  if($scope.cart[index].selectedProduct !== ''){
	  total = parseFloat($scope.cart[index].price * $scope.cart[index].vat)/100;
      $scope.cart[index].vat_subtotal = total;
  }
  return total.toFixed(2);
 }



 // delete the current item from cart object
 $scope.deleteItemFn = function(index){
  $scope.cart.splice(index, 1);
  codeList.splice(index,1);
  freeCodeList.splice(index,1);
 }

 // calculate the total price in all the object in cart
 $scope.getTotalFn = function() {
  var total = 0.00;

  angular.forEach($scope.cart, function(item){
   total += item.subtotal;
  });

  $scope.amount.total = total;

  return $scope.amount.total;
 }

 // calculate the total price in all the object in cart
 $scope.getTotalQty = function() {
  var total = 0;

  angular.forEach($scope.cart, function(item){
      if(item.free != "yes"){
          total += item.quantity;
      }
  });


  $scope.quantity = total;
  // console.log($scope.quantity);

   return $scope.quantity;
 }

//Calculate Vat
$scope.totalVatCalculationFn = function(){
	var total = 0.00;
	angular.forEach($scope.cart, function(row){
		total += parseFloat(row.vat_subtotal);
	});
	$scope.amount.totalvat = total.toFixed(2);

    return $scope.amount.totalvat;

}




 // calculate the Grand Total
 $scope.getGrandTotalFn = function(){
  var total = 0.00;

  total = $scope.amount.total - $scope.amount.totalDiscount + parseFloat($scope.amount.totalvat);
  $scope.amount.grandTotal = total;

  return $scope.amount.grandTotal;
 }

 //calculate real paid
 $scope.getRealPaid = function(){
    var total = 0.0;
    if($scope.amount.paid >= $scope.amount.grandTotal){
       total = $scope.amount.grandTotal;
    }else{
      total = $scope.amount.paid;
    }

    $scope.amount.realPaid  = total.toFixed();

    return $scope.amount.realPaid
 }


 // calculate total due
 $scope.getTotalDueFn = function(){
  var total = 0.00;

   if($scope.amount.paid >= $scope.amount.grandTotal){
       $scope.amount.due = 0.0;
    }else{
       total = $scope.amount.grandTotal - $scope.amount.paid;
       $scope.amount.due = total;
    }
   return $scope.amount.due;
 }


 // calculate total return
 $scope.getReturn= function(){
  var total = 0.00;

   if($scope.amount.paid <= $scope.amount.grandTotal){
       $scope.amount.return = 0.0;
    }else{
       total = $scope.amount.paid - $scope.amount.grandTotal;
       $scope.amount.return= total;
    }
   return $scope.amount.return;
 }

});







//full sale return controller
app.controller('FullSaleReturnCtrl', function($scope, $http){
    // create an empty object
    $scope.cart = [];
    $scope.quantity = 0;
    $scope.allProducts = [];
    $scope.sale_price = 0.00; 
    
    
    // initialize all kind of amount
    $scope.amount = {
    total: 0.00,
    totalvat: 0.00,
    totalDiscount: 0.00,
    grandTotal: 0.00,
    paid: 0.00,
    realPaid : 0.00,
    return : 0.00,
    due: 0.00,
    totalQuantity: 0,
    quantity: 0
    };
    
    $scope.total_vat_amount = 0.0;
    
    
    $scope.$watch("vno",function(vno){
        
        var condition = {
            table : "sale",
            cond  : {
                voucher_number : vno
            }
        };
        
        // console.log(condition);
        
        // set the old one and add a new one
		  $http({
			 method    : 'POST',
			 url       : url + 'read',
			 data      : condition
		  }).success(function(response){
		      // console.log(response);
			 if(response.length > 0) {
			     angular.forEach(response,function(row){
    			     var newItem = {
    			           date           : row.date,
    					   productname    : row.product,
    					   code           : row.code,
    					   category       : row.category,
    					   godown         : row.godown,
    					   subcategory    : row.subcategory,
    					   vat            : parseFloat(row.vat),
    					   price          : parseFloat(row.price),
    					   maxQuantity    : parseInt(row.quantity),
    					   old_quantity   : parseInt(row.quantity),
    					   quantity       : 0,
    					   discount       : parseInt(row.discount),
    					   subtotal       : parseInt(row.subtotal),
    					   name           : row.name,
    					   mobile         : row.mobile,
    					   sale_type      : row.sale_type,
    					   remark         : row.remark,
    					   paid           : parseFloat(row.paid),
    					   due            : parseFloat(row.due)
    				  };
    				 
    				  $scope.cart.push(newItem);
			     });
			   // console.log($scope.cart);
			 }
		  });
         
         
         
         
        
        
        
         // calculate the subtotal
         $scope.setSubtotalFn = function(index){
          var total = 0.00;
        
          if($scope.cart[index].selectedProduct !== ''){
        	  total = $scope.cart[index].price * ($scope.cart[index].old_quantity - $scope.cart[index].quantity);
              $scope.cart[index].subtotal = total;
          }
          return total;
         }
        
        
         // calculate the vat
         $scope.setVatTotalFn = function(index){
          var total = 0.00;
        
          if($scope.cart[index].selectedProduct !== ''){
        	  total = parseFloat($scope.cart[index].price * $scope.cart[index].vat)/100;
              $scope.cart[index].vat_subtotal = total;
          }
          return total.toFixed(2);
         }
        
       
        
         // calculate the total price in all the object in cart
         $scope.getTotalFn = function() {
          var total = 0.00;
        
          angular.forEach($scope.cart, function(item){
           total += item.subtotal;
          });
        
          $scope.amount.total = total;
        
          return $scope.amount.total;
         }
        
         // calculate the total price in all the object in cart
         $scope.getTotalQty = function() {
          var total = 0;
        
          angular.forEach($scope.cart, function(item){
              if(item.remark != "free"){
                  total += (item.old_quantity - item.quantity);
              }
          });
        
        
          $scope.quantity = total;
          // console.log($scope.quantity);
        
           return $scope.quantity;
         }
        
        //Calculate Vat
        $scope.totalVatCalculationFn = function(){
        	var total = 0.00;
        	angular.forEach($scope.cart, function(row){
        		total += parseFloat(row.vat_subtotal);
        	});
        	$scope.amount.totalvat = total.toFixed(2);
        
            return $scope.amount.totalvat;
        
        }
        
        
        
        
         // calculate the Grand Total
         $scope.getGrandTotalFn = function(){
          var total = 0.00;
        
          total = $scope.amount.total - $scope.amount.totalDiscount + parseFloat($scope.amount.totalvat);
          $scope.amount.grandTotal = total;
        
          return $scope.amount.grandTotal;
         }
        
         //calculate real paid
         $scope.getRealPaid = function(){
            var total = 0.0;
            if($scope.amount.paid >= $scope.amount.grandTotal){
               total = $scope.amount.grandTotal;
            }else{
              total = $scope.amount.paid;
            }
        
            $scope.amount.realPaid  = total.toFixed();
        
            return $scope.amount.realPaid
         }
        
        
         // calculate total due
         $scope.getTotalDueFn = function(){
          var total = 0.00;
        
           if($scope.amount.paid >= $scope.amount.grandTotal){
               $scope.amount.due = 0.0;
            }else{
               total = $scope.amount.grandTotal - $scope.amount.paid;
               $scope.amount.due = total;
            }
           return $scope.amount.due;
         }
        
        
         // calculate total return
         $scope.getReturn= function(){
          var total = 0.00;
        
           if($scope.amount.paid <= $scope.amount.grandTotal){
               $scope.amount.return = 0.0;
            }else{
               total = $scope.amount.paid - $scope.amount.grandTotal;
               $scope.amount.return= total;
            }
           return $scope.amount.return;
         }
    });
});



//all sale Controller
app.controller("AllSaleCtrl",function($scope,$http){
	$scope.getSubCategoryFn= function(){
      $scope.allSubCategory = [];
      var where = {
 			table : "subcategory",
 			cond  : {
 				category : $scope.category
 			}
 		};

 		$http({
 			method  : "POST",
 			url     : url + "read",
 			data    : where
 		}).success(function(response){
 		  if(response.length > 0){
 				$scope.allSubCategory = response;
 			}else{
 				$scope.allSubCategory = [];
 			}

 			// console.log($scope.allSubCategory);
 		});
    };

});









// sale return controller
app.controller('ReturnSaleEntryCtrl', function($scope, $http){
 // create an empty object
 $scope.cart = [];

 // initialize all kind of amount
 $scope.amount = {
  total: 0.00,
  totalDiscount: 0.00,
  grandTotal: 0.00,
  paid: 0.00,
  return_amount: 0.00,
  due: 0.00
 };

 $scope.$watch('vno', function(){
  var condition = {
   table: 'sale',
   cond: { voucher_number: $scope.vno }
  }

  $http({
   method: 'POST',
   url: url + 'read',
   data: condition
  }).success(function(response){
  console.log(response);
   angular.forEach(response, function(item, index){
    var row = {
     sl: (index + 1),
     id: item.id,
     category: item.category,
     subcategory: item.subcategory,
     godown: item.godown,
     product: item.product,
     code: item.code,
     quantity: parseInt(item.quantity),
     oldQuantity: parseInt(item.quantity),
     returnQuantity: 0,
     price: parseFloat(item.price),
     subtotal: parseFloat(item.subtotal),
     date: item.date,
     voucher: item.voucher_number,
     paid: parseFloat(item.paid),
     grand_total : parseFloat(item.grand_total),
     discount: parseFloat(item.discount),
     due: parseFloat(item.due)
    };

    $scope.cart.push(row);

    $scope.amount.grandTotal= parseFloat(row.grand_total);
    $scope.amount.totalDiscount= parseFloat(row.discount);
    $scope.amount.paid = parseFloat(row.paid);
    $scope.amount.due = parseFloat(row.due);
   });
  });

  // console.log($scope.cart);
 });

 // calculate subtotal
 $scope.getSubtotalFn = function(index){
  var total = 0.00;

  total = $scope.cart[index].price * ($scope.cart[index].oldQuantity - $scope.cart[index].returnQuantity);
  $scope.cart[index].subtotal = total;

  return $scope.cart[index].subtotal;
 }

 $scope.getTotalFn = function(){
  var total = 0;
  angular.forEach($scope.cart, function(item){
   total += item.subtotal;
  });

  $scope.amount.total = total;
  return $scope.amount.total
 }

 $scope.grandTotalFn = function(){
  var total = 0;
  total = parseFloat($scope.amount.total) - parseFloat($scope.amount.totalDiscount);
  $scope.amount.grandTotal = total.toFixed(2);
  return $scope.amount.grandTotal;
 }

 $scope.getTotalDueFn = function(){
  var total = 0.00;

  total = $scope.amount.grandTotal - ($scope.amount.paid - $scope.amount.return_amount);
  $scope.amount.due = total;

  return $scope.amount.due;
 }


});





// Installment Contrller
app.controller('InstallmentCtrl', function($scope){
	$scope.installment = 1;
	$scope.totalAmountFn = function(amount){
		return (amount * $scope.installment);
	}
});







//SMS Controller
app.controller("CustomSMSCtrl", ["$scope", "$log", function($scope, $log){
	$scope.msgContant = "";
	$scope.totalChar = 0;
	$scope.msgSize = 1;

	$scope.$watch(function(){
		var charLength = $scope.msgContant.length,
		message = $scope.msgContant,
		messLen = 0;




	var english = /^[~!@#$%^&*(){},.:/-_=+A-Za-z0-9 ]*$/;

	if (english.test(message)){
	        if( charLength <= 160){ messLen = 1; }
		else if( charLength <= 306){ messLen = 2; }
		else if( charLength <= 459){ messLen = 3; }
		else if( charLength <= 612){ messLen = 4; }
		else if( charLength <= 765){ messLen = 5; }
		else if( charLength <= 918){ messLen = 6; }
		else if( charLength <= 1071){ messLen = 7; }
		else if( charLength <= 1080){ messLen = 8; }
		else { messLen = "Equal to an MMS!"; }

	}else{
	        if( charLength <= 63){ messLen = 1; }
		else if( charLength <= 126){ messLen = 2; }
		else if( charLength <= 189){ messLen = 3; }
		else if( charLength <= 252){ messLen = 4; }
		else if( charLength <= 315){ messLen = 5; }
		else if( charLength <= 378){ messLen = 6; }
		else if( charLength <= 441){ messLen = 7; }
		else if( charLength <= 504){ messLen = 8; }
		else { messLen = "Equal to an MMS!"; }
	}



		$scope.totalChar = charLength;
		$scope.msgSize = messLen;
	});
}]);




app.controller('AllCustomerCtrl', function($scope, $http, $window){
    $scope.is_form   = false;
    $scope.form_data = [];
	var getAllCustomer = function(){
		$scope.results = [];
		var condition = {
			table: 'registration',
			column: 'mobile',
		};

		$http({
			method: 'POST',
			url: url + 'readGroupBy',
			data: condition
		}).success(function(response){
			angular.forEach(response, function(row, key){
				row.sl = (key + 1);
			});

			$scope.results = response;
			//console.log($scope.results = response);
		});
	}
    
    $scope.userDeactiveFn = function(index){
        $scope.form_data = $scope.results[index];
        $scope.is_form   = true;
    }
    
    $scope.formCloseFn = function(){
        $scope.is_form = false;
    }

	$scope.deleteCustomerFn = function(mobile){
	    $scope.message = "";
		var condition = {
			table: 'orders',
			cond: {mobile: mobile}
		};
		if ($window.confirm("Are you sure want to delete this Customer?")) {
            $http({
				method: 'POST',
				url: url + 'delete',
				data: condition
			}).success(function(response){
			   if(response == "danger"){
			       	var condition = {
            			table: 'registration',
            			cond: {mobile: mobile}
            		};
    			     $http({
            				method: 'POST',
            				url: url + 'delete',
            				data: condition
            			}).success(function(response){
            			    if(response  == "danger"){
            			        $scope.message = '<div class="alert alert-success"><h3><i class="fa fa-check-circle"></i> Success</h3><p>Customer Successfully Deleted..!</p></div>';
            			    }else{
            			        $scope.message = "Error";
            			    }
            			});
    			   }
				getAllCustomer();
			});
        }
	}

	// call the function
	getAllCustomer();
});



app.controller('SearchReportCtrl', function($scope, $http, $window){
	var loadData = function(){
		$scope.orders = [];
		var condition = {
			table: 'orders',
			cond: {},
			groupBy: 'order_no'
		};

		if(typeof $scope.search !== "undefined"){
			angular.forEach($scope.search, function(value, field){
				if(value !== ""){
					condition.cond[field] = value;
				}
			});

			if(typeof $scope.date !== "undefined"){
				angular.forEach($scope.date, function(value, field){
					if(value != "" && field == "from"){condition.cond["order_date >="] = value;}
					if(value != "" && field == "to"){condition.cond["order_date <="] = value;}
				});
			}
		} else {
			alert("Please Selete Status!");
			return false;
		}

		$http({
			method: 'POST',
			url: url + 'read',
			data: condition
		}).success(function(response){

			if(response.length>0){
				console.log(response);
				$scope.active=false;
				angular.forEach(response, function(item, key){
				  item.sl = key + 1;
			    });
			  $scope.orders = response;
			}else{
				$scope.orders = [];
				$scope.active=true;
			}

		});
	}

	$scope.searchDataFn = function(){
		// call the loader
		loadData();
	}

	$scope.getGrandTotalFn = function(){
		var total = 0;
		angular.forEach($scope.orders, function(item){
			total += parseFloat(item.grand_total);
		});

		return total.toFixed(2);
	}
});


//show All Stock Product Ctrl
app.controller('showAllStockProductCtrl', function($scope, $http, $log) {
	$scope.totalPurchase = 0;
    	$scope.allStockProducts = [];
    	$scope.reverse = false;
    	$scope.perPage="200";

	var where = {
	    from: 'stock',
	    join: 'products',
	    cond: 'stock.code=products.bar_code',
	    where:{"stock.quantity >":"0"}
	};

	$http({
		method:'POST',
		url:url+'readJoinData',
		data:where
	}).success(function(response){
		angular.forEach(response,function(value, key) {

		       //sold Quantity Start here
		       var condition = {
		        table : "sale",
		        cond  : {
		          category    : value.category,
		          subcategory : value.subcategory,
		          product     : value.product_name,
		          code        : value.code,
		          godown      : value.godown
		        }
		       };


		       $http({
		          method : "POST",
		          url    : url + "read",
		          data   : condition
		       }).success(function(items){
		        var sold_quantity = 0;
		        var sold_amount = 0.00;
		        if(items.length > 0){
		          angular.forEach(items,function(item){
		             sold_quantity += parseInt(item.quantity);
		             sold_amount   += parseFloat(item.grand_total);
		          });
		        }
		       //sold Quantity end here

		      var purchase_total = (parseInt(value.quantity) * parseFloat(value.purchase_price)).toFixed(2);
		      value['sl']             = key + 1;
		      value['subTotal']       = parseInt(value.quantity) * parseFloat(value.sell_price);
		      value['getPurchaseTotal'] 	= purchase_total;
		      value['quantity']       = parseInt(value.quantity);
		      value['sold_quantity']  = sold_quantity;
		      value['sold_amount']    = sold_amount.toFixed(2);
		      $scope.totalPurchase += parseInt(purchase_total);

		      $scope.allStockProducts.push(value);

		   });


		});

	  	//$log.log($scope.allStockProducts);
	  	console.log($scope.allStockProducts.length);

	  	//Pre Loader
	   	$("#loading").fadeOut("fast",function(){
	    		$("#data").fadeIn('slow');
	  	});
	});

	$scope.getTotalFn = function(index){
		return $scope.allStockProducts[index].total=$scope.allStockProducts[index].quantity * $scope.allStockProducts[index].sell_price;
	}

	$scope.getGrandTotalFn=function(){
		var total = 0;
		angular.forEach($scope.allStockProducts, function(item){
			total += item.subTotal;
		});

	  	return total;
	}

	$scope.getTotalQuantityFn = function() {
		var total = 0;
		angular.forEach($scope.allStockProducts, function(item){
			total += parseInt(item.quantity);
		});

	  	return total;
	}


	   $scope.getPurchasePriceFn = function() {
  		var total = 0;
  		angular.forEach($scope.allStockProducts, function(item){
   		var price = (item.purchase_price != '') ? item.purchase_price : 0;
   		// console.log(typeof parseFloat(item.purchase_price));

  		  total += parseFloat(price);
  		});

   		 return total;
	 }
	  $scope.getPurchaseTotalPriceFn = function() {
  		var total = 0;
  		angular.forEach($scope.allStockProducts, function(item){
   		var price = (item.getPurchaseTotal != '') ? item.getPurchaseTotal : 0;

  		  total += parseFloat(price);
  		});

   		 return total;
	 }



	$scope.getTotalSalePriceFn= function() {
		var total = 0;
		angular.forEach($scope.allStockProducts, function(item){
			total += parseFloat(item.sell_price);
		});

	  	return total;
	}


	$scope.totalSoldQuantityFn = function() {
		var total = 0;
		angular.forEach($scope.allStockProducts, function(item){
			total += parseInt(item.sold_quantity);
		});

	  	return total;
	}

	$scope.totalSoldAmountFn = function() {
		var total = 0;
		angular.forEach($scope.allStockProducts, function(item){
			total += parseFloat(item.sold_amount);
		});

	  	return total.toFixed(2);
	}




	// get product info
	$scope.getProductInfo = function(code = NULL){
		$scope.productInfo = [];
		var where = {
			table : "stock",
			cond  : {
				code  : code
			}
		};
		//console.log(where);

		$http({
		   method : "POST",
		   url    : url + "read",
		   data   : where
	   }).success(function(response){
		   if(response.length == 1){
			  var condition = {
		   			table : "products",
		   			cond  : {
		   				bar_code  : code
		   			}
		   	   	};
				$http({
					method : "POST",
					url    : url + "read",
					data   : condition
				}).success(function(info){
					if(info.length == 1){
						$scope.productInfo['unit'] = info[0].unit;
					}
				});
			   $scope.productInfo = response[0];
		   }else {
		   	$scope.productInfo = [];
		   }
		  // console.log($scope.productInfo);
	   });

	};



});




//old show All Stock Product Ctrl
/* app.controller('showAllStockProductCtrl', function($scope, $http, $log) {
     $scope.allStockProducts = [];
     $scope.reverse = false;

 var where = {
     from: 'stock',
     join: 'products',
     cond: 'stock.code=products.product_code'
 };

 $http({
  method:'POST',
  url:url+'readJoinData',
  data:where
 }).success(function(response){
  angular.forEach(response,function(value, key) {
   value['sl'] = key + 1;
   value['subTotal'] = parseInt(value.quantity) * parseFloat(value.sell_price);
   value['quantity'] = parseInt(value.quantity);

   $scope.allStockProducts.push(value);
  });

    $log.log(response);

    //Pre Loader
     $("#loading").fadeOut("fast",function(){
       $("#data").fadeIn('slow');
    });
 });

 $scope.getTotalFn = function(index){
  return $scope.allStockProducts[index].total=$scope.allStockProducts[index].quantity * $scope.allStockProducts[index].sell_price;
 }

 $scope.getGrandTotalFn=function(){
  var total = 0;
  angular.forEach($scope.allStockProducts, function(item){
   total += item.subTotal;
  });

    return total;
 }

 $scope.getTotalQuantityFn = function() {
  var total = 0;
  angular.forEach($scope.allStockProducts, function(item){
   total += parseInt(item.quantity);
  });

    return total;
 }


 $scope.getTotalPurchasePriceFn = function() {
  var total = 0;
  angular.forEach($scope.allStockProducts, function(item){
   var price = (item.purchase_price != '') ? item.purchase_price : 0;
   // console.log(typeof parseFloat(item.purchase_price));

    total += parseFloat(price);
  });

    return total;
 }



 $scope.getTotalSalePriceFn= function() {
  var total = 0;
  angular.forEach($scope.allStockProducts, function(item){
   total += parseFloat(item.sell_price);
  });

    return total;
 }



});*/




//show All Transaction Ctrl
app.controller('AllTransactionCtrl', function($scope){

	$scope.hello = function(){
		console.log("Hello World!");
	}

})


// custom directive
app.directive('confirmMsg', [function(){
	return {
		link: function (scope, element, attr) {
			var msg = attr.confirmMsg || "Are you sure?",
				callback = attr.callback;

			element.bind('click', function (event) {
				if ( window.confirm(msg) ) {
					scope.$eval(callback)
				} else {
					event.preventDefault();
				}
			});
		}
	};
}]);


// Supplier transaction controller
app.controller("supplierTransactionCtrl",function($http,$scope,$log){

	//get suplier information
	$scope.getsupplierInfo = function(){
		$scope.allSupplierInfo = [];

		var condition={
			from     :'vendor',
			join     :'purchase',
			group_by :'voucher_no',
			cond     :'vendor.id = purchase.vendor_id',
			where    : {
				'vendor.id' : $scope.supplier_name
			}
		};

		$http({
			method  : "POST",
			url     : url+"readJoinGroupByData",
			data    : condition
		}).success(function(response){
			if(response.length > 0){
				angular.forEach(response,function(row, index){
					if(parseFloat(row.due) > 0){
						$scope.allSupplierInfo.push(row);
					}
				});
				$scope.company_name = response[0].company;
			}else{
				$scope.allSupplierInfo = [];
				$scope.company_name = "";
			}
           //console.log($scope.allSupplierInfo);
		});

	};


	//get due info
	$scope.getDueInfo = function(){
		$scope.allDueInfo = [];
		var condition = {
			table    :'purchase',
			column   :'voucher_no',
			cond     : {
				'vendor_id'  : $scope.supplier_name,
				'voucher_no' : $scope.voucher_no
			}
		};

		// console.log(condition);

		$http({
			method  : "POST",
			url     : url + "readGroupBy",
			data    : condition
		}).success(function(response){
			var totalDue = 0;
			if(response.length == 1){
				totalDue = parseFloat(response[0].due);
			}

			if(totalDue >= 0){
			  $scope.balanceSign = "+";
			}else{
			  $scope.balanceSign = "-";
			}

			$scope.totalBalance = Math.abs(totalDue);
			//console.log($scope.totalBalance);
		});

	};


	//claculate total due
	$scope.claculateDue=function(){
		var total =0;
		total = parseFloat($scope.totalBalance) - parseFloat($scope.payment);
		if(total >= 0){
			$scope.netbalanceSign="+";
		}else{
		   $scope.netbalanceSign="-";
		}

		$scope.netBalance = Math.abs(total);
	};
});



// Show All Supplier Transaction
app.controller('showAllSupplierTransactionCtrl',function($scope,$http,$log){

	$scope.allTransactions=[];
	$scope.perPage="30";
	$scope.reverse=true;
	var where={
		from:'vendor',
		join:'supplier_transaction',
		cond:'supplier_transaction.supplier_name=vendor.id'
	};

	$http({
		method:"POST",
		url:url+"readJoinData",
		data:where
	}).success(function(response){
		if(response.length > 0){
			angular.forEach(response,function(value,key){
				value['sl']=key+1;
			    $scope.allTransactions.push(value);
			});
		}else{
			$scope.allTransactions=[];
		}
	 // $log.log($scope.allTransactions);

	  //Pre Loader
	   $("#loading").fadeOut("fast",function(){
	    $("#data").fadeIn('slow');
	  });

	});

	$scope.getGrandTotalFn=function(){
		var total = 0;
		angular.forEach($scope.allTransactions, function(item){
			total += parseFloat(item.payment);
			// console.log(total);
		});
	  return total;
	}



	$scope.getTotalNetBalanceFn = function(){
		var total = 0;
		angular.forEach($scope.allTransactions, function(item){
			total += parseFloat(item.net_balance);
			// console.log(total);
		});
	  return total;
	}


});










app.controller('PrintBarcodeCtrl', ['$scope', '$window', function($scope, $window){
	$scope.codes = [{code: 0, quantity: 0,sale_price : 0.00}];

	$scope.addCodeFn = function() {
		var codeObj = {code: 0, quantity: 0,sale_price : 0.00};
		$scope.codes.push(codeObj);
	}

	$scope.removeRowFn = function(i) {
		if($window.confirm("Are you sure want to delete this row?")){
			$scope.codes.splice(i, 1);
		}
	}
}]);


//net balance sign filter
app.filter("net_balance_sign",function(){
	return function(input){
		var sign;
		if(input>=0){
			sign="-";
		}else{
			sign="+";
		}
	  return sign;
	}
});

app.filter("netBalanceFilter",function() {
	return function(value){
	 return Math.abs(value);
	}
});

// Due Payment Controller
app.controller('DuePaymentCtrl', function($scope, $http){
 $scope.cart = [];
 $scope.amount = {
  paid: 0,
  diposit : 0.00,
  remission : 0.00,
  due: 0
 };
 $scope.info = {};

 $scope.$watch('vno', function(){
  var condition = {
   table: 'sale',
   cond: { voucher_number: $scope.vno }
  }

  $http({
   method: 'POST',
   url: url + 'read',
   data: condition
  }).success(function(response){



  console.log(response);
   angular.forEach(response, function(item){
    var row = {
     id: item.id,
     category: item.category,
     subcategory: item.subcategory,
     godown: item.godown,
     product: item.product,
     oldQuantity: parseInt(item.quantity),
     newQuantity: parseInt(item.quantity),
     price: parseFloat(item.price),
     subtotal: parseFloat(item.subtotal),
     grand_total: parseFloat(item.grand_total),
     discount: parseFloat(item.discount),
     date: item.date,
     voucher: item.voucher_number,
     paid: parseFloat(item.paid),
     remission : parseFloat(item.remission),
     due: parseFloat(item.due)
    };

    $scope.cart.push(row);

    $scope.amount.paid = row.paid;
    $scope.amount.discount = row.discount;
    $scope.amount.total_remission = row.remission;
    $scope.amount.grand_total = row.grand_total;
    $scope.amount.due = row.due;

    $scope.info.date = row.date;
    $scope.info.voucher = row.voucher;
    console.log($scope.cart);
   });
  });
 });

 $scope.setSubtotalFn = function(index){
  $scope.cart[index].subtotal = $scope.cart[index].price * $scope.cart[index].newQuantity;
  return $scope.cart[index].subtotal;
 }

 $scope.getTotalFn = function(){
  var total = 0;
  angular.forEach($scope.cart, function(item){
   total += item.subtotal;
  });

  $scope.amount.total = total;
  return $scope.amount.total;
 }


 $scope.getTotalDueFn = function(d, r,tr){
  var paid = $scope.amount.paid + parseFloat(d) + parseFloat(r) + parseFloat(tr);
  $scope.amount.due = $scope.amount.grand_total - paid;
  return $scope.amount.due;
 }

});


// Sale Return
app.controller('saleReturnCtrl',function($scope,$http,$log){
	$scope.product_code = "";
	$scope.product_name = "";
	$scope.product_cat = "";
	$scope.subcategory = "";
	$scope.sale_price = 0;
	$scope.return_qty = 0;

	$scope.getInfo=function(){
		var where = {
		   "table"  : "products",
		   cond : {bar_code : $scope.product_code}
		};

		$http({
			method:"POST",
			url:url+"read",
			data:where
		}).success(function(response){
			if(response.length > 0){
				console.log(response[0]);
				$scope.product_code = response[0].bar_code;
				$scope.product_name = response[0].product_name;
				$scope.product_cat = response[0].product_cat;
				$scope.subcategory = response[0].subcategory;
				$scope.sale_price = parseFloat(response[0].sale_price);
			}else{
				$scope.allTransactions=[];
			}
		});

	}



	$scope.getTotalNetBalanceFn = function(){
		var total = 0;
		angular.forEach($scope.allTransactions, function(item){
			total += parseFloat(item.net_balance);
			// console.log(total);
		});
	  return total;
	}


});


app.controller('AllOrderCtrl', function($scope, $http, $window){
	$scope.orders = [];

    $scope.privil = $window.privil;
    $scope.supplier_id = $window.supplier_id;
    
    //console.log($scope.privil);
  
	var loadData = function(){
		var condition = {
			table: 'orders',
			cond: {status: 'pending'},
			column: 'order_no'
		};
		
		/*if($scope.privil != 'undefined' && $scope.privil != 'super'){
		    condition.cond.supplier_id = $scope.supplier_id;
		}*/
		
		//console.log(condition);

		$http({
			method: 'POST',
			url: url + 'readGroupBy',
			data: condition
		}).success(function(response){
		    //loop through all data start here
			angular.forEach(response, function(item, key){
				item.sl = key + 1;
				$scope.grand_totalFn(item.grand_total);
				
				//Getting the products info --->
        		var con = {
        			table: 'products',
        			cond: {product_code: item.code}
        		};
        		//console.log(con);
        
        		$http({
        			method: 'POST',
        			url: url + 'read',
        			data: con
        		}).success(function(response){
        			//console.log(response);
        			if(response.length > 0){
                        //item.supplierID       = response[0].user_id;
                        //item.supplierUsername = response[0].user_name;
        			    //console.log(item.supplierID);
        			}
        			
        			//Getting supplier info --->
        			/*var where = {
            			table: 'users',
            			cond: {id: item.supplierID}
            		};
            		//console.log(where);
            
            		$http({
            			method: 'POST',
            			url: url + 'read',
            			data: where
            		}).success(function(supplierInfo){
            			//console.log(response);
            			if(supplierInfo.length > 0 && supplierInfo[0].sr.length > 0 ){
            			    item.srCommission = parseFloat(item.grand_total)*.1;
            			}else{
            			    item.srCommission = 0.00;
            			}
            		});*/
            		
            		
        		});
        		
        		//Getting the products info end here
        		
			});
			// loop end here

			$scope.orders = response;
			//console.log($scope.orders);
		});
	}
	

	$scope.grand_totalFn = function(){
		var total = 0;
		angular.forEach($scope.orders, function(item){
			total += parseFloat(item.grand_total);
		});

	  	return total;
	}


	$scope.total_discountFn = function(){
		var total = 0;
		angular.forEach($scope.orders, function(item){
			total += parseFloat(item.discount);
		});

		return total;
	}
	
	
	$scope.setSupplierFn = function(orderNo,user_id){
	    var condition = {
			table: 'orders',
			cond: {order_no: orderNo},
			data: {supplier_id: user_id}
		};

		$http({
			method: 'POST',
			url: url + 'save',
			data: condition
		}).success(function(response){
			loadData();
			//console.log(response);
		});
	}


	$scope.updateStatusFn = function(orderNo, status){
	    console.log(status);
		var condition = {
			cond: {order_no: orderNo},
			data: {status: status}
		};

		$http({
			method: 'POST',
			url: url + 'status_change',
			data: condition
		}).success(function(response){
			loadData();
			//console.log(response);
		});
	}

	$scope.deleteOrderFn = function(ono){
		var condition = {
			table: 'orders',
			cond: {order_no: ono}
		};

		if ($window.confirm("Are you sure want to delete this Order?")) {
			$http({
				method: 'POST',
				url: url + 'delete',
				data: condition
			}).success(function(response){
				loadData();
				console.log(response);
			});
		}
	}

	// call the loader
	loadData();
});


app.controller('SrOrderCtrl', function($scope, $http, $window){
	$scope.orders = [];


	var loadData = function(){
		var condition = {
			table: 'orders',
			cond: {
				'sr_name !=' : '',
				'sr_code !=' : ''
				},
			column: 'order_no'
		};

		$http({
			method: 'POST',
			url: url + 'readGroupBy',
			data: condition
		}).success(function(response){
			angular.forEach(response, function(item, key){
				item.sl = key + 1;
				$scope.grand_totalFn(item.grand_total);
			});

			$scope.orders = response;
			console.log(response);
		});

	}

	$scope.grand_totalFn = function(){
		var total = 0;
		angular.forEach($scope.orders, function(item){
			total += parseFloat(item.grand_total);
		});

	  	return total;
	}


	$scope.total_discountFn = function(){
		var total = 0;
		angular.forEach($scope.orders, function(item){
			total += parseFloat(item.discount);
		});

		return total;
	}


	$scope.updateStatusFn = function(orderNo, status){
		var condition = {
			table: 'orders',
			cond: {order_no: orderNo},
			data: {status: status}
		};

		$http({
			method: 'POST',
			url: url + 'save',
			data: condition
		}).success(function(response){
			loadData();
			console.log(response);
		});
	}

	$scope.deleteOrderFn = function(ono){
		var condition = {
			table: 'orders',
			cond: {order_no: ono}
		};

		if ($window.confirm("Are you sure want to delete this Order?")) {
			$http({
				method: 'POST',
				url: url + 'delete',
				data: condition
			}).success(function(response){
				loadData();
				console.log(response);
			});
		}
	}

	// call the loader
	loadData();
});



app.controller('SearchOrderCtrl', function($scope, $http, $window){
    //$scope.search_status = '';
	var loadData = function(){
		$scope.orders = [];
		var condition = {
			from     : 'products',
			join     : 'orders',
			group_by : 'order_no',
			cond     : 'orders.code = products.product_code',
			where    : {}
		};
		//console.log(condition);

		if(typeof $scope.search !== "undefined"){
		    
			angular.forEach($scope.search, function(value, field){
				if(value !== ""){
					if(field == "status"){
    					condition.where['orders.status'] = value;
    					//$scope.search_status = value;
    				}else{
					    condition.where[field] = value;
    				}
				}
			});

			/*if(typeof $scope.date !== "undefined"){
				angular.forEach($scope.date, function(value, field){
					if(value != "" && field == "from"){condition.where["order_date >="] = value;}
					if(value != "" && field == "to"){condition.where["order_date <="] = value;}
				});
			}*/
			
			let date_from = document.getElementById('date_from').value;
			let date_to = document.getElementById('date_to').value;
			
			if(date_from != "") condition.where["order_date >="] = date_from;
			if(date_to != "")   condition.where["order_date <="] = date_to;
			
		}else if(typeof $scope.search == "undefined"){
		    
			let date_from = document.getElementById('date_from').value;
			let date_to = document.getElementById('date_to').value;
			
			if(date_from != "") condition.where["order_date >="] = date_from;
			if(date_to != "")   condition.where["order_date <="] = date_to;
			
			if(date_from=='' || date_to==''){
			    
    			//Today Date Set 
    			var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0');
                var yyyy = today.getFullYear();
                
                today = yyyy + '-' + mm + '-' + dd;
                condition.where["order_date"] = today;
			    
			}
			
		} else {
			//alert("Please Selete Status!");
			//return false;
			return true;
		}
		
		//console.log(condition);

		$http({
			method : 'POST',
			url    : url + 'readJoinGroupByData',
			data   : condition
		}).success(function(response){
		    
		    //console.log(response);
		    
			if(response.length>0){
                $scope.active=false;
                    angular.forEach(response, function(item, key){
                    item.sl = key + 1;
                });
			    $scope.orders = response;
			}else{
				 $scope.active=true;
				 $scope.orders=[];
			}
            //console.log(response);
		});
		
		
		/*$http({
			method: 'POST',
			url: url + 'readGroupBy',
			data: condition
		}).success(function(response){
			if(response.length>0){
			 $scope.active=false;
			 angular.forEach(response, function(item, key){
				item.sl = key + 1;
			  });
			$scope.orders = response;
			}else{
				 $scope.active=true;
				 $scope.orders=[];
			}

		});*/
	}

	$scope.grand_totalFn = function(){
		var total = 0;
		angular.forEach($scope.orders, function(item){
			total += parseFloat(item.grand_total);
		});

	  	return total;
	}

	$scope.total_discountFn = function(){
		var total = 0;
		angular.forEach($scope.orders, function(item){
			total += parseFloat(item.discount);
		});

		return total;
	}


	$scope.searchDataFn = function(){
		// call the loader
		loadData();
	}
	
	loadData();

	$scope.updateStatusFn = function(orderNo, status){
		var condition = {
			cond: {order_no: orderNo},
			data: {status: status}
		};

		//console.log(condition);
		$http({
			method: 'POST',
			url: url + 'status_change',
			data: condition
		}).success(function(response){
			loadData();
		});
	}


	$scope.deleteOrderFn = function(ono){
	    
	    swal({
            title: "Are you sure?",
            text:  "",
            icon:  "warning",
            buttons: {
                cancel: "Cancel",
                defeat: 'Ok',
            },
        })
        .then((value) => {
            if(value=='defeat'){
                var condition = {
        			table: 'orders',
        			cond: {order_no: ono}
        		};
    
        		$http({
    				method: 'POST',
    				url: url + 'delete',
    				data: condition
    			}).success(function(response){
    				loadData();
    				console.log(response);
    			});
            }
        });
	    
	}
});

//cost controller start here
app.controller("costCtrl",['$scope','$http',function($scope,$http){
    $scope.perPage = "10";
    $scope.reverse = false;
    $scope.fields = [];

	var obj = {
		table : "cost_field"
	};

	$http({
		method : "POST",
		url : url + "read",
		data : obj
	}).success(function(response){
		if(response.length>0){
			angular.forEach(response,function(values,index){
				values['sl'] = index + 1;
				$scope.fields.push(values);
			});
		}else{
			$scope.fields = [];
		}
	});
}]);


//cost controller start here
app.controller("incomeCtrl",['$scope','$http',function($scope,$http){
    $scope.perPage = "10";
    $scope.reverse = false;
    $scope.fields = [];

	var obj = {
		table : "income_field"
	};

	$http({
		method : "POST",
		url : url + "read",
		data : obj
	}).success(function(response){
		if(response.length>0){
			angular.forEach(response,function(values,index){
				values['sl'] = index + 1;
				$scope.fields.push(values);
			});
		}else{
			$scope.fields = [];
		}
	});
	console.log($scope.fields);
}]);




// free Product Ctrl
app.controller("freeProductCtrl",function($scope,$http,$window){
	$scope.cart = [];
	$scope.product_name = "";
	$scope.free_product_name = "";

	$scope.addNewProductFn = function(){
	 if(typeof $scope.product != "undefined" && typeof $scope.free_product != "undefined" && typeof $scope.quantity != "undefined" && typeof $scope.free_quantity != "undefined" && typeof $scope.relation != "undefined"){
		var where = {
			table : "products",
			cond  : {
				bar_code  : $scope.product
			}
		};

		$http({
			method  : "POST",
			url     : url + "read",
			data    : where
		}).success(function(response){
			if(response.length == 1){
				$scope.product_name = response[0].product_name;
			}

			var where = {
				table : "products",
				cond  : {
				bar_code  : $scope.free_product
				}
			};

			$http({
				method  : "POST",
				url     : url + "read",
				data    : where
			}).success(function(response){
				if(response.length == 1){
					$scope.free_product_name = response[0].product_name;

					var item = {
						product_code  		: $scope.product,
						product_name  		: $scope.product_name,
						quantity      		: $scope.quantity,
						relation      		: $scope.relation,
						free_product_code  	: $scope.free_product,
						free_product_name  	: $scope.free_product_name,
						free_quantity 		: $scope.free_quantity
					};

					$scope.cart.push(item);
					$scope.active = true;
				}
			});
		});

		console.log($scope.cart);
	};
  }

  //delete row
  $scope.deleteRow = function(i){
	  if($scope.cart.length == 1){
		  if($window.confirm("Are you sure want to delete this row?")){
			  $scope.cart.splice(i,1);
		  }
	  }else{
		   $scope.cart.splice(i,1);
	  }
  };

});





// add product Controller
app.controller("addProductCtrl", ["$scope", "$http", function($scope, $http) {

    
    $scope.getuserNameFn= function(){
        $scope.userName = '';
        var where = {
			table : "users",
			cond  : {
				id : $scope.user_id
			}
		};

		$http({
			method  : "POST",
			url     : url + "read",
			data    : where
		}).success(function(response){
		  if(response.length > 0){
				$scope.userName = response[0].name;
			}else{
				$scope.userName = '';
			}
		});
   };
    
    
    $scope.getSubCategoryFn= function(){
     $scope.allSubCategory = [];
     var where = {
			table : "subcategory",
			cond  : {
				category : $scope.category
			}
		};

		$http({
			method  : "POST",
			url     : url + "read",
			data    : where
		}).success(function(response){
		  if(response.length > 0){
				$scope.allSubCategory = response;
			}else{
				$scope.allSubCategory = [];
			}

			// console.log($scope.allSubCategory);
		});
   };



   $scope.checkExists = function(){
   $scope.message = "";
   $scope.check  = "";

     var where = {
			table : "products",
			cond  : {
				bar_code : $scope.bar_code
			}
		};

		$http({
			method  : "POST",
			url     : url + "read",
			data    : where
		}).success(function(response){
		  if(response.length == 1){
		                $scope.bar_code = "";
				$scope.message = "This code already exists.Please try another."
			}else{
				$scope.message = "";
			}

		});

   };



	// console.log(1);
	var counter = 0;

	$scope.imgLimit = 4;
	$scope.gallery = [];

	$scope.addFieldsFn = function() {
		var details = {	name: "field-" + counter };

		if($scope.gallery.length < $scope.imgLimit) {
			$scope.gallery.push(details);
		}

		counter++;
	}

}]);


// edit product Controller
app.controller("editProductCtrl", ["$scope", "$http", function($scope, $http) {

  $scope.category = "";
  $scope.subcategoryt = "";
  $scope.allSubCategory = []; 
  
  $scope.getuserNameFn= function(){
        $scope.userName = '';
        var where = {
			table : "users",
			cond  : {
				id : $scope.user_id
			}
		};

		$http({
			method  : "POST",
			url     : url + "read",
			data    : where
		}).success(function(response){
		  if(response.length > 0){
				$scope.userName = response[0].name;
			}else{
				$scope.userName = '';
			}
		});
   };

  $scope.$watch("product_id",function(product_id){

     var where = {
			table : "products",
			cond  : {
				id: product_id
			}
		};

		$http({
			method  : "POST",
			url     : url + "read",
			data    : where
		}).success(function(response){
		  if(response.length > 0){

		  		var where = {
					table : "subcategory",
					cond  : {
						category: response[0].product_cat
					}
				};

				$http({
					method  : "POST",
					url     : url + "read",
					data    : where
				}).success(function(info){
				  if(info.length > 0){
				      $scope.allSubCategory = info;
				  }else{
				     $scope.allSubCategory = [];
				  }
				});

				$scope.category = (response[0].product_cat);
				$scope.subcategoryt = (response[0].subcategory);
				// console.log($scope.subcategoryt);
				
			}else{
				$scope.category = "";
				$scope.subcategory = "";
			}

		});
		
		 $scope.getSubCategoryFn= function(){

         $scope.allSubCategory = [];
         var where = {
    			table : "subcategory",
    			cond  : {
    				category : $scope.category
    			}
    		};
    
    		$http({
    			method  : "POST",
    			url     : url + "read",
    			data    : where
    		}).success(function(response){
    		  if(response.length > 0){
    				$scope.allSubCategory = response;
    			}else{
    				$scope.allSubCategory = [];
    			}
    
    		});
       };
  });


  



}]);



// delivery_charge_ctrl
app.controller("delivery_charge_ctrl",function($scope,$http){
	$scope.area = "";
	$scope.amount = 0.00;
	$scope.button_name = "Save";
	$scope.button_class = "btn-primary";

	$scope.get_delivery_charge = function(){
		var where = {
			table : "delivery_charge",
			cond  : {
				area  : $scope.area
			}
		};

		$http({
			method  : "POST",
			url     : url + "read",
			data    : where
		}).success(function(response){
			if(response.length == 1){
				$scope.amount = parseFloat(response[0].amount);
				$scope.button_name = "Update";
				$scope.button_class = "btn-success";
			}else{
				$scope.amount = 0.00;
				$scope.button_name = "Save";
				$scope.button_class = "btn-primary";
			}
		});
	};

});




app.controller("dueCollectionCtrl",["$scope","$http",function($scope,$http){
    $scope.total = 0.00;
    $scope.current_paid = 0.00;
    $scope.dueCalcFn = function(){
        total = parseFloat($scope.grand_total) - parseFloat($scope.previous_paid) - parseFloat($scope.current_paid);
        return parseFloat(total);
    }
    
}]);



// company transaction controller start here
app.controller('SupplierTransactionCtrl', ['$scope', '$http', function($scope, $http) {
	$scope.balance = 0.00;
	$scope.sign = "Receivable";

	$scope.payment = 0.00;
	$scope.csign = "Receivable";

	// get supplier Banlance information
	$scope.getCompanyInfo = function(){
		var total_debit = total_credit = total_balance = 0.00;

		var condition = {
		   	table : "parties",
			cond :{
				code : $scope.code
			}
	   	};

	   	$http({
	   		method : 'POST',
	   		url    : url + 'read',
	   		data   : condition
	   	}).success(function(response){
	   		if (response.length > 0) {
	   			$scope.initial_balance = response[0].initial_balance;
	   			total_balance = parseFloat(response[0].initial_balance);

	   			$scope.displayBalance = total_balance;
				$scope.balance = Math.abs(total_balance);

				if(total_balance < 0) {
					$scope.sign = 'Payable';
				} else {
					$scope.sign = 'Receivable';
				}
	   		}

	   	});


	   	// fetch partytransaction records
	   	
	   	var transaction = {
	   		table: 'partytransaction',
	   		cond : {
	   			party_code : $scope.code,
	   			trash      : '0'
	   		}
	   	};

	   	$http({
	   		method : 'POST',
	   		url    : url + 'read',
	   		data   : transaction
	   	}).success(function(records){
	   		if (records.length > 0) {
	   			//console.log(records);
	   			angular.forEach(records,function(item,index){
	   				total_credit += parseFloat(item.credit);
	   				total_debit	+= parseFloat(item.debit);
	   			});

	   			total_balance  = total_debit - total_credit + parseFloat($scope.initial_balance);

	   			$scope.displayBalance = total_balance;
				$scope.balance = Math.abs(total_balance);
				if(total_balance < 0) {
					$scope.sign = 'Payable';
				} else {
					$scope.sign = 'Receivable';
				}
	   		}
	   	});
	};

	$scope.getTotalFn = function() {
		var total = 0.00;

		if($scope.sign == 'Receivable') {
			total = $scope.balance + $scope.payment;
			$scope.csign = "Receivable";
		} else {
			total = $scope.balance - $scope.payment;

			if(total > 0) {
				$scope.csign = "Payable";
			} else {
				$scope.csign = "Receivable";
			}
		}

		return Math.abs(total);
	}
}]);




// add purchase entry
app.controller('PurchaseEntry', function($scope, $http){
	$scope.active = true;
	$scope.cart = [];
	$scope.amount = {
		total: 0,
		totalDiscount: 0,
		transport_cost: 0,
		grandTotal: 0,
		paid: 0,
		due: 0
	};
	$scope.validation = false;

	$scope.exists = function() {
		var where = {
			table: "saprecords",
			cond: {
				voucher_no: $scope.voucherNo,
				trash     : '0'
			}
		};

		$http({
			method: "POST",
			url: url + "read",
			data: where
		}).success(function(response) {
			if(response.length > 0) {
				$scope.validation = true;
			} else {
				$scope.validation = false;
			}
		});
	}

	$scope.partyInfo = {
		balance: 0.00,
		payment: 0.00,
		sign: 'Receivable',
		csign: 'Receivable'
	};

	$scope.setPartyfn = function() {
		var total_debit = total_credit = total_balance = 0.00;
		/*
		var condition = {
		   	table : "parties",
			cond :{
				code : $scope.partyCode
			}
	   	};

	   	$http({
	   		method : 'POST',
	   		url    : url + 'read',
	   		data   : condition
	   	}).success(function(response){
	   		if (response.length > 0) {
	   			$scope.initial_balance = response[0].initial_balance;
	   			total_balance = parseFloat(response[0].initial_balance);

				$scope.partyInfo.balance = Math.abs(total_balance);
				if(total_balance < 0) {
					$scope.partyInfo.sign = 'Payable';
				} else {
					$scope.partyInfo.sign = 'Receivable';
				}
	   		}

	   	});

	   	// fetch partytransaction records
	   	var transaction = {
	   		table: 'partytransaction',
	   		cond : {
	   			party_code : $scope.partyCode,
	   			trash      : '0'
	   		}
	   	};

	   	$http({
	   		method : 'POST',
	   		url    : url + 'read',
	   		data   : transaction
	   	}).success(function(records){
	   		if (records.length > 0) {
	   			angular.forEach(records,function(item,index){
	   				total_credit += parseFloat(item.credit);
	   				total_debit	+= parseFloat(item.debit);
	   			});

	   			total_balance  = total_debit - total_credit + parseFloat($scope.initial_balance);

				$scope.partyInfo.balance = Math.abs(total_balance);
				if(total_balance < 0) {
					$scope.partyInfo.sign = 'Payable';
				} else {
					$scope.partyInfo.sign = 'Receivable';
				}
	   		}
	   	});
	   	*/
	   	
	   	
	   	var condition = {
    		from : "parties",
    		join : "partytransaction",
    		cond : "parties.code = partytransaction.party_code",
    		where : {
    			'parties.code'  : $scope.partyCode,
    			'partytransaction.trash' : "0"
    		}
	    };
	    
	    $http({
	        method: 'POST',
	        url   : url + 'readJoinData',
	        data  : condition
	    }).success(function(records){
	        //console.log(records);
	        if(records.length > 0 ){
	            angular.forEach(records,function(item,index){
	   				total_credit += parseFloat(item.credit);
	   				total_debit	+= parseFloat(item.debit);
	   			});

	   			total_balance  = total_debit - total_credit + parseFloat(records[0].initial_balance);

				$scope.partyInfo.balance = Math.abs(total_balance);
				if(total_balance < 0) {
					$scope.partyInfo.sign = 'Payable';
				} else {
					$scope.partyInfo.sign = 'Receivable';
				}
	        }else{
	            var condition = {
        		   	table : "parties",
        			cond :{
        				code : $scope.partyCode
        			}
        	   	};
        
        	   	$http({
        	   		method : 'POST',
        	   		url    : url + 'read',
        	   		data   : condition
        	   	}).success(function(response){
        	   		if (response.length > 0) {
        	   			$scope.initial_balance = response[0].initial_balance;
        	   			total_balance = parseFloat(response[0].initial_balance);
        
        				$scope.partyInfo.balance = Math.abs(total_balance);
        				if(total_balance < 0) {
        					$scope.partyInfo.sign = 'Payable';
        				} else {
        					$scope.partyInfo.sign = 'Receivable';
        				}
        	   		}
        	   	});
	        }
	    });
	    
	    
	}


	$scope.getCurrentTotalFn = function() {
		var total = 0.00;

		if($scope.partyInfo.sign == 'Receivable'){
			total = ($scope.partyInfo.balance + $scope.amount.paid) - parseFloat($scope.amount.grandTotal);

			if(total >= 0) {
				$scope.partyInfo.csign = "Receivable";
			} else {
				$scope.partyInfo.csign = "Payable";
			}
		} else {
			total = ($scope.partyInfo.balance + parseFloat($scope.amount.grandTotal)) - $scope.amount.paid;

			if(total > 0) {
				$scope.partyInfo.csign = "Payable";
			} else {
				$scope.partyInfo.csign = "Receivable";
			}
		}

		return Math.abs(total.toFixed(2));
	}

	$scope.addNewProductFn = function(){
		if(typeof $scope.product !== 'undefined'){
			$scope.active = false;

			var condition = {
				table: 'products',
				cond: {
					product_code   : $scope.product,
					status         : 1
				}
			};

			$http({
				method: 'POST',
				url: url + 'read',
				data: condition
			}).success(function(response){
				if(response.length == 1){
					var item = {
						product        : response[0].product_name,
						product_code   : response[0].product_code,
						product_cat    : response[0].product_cat,
						product_subcat : response[0].subcategory,
						unit 		   : response[0].unit,
						price          : parseFloat(response[0].purchase_price),
						sale_price     : parseFloat(response[0].sale_price),
						quantity       : (typeof $scope.quantity === 'undefined') ? 0 : $scope.quantity,
						discount       : 0.00,
						subtotal       : 0.00,
					};
					$scope.cart.push(item);
				}else{
					$scope.cart = [];
				}
			});
		}
	}


	$scope.setSubtotalFn = function(index){
		$scope.cart[index].subtotal = $scope.cart[index].price * $scope.cart[index].quantity;
		return $scope.cart[index].subtotal.toFixed(2);
	}

	$scope.getTotalFn = function(){
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.subtotal);
		});

		$scope.amount.total = total.toFixed(2);
		return $scope.amount.total;
	}

	/*
	$scope.getTotalDiscountFn = function() {
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.discount);
		});

		$scope.amount.totalDiscount = total.toFixed(2);
		return $scope.amount.totalDiscount;
	}*/

	$scope.getGrandTotalFn = function(){
		$scope.amount.grandTotal = parseFloat($scope.amount.total - $scope.amount.totalDiscount + $scope.amount.transport_cost) ;
		return $scope.amount.grandTotal.toFixed(2);
	}

	$scope.getTotalDueFn = function() {
		$scope.amount.due = $scope.amount.grandTotal - $scope.amount.paid;
		return $scope.amount.due.toFixed(2);
	}

	$scope.deleteItemFn = function(index){
		$scope.cart.splice(index, 1);
	}

});


// add purchase entry
app.controller('returnPurchaseProduct', function($scope, $http){
	$scope.active = true;
	$scope.cart = [];
	$scope.amount = {
		total: 0,
		totalDiscount: 0,
		transport_cost: 0,
		grandTotal: 0,
		paid: 0,
		due: 0
	};
	$scope.validation = false;

	$scope.exists = function() {
		var where = {
			table: "saprecords",
			cond: {
				voucher_no: $scope.voucherNo,
				trash     : '0'
			}
		};

		$http({
			method: "POST",
			url: url + "read",
			data: where
		}).success(function(response) {
			if(response.length > 0) {
				$scope.validation = true;
			} else {
				$scope.validation = false;
			}
		});
	}

	$scope.partyInfo = {
		balance: 0.00,
		payment: 0.00,
		sign: 'Receivable',
		csign: 'Receivable'
	};

	$scope.setPartyfn = function() {
		var total_debit = total_credit = total_balance = 0.00;
		var condition = {
		   	table : "parties",
			cond :{
				code : $scope.partyCode
			}
	   	};

	   	$http({
	   		method : 'POST',
	   		url    : url + 'read',
	   		data   : condition
	   	}).success(function(response){
	   		if (response.length > 0) {
	   			$scope.initial_balance = response[0].initial_balance;
	   			total_balance = parseFloat(response[0].initial_balance);

				$scope.partyInfo.balance = Math.abs(total_balance);
				if(total_balance < 0) {
					$scope.partyInfo.sign = 'Payable';
				} else {
					$scope.partyInfo.sign = 'Receivable';
				}
	   		}

	   	});

	   	// fetch partytransaction records
	   	var transaction = {
	   		table: 'partytransaction',
	   		cond : {
	   			party_code : $scope.partyCode,
	   			trash      : '0'
	   		}
	   	};

	   	$http({
	   		method : 'POST',
	   		url    : url + 'read',
	   		data   : transaction
	   	}).success(function(records){
	   		if (records.length > 0) {
	   			angular.forEach(records,function(item,index){
	   				total_credit += parseFloat(item.credit);
	   				total_debit	+= parseFloat(item.debit);
	   			});

	   			total_balance  = total_debit - total_credit + parseFloat($scope.initial_balance);

				$scope.partyInfo.balance = Math.abs(total_balance);
				if(total_balance < 0) {
					$scope.partyInfo.sign = 'Payable';
				} else {
					$scope.partyInfo.sign = 'Receivable';
				}
	   		}
	   	});
	}


	$scope.getCurrentTotalFn = function() {
		var total = 0.00;

		if($scope.partyInfo.sign == 'Receivable'){
			total = ($scope.partyInfo.balance + $scope.amount.paid) + parseFloat($scope.amount.grandTotal);

			if(total >= 0) {
				$scope.partyInfo.csign = "Receivable";
			} else {
				$scope.partyInfo.csign = "Payable";
			}
		} else {
			total = ($scope.partyInfo.balance - parseFloat($scope.amount.grandTotal));

			if(total > 0) {
				$scope.partyInfo.csign = "Payable";
			} else {
				$scope.partyInfo.csign = "Receivable";
			}
		}

		return Math.abs(total.toFixed(2));
	}

	$scope.addNewProductFn = function(){
		if(typeof $scope.product !== 'undefined'){
			$scope.active = false;

			var condition = {
				table: 'stock',
				cond: {code   : $scope.product}
			};

			$http({
				method: 'POST',
				url: url + 'read',
				data: condition
			}).success(function(response){
				if(response.length == 1){
					var item = {
						product        : response[0].name,
						product_code   : response[0].code,
						unit 		   : response[0].unit,
						price          : parseFloat(response[0].purchase_price),
						quantity       : (typeof $scope.quantity === 'undefined') ? 0 : $scope.quantity,
						discount       : 0.00,
						subtotal       : 0.00,
					};
					$scope.cart.push(item);
				}else{
					$scope.cart = [];
				}
			});
		}
	}


	$scope.setSubtotalFn = function(index){
		$scope.cart[index].subtotal = $scope.cart[index].price * $scope.cart[index].quantity;
		return $scope.cart[index].subtotal.toFixed(2);
	}

	$scope.getTotalFn = function(){
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.subtotal);
		});

		$scope.amount.total = total.toFixed(2);
		return $scope.amount.total;
	}

	/*
	$scope.getTotalDiscountFn = function() {
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.discount);
		});

		$scope.amount.totalDiscount = total.toFixed(2);
		return $scope.amount.totalDiscount;
	}*/

	$scope.getGrandTotalFn = function(){
		$scope.amount.grandTotal = parseFloat($scope.amount.total - $scope.amount.totalDiscount + $scope.amount.transport_cost) ;
		return $scope.amount.grandTotal.toFixed(2);
	}

	$scope.getTotalDueFn = function() {
		$scope.amount.due = $scope.amount.grandTotal - $scope.amount.paid;
		return $scope.amount.due.toFixed(2);
	}

	$scope.deleteItemFn = function(index){
		$scope.cart.splice(index, 1);
	}

});




