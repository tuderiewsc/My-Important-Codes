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

			 
})