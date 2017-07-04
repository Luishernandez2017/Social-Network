<script>

    var data = '<?php echo $ajaxData; ?>';
 
    var url = '<?php echo $ajaxUrl; ?>';
	$(document).ready(function(){
		//$('.posts_area').html(userLoggedIn);
		
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
		
		
		//ON SCROLL
		$(window).scroll(function(){
			
			var height = $('.posts_area').height();//div containing posts
			
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts= $('.posts_area').find('.noMorePosts').val();
			
			//if height you scroll to is top of page + height o window
			if((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false'){
				$('#loading').show();
				//alert("hello");
				
				
		//MAKE A SECOND REQUEST
	var ajaxReq=	$.ajax({
			url: url,
			type: "POST",
			data:"page=" + page + "&userLoggedIn=" + data,
			cache: false,
			
			success: function(response){
				$('.posts_area').find('.nextPage').remove();//removes current .nextpage
				
				$('.posts_area').find('.noMorePosts').remove();//removes current noMorePosts
				
				$('#loading').hide();
				$('.posts_area').append(response);//
			}
			
		});
				
				
				
			}//end of if scroll block
			
			return false;//if there is no scrolling
			
		});//end (window).scroll
		
		
	});
</script>