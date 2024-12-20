function UserDashboard(){};


UserDashboard.removeContent = 
	function(){
		var dashboardElement = document.getElementById("userDashboard");
		if (dashboardElement === null)
			return;
		
		var firstChild = dashboardElement.firstChild;
		if (firstChild !== null)
			dashboardElement.removeChild(firstChild);
	
	}
	
UserDashboard.setEmptyDashboard = 
	function(){
		UserDashboard.removeContent();
		
		var dashboardElement = document.getElementById("userDashboard");  /*messo io*/
		if (dashboardElement === null)
			return;
		
		
		var warningDivElem = document.createElement("div");
		warningDivElem.setAttribute("class", "warning");
		var warningSpanElem = document.createElement("span");
		warningSpanElem.textContent = "Non ci sono utenti da visualizzare";
		
		warningDivElem.appendChild(warningSpanElem);
		dashboardElement.appendChild(warningDivElem);
		
	}
	
UserDashboard.refreshData =
	function(data, search){
		UserDashboard.removeContent();
		
		// Create new place lists (tag <ul></ul>)
		var newUserListElem =	UserDashboard.createUserListElement();
		
		// Create new place item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var userItemElem = UserDashboard.createUserItemElement(data[i], search);
			newUserListElem.appendChild(userItemElem);
		}		
		
		document.getElementById("userDashboard").appendChild(newUserListElem);
			
	}
	
UserDashboard.createUserListElement = 
	function(){
		var userListElem = document.createElement("ul");
		userListElem.setAttribute("id", "userList");
		userListElem.setAttribute("class", "user_list");
		
		return userListElem;
	}
	
UserDashboard.createUserItemElement = 	
	function(currentData, search){
		var userItemLi = document.createElement("li");
		userItemLi.setAttribute("id", "user_item_" + currentData.nomeUtente);
		userItemLi.setAttribute("class", "user_item_wrapper");
		
		userItemLi.appendChild(UserDashboard.createUsernameElement(currentData));
		userItemLi.appendChild(UserDashboard.createEmailElement(currentData));
		userItemLi.appendChild(UserDashboard.createNomeElement(currentData));
		userItemLi.appendChild(UserDashboard.createCognomeElement(currentData));
		userItemLi.appendChild(UserDashboard.createDeleteElement(currentData, search));

		
		
		return userItemLi; 
	}
	
UserDashboard.createUsernameElement =
	function(currentData){
		var usernameElem = document.createElement("div");
		usernameElem.setAttribute("class", "user_div username");
		
		var para1 = document.createElement("p");
		para1.setAttribute("class", "title");
		var node1 = document.createTextNode('Utente:');
		para1.appendChild(node1);
		var para = document.createElement("p");
		var node = document.createTextNode(currentData.nomeUtente);
		para.appendChild(node);
		
		usernameElem.appendChild(para1);
		usernameElem.appendChild(para);
		
		return usernameElem;
	}
	
UserDashboard.updateNavigationPage = 
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
	
UserDashboard.createEmailElement =
	function(currentData){
		var emailElem = document.createElement("div");
		emailElem.setAttribute("class", "user_div email");
		
		var para1 = document.createElement("p");
		para1.setAttribute("class", "title");
		var node1 = document.createTextNode('Email:');
		para1.appendChild(node1);
		var para = document.createElement("p");
		var node = document.createTextNode(currentData.email);
		para.appendChild(node);

		emailElem.appendChild(para1);		
		emailElem.appendChild(para);
		
		return emailElem;
	}
	
UserDashboard.createNomeElement =
	function(currentData){
		var nomeElem = document.createElement("div");
		nomeElem.setAttribute("class", "user_div nome");
		
		var para1 = document.createElement("p");
		para1.setAttribute("class", "title");
		var node1 = document.createTextNode('Nome:');
		para1.appendChild(node1);
		var para = document.createElement("p");
		var node = document.createTextNode(currentData.nome);
		para.appendChild(node);
		
		nomeElem.appendChild(para1);
		nomeElem.appendChild(para);
		
		return nomeElem;
	}
	
UserDashboard.createCognomeElement =
	function(currentData){
		var cognomeElem = document.createElement("div");
		cognomeElem.setAttribute("class", "user_div cognome");
		
		var para1 = document.createElement("p");
		para1.setAttribute("class", "title");
		var node1 = document.createTextNode('Cognome:');
		para1.appendChild(node1);
		var para = document.createElement("p");
		var node = document.createTextNode(currentData.cognome);
		para.appendChild(node);

		cognomeElem.appendChild(para1);		
		cognomeElem.appendChild(para);
		
		return cognomeElem;
	}
	
UserDashboard.createDeleteElement =
	function(currentData, search) {
		
		// Create delete div elem (tag <div></div>)
		var deleteItemElem = document.createElement("div");
		deleteItemElem.setAttribute("id", "deleteItem_" + currentData.nomeUtente);
		deleteItemElem.setAttribute("class", "delete_user_item" /*"check_img_" + currentData.placeUserStat.visitato*/);
		deleteItemElem.setAttribute("onClick", "UserEventHandler.onDeleteEvent('" + currentData.nomeUtente + "', " + search + ")");
		
		var para = document.createElement("p");
		var node = document.createTextNode('Elimina');
		para.appendChild(node);
		deleteItemElem.appendChild(para);

		
		return deleteItemElem;
	}