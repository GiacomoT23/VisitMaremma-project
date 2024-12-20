function ReviewDashboard(){};


ReviewDashboard.removeContent = 
	function(){
		var dashboardElement = document.getElementById("reviewDashboard");
		if (dashboardElement === null)
			return;
		
		var firstChild = dashboardElement.firstChild;
		if (firstChild !== null)
			dashboardElement.removeChild(firstChild);
		
		var firstChild = dashboardElement.firstChild;
		if (firstChild !== null)
			dashboardElement.removeChild(firstChild);
	
	}
	
ReviewDashboard.setEmptyDashboard = 
	function(){
		ReviewDashboard.removeContent();
		
		var dashboardElement = document.getElementById("reviewDashboard");  /*messo io*/
		if (dashboardElement === null)
			return;
		
		
		var warningDivElem = document.createElement("div");
		warningDivElem.setAttribute("class", "warning");
		var warningSpanElem = document.createElement("span");
		warningSpanElem.textContent = "Non ci sono recensioni da visualizzare";
		
		warningDivElem.appendChild(warningSpanElem);
		dashboardElement.appendChild(warningDivElem);
		
	}
	
ReviewDashboard.refreshData =
	function(data){
		ReviewDashboard.removeContent();
		
		// Create new review lists (tag <ul></ul>)
		var newReviewListElem =	ReviewDashboard.createReviewListElement();
		
		// Create new review item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var reviewItemElem = ReviewDashboard.createReviewItemElement(data[i]);
			newReviewListElem.appendChild(reviewItemElem);
		}		
		
		document.getElementById("reviewDashboard").appendChild(newReviewListElem);
		
		if(data.length == ReviewLoader.REVIEW_TO_LOAD){
			var showMoreElement = ReviewDashboard.createReviewShowMoreElement(data[0].nomeLuogo, 0);
			document.getElementById("reviewDashboard").appendChild(showMoreElement);
		}

			
	}
	
ReviewDashboard.createReviewListElement = 
	function(){
		var reviewListElem = document.createElement("ul");
		reviewListElem.setAttribute("id", "reviewList");
		reviewListElem.setAttribute("class", "review_list");
		
		return reviewListElem;
	}
	
ReviewDashboard.createReviewItemElement = 	
	function(currentData){
		var reviewItemLi = document.createElement("li");
		reviewItemLi.setAttribute("id", "review_item_" + currentData.nomeUtente);
		reviewItemLi.setAttribute("class", "review_item_wrapper");
		
		reviewItemLi.appendChild(ReviewDashboard.createNavBarElement(currentData));
		reviewItemLi.appendChild(ReviewDashboard.createRatingElement(currentData));
		reviewItemLi.appendChild(ReviewDashboard.createReviewElement(currentData));
		
		
		return reviewItemLi; 
	}
	
ReviewDashboard.createNavBarElement =
	function(currentData){
		var navBarElem = document.createElement("nav");
		navBarElem.setAttribute("class", "name_review_nav_bar");
		
		var para = document.createElement("p");
		var node = document.createTextNode(currentData.nomeUtente+':');
		para.appendChild(node);
		
		navBarElem.appendChild(para);
		
		return navBarElem;
	}
	
ReviewDashboard.createRatingElement =
	function(currentData){
		var ratingElem = document.createElement("div");
		ratingElem.setAttribute("class", "item_rating");
		
		var rat = currentData.valutazione;
		for(var i=1; i<=rat; i++){
			var img = document.createElement("div");
			img.setAttribute("class", "star");
			ratingElem.appendChild(img);
		}
		if((rat%1) != 0){
			var img = document.createElement("div");
			img.setAttribute("class", "half_star");
			ratingElem.appendChild(img);
		}
		
		return ratingElem;
	}
	
ReviewDashboard.createReviewElement =
	function(currentData){
		var reviewElem = document.createElement("div");
		reviewElem.setAttribute("class", "review_content");
		
		var para = document.createElement("p");
		var node = document.createTextNode(currentData.recensione);
		para.appendChild(node);
		
		var istante = document.createElement("p");
		istante.setAttribute("class", "istante");
		var node1 = document.createTextNode(currentData.istante);
		istante.appendChild(node1);
		
		reviewElem.appendChild(para);
		reviewElem.appendChild(istante);

		return reviewElem;
	}
	
	/*ADMIN*/
	
