=== Bit.ly Shortlinks ===
Contributors: joostdevalk
Donate link: http://yoast.com/donate/
Tags: shortlink, shortlinks, url shortener, bitly
Requires at least: 2.8
Tested up to: 3.2
Stable tag: 0.2

This plugin replaces the default WordPress shortlinks with bit.ly shortlinks. 

== Description ==

WordPress generates shortlinks for your posts and pages. By default it uses the `?p=` with the post ID added to it, but if you have a rather long domain name this isn't very useful. If you use [Bit.ly](http://bit.ly/), or even better, [Bit.ly Pro](http://bit.ly/pro/), this plugin will help you: it replaces the shortlink WordPress generates with a proper Bit.ly shortlink.

The plugin replaces the 3.1+ Admin Bar "Shortlink" item with a Bit.ly menu, linking to the stats page and allowing you to share the link on Twitter.

Other interesting stuff:

* The plugin page on Yoast.com: [Bit.ly shortlinks](http://yoast.com/wordpress/bitly-shortlinks/).
* Check out the other [Wordpress plugins](http://yoast.com/wordpress/) by the same author.
* Want to increase traffic to your WordPress blog? Check out the [WordPress SEO](http://yoast.com/articles/wordpress-seo/) Guide!
* Check out the authors [WordPress Hosting](http://yoast.com/articles/wordpress-hosting/) experience. Good hosting is hard to come by, but it doesn't have to be expensive, Joost tells you why!
* If you've still not seen enough, or you'd rather listen than read, check out the [WordPress Podcast](http://wp-community.org/), hosted by the author of this plugin and Frederick Townes, the creator of [W3 Total Cache](http://wordpress.org/extend/plugins/w3-total-cache/).

== Installation ==

1. Upload the `plugin` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Follow the [Configuration guidelines](http://yoast.com/wordpress/bitly-shortlinks/#configure)

== Changelog ==

= 0.2 =

* Fix bug when Bit.li API doesn't respond appropriately.
* Trimmed return from Bit.ly as it could contain an extra line break that broke things.
* Added option to use j.mp instead of bit.ly by defining `BITLY_JMP` to true in *wp-config.php*.

= 0.1 =

* Initial release.

== Screenshots ==

1. Screenshot of the admin bar item.
2. Screenshot of the prompt with a custom Bit.ly pro link.