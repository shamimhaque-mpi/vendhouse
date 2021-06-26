var site_url = url.replace('frontend/ajax/', '');
app.controller("wishListCtrl", function($scope, $http, $log, $window){
    $scope.items    = [];
    $scope.user_id  = null;
    $scope.$watch('user_id', function(user_id){
        $scope.user_id = user_id;
        var where = {
    		from : "wish_list",
    		join : "products",
    		cond : "wish_list.product_id=products.id",
    		where : {
    			'wish_list.user_id' : user_id
    		}
    	}
    	$http({
    		method : "POST",
    		url : url+ "readJoinData",
    		data : where
    	}).success(function(response){
    		if (response.length > 0) {
    		    $scope.items = response;
    		    console.log(response);
    		}
    	});
    });
    
    $scope.remove=function(id){
        if($scope.user_id){
            $http({
        		method  : "POST",
        		url     : site_url+"frontend/ajax/removeFromWish",
        		data    : {
        		    user_id     : $scope.user_id,
        		    product_id  : id
        		}
        	}).success(function(response){
        	    var count = document.querySelector('#count');
        	    console.log(count);
        	    count.innerText = 0;
        	    $scope.items=[];
        		if (response.length > 0) {
        		    $scope.items = response;
        		    count.innerText = (Object.keys(response)).length;
        		    console.log(response);
        		}
        	});
        }
    }
      
});