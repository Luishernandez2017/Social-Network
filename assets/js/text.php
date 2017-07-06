<script>



    var data;

	data = '<?php echo $ajaxData; ?>';
 
    var url;
	url = '<?php echo $ajaxUrl; ?>';
	
	var isDropdown;

	
	isDropdown = '<?php echo $ajaxVar; ?>';
var element;

		
	$(document).ready(function(){

toggleDropDown(isDropdown);
		//$('.posts_area').html(userLoggedIn);
		if(!isDropdown == 1){
			
 		win =document.defaultView;
		
			$('#loading').show();
			
			
			//LOAD 10 POSTS
			//original ajax request for loading posts	
			$.ajax({
				url: url,
				type: "POST",
				data:"page=1&userLoggedIn="+ data,
				cache: false,
				
				success: function(data){
					$('#loading').hide();
					$('.posts_area').html(data);
				}
				
			});
		}else{
				win = $('.dropdown_data_window');
		}
		
		//ON SCROLL
		$(win).scroll(function(){
			
			var height = $('.posts_area').height();//div containing posts
			if(isDropdown==1){
				var element = $('.dropdown_data_window');
				var inner_height = element.innerHeight();
				var scroll_top = element.scrollTop();
				var page = element.find('.nextPageDropdownData').val();
				var noMoreData= element.find('.noMoreDropdownData').val();
				var data = $('#dropdown_data_type');
				var condition = ((scroll_top + inner_height >= element[0].scrollHeight) && noMoreData == 'false');
						var type = $('#dropdown_data_type').val();
					//holds name of apge to send ajax request to
					// var type = dataType.val();//data value

					if(type == 'notification'){
						url +="ajax_load_notification.php";

					}else if(type == 'message'){
						url +=  "ajax_load_message.php"
					}
				
		}else{
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts= $('.posts_area').find('.noMorePosts').val();
			var condition = ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false');
		}
			//if height you scroll to is top of page + height o window
			if(condition){
				if(isDropdown==0){
				$('#loading').show();
				//alert("hello");
				
				}
		//MAKE A SECOND REQUEST
	var ajaxReq=	$.ajax({
			url: url,
			type: "POST",
			data:"page=" + page + "&userLoggedIn=" + data,
			cache: false,
			
				success: function(response){
					if(isDropdown==0){
					$('.posts_area').find('.nextPage').remove();//removes current .nextpage
					
					$('.posts_area').find('.noMorePosts').remove();//removes current noMorePosts
					
					$('#loading').hide();
					$('.posts_area').append(response);//
				}else{
			
				
					element.find('.nextPageDropdownData').remove();//removes current .nextpage
					
					element.find('.noMoreDropdownData').remove();//removes current noMorePosts
					
				
					element.append(response);//
				}
			}
			
		});
				
				
				
			}//end of if scroll block
			
			return false;//if there is no scrolling
		
		});//end (window).scroll
		
		function toggleDropDown(isDropdown){
	var dropdown= $("#dropdownBtn").click(function(){
		isDropdown=true;
	});
}

	});
</script>