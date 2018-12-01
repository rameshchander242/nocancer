$(document).ready(function(){
	$("#foodsearch").typeahead({
    source: function (query, result) {
      $.ajax({
        url: SITE_URL+"/food/food_search",
				data: "search=" + query,            
        dataType: "json",
        type: "POST",
        success: function (data) {
					result($.map(data, function (item) {
						return item;
          }));
        }
      });
    }
	});
});


$(window).scroll(function() {    
  var scroll = $(window).scrollTop();
  if (scroll >= 10) {
    $(".main-header").addClass("header-green");
  } else {
    $(".main-header").removeClass("header-green");
  }
});	