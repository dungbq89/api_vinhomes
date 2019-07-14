$(function(){
	/*var menubar = $('#menubar').position();
	$(window).scroll(function (event) {
		if ($(this).scrollTop() > (menubar.top )) {
			$('#menubar').css( { 'position' : 'fixed', 'top' : '0px','z-index' : '9999999', 'left':'0px', 'width' : '100%' } );
			$('.home-logo').show();
		}else{
			$('#menubar').css( { 'position' : '', 'top' : '','border-bottom':'none' } );
			$('.home-logo').hide();
		} 
	}); */
	$('#btnsearchpc').click(function(){
		 $(this).parent().toggleClass("active");
		$(".box-search-top").slideToggle();
		return false;
	});
	$('#btn-search-mobile').click(function(){
		 $(this).parent().toggleClass("active");
		$(".box-search-mobile").slideToggle();
		return false;
	});
	$('.nav li').hover(function(){
		$('ul:first',this).stop().slideDown();
	},function(){
		$('ul',this).hide();	
	});
	
	$('.tab-detail li').click(function(){
		$('.tab-detail li').removeClass('active');
		$(this).addClass('active');
		$('.tabcontentdetail').hide();
		$('#' + $(this).attr('data-content')).show();
		initializeMaps();
	});
	$(".datepk").datepicker({
			dateFormat: 'dd/mm/yy'	,
			minDate: "Now",
			maxDate: "+1y"
		});
	
	
	$('.hotline-header, .email-header').hover(function(){
		$('.box',this).stop().slideDown();
	},function(){
			$('.box',this).stop().hide();
	});
});
