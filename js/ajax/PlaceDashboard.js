function PlaceDashboard(){};

PlaceDashboard.DEFAULT_POSTER_URL = "../img/luoghi/immagine_mancante.jpg";



PlaceDashboard.removeContent = 
	function(){
		var dashboardElement = document.getElementById("placeDashboard");
		if (dashboardElement === null)
			return;
		
		var firstChild = dashboardElement.firstChild;
		if (firstChild !== null)
			dashboardElement.removeChild(firstChild);
	
	}
	
PlaceDashboard.setEmptyDashboard = 
	function(){
		PlaceDashboard.removeContent();
		
		var dashboardElement = document.getElementById("placeDashboard");  /*messo io*/
		if (dashboardElement === null)
			return;
		
		
		var warningDivElem = document.createElement("div");
		warningDivElem.setAttribute("class", "warning");
		var warningSpanElem = document.createElement("span");
		warningSpanElem.textContent = "Non ci sono luoghi da visualizzare";
		
		warningDivElem.appendChild(warningSpanElem);
		dashboardElement.appendChild(warningDivElem);
		
	}
	
PlaceDashboard.refreshData =
	function(data){
		PlaceDashboard.removeContent();
		
		// Create new place lists (tag <ul></ul>)
		var newPlaceListElem =	PlaceDashboard.createPlaceListElement();
		
		// Create new place item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var placeItemElem = PlaceDashboard.createPlaceItemElement(data[i]);
			newPlaceListElem.appendChild(placeItemElem);
		}		
		
		document.getElementById("placeDashboard").appendChild(newPlaceListElem);
			
	}
	
PlaceDashboard.createPlaceListElement = 
	function(){
		var placeListElem = document.createElement("ul");
		placeListElem.setAttribute("id", "posterPlaceList");
		placeListElem.setAttribute("class", "poster_places_list");
		
		return placeListElem;
	}
	
PlaceDashboard.createPlaceItemElement = 	
	function(currentData){
		var placeItemLi = document.createElement("li");
		placeItemLi.setAttribute("id", "place_item_" + currentData.place.nome);
		placeItemLi.setAttribute("class", "poster_place_item_wrapper");
		
		placeItemLi.appendChild(PlaceDashboard.createNavBarElement(currentData));
		placeItemLi.appendChild(PlaceDashboard.createCentralElement(currentData));
		placeItemLi.appendChild(PlaceDashboard.createFooterElement(currentData));
		
		
		return placeItemLi; 
	}

	
PlaceDashboard.createNavBarElement =
	function(currentData){
		var navBarElem = document.createElement("nav");
		navBarElem.setAttribute("class", "name_nav_bar");
		
		var para = document.createElement("p");
		var nomeSpazi = currentData.place.nome;
		nomeSpazi = nomeSpazi.replace(/_/g, " ");
		var node = document.createTextNode(nomeSpazi);
		para.appendChild(node);
		
		navBarElem.appendChild(para);
		
		return navBarElem;
	}
	
PlaceDashboard.createCentralElement =
	function(currentData){
		var centralElem = document.createElement("div");
		centralElem.setAttribute("class", "item_content");
		
		centralElem.appendChild(PlaceDashboard.createPosterElement(currentData));
		centralElem.appendChild(PlaceDashboard.createSideElement(currentData));
		
		return centralElem;
	}
	
PlaceDashboard.createPosterElement =
	function(currentData){
		// Create div wrapper
		var posterDivElem = document.createElement("div");
		posterDivElem.setAttribute("class", "poster_place_item");
		
		// Create poster link
		var posterLinkElem = document.createElement("a");
		posterLinkElem.setAttribute("href", "./detailedplace.php?nome_luogo=" + currentData.place.nome);
		
		// Create img
		var posterImgElem = new Image();
		posterImgElem.alt = "poster";
		posterImgElem.src = currentData.place.posterUrl;
		if (currentData.place.posterUrl === "N/A")
			posterImgElem.src = MovieDashboard.DEFAULT_POSTER_URL;
				
		posterLinkElem.appendChild(posterImgElem);
		posterDivElem.appendChild(posterLinkElem);
		
		return posterDivElem;
	}

PlaceDashboard.createSideElement =										
	function(currentData){
		var sideElem = document.createElement("div");
		sideElem.setAttribute("class", "side_place_item");
		
		var mareItemElem = document.createElement("div");
		mareItemElem.setAttribute("id", "mareItem_" + currentData.place.nome);
		mareItemElem.setAttribute("class", "side_item mare_" + currentData.place.mare);
		
		var montagnaItemElem = document.createElement("div");
		montagnaItemElem.setAttribute("id", "montagnaItem_" + currentData.place.nome);
		montagnaItemElem.setAttribute("class", "side_item montagna_" + currentData.place.montagna);
		
		var storiaItemElem = document.createElement("div");
		storiaItemElem.setAttribute("id", "storiaItem_" + currentData.place.nome);
		storiaItemElem.setAttribute("class", "side_item storia_" + currentData.place.storia);
		
		var parcoItemElem = document.createElement("div");
		parcoItemElem.setAttribute("id", "parcoItem_" + currentData.place.nome);
		parcoItemElem.setAttribute("class", "side_item parco_" + currentData.place.parco);
		
		sideElem.appendChild(mareItemElem);
		sideElem.appendChild(montagnaItemElem);
		sideElem.appendChild(storiaItemElem);
		sideElem.appendChild(parcoItemElem);

		
		return sideElem;
	}
	