ReviewDashboard.refreshDataAdmin =
	function(data){
		ReviewDashboard.removeContent();
		
		// Create new review lists (tag <ul></ul>)
		var newReviewListElem =	ReviewDashboard.createReviewListElement();
		
		// Create new review item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var reviewItemElem = ReviewDashboard.createReviewItemElementAdmin(data[i]);
			newReviewListElem.appendChild(reviewItemElem);
		}		
		
		document.getElementById("reviewDashboard").appendChild(newReviewListElem);
		
		if(data.length == ReviewLoader.REVIEW_TO_LOAD){
			var showMoreElement = ReviewDashboard.createReviewShowMoreElement(data[0].nomeLuogo, 1);
			document.getElementById("reviewDashboard").appendChild(showMoreElement);
		}
			
	}
	
ReviewDashboard.createReviewItemElementAdmin = 	
	function(currentData){
		var reviewItemLi = document.createElement("li");
		reviewItemLi.setAttribute("id", "review_item_" + currentData.nomeUtente);
		reviewItemLi.setAttribute("class", "review_item_wrapper");
		
		reviewItemLi.appendChild(ReviewDashboard.createNavBarElement(currentData));
		reviewItemLi.appendChild(ReviewDashboard.createRatingElement(currentData));
		reviewItemLi.appendChild(ReviewDashboard.createReviewElement(currentData));
		reviewItemLi.appendChild(ReviewDashboard.createDeleteElement(currentData));
		
		return reviewItemLi; 
	}
	
ReviewDashboard.createDeleteElement =
	function(currentData) {
		
		// Create delete div elem (tag <div></div>)
		var deleteItemElem = document.createElement("div");
		deleteItemElem.setAttribute("id", "deleteItem_" + currentData.nomeUtente);
		deleteItemElem.setAttribute("class", "delete_review_item" /*"check_img_" + currentData.placeUserStat.visitato*/);
		deleteItemElem.setAttribute("onClick", "ReviewEventHandler.onDeleteEvent('" + currentData.nomeLuogo + "', '" + currentData.nomeUtente + "')");
		
		var para = document.createElement("p");
		var node = document.createTextNode('Elimina');
		para.appendChild(node);
		deleteItemElem.appendChild(para);

		
		return deleteItemElem;
	}
	
ReviewDashboard.createReviewShowMoreElement =
	function(nomeLuogo, admin) {
		var showMoreElement = document.createElement("div");
		showMoreElement.setAttribute("id", "showMoreItem");
		showMoreElement.setAttribute("class", "showMore_review_item" /*"check_img_" + currentData.placeUserStat.visitato*/);
		showMoreElement.setAttribute("onClick", "ReviewEventHandler.onAddEvent('" + nomeLuogo + "', '" + admin + "')");
		
		var para = document.createElement("p");
		var node = document.createTextNode('Carica altre recensioni');
		para.appendChild(node);
		showMoreElement.appendChild(para);

		
		return showMoreElement;
}

ReviewDashboard.removeShowMore = 
	function() {
		var showMoreElement = document.getElementById("showMoreItem");
		showMoreElement.remove();
}

ReviewDashboard.addData =
	function(data) {
		var reviewListElem =	document.getElementById("reviewList");
		
		// Create new review item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var reviewItemElem = ReviewDashboard.createReviewItemElement(data[i]);
			reviewListElem.appendChild(reviewItemElem);
		}
		
		if(data.length < ReviewLoader.REVIEW_TO_LOAD){
			ReviewDashboard.removeShowMore();
		}
	}
	
ReviewDashboard.addDataAdmin =
	function(data) {
		var reviewListElem =	document.getElementById("reviewList");
		
		// Create new review item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var reviewItemElem = ReviewDashboard.createReviewItemElementAdmin(data[i]);
			reviewListElem.appendChild(reviewItemElem);
		}
		
		if(data.length < ReviewLoader.REVIEW_TO_LOAD){
			ReviewDashboard.removeShowMore();
		}
	}