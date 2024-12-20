function UserPlaceEventHandler(){}

UserPlaceEventHandler.DEFAUL_METHOD = "GET";
UserPlaceEventHandler.URL_REQUEST = "./ajax/userPlaceInteraction.php";
UserPlaceEventHandler.URL_DELETE = "./ajax/userPlaceDeleteInteraction.php";
UserPlaceEventHandler.ASYNC_TYPE = true;

UserPlaceEventHandler.SUCCESS_RESPONSE = "0";

UserPlaceEventHandler.onVisitEvent = 
	function(nome) {
		var flag =  getComplementaryFlag(document.getElementById("visitedItem_" + nome))
		var queryString = "?nome=" + nome + "&isVisited=" + flag;
		var url = UserPlaceEventHandler.URL_REQUEST + queryString;
		var responseFunction = UserPlaceEventHandler.onAjaxResponse;
	
		AjaxManager.performAjaxRequest(UserPlaceEventHandler.DEFAUL_METHOD, 
										url, UserPlaceEventHandler.ASYNC_TYPE, 
										null, responseFunction)
	}
	
UserPlaceEventHandler.onToVisitEvent =
	function(nome){
		var flag =  getComplementaryFlag(document.getElementById("toVisitItem_" + nome))
		var queryString = "?nome=" + nome + "&toVisit=" + flag;
		var url = UserPlaceEventHandler.URL_REQUEST + queryString;
		var responseFunction = UserPlaceEventHandler.onAjaxResponse;
	
		AjaxManager.performAjaxRequest(UserPlaceEventHandler.DEFAUL_METHOD, 
										url, UserPlaceEventHandler.ASYNC_TYPE, 
										null, responseFunction)
	}

	
	
	
	
UserPlaceEventHandler.onAjaxResponse = 
	function(response){
		if (response.responseCode === UserPlaceEventHandler.SUCCESS_RESPONSE)
			PlaceDashboard.updatePlaceFooter(response.data);
		
	}

function getComplementaryFlag(item){
	var classAttribute = item.getAttribute("class"); // item.className;
	var currentFlag = parseInt(classAttribute.charAt(classAttribute.length-1)); // parseInt(classAttribute.slice(-1));
	return (currentFlag+1)%2;
}

UserPlaceEventHandler.onDeleteEvent = 
	function(nomeLuogo) {
		
		var queryString1 = "?nomeLuogo=" + nomeLuogo  + "&placeToLoad=" + PlaceLoader.PLACE_TO_LOAD 
							+ "&offset=" + (PlaceLoader.CURRENT_PAGE_INDEX-1)*PlaceLoader.PLACE_TO_LOAD ;
							
		var url = UserPlaceEventHandler.URL_DELETE + queryString1;
		
		var responseFunction = PlaceLoader.onAjaxResponseAdmin;
	
		AjaxManager.performAjaxRequest(UserPlaceEventHandler.DEFAUL_METHOD, 
										url, UserPlaceEventHandler.ASYNC_TYPE, 
										null, responseFunction);
	}
	