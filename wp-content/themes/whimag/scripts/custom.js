jQuery( function($) {

jQuery('#Gallerybox').delay(3000).fadeIn(400);

$(document).ready(function(){
jQuery("ul.sf-menu").supersubs({
            minWidth:    18,
            maxWidth:    18,
            extraWidth:  1
        }).superfish();

});

 jQuery("#mobile-nav ul").hide('fast');
 jQuery(".mobile-open-click").click(function(){
 jQuery("#mobile-nav ul").toggle('fast');
 }
 );

});

document.write('<style type="text/css">.tabber{display:none;}<\/style>');

function startGallery() {
var myGallery = new gallery($('myGallery'), {
timed: true,
showArrows: true,
showCarousel: false,
embedLinks: true
});
document.gallery = myGallery;
}
if (typeof onDomReady == 'function') {
window.onDomReady(startGallery);
}
