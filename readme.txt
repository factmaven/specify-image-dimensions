=== Specify Image Dimensions ===
Contributors: factmaven, ethanosullivan, nateallen
Tags: specify image dimensions, image, img, dimensions, width, height, gtmetrix, yslow, pagespeed, page speed, optimization, performance
Requires at least: 1.5.1
Tested up to: 4.6
Stable tag: 1.0.3
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Automatically specify image dimensions that are missing width and/or height attributes. Helps with website speed tools such as <a href="https://gtmetrix.com">GTmetrix</a>.

== Description ==
A simple and lightweight plugin that scans your website and automatically sets the appropriate image dimensions that are missing a `width` and/or `height` attributes in your `<img>` tags.

For example, here are some images with no dimensions set:
`
<img src="http://link.to/some/img1.jpg" id="123" alt="Some Alt" />
<img class="some-class" src="http://link.to/some/img2.jpg" alt="Another Alt" />
<img class="another-class" src="http://link.to/some/img2.jpg" width="500" />
`
The plugin will get the actual image dimension and insert the width and height:
`
<img src="http://link.to/some/img1.jpg" alt="Some Alt" id="123" width="500" height="350" />
<img src="http://link.to/some/img1.jpg" alt="Another Alt" class="some-class" width="500" height="350" />
<img src="http://link.to/some/img1.jpg" class="another-class" width="500" height="350" />
`
= Why is this important? =
Specifying a `width` and `height` for all images allows for faster rendering by eliminating the need for unnecessary re-flows and repaints. This is particularly helpful with website speed tools such as <a href="https://gtmetrix.com">GTmetrix</a> and <a href="https://developers.google.com/speed/pagespeed/">Google's PageSpeed</a>.

> **More details from Google**
>
> When the browser lays out the page, it needs to be able to flow around replaceable elements such as images. It can begin to render a page even before images are downloaded, provided that it knows the dimensions to wrap non-replaceable elements around. If no dimensions are specified in the containing document, or if the dimensions specified don't match those of the actual images, the browser will require a reflow and repaint once the images are downloaded. To prevent reflows, specify the width and height of all images, either in the HTML <img> tag, or in CSS.
>
> **Reference**: [GTmetrix](https://gtmetrix.com/specify-image-dimensions.html)

= Contribute on GitHub =
[View this plugin on GitHub](https://github.com/factmaven/specify-image-dimensions)

We're always looking for suggestions to improve our plugin!

== Installation ==
1. Upload the plugin to the `/wp-content/plugins/` directory.
1. Activate the plugin through the `Plugins` menu in WordPress.
1. Let it settle in a for a minute and be amazed.

If there are any issues or questions, head over to our [FAQ](https://wordpress.org/plugins/specify-image-dimensions/faq) or our [Support](https://wordpress.org/support/plugin/specify-image-dimensions) page.

== Frequently Asked Questions ==
= How does it work? =
The plugin will scan the contents in your posts and [*automagically*](http://www.dictionary.com/browse/automagically) specify the image dimensions by adding the correct `width` and `height`.

= Why is this important? =
Specifying a `width` and `height` for all images allows for faster rendering by eliminating the need for unnecessary re-flows and repaints. This is particularly helpful with website speed tools such as <a href="https://gtmetrix.com">GTmetrix</a> and <a href="https://developers.google.com/speed/pagespeed/">Google's PageSpeed</a>. More information can be found [here](https://developers.google.com/speed/pagespeed/module/filter-image-optimize#resize-image-dimensions).

= I'd like to contribute to this plugin and help improve it =
That's easy! If you have a GitHub account, you're more than welcome to share your contribution to our plugin which can be found [here](https://github.com/factmaven/specify-image-dimensions).

== Screenshots ==
1. Before and after result using the Specify Image Dimensions plugin from GTmetrix report.

== Changelog ==
= 1.0.3 (09/01/16) =
* **Fix**: Thumbnail weren't showing up in *Pages*
* Renamed plugin file from `index.php` to `specify-image-dimensions.php`

= 1.0.2 (08/25/16) =
* **Fix**: Thumbnails weren't showing in the *Media* library (thanks [ramonjosegn](https://wordpress.org/support/topic/bug-in-last-udpate))

= 1.0.1 (08/24/16) =
* **Fix**: Image dimensions were not being set

= 1.0.0 (08/21/16) =
* Initial release, huzzah!

== Upgrade Notice ==
= 1.0.2 =
**Problem**: Image thumbnails in Pages were not showing
**Solution**: Added exception to not apply changes anywhere in the `wp-admin`

= 1.0.2 =
**Problem**: Image thumbnails in Media gallery were not showing
**Solution**: Added exception to not apply changes on the Media page

= 1.0.1 =
**Problem**: Both width/height attributes weren't being inserted for some websites.
**Solution**: Enabled output buffering (`ob_start`) and hook the `plugins_loaded` tag instead.