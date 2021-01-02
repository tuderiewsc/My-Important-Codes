$(document).ready(function () {
	
		 var url = new URL(window.location.href);
		 var params = new window.URLSearchParams(window.location.search);
		 var filters = JSON.parse(params.get('filters') || "{}");
		 $('#search_frm_input').val(filters.search_phrase);

		let allSites = <%- JSON.stringify(listOfSites) %>;
	
	
	 let eligibleInputs = Array.from(document.querySelectorAll('input[name="selectedSite"]'))
		 .filter(input => selectedCityIds.indexOf(input.getAttribute('city_id')) != -1);
	 eligibleInputs.forEach(input => $(input).prop('checked', true));
			 
			 
	 const sitesFilteredByQuery = allSites.filter(s => {
			const sumSQ = initialQueriesSites.filter(sq => sq.siteId == s._key).reduce((s, sq) => s + sq.count, 0);
			 
			 
			 if (!Array.from(document.querySelectorAll('input[name="selectedSite"]:checked')).length) {
                        $('#sitesFilterCheckBox-all').prop('checked', true);
                    }
					
					
					$(document).click(function (e) {
                if ($(e.target).closest('#sortByDropdownMenuButton').length === 0) {
                    $('#sortByDropdownMenuButton').find('i').text('keyboard_arrow_down');
                }
            });
			
			
			$(".products_list").after($(`
                    <div class="loading d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    `).fadeIn('slow')).data("loading", true);
					
					
					selectedSitesIds = Array.from(document.querySelectorAll('input[name="selectedSite"]:checked'))
                            .map(e => $(e).val());
							
							
			filters.site_id = selectedSitesIds.join(','); //to join the array elements into a string
			
			
			window.history.replaceState({ url: url }, null, url);
			
			
			// to locate the last occurrence of a specified value
			var productsUrl = new URL(url.substr(0, url.lastIndexOf('/')) + '/api/v1/products');
			
			
			// load dynamic data
			let lastScrollY = 0;
            window.addEventListener('scroll', async (event) => {
                const diff = window.scrollY - lastScrollY; // scrolling down
                lastScrollY = window.scrollY;
                if (diff > 0 && (canLoadMoreProducts || canLoadMoreCrawledProducts) && isLoading == false && (window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
                    loadData();
                }
            });


if(!isNaN(val.featured_image))


 const { min, max } = list_date.reduce((o, d) => {
        o.min = (o.min > d.min_price ? d.min_price : o.min);
        o.max = (o.max < d.max_price ? d.max_price : o.max);
        return o;
      }, { min: Number.MAX_SAFE_INTEGER, max: -1 });


      const [todayFullYear, todayMonth, todayDate] = today.toLocaleString('fa').split('¡')[0].split('/');
	  
	  
	  
	  groups[k].push({ min_price: d.min_price, max_price: d.max_price });
	  minPrice = Math.min(...groups[dateStr].map(o => o.min_price));
      maxPrice = Math.max(...groups[dateStr].map(o => o.max_price));
      avgPrice = parseFloat(((maxPrice + minPrice) / 2).toFixed(2));


if (staticSites) {
      sitesResponse = { data: staticSites };
      await Promise.delay(1500);
    } else {
      sitesResponse = await axios.get(`/api/v1/products/${product._key}/sites`);
    }
	
	var fruits = ["Banana", "Orange", "Lemon", "Apple", "Mango"];
  var citrus = fruits.slice(1, 3);
  Orange,Lemon
  
  
  $('.close_filter_tag').click(function () {
		let li_element = $(this).parents('li');
		li_element.remove();
	});
	
	
			if (value === ''){
			$(this).siblings('.invalid-feedback').css('display', 'block');
			is_name_validate = false;
		}
		
		
		
	$('.signup_frm').change(); // call programitically
	$('.signup_frm').on('change' , function () {})

		let urlRejex = /^http:\/\/|(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
		let is_url_valid = urlRejex.test(value);

	$.ajax({
				url: '/api/v1/users/forms/report',
				type: 'POST',
				data: { 'report_type':'shopSignup' ,'full_name':name+family ,'email':email ,'reason':link_phone_desc ,'shop_name':shop_name  },
				dataType: 'JSON',
				success: function (data , xhr) {
					if (xhr === 'success'){
						showSnackBar('green' , 'ãÔÎÕÇÊ ÔãÇ ÇÑÓÇá ÔÏ. Èå ÒæÏí ÈÇ ÔãÇ ÊãÇÓ ãííÑíã');
						resetSignUpForm();
					} else {
						showSnackBar('red' , xhr);
					}
				}, error:function (err) {
					//console.log(err);
				}, complete:function () {
					$('#signup_frm_submit').find('i').css('visibility', 'hidden').removeClass('fa-spin');
				},
	timeout:10000
			});
			
			
			
			document.getElementById("myForm").reset();
			
			let value = $(this).val().toLowerCase();
		$("#sitesCollapse").find('.form-check').filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
		
		
		// copyToClipboard //
function copyToClipboard(element) {
 			var $temp = $("<input>");
 			$("body").append($temp);
 			$temp.val($(element).text()).select();
 			document.execCommand("copy");
 			$temp.remove();
 			//$('div.toast').css('display', 'block');
 			$('.tooltip-inner').text('ÑãÒ ÏÇäáæÏ ˜í ÔÏ');
 }
 
		
		
		$('#shops_search').trigger('input'); // input event trigger manually
		
		
		
			$('#shops_list_search').on('input' , function () {
		window.scrollTo(0,document.body.scrollHeight);



// Back to top btn
	$(window).scroll(function(event) {
		if ($(this).scrollTop() > 600) {
			$('#scroll_to_top_btn').css('transform', 'translateX(125px) rotateZ(360deg)');
		} else {
			$('#scroll_to_top_btn').css('transform', 'translateX(-125px) rotateZ(-360deg)');
		}
	});
	$('#scroll_to_top_btn').on('click', function () {
		$('html,body').animate({
			scrollTop: 0
		}, 0);
	});
	
	
	$.fn.digits = function () {
		return this.each(function () {
			$(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		})
	};
	$('.digits').digits();
	
	
	// Multi Checkbox Table
	$('table#tbl_categories').simpleCheckboxTable();


	  
})