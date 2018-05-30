car = angular.module('cars', []);

//-----------------Root Scope--------------------------------
car.run(function($rootScope) {
    $rootScope.bookedSlot = 0;
    $rootScope.slotId     = 0;
    $rootScope.loading     = false;
    $rootScope.completed   = false;
    $rootScope.failed      = false;
    $rootScope.changeSlot = function(value,id){
	//alert($slot);
    	$rootScope.bookedSlot = value;
	$rootScope.slotId     = id;
    }
    //-------------------------------------------------
     
});
//-------------------------------------------------------------
car.controller('bookingCtrl', function($scope, $http) {

    //$http.get("welcome.html")
    // $http.get("https://www.w3schools.com/angular/customers.php")
     $http.get("http://redefineyourshine.com/demo/slim/index.php/cars")
    .then(function(response) {
			//	   alert(response);
        $scope.names = response.data;
    });
});  
//---------------------------------------------------------
car.controller('boxCtrl', function($scope, $http, $window,$rootScope) {
  
   $scope.submitForm = function() {
   $rootScope.loading = true;
  
    //-------------------------------------  
     var data = $.param({
                mobile : $scope.mobile,
                vnumber: $scope.vnumber,
				slot   : $rootScope.bookedSlot,
				slotid : $rootScope.slotId
               
            });
   // alert($scope.loading);
    //----------------------------------------
      var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }
    //----------------------------------------
     $http.post('http://redefineyourshine.com/demo/slim/index.php/saveSlot', data, config)
            .success(function (data, status, headers, config) {
							   alert(data);
                //$scope.PostDataResponse = data;
	       //var message = 'You successfully completed your booking.';
	       $rootScope.completed = true;
	      
	      
            })
	    .error(function (data, status, header, config) {
	      //----------------------------------------------
                 $rootScope.failed = true;
	      //----------------------------------------------
            });
    //------------------------------------------------------
      //alert($scope.mobile);
    //------------------------------------------------------------
  };
  
  $scope.refreshSlot = function(){
	$window.location.href = 'http://redefineyourshine.com/demo/';
    }
  
});