$(function(){
    $('.btn').on('click', function(event){
		event.preventDefault();
        $(this).toggleClass('active');
    });
});