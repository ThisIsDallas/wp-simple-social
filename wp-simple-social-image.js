jQuery(document).ready(function() {
 
jQuery('.upload_image_button').click(function() {
 formfield = jQuery('.upload_image').attr('name');
 tb_show('','media-upload.php?type=image&TB_iframe=true');
 return false;
});
 
	window.send_to_editor = function(html) {
		// html returns a link like this:
		// <a href="{server_uploaded_image_url}"><img src="{server_uploaded_image_url}" alt="" title="" width="" height"" class="alignzone size-full wp-image-125" /></a>
		var image_url = jQuery('img',html).attr('src');
		//alert(html);
		jQuery('.upload_image').val(image_url);
		tb_remove();
		
	}
 
});


