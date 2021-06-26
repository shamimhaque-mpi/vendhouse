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