PlaceDashboard.createFooterElement =
	function(currentData) {
		var footerElem = document.createElement("div");
		footerElem.setAttribute("class", "footer_elem");
		footerElem.setAttribute("id", "user_place_footer_" + currentData.place.nome);
		
		// Create visited div elem (tag <div></div>)
		var visitedItemElem = document.createElement("div");
		visitedItemElem.setAttribute("id", "visitedItem_" + currentData.place.nome);
		visitedItemElem.setAttribute("class", "footer_place_item check_img_" + currentData.placeUserStat.visitato);
		visitedItemElem.setAttribute("onClick", "UserPlaceEventHandler.onVisitEvent('" + currentData.place.nome + "')");
	
		// Create to-visit div elem (tag <div></div>)
		var toVisitItemElem = document.createElement("div");
		toVisitItemElem.setAttribute("id", "toVisitItem_" + currentData.place.nome);
		toVisitItemElem.setAttribute("class", "footer_place_item to_visit_img_" + currentData.placeUserStat.daVisitare);
		toVisitItemElem.setAttribute("onClick", "UserPlaceEventHandler.onToVisitEvent('" + currentData.place.nome + "')");
		
		footerElem.appendChild(visitedItemElem);
		footerElem.appendChild(toVisitItemElem);
		
		return footerElem;
	}
		
	
PlaceDashboard.updatePlaceFooter = 
	function(data){
		if (document.getElementById("user_place_footer_" + data.place.nome) === null)
			return;
	
		var itemFooter;
		// Visited item
		itemFooter = document.getElementById("visitedItem_" + data.place.nome);
		itemFooter.setAttribute("class", "footer_place_item check_img_" + data.placeUserStat.visitato);
		// to Visit item
		itemFooter = document.getElementById("toVisitItem_" + data.place.nome);
		itemFooter.setAttribute("class", "footer_place_item to_visit_img_" +  data.placeUserStat.daVisitare);
	}	
	
PlaceDashboard.updateNavigationPage = 
	function(currentPage, noMoreDataExist){
		// update the number of the page
		var currentPageElems = document.getElementsByClassName("currentPage");
		for (var i = 0; i < currentPageElems.length; i++)
			currentPageElems[i].textContent = /*"Page " +*/ currentPage;
		
		var previousElems = document.getElementsByClassName("previous");
		for (var i = 0; i < previousElems.length; i++){
			if (currentPage === 1){ // Disable the previous event
				previousElems[i].disabled = true;
				previousElems[i].value = " ";
			}
			else {// Enable the previous event
				previousElems[i].disabled = false;
				previousElems[i].value = currentPage-1;
			}
			
		}
		
		var nextElems = document.getElementsByClassName("next");
		for (var i = 0; i < nextElems.length; i++){
			if (noMoreDataExist){ // Disable the next event
				nextElems[i].disabled = true;
				nextElems[i].value = " ";
			}
			else{ // Enable the previous event
				nextElems[i].disabled = false;
				nextElems[i].value = currentPage+1;
			}
		}
			
		
	}
	
	/*ADMIN--------------------------------------------------------------------------------------*/
	
	PlaceDashboard.refreshDataAdmin =
	function(data){
		PlaceDashboard.removeContent();
		
		// Create new place lists (tag <ul></ul>)
		var newPlaceListElem =	PlaceDashboard.createPlaceListElement();
		
		// Create new place item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var placeItemElem = PlaceDashboard.createPlaceItemElementAdmin(data[i]);
			newPlaceListElem.appendChild(placeItemElem);
		}		
		
		document.getElementById("placeDashboard").appendChild(newPlaceListElem);
			
	}
	
	PlaceDashboard.createPlaceItemElementAdmin = 	
	function(currentData){
		var placeItemLi = document.createElement("li");
		placeItemLi.setAttribute("id", "place_item_" + currentData.place.nome);
		placeItemLi.setAttribute("class", "poster_place_item_wrapper");
		
		placeItemLi.appendChild(PlaceDashboard.createNavBarElement(currentData));
		placeItemLi.appendChild(PlaceDashboard.createCentralElement(currentData));
		placeItemLi.appendChild(PlaceDashboard.createDeleteElement(currentData));
		
		
		return placeItemLi; 
	}
	
	PlaceDashboard.createDeleteElement =
	function(currentData) {
		var deleteElem = document.createElement("div");
		deleteElem.setAttribute("class", "delete_elem");
		deleteElem.setAttribute("id", "delete_place_footer_" + currentData.place.nome);
		
		deleteElem.setAttribute("onClick", "UserPlaceEventHandler.onDeleteEvent('" + currentData.place.nome + "')");
		
		var node = document.createTextNode('Elimina');
		deleteElem.appendChild(node);
		
		return deleteElem;
	}

	
/*OSPITE-------------------------------------------------------*/

PlaceDashboard.refreshDataOspite =
	function(data){
		PlaceDashboard.removeContent();
		
		// Create new place lists (tag <ul></ul>)
		var newPlaceListElem =	PlaceDashboard.createPlaceListElement();
		
		// Create new place item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var placeItemElem = PlaceDashboard.createPlaceItemElementOspite(data[i]);
			newPlaceListElem.appendChild(placeItemElem);
		}		
		
		document.getElementById("placeDashboard").appendChild(newPlaceListElem);
			
	}
	
	PlaceDashboard.createPlaceItemElementOspite = 	
	function(currentData){
		var placeItemLi = document.createElement("li");
		placeItemLi.setAttribute("id", "place_item_" + currentData.place.nome);
		placeItemLi.setAttribute("class", "poster_place_item_wrapper");
		
		placeItemLi.appendChild(PlaceDashboard.createNavBarElement(currentData));
		placeItemLi.appendChild(PlaceDashboard.createCentralElement(currentData));		
		
		return placeItemLi; 
	}
	