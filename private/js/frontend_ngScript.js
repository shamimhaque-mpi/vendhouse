var app = angular.module("MainApp", ['angularUtils.directives.dirPagination',,'ngSanitize']);

//var url     = window.location.origin + '/ecom/frontend/ajax/';
//var siteurl = window.location.origin + '/ecom/';

var url = window.location.origin + '/frontend/ajax/';
var siteurl = window.location.origin + '/';


app.filter('ucfirst', function() {
	return function(input) {
  		var firstChar = input.charAt(0).toUpperCase();
  		var fullStr = firstChar + input.substr(1);

		return fullStr;
	}
});

// remove undescore custom filter in Angular js
app.filter('removeUnderScore', function(){
	return function(input){
		return input.replace(/_/gi," ");
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


//SMS Controller
app.controller("CustomSMSCtrl", ["$scope", "$log", function($scope, $log){
	$scope.msgContant = "";
	$scope.totalChar = 0;
	$scope.msgSize = 1;

	$scope.$watch(function(){
		var charLength = $scope.msgContant.length,
			messLen = 0;

		if( charLength <= 160){ messLen = 1; }
		else if( charLength <= 306){ messLen = 2; }
		else if( charLength <= 459){ messLen = 3; }
		else if( charLength <= 612){ messLen = 4; }
		else if( charLength <= 765){ messLen = 5; }
		else if( charLength <= 918){ messLen = 6; }
		else if( charLength <= 1071){ messLen = 7; }
		else if( charLength <= 1080){ messLen = 8; }
		else { messLen = "Equal to an MMS."; }

		$scope.totalChar = charLength;
		$scope.msgSize = messLen;
	});
}]);


// frontend Order Show Off Ctrl

app.controller("orderShowCtrl", function($scope, $http, $log, $window){
	$scope.cart = [];
	$scope.allSearchProductsInfo = [];
	$scope.itemInCart = 0;
	$scope.productInCart = 0;
	$scope.delivery_charge = 0.00;
	$scope.discount = 0.00;
	$scope.allProductsInfo = [];

	$scope.isDisabled = true;
	$scope.warning_message = "";

	$scope.global_category = false;
	$scope.POS_Card_Status = true;
	$scope.active = true;

	$scope.areas = [];
	$scope.area  = '';
	$scope.service_charge = 0;
	$scope.category = '';
	$scope.search_item='';
	$scope.method_name = '';
	$scope.is_search_bar = true;
	$scope.district_id   = '';
	$scope.upazila_id    = '';
	$scope.checkoutbtn   = true;
	
	$scope.checkQtyFn = function(qty){
	    if(qty > 0){
	        $scope.checkoutbtn = true;
	    }
	    else{
	        $scope.checkoutbtn = false;
	    }
	}
	
	//get customer by mobile number Start here
		$scope.getCustomer = function(){
		 $scope.customerInfo = [];
			var where = {
				table : "registration",
				cond  : { mobile: $scope.mobile }
			};

			$http({
				method  : "POST",
				url     : url + "read",
				data    : where
			}).success(function(response){
				if(response.length == 1){
					$scope.customerInfo = response[0];
					$scope.district_id  = response[0].district_id;
					$scope.upazila_id   = response[0].upazila_id;
					
					$scope.isDisabled = false;
					if($scope.customerInfo.status == 'inactive') {
					    $scope.customerInfo = [];
					    $scope.isDisabled = true;
					}
				}else{
					$scope.customerInfo = [];
				}
			});
		};
	//get customer by mobile number End here
	    $scope.$watch('category', function(){
	        $scope.getProductInfoFn();
	    });
	
	    window.addEventListener('click', function(event){
	        let Search_item = document.querySelector('.Search_item');
	        if(!event.target.closest('.search_relative')){
	            if(Search_item)
	            Search_item.style.display = "none";
	        }else{
	            if(Search_item)
	            Search_item.style.display = "";
	        }
	    });
	    
	//get all product info fn start for data list
		$scope.getProductInfoFn = function(){
		    $scope.active = true;
		    $scope.allSearchProductsInfo = [];
            if($scope.search_item !='' || $scope.category != ''){
    	        $scope.allSearchProductsInfo = [];
    	        var where = {
                    table     : "products",
                    data      : $scope.search_item,
                    category  : $scope.category
    	    	};
    		    	
    			$http({
    				method  : "POST",
    				url     : url + "readlike",
    				data    : where
    			}).success(function(response){
    				if(response.length > 0){
    					$scope.allSearchProductsInfo = response;
    				}else{
    					$scope.allSearchProductsInfo = [];
    				}
    			});
            }
		};
		
		$scope.showHideFn = function(){
		   if(typeof $scope.search_item == "undefined"){
		     $scope.active = false;
		   }else{
		      $scope.active = true; 
		   }
		}
		
   //get all product info fn end for data list

    
    
    //start get payment method number
        
    $scope.paymentmethod = function(name){
        $scope.method_name = name;
        $scope.paymentMethods = {};
        $scope.paymentNumber = '';
        $scope.paymentType = '';
        
        // conditional array
        var where = {
            table : "payment_method",
            cond: {name : name}
        }
        
        // read data by method
        $http({
            method : "post",
            url : url + "read",
            data : where
        }).success(function(response){
            
            if(response.length >= 0){
                $scope.paymentMethods = response;
                $scope.paymentNumber = response[0].number;
                $scope.paymentMethod = response[0].name;
                $scope.paymentType = "(" + response[0].type + ")";
            }
        });
        
        
    }
    
    //end get payment method number
    
    

   //get all product info fn start for searchbox
	   $scope.getProductInfoFnForSubmit = function(){
		   var where = {
			   table : "products",
			   cond  : {
				   product_name : $scope.searchItem,
				   product_cat  : $scope.searchItem
			   }
		   };

		   $http({
			   method  : "POST",
			   url     : url + "readlike",
			   data    : where
		   }).success(function(response){
			   if(response.length > 0){
				   $scope.allProductsInfo = response;
			   }else{
				   $scope.allProductsInfo = [];
			   }
			   // console.log($scope.allProductsInfo);
		   });
	   };
  //get all product info fn end for searchbox


	$scope.adjustItemFn = function($id){
		var condition = {table: 'products', cond: {id: $id}};
		$http({
			method: 'POST',
			url: url + 'read',
			data: condition
		}).success(function(response){
		    console.log(response);
			$scope.productInfo = {
				id: response[0].id,
				img_path: response[0].img_path,
				product_cat: response[0].product_cat,
				product_name: response[0].product_name,
				product_code: response[0].product_code,
				discount: response[0].discount,
				sale_price: (parseFloat(response[0].sale_price) > 0) ? parseFloat(response[0].sale_price) : parseFloat(response[0].regular_price),
				unit: response[0].unit,
				quantity: 1,
				status: response[0].status,
				color: (response[0].color !==null) ? response[0].color.split(','):'',
				allSize: (response[0].size !==null) ? response[0].size.split(','):'',
				product_color : "",
				product_size   : ""
			};
		});
	}




	$scope.addToCartFn = function(){
		$scope.active = false;
		var status = false;

		// check the item exists or not
		angular.forEach($scope.productInfoInCart, function(item){
			if(item.id == $scope.productInfo.id){ status = true; alert("Your selected item already in the Shoping Cart!");}
		       if($scope.global_category == false) {  $scope.global_category = (item.product_cat == "global") ? true : false; }

		});

		// push item in cart
		if(status == false){
			$scope.productInfo.total = $scope.productInfo.quantity * $scope.productInfo.sale_price;
			$scope.cart.push($scope.productInfo);
			$scope.itemInCart = $scope.cart.length;

			// Check browser support
			if (typeof(Storage) !== "undefined") {

				//set product quantity in localstorage
				var product_count = (localStorage.getItem("cart_quantity") != null) ? parseInt(localStorage.getItem("cart_quantity")) : 0;
				localStorage.setItem("cart_quantity", product_count+1);

	            //set product information in localstorage
				var oldItems = JSON.parse(localStorage.getItem('cart_item')) || [];
				var newItem = $scope.productInfo
				
				 oldItems.push(newItem);
				 localStorage.setItem('cart_item', JSON.stringify(oldItems));
			}
		}

		// get item in cart from local storage onclick to adtocart
		$scope.productInCart = localStorage.getItem("cart_quantity");
		$scope.productInfoInCart = JSON.parse(localStorage.getItem("cart_item"));
		
		// console.log($scope.productInfoInCart);
	};



	// get item in cart from local storage on reload
	$scope.productInCart = localStorage.getItem("cart_quantity");
	if($scope.productInCart==null){
	    $scope.productInCart = 0;
	}
	$scope.productInfoInCart = JSON.parse(localStorage.getItem("cart_item"));

	// get localStorage value for updating quantity in order pop up
	$scope.loadValueFromLocalStorage = function(){
		// check the item is global or not
		angular.forEach($scope.productInfoInCart, function(item){
		   if($scope.global_category == false) { $scope.global_category = (item.product_cat == "global") ? true : false;}

		});

		$scope.productInCart = localStorage.getItem("cart_quantity");
		$scope.productInfoInCart = JSON.parse(localStorage.getItem("cart_item"));
		// console.log($scope.productInfoInCart);
	};


	$scope.getSubtotal = function(index){
		// check the item is global or not
		angular.forEach($scope.productInfoInCart, function(item){
		   if($scope.global_category == false) { $scope.global_category = (item.product_cat == "global") ? true : false;}

		});

		$scope.productInfoInCart[index].total = $scope.productInfoInCart[index].quantity * ($scope.productInfoInCart[index].sale_price - $scope.productInfoInCart[index].discount);
		return $scope.productInfoInCart[index].total.toFixed(2);
	}


	$scope.grandTotal = function(){
		var total = 0;
		var limit_amount = 0.00;
		angular.forEach($scope.productInfoInCart, function(item){
			total += item.total;
		});
		
		return total;
	};

    $scope.areas = [];
   
    $scope.$watch('district_id', ()=>{
        
        console.log($scope.customerInfo);
        if(typeof $scope.district_id !== 'undefined' && $scope.district_id != ''){
            var where = {
               table    : "upazilas",
               cond     : { district_id : $scope.district_id }
            };
    
            $http({
                method : "POST",
                url    : url + "read",
                data   : where
            }).success(function(response){
                $scope.areas = [];
                if(response.length > 0){
                  $scope.areas = response;
                }
            });
        }
    });
    
    
   	$scope.areaCharge = function(){
   		angular.forEach($scope.areas, function(value){
   			if(value.name == $scope.area){
   				$scope.service_charge = value.charge;
   			}
   		});
   	// 	console.log($scope.service_charge);
   	}

   $scope.getZIPCode= function(){
	   $scope.allZipCodes = [];
	   var where = {
		   table    : "upazilas",
		   cond     : {
			   name : $scope.area
		   }
	   };

	  $http({
		  method : "POST",
		  url    : url + "read",
		  data   : where
	  }).success(function(response){
		  if(response.length > 0){
			  $scope.allZipCodes= response;
		  }else {
		  	  $scope.allZipCodes= [];
		  }
		// console.log($scope.allZipCodes);
	  });
   };




	$scope.calculateDeliveryCharge = function(){
		var total = 0;
		$scope.delivery_charge = 0.00;
		$scope.charge_amount = 0.00;
		angular.forEach($scope.productInfoInCart, function(item){
			total += item.total;
		});


		  if($scope.productInfoInCart != null){
			  if($scope.productInfoInCart.length > 0){
				  var where = {
					  table : "delivery_charge",
					  cond  : {
						  area : ($scope.area == "Jessore Sadar") ? $scope.area : "Others"
					  }
				  };

				 $http({
					 method : "POST",
					 url    : url + "read",
					 data   : where
				 }).success(function(response){
				     //console.log(response);
					 if(response.length == 1){
						 $scope.charge_amount = parseFloat(response[0].amount);
					 }
                     
                     
                     // fetch purchase amount limit from 'purchase_limit' table
                     var purchase_limit = 0.00;
                     
                     var where = {
                         table: 'purchase_limit'
                     };
                     
                     $http({
                         method: "POST",
                         url   : url + "read",
                         data  : where
                     }).success(function(data){
                         if(data.length == 1){
                            purchase_limit = parseFloat(data[0].amount);
                         }
                         
                         // check limit
    					 if(total > purchase_limit){
    						 $scope.delivery_charge = 0.00;
    					 }else{
    						 $scope.delivery_charge = $scope.charge_amount;
    					 }
                         
                     });
                     
                     // fetch end here
                     
				// 	 console.log($scope.delivery_charge);
				 });
			 }
		  }

	 return $scope.area;
	};


	$scope.changeDeliveryChargeFn = function(id)
	{
	   var where = {
            table : "upazilas",
            cond  : { id : id}
        };
		$http({
			 method : "POST",
			 url    : url + "read",
			 data   : where
		})
		.success(function(response){
		    console.log(response);
			 if(response.length > 0){
			     $scope.service_charge = response[0].shipping_charge;
			 }
		});
	   // console.log($scope.delivery_charge);
	};


	$scope.calculateDiscount = function(){
		var total = 0.00;
		$scope.discount = 0.00;

		angular.forEach($scope.productInfoInCart, function(item){
			total += item.total;
		});


		var where = {
			table : "coupon",
			cond  : {
				coupon_no : $scope.coupon
			}
		};

		// console.log(where);

		$http({
			method : "POST",
			url    : url + "read",
			data   : where
		}).success(function(response){
			if(response.length == 1){
			   $scope.discount = total * parseFloat(response[0].coupon_discount/100);
			}else{
				$scope.discount = 0.00;
			}
			// console.log($scope.discount);
		});
	};
	
	$scope.deliveryCharge = function(){
		var total = discount = 0.00;
		if($scope.productInfoInCart != null){
			if($scope.productInfoInCart.length > 0){
				total = parseFloat($scope.delivery_charge);
				discount = parseFloat($scope.discount);
			}
		}

		angular.forEach($scope.productInfoInCart, function(item){
			total += item.total;
		});
		
		total = parseFloat(total - discount);
		
		var charge = 0;
		
		if(total < 300 && total != 0){
		    charge = 20;
		}
		return +$scope.service_charge;
	};




	$scope.GetgrandTotal = function(){
		var total = discount = 0.00;
		if($scope.productInfoInCart != null){
			if($scope.productInfoInCart.length > 0){
				total = parseFloat($scope.delivery_charge);
				discount = parseFloat($scope.discount);
			}
		}

		angular.forEach($scope.productInfoInCart, function(item){
			total += item.total;
		});
		
		return (total + this.deliveryCharge()) - discount;
	};
	
	
	

	$scope.deleteItemFromCartFn = function(index){
		if ($window.confirm("Do you want to Delete this Product from the Shopping Cart?")) {

			$scope.productInfoInCart.splice(index, 1);

			//set after delete
			localStorage.setItem("cart_item",JSON.stringify($scope.productInfoInCart));
			localStorage.setItem("cart_quantity",$scope.productInfoInCart.length);

			// get after delete
			$scope.productInCart = localStorage.getItem("cart_quantity");
			$scope.productInfoInCart = JSON.parse(localStorage.getItem("cart_item"));
		}
	};

    
    // Clear cart when order Complated
    var order_check = document.querySelector("#order_check");
    if(order_check){
        if(order_check.dataset.con == 1){
            localStorage.clear();
            $scope.global_category == false;
            $scope.loadValueFromLocalStorage();
        }
    }

	 // clear all localStorage after order submit
	  $scope.clearLocalStorageFn = function(){
		  localStorage.clear();
		  $scope.global_category == false;
	  };



});


// end search



// all brand ctrl
app.controller('allbrandCtrl',['$scope','$http',function($scope,$http){
	$scope.allBrand = [];
	$scope.totalProduc = 0;
	var where = {
		table : "subcategory"
	}

	$http({
		method : "POST",
		url : url+ "read",
		data : where
	}).success(function(response){
		if (response.length > 0) {
			$scope.allBrand = response;


		//read data form products table for calculate brandwise total
		angular.forEach(response, function(subcategoryName,key){

				var condition = {
					table: "products",
					cond : {
						subcategory : subcategoryName.subcategory
					}
				}

				$http({
					method : "POST",
					url    : url + "read",
					data   : condition
				}).success(function(result){
					if (result.length > 0 ) {
						$scope.allBrand[key].total = result.length;
					}else{
						$scope.allBrand[key].total = 0;
					}
				});
		});

		//console.log($scope.allBrand);

	}

	});

}]);



// all category ctrl
app.controller('allcategoryCtrl',['$scope','$http',function($scope,$http){
	$scope.allCategory = [];

	var where = {
		table : "category"
	}

	$http({
		method : "POST",
		url : url+ "read",
		data : where
	}).success(function(response){
		if (response.length > 0) {
			$scope.allCategory = response;

			angular.forEach(response, function(categoryName,key){

				var condition = {
					table : "products",
					cond:{
						product_cat: categoryName.category
					}
				}


				$http({
					method : "POST",
					url    : url + "read",
					data   : condition
				}).success(function(result){
					if (result.length > 0 ) {
						$scope.allCategory[key].total = result.length;
					}else{
						$scope.allCategory[key].total = 0;
					}
				});

			});
// 			console.log($scope.allCategory);

		}
	});


}]);



// barnd or category wise product Ctrl

app.controller("barnd_categoryCtrl",function($scope,$http){

	 $scope.$watch("brand",function(brand,type){
	 	$scope.allProducts = [];

	 	 if($scope.type == 'category'){
	 	 	 var where = {
			 	table : "products",
			 	cond : {
			 		product_cat : brand,
			 		status: 1
			 	}
		 	}
	 	 }else{
	 	 	 var where = {
			 	table : "products",
			 	cond : {
			 		subcategory : brand
			 	}
		 	}
	 	 }


		 $http({
		 	method : "POST",
		 	url    : url + "read",
		 	data   : where
		 }).success(function(response){
		 	if(response.length > 0 ){
				angular.forEach(response,function(row,index){

					var category = row.product_cat.replace(/_/gi, " ").toLowerCase(),
					category = category.replace(/\b[a-z]/g, function(letter) {
						return letter.toUpperCase();
					});

					response[index].product_cat = category;
					response[index].url = 'frontend/home/products_details/'+ row.id;
				});

		 		$scope.allProducts = response;
		 		$scope.product_catTitle = response[0].product_cat;
		 	}

		    

		 });
    
	 });
});




//signup Controller
app.controller('SubscriberSignupCtrl', ['$scope', '$http', function($scope, $http) {

	$scope.signupFn = function(){
        $scope.signup_warning = "";
        $scope.signup_success = "";
        $scope.name_field     = "";
        $scope.mobile_field   = "";
        $scope.password_field = "";
        $scope.sr             = "";
        $scope.address_field  = "";
        $scope.result         = [];
		
		var data = {
			name                : $scope.name,
			mobile              : $scope.mobile,
			password            : $scope.password,
			confirm_password    : $scope.confirm_password,
			sr                  : $scope.sr,
			address             : $scope.address
		};

		$http({
			method : "POST",
			url    : siteurl + "frontend/signup/index",
			data   : data
		}).success(function(response){
			if(response.length > 0){
			    $scope.result = JSON.stringify(response);
			    $scope.result = JSON.parse($scope.result);
			    
			    //-------------------------------------------------
                $scope.signup_warning = $scope.result[0].signup_warning;
                $scope.signup_success = $scope.result[0].signup_success;
                if(typeof $scope.signup_success != "undefined"){
                    window.location.href=siteurl + 'login?user='+$scope.mobile;
                }
                //-------------------------------------------------
                
                $scope.name_field     = response[0].name_field;
                $scope.mobile_field   = response[0].mobile_field;
                $scope.password_field = response[0].password_field;
                //$scope.sr             = response[0].sr;
                $scope.address_field  = response[0].address_field;
                
                
				//claer set value
                $scope.name             = "";
                $scope.mobile           = "";
                $scope.password         = "";
                $scope.confirm_password = "";
                $scope.address          = "";
                //$scope.sr               = "";
                
                //--------------------------
                $scope.name_field     = '';
                $scope.mobile_field   = '';
                $scope.password_field = '';
                $scope.address_field  = '';
                //---------------------------
			}
		});
	}
}]);


// signin controller
app.controller('SubscriberLoginCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.mobile       = '';
    $scope.password     = '';
	$scope.verified     = false;
	$scope.validateCode = false;
	$scope.code         = '';
	$scope.login_error  = "";
	
    //get login start here
	$scope.getAccessLogin   = function(){
	    $scope.login_error = '';
		
        if(!$scope.verified){
    		$http({
    			method : "POST",
    			url    : siteurl + "access/subscriber/login",
    			data   : {
        			mobile   : $scope.mobile,
        			password : $scope.password
        		}
    		}).success(function(response){
    		    console.log(response);
                if(response=='denied'){
                    $scope.login_error = "Your Username and password is wrong!";
                    $scope.verified = false;
                }
                else {
                    $scope.validateCode = response;
                    $scope.verified     = true;
                }
    		});
        }
        
        
        else if($scope.validateCode==$scope.code){
            $scope.login_error = '';
            $http({
    			method : "POST",
    			url    : siteurl + "access/subscriber/codeVerify",
    			data   : {
        			mobile      : $scope.mobile,
        			password    : $scope.password
        		}
    		}).success(function(response){
                if(response!='error'){
                    window.location.href = siteurl + "subscriber/dashboard";
                }
                else {
                    $scope.login_error == "Something is Wrong! Please Try Again";
                }
    		});
        }else {
            $scope.login_error = 'Code is not correct';
        }
	}


}]);


app.controller('seeMoreCtrl', ['$scope', '$http', function($scope, $http) {
	$scope.limit = 30;
	$scope.offset = 0;
	$scope.products = [];

		$scope.seeMore = function(more=0){
			$("#loading").fadeIn('fast');
			$scope.limit += more;

			var where = {
				table  : "products",
				cond   : {
							product_cat: $scope.cat,
							status:1
						},
				limit  : $scope.limit,
				offset : $scope.offset
			};

			$http({
				method : "POST",
				url    : url + "read_limit_rang",
				data   : where
			}).success(function(response){
				$("#loading").fadeOut('fast');
				if(response.length > 0){
					angular.forEach(response,function(row,index){

						var category = row.product_cat.replace(/_/gi, " ").toLowerCase(),
			        	category = category.replace(/\b[a-z]/g, function(letter) {
			        		return letter.toUpperCase();
			    		});

						response[index].product_cat = category;
						response[index].url = 'frontend/home/products_details/'+ row.id;

					});

					$scope.products = response;
					// console.log($scope.products);
				}
			});
		}

	$scope.$watch('cat', function(){
		$scope.seeMore();
	});

	//Check Product Availablity
	/*$scope.not_available = function(p_code){
			var where = {
				table  : "stock",
				cond   : {code: p_code}
			};

			$http({
				method : "POST",
				url    : url + "read",
				data   : where
			}).success(function(response){
				if(response.length<1){
					return false;
				}else if(response.quantity<1){
					return false;
				}else{
					return true;
				}
			});
	}*/


}]);

app.controller('seeBrandCtrl', ['$scope', '$http', function($scope, $http) {
	$scope.limit = 18;
	$scope.offset = 0;
	$scope.products = [];

		$scope.seeMore = function(more=0){
			$("#loading").fadeIn('fast');
			$scope.limit += more;

			var where = {
				table  : "products",
				cond   : {product_cat: $scope.cat, subcategory: $scope.subcat},
				limit  : $scope.limit,
				offset : $scope.offset
			};
			//console.log(where);

			$http({
				method : "POST",
				url    : url + "read_limit_rang",
				data   : where
			}).success(function(response){
				$("#loading").fadeOut('fast');
				// console.log(response);
				if(response.length > 0){
					angular.forEach(response,function(row,index){

						var category = row.product_cat.replace(/_/gi, " ").toLowerCase(),
			        	category = category.replace(/\b[a-z]/g, function(letter) {
			        		return letter.toUpperCase();
			    		});

						response[index].product_cat = category;
                        response[index].url = 'frontend/home/products_details/'+ row.id;
					});

					$scope.products = response;
				}
			});
		}

	$scope.$watch(['cat','subcat'], function(){
		$scope.seeMore();
	});

}]);

app.controller('userAccountCtrl', ['$scope','$http', function ($scope,$http) {
	$scope.none         = 'none';
	$scope.disabledbtn  = true;
    $scope.areas        = [];
    $scope.district_id  = '';
    $scope.upazila_id   = '';
    
    
	$scope.matchPassword = function(){
		if ($scope.password == $scope.cpassword) {
			$scope.none = 'none';
			$scope.disabledbtn = false;
		}else{
			$scope.none = "block";
			$scope.disabledbtn = true;
		}

	}
	
	$scope.$watch('district_id', ()=>{
	    if(typeof $scope.district_id !== 'undefined' && $scope.district_id != ''){
            var where = {
               table    : "upazilas",
               cond     : { district_id : $scope.district_id }
            };
    
            $http({
                method : "POST",
                url    : url + "read",
                data   : where
            }).success(function(response){
                $scope.areas = [];
                if(response.length > 0){
                  $scope.areas = response;
                }
            });
        }
	});
    

}])
