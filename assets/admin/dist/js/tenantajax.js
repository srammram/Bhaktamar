function getBaseURL() {
    return baseUrl = base_url;
};

	function get_category(str){
		var postUrl  = getBaseURL()+'tenant/request/get_category' ;
		if (str == '') {
			$("#category").html("<option value=''>Please Select</option>");
		} else {
			$("#category").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { requesttype : str },
				cache: false,
				success: function(result){
					$("#category").html("<option value=''>Please Select</option>");
					$("#category").append(result);
				}
			});
		}
	}
	
	
	function get_subcategory(str){
		var postUrl  = getBaseURL()+'tenant/request/get_subcategory' ;
		if (str == '') {
			$("#subcategory").html("<option value=''>Please Select</option>");
		} else {
			$("#subcategory").html("<option value=''>Please Select</option>");
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { categoryid : str },
				cache: false,
				success: function(result){
					$("#subcategory").html("<option value=''>Please Select</option>");
					$("#subcategory").append(result);
				}
			});
		}
	}
	
	function get_subcategory_details(str){
		var postUrl  = getBaseURL()+'tenant/request/get_subcategory_details' ;
			$.ajax({
				type: "POST",
				url: postUrl,
				data: { subcategoryid : str },
				cache: false,
				success: function(result){
					$("#price").val(result);
				}
			});
		
	}
	
