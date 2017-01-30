=== Specify Image Dimensions ===
Contributors: factmaven, ethanosullivan, nateallen
Tags: dimensions, gtmetrix, height, image, img, optimization, page speed, pagespeed, performance, specify image dimensions, width, yslow
Requires at least: 1.5.1
Tested up to: 4.7.2
Stable tag: 1.1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Automatically specify image dimensions that are missing width and/or height attributes. Helps load faster and better ranking on website speed tools such as GTmetrix.

== Description ==
> **Specify Image Dimensions** is a plugin that scans and inserts missing `width` and `height` in all `<img>` tags. Specifying the dimension allows for faster rendering by eliminating the need for unnecessary re-flows and repaints. This is particularly helpful with website speed tools such as [GTmetrix](https://gtmetrix.com) and [Google's PageSpeed](https://developers.google.com/speed/pagespeed).

= Before =
`
<img src="http://example.com/image.jpg" title="Some Title" />
<img src="http://example.com/vector.svg" class="svg" />
<img src="http://example.com/another-vector.webp" />
`

= After =
`
<img src="http://example.com/image.jpg" title"Some Title" width="100" height="25" />
<img src="http://example.com/vector.svg" class="svg" width="100%" height="auto" />
<img src="http://example.com/another-vector.webp" width="100%" height="auto" />
`

= Contribute on GitHub =
Want to help improve this plugin? Head over to our [GitHub page](https://github.com/factmaven/specify-image-dimensions)

== Installation ==
1. Upload the plugin to the `/wp-content/plugins/` directory.
1. Activate the plugin through the `Plugins` menu in WordPress.
1. Let it settle in a for a minute and be amazed.

If there are any issues or questions, head over to our [FAQ](https://wordpress.org/plugins/specify-image-dimensions/faq) or our [Support](https://wordpress.org/support/plugin/specify-image-dimensions) page.

== Frequently Asked Questions ==
= How does it work? =
The plugin will scan the contents in your posts and [*automagically*](http://www.dictionary.com/browse/automagically) specify the image dimensions by adding the correct `width` and `height`.

= Why is this important? =
Specifying a `width` and `height` for all images allows for faster rendering by eliminating the need for unnecessary re-flows and repaints. This is particularly helpful with website speed tools such as [GTmetrix](https://gtmetrix.com) and [Google's PageSpeed](https://developers.google.com/speed/pagespeed). More information can be found [here](https://developers.google.com/speed/pagespeed/module/filter-image-optimize#resize-image-dimensions).

= I'd like to contribute to this plugin and help improve it =
That's easy! If you have a GitHub account, you're more than welcome to share your contribution to our plugin which can be found [here](https://github.com/factmaven/specify-image-dimensions).

== Screenshots ==
1. Before and after result using the Specify Image Dimensions plugin from GTmetrix report.

== Changelog ==
= 1.1.0 =
*2016-01-29*
* **Fix**: images with blank dimensions weren't being detected
* Added support for additional [`img` attributes](http://www.w3schools.com/tags/tag_img.asp)

=1.0.4 =
*2016-11-28*
* **Fix**: SVG and webP images were given `0` width and height
* Various code improvements

= 1.0.3 =
* *2016-09-01*
* **Fix**: Thumbnail weren't showing up in *Pages*
* Renamed plugin file from `index.php` to `specify-image-dimensions.php`

= 1.0.2 =
* *2016-08-25*
* **Fix**: Thumbnails weren't showing in the *Media* library (thanks [ramonjosegn](https://wordpress.org/support/topic/bug-in-last-udpate))

= 1.0.1 =
* *2016-08-24*
* **Fix**: Image dimensions were not being set

= 1.0.0 =
* *2016-08-21*
* Initial release, huzzah!

== Upgrade Notice ==
= 1.0.4 =
Fixed issue with SVG and webP images set to "0" for width and height

= 1.0.2 =
Image thumbnails in Media gallery were not showing

= 1.0.1 =
Both width/height attributes weren't being inserted for some websites.