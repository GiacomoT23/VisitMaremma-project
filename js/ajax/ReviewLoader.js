function ReviewLoader(){};

ReviewLoader.DEFAUL_METHOD = "GET";
ReviewLoader.URL_REQUEST = "./ajax/reviewLoader.php";
ReviewLoader.ASYNC_TYPE = true;
ReviewLoader.REVIEW_TO_LOAD = 3;
ReviewLoader.CURRENT_PAGE_INDEX = 1;

/*PlaceLoader.PLACE_TO_LOAD = 12;
PlaceLoader.CURRENT_PAGE_INDEX = 1;*/

ReviewLoader.SUCCESS_RESPONSE = "0";
ReviewLoader.NO_MORE_DATA = "-1";

/*ReviewLoader.init = 
	function() {
		PlaceLoader.PAGE_INDEX = 1;
	}*/
	
ReviewLoader.loadData =
	function(nomeLuogo, admin){
		var queryString = "?nomeLuogo=" + nomeLuogo + "&reviewToLoad=" + ReviewLoader.REVIEW_TO_LOAD 
							+ "&offset=" + (ReviewLoader.CURRENT_PAGE_INDEX-1)*ReviewLoader.REVIEW_TO_LOAD;
		var url = ReviewLoader.URL_REQUEST + queryString;
		if(admin==0)
			var responseFunction = ReviewLoader.onAjaxResponse;
		else if (admin==1)
			var responseFunction = ReviewLoader.onAjaxResponseAdmin;
	
		AjaxManager.performAjaxRequest(ReviewLoader.DEFAUL_METHOD, 
										url, ReviewLoader.ASYNC_TYPE, 
										null, responseFunction);
	}
	
ReviewLoader.onAjaxResponse = 
	function(response){
		if (response.responseCode === ReviewLoader.NO_MORE_DATA 
		 	/*&&	PlaceLoader.CURRENT_PAGE_INDEX === 1*/){
			
				ReviewDashboard.setEmptyDashboard(response.message);
				/*ReviewDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	true);*/
				return;
		}
		
		if (response.responseCode === ReviewLoader.SUCCESS_RESPONSE)
			ReviewDashboard.refreshData(response.data);
		
		/*var noMoreDataExist = (response.data === null || response.data.length < PlaceLoader.PLACE_TO_LOAD);
		PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);*/
		
	}
	
ReviewLoader.onAjaxResponseAdmin = 
	function(response){
		if (response.responseCode === ReviewLoader.NO_MORE_DATA 
		 	/*&&	PlaceLoader.CURRENT_PAGE_INDEX === 1*/){
			
				ReviewDashboard.setEmptyDashboard(response.message);
				/*ReviewDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	true);*/
				return;
		}
		
		if (response.responseCode === ReviewLoader.SUCCESS_RESPONSE)
			ReviewDashboard.refreshDataAdmin(response.data);
		
		/*var noMoreDataExist = (response.data === null || response.data.length < PlaceLoader.PLACE_TO_LOAD);
		PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);*/
		
	}