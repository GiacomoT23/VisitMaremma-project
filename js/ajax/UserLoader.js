function UserLoader(){};

UserLoader.DEFAUL_METHOD = "GET";
UserLoader.URL_REQUEST = "./ajax/userLoader.php";
UserLoader.EXPLORE_REQUEST = "./ajax/userCercaLoader.php";

UserLoader.ASYNC_TYPE = true;

UserLoader.ALL_USERS_SEARCH = 0;
UserLoader.NAVBAR_USERS_SEARCH = 1;

UserLoader.USERS_TO_LOAD = 12;
UserLoader.CURRENT_PAGE_INDEX = 1;

UserLoader.SUCCESS_RESPONSE = "0";
UserLoader.NO_MORE_DATA = "-1";


UserLoader.init = 
	function(searchType) {
		UserLoader.PAGE_INDEX = 1;
		if(searchType = 0)
			UserLoader.highlight();
		else if(searchType = 1)
			UserDashboard.updateNavigationPage(UserLoader.CURRENT_PAGE_INDEX,	true);
	}
	
UserLoader.loadData =
	function(){
		var queryString = "?usersToLoad=" + UserLoader.USERS_TO_LOAD 
							+ "&offset=" + (UserLoader.CURRENT_PAGE_INDEX-1)*UserLoader.USERS_TO_LOAD;
		var url = UserLoader.URL_REQUEST + queryString;
		
		var responseFunction = UserLoader.onAjaxResponse;
		
	
		AjaxManager.performAjaxRequest(UserLoader.DEFAUL_METHOD, 
										url, UserLoader.ASYNC_TYPE, 
										null, responseFunction);
	}
	
UserLoader.next =
	function(searchType){
		UserLoader.CURRENT_PAGE_INDEX++;
		if(searchType==1){
			pattern = document.getElementById("input_cerca").value;
			UserLoader.search(pattern, 0);
		}
		else
			UserLoader.loadData();
	}
	
UserLoader.previous = 
	function(searchType){
		UserLoader.CURRENT_PAGE_INDEX--;
		if (UserLoader.CURRENT_PAGE_INDEX <= 1)
			UserLoader.CURRENT_PAGE_INDEX = 1;
		if(searchType==1){
			pattern = document.getElementById("input_cerca").value;
			UserLoader.search(pattern, 0);
		}
		else
			UserLoader.loadData();
	}
	
UserLoader.onAjaxResponse = 
	function(response){
		if (response.responseCode === UserLoader.NO_MORE_DATA 
		 	/*&&	UserLoader.CURRENT_PAGE_INDEX === 1*/){
			
				UserDashboard.setEmptyDashboard(response.message);
				UserDashboard.updateNavigationPage(UserLoader.CURRENT_PAGE_INDEX,	true);
				return;
		}
		
		if (response.responseCode === UserLoader.SUCCESS_RESPONSE)
			UserDashboard.refreshData(response.data, 0);
		
		var noMoreDataExist = (response.data === null || response.data.length < UserLoader.USERS_TO_LOAD);
		UserDashboard.updateNavigationPage(UserLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);
		
	}
	
UserLoader.search =
	function(pattern, tastiera){
		if (pattern === null || pattern.length === 0){
			UserDashboard.removeContent();
			UserLoader.CURRENT_PAGE_INDEX = 1;
			UserDashboard.updateNavigationPage(UserLoader.CURRENT_PAGE_INDEX,	true);
			return;	
		}
		
		if(tastiera)
			UserLoader.CURRENT_PAGE_INDEX = 1;
			
		var queryString = "?pattern=" + pattern + "&usersToLoad=" + UserLoader.USERS_TO_LOAD 
							+ "&offset=" + (UserLoader.CURRENT_PAGE_INDEX-1)*UserLoader.USERS_TO_LOAD;
		var url = UserLoader.EXPLORE_REQUEST + queryString;
		var responseFunction = UserLoader.onExploreAjaxResponse;
	
		AjaxManager.performAjaxRequest(UserLoader.DEFAUL_METHOD, 
										url, UserLoader.ASYNC_TYPE, 
										null, responseFunction);
	}
	
UserLoader.onExploreAjaxResponse = 
	function(response){
		if (response.responseCode === UserLoader.NO_MORE_DATA 
		 	/*&&	UserLoader.CURRENT_PAGE_INDEX === 1*/){
			
				UserDashboard.setEmptyDashboard(response.message);
				UserDashboard.updateNavigationPage(UserLoader.CURRENT_PAGE_INDEX,	true);
				return;
		}
		
		if (response.responseCode === UserLoader.SUCCESS_RESPONSE)
			UserDashboard.refreshData(response.data, 1);
		
		var noMoreDataExist = (response.data === null || response.data.length < UserLoader.USERS_TO_LOAD);
		UserDashboard.updateNavigationPage(UserLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);
		
	}
	
/*UserLoader.onExploreAjaxResponse =
	function(response){
		if (response.responseCode === UserEventHandler.SUCCESS_RESPONSE){
			UserDashboard.refreshData(response.data, 1);
			return;
		}
		
		if (response.responseCode === UserLoader.NO_MORE_DATA)
			UserDashboard.setEmptyDashboard();
		
	}*/
	
UserLoader.highlight = 
	function(){
		document.getElementById("utenti_link").setAttribute("class", "selected_link");
	}