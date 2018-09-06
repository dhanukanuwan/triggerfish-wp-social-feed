
( function ( $ ) {

    "use strict";

    window.NewsFeed = {
        init: function () {

           NewsFeed.newsFeedFilter(); 
           NewsFeed.newsFeedLinkify();

        },
        newsFeedFilter: function () {

        	const newsFeedContainer = jQuery( '.tg-newsfeed-filter-content' );

        	if ( newsFeedContainer.length > 0 ) {

	            const mixer = mixitup(newsFeedContainer, {
	                animation: {
	                    animateResizeContainer: false // required to prevent column algorithm bug
	                },
                    load: {
                        sort: 'published-date:desc'
                    }
	            });

        	}

        },
        newsFeedLinkify: function () {

        	const linkContainer = jQuery( '.tg-newsfeed-single-inner' );

        	if ( linkContainer.length > 0 ) {

        		jQuery( linkContainer ).linkify({
				    target: "_blank"
				});

        	}
        }
    };

    jQuery(document).ready(function($) {
      
      NewsFeed.init();

    });

    

} )( jQuery );
