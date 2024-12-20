function ReviewEventHandler(){}

ReviewEventHandler.DEFAUL_METHOD = "POST";
ReviewEventHandler.URL_REQUEST = "./ajax/reviewInteraction.php";
ReviewEventHandler.URL_DELETE = "./ajax/reviewDeleteInteraction.php";
ReviewEventHandler.ASYNC_TYPE = true;

ReviewEventHandler.SUCCESS_RESPONSE = "0";
ReviewEventHandler.NO_MORE_DATA = "-1";


ReviewEventHandler.onReviewEvent = 
	function(nome) {
		if (document.getElementById("my_review").value.length < 50){
			document.getElementById("review_message").innerHTML = "*Minimo 50 caratteri";
			return;
		}
		var rating = document.getElementById("quantity").value;
		var review = document.getElementById("my_review").value;
		var nomeLuogo = nome;
		var dataToSend = "rating=" + rating + "&review=" + review + "&nomeLuogo=" + nomeLuogo + "&reviewToLoad=" + ReviewLoader.REVIEW_TO_LOAD;
		var responseFunction = ReviewEventHandler.onAjaxResponse;
	
		AjaxManager.performAjaxRequest(ReviewEventHandler.DEFAUL_METHOD, 
										ReviewEventHandler.URL_REQUEST, ReviewEventHandler.ASYNC_TYPE, 
										dataToSend, responseFunction);
	}

ReviewEventHandler.onAjaxResponse =
	function(response){
		if (response.responseCode === ReviewEventHandler.SUCCESS_RESPONSE){
			ReviewLoader.CURRENT_PAGE_INDEX = 1;
			ReviewDashboard.refreshData(response.data);
			return;
		}
		
		if (response.responseCode === ReviewEventHandler.NO_MORE_DATA)
			ReviewDashboard.setEmptyDashboard();
		
	}
	
ReviewEventHandler.onDeleteEvent = 
	function(nomeLuogo, nomeUtente) {
	
		ReviewLoader.CURRENT_PAGE_INDEX = 1;
		
		var queryString = "?nomeLuogo=" + nomeLuogo + "&nomeUtente=" + nomeUtente + "&reviewToLoad=" + ReviewLoader.REVIEW_TO_LOAD 
							+ "&offset=" + (ReviewLoader.CURRENT_PAGE_INDEX-1)*ReviewLoader.REVIEW_TO_LOAD;
		var url = ReviewEventHandler.URL_DELETE + queryString;
		var responseFunction = ReviewEventHandler.onAjaxResponseAdmin;
	
		AjaxManager.performAjaxRequest('GET', 
										url, ReviewEventHandler.ASYNC_TYPE, 
										null, responseFunction);
	}
	
ReviewEventHandler.onAjaxResponseAdmin =
	function(response){
		if (response.responseCode === ReviewEventHandler.SUCCESS_RESPONSE){
			ReviewDashboard.refreshDataAdmin(response.data);
			return;
		}
		
		if (response.responseCode === ReviewEventHandler.NO_MORE_DATA)
			ReviewDashboard.setEmptyDashboard();
		
	}
	
ReviewEventHandler.onAddEvent = 
	function(nomeLuogo, admin) {
		ReviewLoader.CURRENT_PAGE_INDEX++;

		var queryString = "?nomeLuogo=" + nomeLuogo + "&reviewToLoad=" + ReviewLoader.REVIEW_TO_LOAD 
							+ "&offset=" + (ReviewLoader.CURRENT_PAGE_INDEX-1)*ReviewLoader.REVIEW_TO_LOAD;
		var url = ReviewLoader.URL_REQUEST + queryString;
		if(admin==0)
			var responseFunction = ReviewEventHandler.onAddAjaxResponse;
		else if (admin==1)
			var responseFunction = ReviewEventHandler.onAddAjaxResponseAdmin;
	
		AjaxManager.performAjaxRequest(ReviewLoader.DEFAUL_METHOD, 
										url, ReviewLoader.ASYNC_TYPE, 
										null, responseFunction);
	}
		
ReviewEventHandler.onAddAjaxResponse = 
	function(response){
		if (response.responseCode === ReviewLoader.NO_MORE_DATA 
		 	/*&&	PlaceLoader.CURRENT_PAGE_INDEX === 1*/){
			
				ReviewDashboard.removeShowMore();
				/*ReviewDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	true);*/
				return;
		}
		
		if (response.responseCode === ReviewLoader.SUCCESS_RESPONSE)
			ReviewDashboard.addData(response.data);
		
		/*var noMoreDataExist = (response.data === null || response.data.length < PlaceLoader.PLACE_TO_LOAD);
		PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);*/
		
	}
	
ReviewEventHandler.onAddAjaxResponseAdmin = 
	function(response){
		if (response.responseCode === ReviewLoader.NO_MORE_DATA 
		 	/*&&	PlaceLoader.CURRENT_PAGE_INDEX === 1*/){
			
				ReviewDashboard.removeShowMore();
				/*ReviewDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	true);*/
				return;
		}
		
		if (response.responseCode === ReviewLoader.SUCCESS_RESPONSE)
			ReviewDashboard.addDataAdmin(response.data);
		
		/*var noMoreDataExist = (response.data === null || response.data.length < PlaceLoader.PLACE_TO_LOAD);
		PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);*/
		
	}