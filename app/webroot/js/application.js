function hecYear(){
	base_year = 2012;
	base_hec_year = 87;
	var date = new Date();
	if( (date.getMonth()) >= 5 ){ // 0 is January, 1 is February, etc.
		// It's June. We're thinking about next year.
		return base_year - 1924;
	}else{
		return base_year - 1925;
	}
	
}

document.onreadystatechange = function(){
	if(this.readyState ==  "complete"){
		if(document.location.pathname.search("profiles/add")){
			var userType = document.getElementById("UserType");
			userType.onchange = function(){
				var eventSelect = document.getElementById("EventEvent");
				var companyInput = document.getElementById("UserCompany");
				if(this.value === "attendee"){
					// disable
					eventSelect.disabled = "disabled";
					companyInput.value = "";
					companyInput.disabled = "";
				}else{
					//enable
					eventSelect.disabled = "";
					companyInput.value = "Hotel Ezra Cornell "+hecYear();
					companyInput.disabled = "disabled";
				}
			}
		}
	}
}