<?php if(in_category('blog') || in_category('gallery')){
	 get_template_part('templates/content', 'blog');
	 
}  else{
	 get_template_part('templates/content', 'single');
}?>