// sale controller
app.controller('SaleEntryCtrl', function($scope, $http) {

	$scope.active = true;
	$scope.active1 = false;
	$scope.cart = [];

	$scope.stype = "cash";
    $scope.presentBalance = 0.00;

    $scope.isDisabled = false;

	$scope.remaining_commission = 0;
	$scope.total_commission_amount = 0.00;

	$scope.amount = {
		labour : 0,
		total: 0,
		totalqty: 0,
		totalDiscount: 0,
		discount_percentage: 0,
		truck_rent : 0,
		grandTotal: 0,
		paid: 0,
		due: 0
	};

	//get sale type
	$scope.getsaleType = function(type){
		if(type == "cash"){
			$scope.active = true;
			$scope.active1 = false;
			$scope.partyInfo.balance = 0.00;
			$scope.partyInfo.sign = "Receivable";
		}else{
			$scope.active = false;
			$scope.active1 = true;
			$scope.partyCode = "";
			$scope.partyInfo.code = "";
			$scope.partyInfo.contact = "";
			$scope.partyInfo.address = "";
		}
	};

	// Get all products godowns wise
	$scope.getAllProducts = function(){
		$scope.allProducts = [];
		var where = {
			table : 'stock',
			cond  :{
				godown: $scope.godown 
			}
		}
		$http({
			method : 'POST',
			url    : url + 'read',
			data   : where
		}).success(function(products){
			if (products.length > 0 ) {
				$scope.allProducts = products;
			}else{
				$scope.allProducts = [];
			}
		});

	}

	// Get all godowns product wise
	$scope.getAllGodowns = function(){
		$scope.allGodowns = [];
		var where = {
			table : 'stock',
			cond  :{
				code: $scope.product 
			}
		}
		$http({
			method : 'POST',
			url    : url + 'read',
			data   : where
		}).success(function(godowns){
			if (godowns.length > 0 ) {
				angular.forEach(godowns,function(value){
					var where = {
						table: 'godowns',
						cond: {
							code : value.godown
						}
					};
					$http({
						method : 'POST',
						url    : url + 'read',
						data   : where
					}).success(function(response){
						var info = {
							name : response[0].name,
							code : response[0].code
						};

						$scope.allGodowns.push(info);
					});
				});

			}else{
				$scope.allGodowns = [];
			}
		});

	}

	$scope.addNewProductFn = function(){
		if(typeof $scope.product !== 'undefined'){
			var condition = {
				table: 'stock',
				cond: {
					code   : $scope.product.trim(),
					godown : $scope.godown,
				}
			};

			$http({
				method: 'POST',
				url: url + 'read',
				data: condition
			}).success(function(response){
				if (response.length > 0) {
					var newItem = {
						product              : response[0].name,
						product_code         : response[0].code,
						unit				 : response[0].unit,
						godown               : response[0].godown,
						maxQuantity          : parseInt(response[0].quantity),
						stock_qty            : parseInt(response[0].quantity),
						quantity             : 1.00,
						bag_size             : 1.00,
						bags                 : 0.00,
						subtotal             : 0.00,
						discount             : 0.00,
						purchase_price       : parseFloat(response[0].purchase_price),
						sale_price           : parseFloat(response[0].sell_price),
					};

					$scope.cart.push(newItem);
				}
			});
		}
	}
	

	//calculate Bags no
	$scope.calculateBags = function(index){
		//console.log($scope.cart[index].quantity);
		var bag_no = 0.00;
        bag_no = parseFloat($scope.cart[index].quantity) / parseFloat($scope.cart[index].bag_size);
		$scope.cart[index].bags = bag_no.toFixed(2);
		return $scope.cart[index].bags;
	};
	

	//calculate commission
	$scope.calculateTotalCommission = function(){
		var total = parseFloat($scope.amount.total),
		    totalCommission = 0.00,
			remainingCommission = 0;

		remainingCommission  = parseInt(6 - $scope.commission);
		$scope.remaining_commission = remainingCommission;

		totalCommission = parseFloat(total * (parseFloat($scope.commission)/100));
		$scope.total_commission_amount = totalCommission.toFixed(2);

        return $scope.total_commission_amount;
	};


	$scope.setSubtotalFn = function(index){
		$scope.cart[index].subtotal = $scope.cart[index].sale_price * $scope.cart[index].quantity;
		return $scope.cart[index].subtotal.toFixed();
	}

	$scope.purchaseSubtotalFn = function(index){
		$scope.cart[index].purchase_subtotal = $scope.cart[index].purchase_price * $scope.cart[index].quantity;
		return $scope.cart[index].purchase_subtotal.toFixed();
	}

	$scope.getTotalFn = function(){
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.subtotal);
		});

		$scope.amount.total = total.toFixed();
		return $scope.amount.total;
	}
	
	$scope.calculateDiscountFn = function(){
	    var total= 0.00;
	    total = $scope.amount.total * ($scope.amount.discount_percentage/ 100);
	    $scope.amount.totalDiscount = total;
	    return total.toFixed(2);
	}


	$scope.getTotalQtyFn = function(){
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.quantity);
		});

		$scope.amount.totalqty = total;
		return $scope.amount.totalqty;
	}
	
	$scope.getTotalBagFn = function(){
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.bags);
		});

		$scope.amount.totalqty = total;
		return $scope.amount.totalqty;
	}

	$scope.getPurchaseTotalFn = function(){
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.purchase_subtotal);
		});

		$scope.amount.purchase_total = total.toFixed();
		return $scope.amount.purchase_total;
	}

	$scope.getTotalDiscountFn = function() {
		var total = 0;
		angular.forEach($scope.cart, function(item){
			total += parseFloat(item.discount);
		});
		$scope.amount.totalDiscount = total.toFixed(2);
		return $scope.amount.totalDiscount;
	}

	$scope.getGrandTotalFn = function(){
		var grand_total = 0.0;

		grand_total = parseFloat($scope.amount.total)  - parseFloat($scope.amount.totalDiscount);
		return $scope.amount.grandTotal = grand_total.toFixed(2);
	}


	$scope.getCurrentTotalFn = function() {
		var total = 0.00;

		if($scope.partyInfo.sign == 'Receivable') {
			total = (parseFloat($scope.partyInfo.balance) + parseFloat($scope.amount.grandTotal)) - $scope.amount.paid;

			if(total > 0) {
				$scope.partyInfo.csign = "Receivable";
			} else if(total < 0) {
				$scope.partyInfo.csign = "Payable";
			} else {
				$scope.partyInfo.csign = "Receivable";
			}
		} else {
			total = (parseFloat($scope.partyInfo.balance) + $scope.amount.paid) - parseFloat($scope.amount.grandTotal);

			if(total > 0) {
				$scope.partyInfo.csign = "Payable";
			} else if(total < 0) {
				$scope.partyInfo.csign = "Receivable";
			} else {
				$scope.partyInfo.csign = "Receivable";
			}
		}

		$scope.amount.due = total.toFixed(2);
		$scope.presentBalance = Math.abs(total.toFixed(2));

	     /*
		  console.log("Current Balance =>" +  $scope.presentBalance);
	      console.log("Current Sign =>" + $scope.partyInfo.csign);
		  console.log("Credit Limit =>" + $scope.partyInfo.cl);
		 */

		if($scope.stype == "credit"){
			if($scope.partyInfo.csign == "Receivable" && $scope.presentBalance <= $scope.partyInfo.cl){
			   $scope.isDisabled = false;
			   $scope.message = "";
		   }else if($scope.partyInfo.csign == "Payable"){
			   $scope.isDisabled = false;
			   $scope.message = "";
		   }else{
			   $scope.isDisabled = true;
			   $scope.message = "Total is being crossed the Credit Limit!";
		   }
		}

		return $scope.presentBalance;
	}

	$scope.partyInfo = {
		code: '',
		name: '',
		contact: '',
		address: '',
		balance: 0.00,
		payment: 0.00,
		cl : 0.00,
		sign: 'Receivable',
		csign: 'Receivable'
	};

	$scope.findPartyFn = function() {
		if(typeof $scope.partyCode != 'undefined'){
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

					$scope.partyInfo.code    = response[0].code;
					$scope.partyInfo.name    = response[0].name;
					$scope.partyInfo.contact = response[0].mobile;
					$scope.partyInfo.address = response[0].address;
					$scope.partyInfo.cl      = parseFloat(response[0].credit_limit);

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
	}


	$scope.deleteItemFn = function(index){
		$scope.cart.splice(index, 1);
	}
});
