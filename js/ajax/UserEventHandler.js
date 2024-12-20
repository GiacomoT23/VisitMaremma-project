function UserEventHandler(){}

UserEventHandler.DEFAUL_METHOD = "GET";
UserEventHandler.URL_DELETE = "./ajax/userDeleteInteraction.php";
UserEventHandler.URL_DELETE_SEARCH = "./ajax/userDeleteSearchInteraction.php";

UserEventHandler.ASYNC_TYPE = true;

UserEventHandler.SUCCESS_RESPONSE = "0";
UserEventHandler.NO_MORE_DATA = "-1";

UserEventHandler.onDeleteEvent = 
	function(nomeUtente, search) {
		
		var queryString1 = "?nomeUtente=" + nomeUtente  + "&usersToLoad=" + UserLoader.USERS_TO_LOAD 
							+ "&offset=" + (UserLoader.CURRENT_PAGE_INDEX-1)*UserLoader.USERS_TO_LOAD ;
		if(search==0){
			var url = UserEventHandler.URL_DELETE + queryString1;
			var responseFunction = UserLoader.onAjaxResponse;
		}
		else{
			var responseFunction = UserLoader.onExploreAjaxResponse;
			pattern = document.getElementById("input_cerca").value;
			var queryString2 = "?nomeUtente=" + nomeUtente  + "&pattern=" + pattern + "&usersToLoad=" + UserLoader.USERS_TO_LOAD 
							+ "&offset=" + (UserLoader.CURRENT_PAGE_INDEX-1)*UserLoader.USERS_TO_LOAD ;
			var url = UserEventHandler.URL_DELETE_SEARCH + queryString2;
		}
		
		AjaxManager.performAjaxRequest(UserEventHandler.DEFAUL_METHOD, 
										url, UserEventHandler.ASYNC_TYPE, 
										null, responseFunction);
	}
	

	
/*UserEventHandler.onAjaxResponse =
	function(response){
		if (response.responseCode === UserEventHandler.SUCCESS_RESPONSE){
			UserDashboard.refreshData(response.data, 0);
			return;
		}
		
		if (response.responseCode === UserEventHandler.NO_MORE_DATA)
			UserDashboard.setEmptyDashboard();
		
	}
	
UserEventHandler.onAjaxResponseSearch =
	function(response){
		if (response.responseCode === UserEventHandler.SUCCESS_RESPONSE){
			UserDashboard.refreshData(response.data, 1);
			return;
		}
		
		if (response.responseCode === UserEventHandler.NO_MORE_DATA)
			UserDashboard.setEmptyDashboard();
		
	}*/