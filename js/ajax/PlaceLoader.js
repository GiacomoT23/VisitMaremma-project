function PlaceLoader(){};

PlaceLoader.DEFAUL_METHOD = "GET";
PlaceLoader.URL_REQUEST = "./ajax/placeLoader.php";
PlaceLoader.EXPLORE_REQUEST = "./ajax/cercaLoader.php";
PlaceLoader.ASYNC_TYPE = true;

PlaceLoader.PLACE_TO_LOAD = 12;
PlaceLoader.CURRENT_PAGE_INDEX = 1;

PlaceLoader.ALL_PLACES_SEARCH = 0;
PlaceLoader.VISITED_PLACES_SEARCH = 1;
PlaceLoader.TO_VISIT_PLACES_SEARCH = 2;
PlaceLoader.MARE_PLACES_SEARCH = 3;
PlaceLoader.MONTAGNA_PLACES_SEARCH = 4;
PlaceLoader.STORIA_PLACES_SEARCH = 5;
PlaceLoader.PARCO_PLACES_SEARCH = 6;
PlaceLoader.NAVBAR_PLACES_SEARCH = 7;


PlaceLoader.SUCCESS_RESPONSE = "0";
PlaceLoader.NO_MORE_DATA = "-1";


PlaceLoader.init = 
	function(searchType) {
		PlaceLoader.PAGE_INDEX = 1;
		if(searchType==0)
			PlaceLoader.highlight();
		if(searchType==7)
			PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	true);

			
	}
	
PlaceLoader.loadData =
	function(searchType, admin, logged){
		var queryString = "?searchType=" + searchType + "&placeToLoad=" + PlaceLoader.PLACE_TO_LOAD 
							+ "&offset=" + (PlaceLoader.CURRENT_PAGE_INDEX-1)*PlaceLoader.PLACE_TO_LOAD;
		var url = PlaceLoader.URL_REQUEST + queryString;
		if(admin==1)
			var responseFunction = PlaceLoader.onAjaxResponseAdmin;
		else if(logged==0)
			var responseFunction = PlaceLoader.onAjaxResponseOspite;
		else	
			var responseFunction = PlaceLoader.onAjaxResponse;
		
	
		AjaxManager.performAjaxRequest(PlaceLoader.DEFAUL_METHOD, 
										url, PlaceLoader.ASYNC_TYPE, 
										null, responseFunction);
	}

PlaceLoader.next =
	function(searchType, admin, logged){
		PlaceLoader.CURRENT_PAGE_INDEX++;
		if(searchType==7){
			pattern = document.getElementById("input_cerca").value;
			PlaceLoader.search(pattern, 0, logged);
		}
		else
			PlaceLoader.loadData(searchType, admin, logged);
	}
	
PlaceLoader.previous = 
	function(searchType, admin, logged){
		PlaceLoader.CURRENT_PAGE_INDEX--;
		if (PlaceLoader.CURRENT_PAGE_INDEX <= 1)
			PlaceLoader.CURRENT_PAGE_INDEX = 1;
		if(searchType==7){
			pattern = document.getElementById("input_cerca").value;
			PlaceLoader.search(pattern, 0, logged);
		}
		else
			PlaceLoader.loadData(searchType, admin, logged);
	}
	
PlaceLoader.onAjaxResponse = 
	function(response){
		if (response.responseCode === PlaceLoader.NO_MORE_DATA 
		 	/*&&	PlaceLoader.CURRENT_PAGE_INDEX === 1*/){
			
				PlaceDashboard.setEmptyDashboard(response.message);
				PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	true);
				return;
		}
		
		if (response.responseCode === PlaceLoader.SUCCESS_RESPONSE)
			PlaceDashboard.refreshData(response.data);
		
		var noMoreDataExist = (response.data === null || response.data.length < PlaceLoader.PLACE_TO_LOAD);
		PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);
		
	}
	
PlaceLoader.onAjaxResponseAdmin = 
	function(response){
		if (response.responseCode === PlaceLoader.NO_MORE_DATA 
		 	/*&&	PlaceLoader.CURRENT_PAGE_INDEX === 1*/){
			
				PlaceDashboard.setEmptyDashboard(response.message);
				PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	true);
				return;
		}
		
		if (response.responseCode === PlaceLoader.SUCCESS_RESPONSE)
			PlaceDashboard.refreshDataAdmin(response.data);
		
		var noMoreDataExist = (response.data === null || response.data.length < PlaceLoader.PLACE_TO_LOAD);
		PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);
		
	}
	
PlaceLoader.onAjaxResponseOspite = 
	function(response){
		if (response.responseCode === PlaceLoader.NO_MORE_DATA 
		 	/*&&	PlaceLoader.CURRENT_PAGE_INDEX === 1*/){
			
				PlaceDashboard.setEmptyDashboard(response.message);
				PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	true);
				return;
		}
		
		if (response.responseCode === PlaceLoader.SUCCESS_RESPONSE)
			PlaceDashboard.refreshDataOspite(response.data);
		
		var noMoreDataExist = (response.data === null || response.data.length < PlaceLoader.PLACE_TO_LOAD);
		PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);
		
	}

PlaceLoader.search =
	function(pattern, tastiera, logged){
		if (pattern === null || pattern.length === 0){
			PlaceDashboard.removeContent();
			PlaceLoader.CURRENT_PAGE_INDEX = 1;
			PlaceDashboard.updateNavigationPage(PlaceLoader.CURRENT_PAGE_INDEX,	true);
			return;	
		}
		
		if(tastiera)
			PlaceLoader.CURRENT_PAGE_INDEX = 1;
			
		var queryString = "?pattern=" + pattern + "&placeToLoad=" + PlaceLoader.PLACE_TO_LOAD 
							+ "&offset=" + (PlaceLoader.CURRENT_PAGE_INDEX-1)*PlaceLoader.PLACE_TO_LOAD;
		var url = PlaceLoader.EXPLORE_REQUEST + queryString;
		
		if(logged)
			var responseFunction = PlaceLoader.onAjaxResponse;
		else
			var responseFunction = PlaceLoader.onAjaxResponseOspite;

		AjaxManager.performAjaxRequest(PlaceLoader.DEFAUL_METHOD, 
										url, PlaceLoader.ASYNC_TYPE, 
										null, responseFunction);
	}
	
PlaceLoader.onExploreAjaxResponse =
	function(response){
		if (response.responseCode === UserPlaceEventHandler.SUCCESS_RESPONSE){
			PlaceDashboard.refreshData(response.data);
			return;
		}
		
		if (response.responseCode === PlaceLoader.NO_MORE_DATA)
			PlaceDashboard.setEmptyDashboard();
		
	}
	
PlaceLoader.highlight = 
	function(){
		document.getElementById("luoghi_link").setAttribute("class", "selected_link");
	}