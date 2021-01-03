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


      const [todayFullYear, todayMonth, todayDate] = today.toLocaleString('fa').split('°')[0].split('/');
	  
	  
	  
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
						showSnackBar('green' , '„‘Œ’«  ‘„« «—”«· ‘œ. »Â “ÊœÌ »« ‘„«  „«” „ÌêÌ—Ì„');
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
 			$('.tooltip-inner').text('—„“ œ«‰·Êœ òÅÌ ‘œ');
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


        success: function (data) {
            var options = [];
            options.push("<option value='0' disabled> ---  ·ÿ›« ‘Â— «‰ Œ«» ò‰Ìœ --- </option>")
            for (var i = 0; i < data.length; i++) {
                options.push('<option value="',
                    data[i]['id'], '">',
                    data[i]['city'], '</option>');
            }
            $("#city_list").html(options.join(''));
        }
		
		
		
		/* Video Uploader */
function uploadToServer(){
    var file = document.getElementById('video').files[0];
    var formData = new FormData();
    var httpReq = new XMLHttpRequest();
    var metas = document.getElementsByTagName('meta');

    formData.append('video', file);
    httpReq.upload.addEventListener('progress', progressFunc);
    httpReq.addEventListener('load', loadFunc);
    httpReq.addEventListener('error', errorFunc);
    httpReq.addEventListener('abort', abortFunc);
    httpReq.open('post', 'http://localhost:8000/admin/videos/upload');

    for (i=0; i<metas.length; i++) {
        if (metas[i].getAttribute("name") == "csrf-token") {
            httpReq.setRequestHeader("X-CSRF-Token", metas[i].getAttribute("content"));
        }
    }
    httpReq.send(formData);
}
function progressFunc(event){
    var loaded = (event.loaded)/100;
    var total = (event.total)/100;
    document.getElementById('loaded').innerHTML = "uploaded " + loaded + "Kilobytes of "+
        total;
    var percent = (event.loaded / event.total) *100;
    var p = Math.round(percent);
    document.getElementById('prog').style.width = p + '%';
    document.getElementById('percent').innerHTML = p + "% ¬Å·Êœ ‘œÂ" ;
    if(p == 100){
        setTimeout(function () {
            alert('Done');
            document.getElementById('prog').style.width = 0 + '%';
            document.getElementById('video').value = '';
        },2000)
    }
}
function loadFunc(event){
    document.getElementById('result').innerHTML = event.target.responseText;
}
function errorFunc(){
    document.getElementById('result').innerHTML = "Œÿ« œ— ¬Å·Êœ";
}
function abortFunc(){
    document.getElementById('result').innerHTML = "¬Å·Êœ ·€Ê ‘œ!";
}
function Cancel(){
    location.reload();
}
/* Video Uploader */


/* Random Password */
$('#rand_pass').click(function () {
        var str = [];
        var str1 = 'abcdefghijklmmnopqrstuwxyz';
        var str2 = '1234567890';
        var str3 = '!@#$%^&*';
        var ss1 = shuffle(str1);
        ss1 = ss1.substr(0,4)
        var ss2 = shuffle(str2);
        ss2 = ss2.substr(0,2)
        var ss3 = shuffle(str3);
        ss3 = ss3.substr(0,2)
        str = ss1+ss2+ss3;
        function shuffle(string) {
            var parts = string.split('');
            for (var i = parts.length; i > 0;) {
                var random = parseInt(Math.random() * i);
                var temp = parts[--i];
                parts[i] = parts[random];
                parts[random] = temp;
            }
            return parts.join('');
        }
        str = shuffle(str);
        $('#reg_password').val(str);
        $('#reg_passwordconfirm').val(str);

    })
/* Random Password */




        // powerPass //
        var power = 0;
        var char1 = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var char2 = "0123456789";
        var char3 = "!@#$&*";
        for (var i = 0; i < val.length; i++) {
            var n1 = char1.indexOf(val[i]);
            if (n1 > 0) {
                power++;
                break;
            }
        }
        for (var i = 0; i < val.length; i++) {
            var n2 = char2.indexOf(val[i]);
            if (n2 > 0) {
                power++;
                break;
            }
        }
        for (var i = 0; i < val.length; i++) {
            var n3 = char3.indexOf(val[i]);
            if (n3 > 0) {
                power++;
                break;
            }
        }
        if (val.length < 6) {
            power--;
        }


        console.log(power);

        switch (power) {
            case 0:
                $('div.powerpass').find('span').text('');
                $('div.powerpass').css({
                    'background-color': '#C91F37',
                    'width': '0'
                })
                break;
            case 1:
                $('div.powerpass').find('span').text('—„“ ⁄»Ê—: ÷⁄Ì›');
                $('div.powerpass').css({
                    'background-color': '#DC3023',
                    'width': '33%'
                })
                break;
            case 2:
                $('div.powerpass').find('span').text('—„“ ⁄»Ê—: „ Ê”ÿ');
                $('div.powerpass').css({
                    'background-color': '#FFA400',
                    'width': '66%'
                })
                break;
            case 3:
                $('div.powerpass').find('span').text('—„“ ⁄»Ê—: ﬁÊÌ');
                $('div.powerpass').css({
                    'background-color': '#26C281',
                    'width': '100%'
                })
                break;
        }
        // powerPass //
	  
	  
	  $('.do_action').click(function (e) {
        e.preventDefault();
        var dataId=[];
        var count = $('input#counter').val();
        for (i=1; i<=count; i++){
            var checked_status = $('#catChk'+i).prop('checked');
            if(checked_status == true){
                dataId.push($('#catChk'+i).data('id'));
            }
        }

        if(dataId.length == 0){
            alert('ÂÌç ¬Ì „Ì «‰ Œ«» ‰‘œÂ «” ');
        }else{
            $(this).find('i').css('display', 'inline-block').addClass('fa-spin');
            var data_to_send = JSON.stringify(dataId);
            $.ajax({
                url: '/admin/cat_bulk_delete',
                type: 'POST',
                data: { ids: data_to_send , '_token': $('meta[name="csrf-token"]').attr('content') },
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if (data == 1){
                        location.reload();
                    }else {
                        alert('Œÿ« œ— ⁄„·Ì« !');
                        $('.do_action').find('i').css('display', 'none').removeClass('fa-spin');
                    }
                }, error:function (err) {
                    console.log(err);
                }
            });

        }

    });
	
	// Elevate Zoom for Product Page image
    $("#zoom_01").elevateZoom({
        gallery: 'gallery_01',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500,
        zoomWindowPosition: 11,
        lensFadeIn: 500,
        lensFadeOut: 500,
        loadingIcon: 'image/progress.gif'
    });
    //////pass the images to swipebox
    $("#zoom_01").bind("click", function (e) {
        var ez = $('#zoom_01').data('elevateZoom');
        $.swipebox(ez.getGalleryList());
        return false;
    });
	
	
	$('button#cap').click(function () {
        $.ajax({
            type: "GET",
            url: "captcha",
            success: function (response) {
                $('img#captcha').attr('src', response);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
	
	$(".alert-danger").delay(4000).slideUp(500, function() {
		$(this).alert('close');
	});
	
	
	$(".tab li").click(function () {
        $(".tab li").removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $(".tab-content .section").hide();
        $(".tab-content .section").eq(index).fadeIn(200);
    });
})