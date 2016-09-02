Automatically specify image dimensions that are missing width and/or height attributes. Helps with website speed tools such as [GTmetrix](https://gtmetrix.com).

## Description
A simple and lightweight plugin that scans your website and automatically sets the appropriate image dimensions that are missing a `width` and/or `height` attributes in your `<img>` tags.

For example, here are some images with no dimensions set:
```html
<img src="http://link.to/some/img1.jpg" id="123" alt="Some Alt" />
<img class="some-class" src="http://link.to/some/img2.jpg" alt="Another Alt" />
<img class="another-class" src="http://link.to/some/img2.jpg" width="500" />
```
The plugin will get the actual image dimension and insert the width and height:
```html
<img src="http://link.to/some/img1.jpg" alt="Some Alt" id="123" width="500" height="350" />
<img src="http://link.to/some/img1.jpg" alt="Another Alt" class="some-class" width="500" height="350" />
<img src="http://link.to/some/img1.jpg" class="another-class" width="500" height="350" />
```

### Why is this important? 
Specifying a `width` and `height` for all images allows for faster rendering by eliminating the need for unnecessary re-flows and repaints. This is particularly helpful with website speed tools such as [GTmetrix](https://gtmetrix.com) and [Google's PageSpeed](https://developers.google.com/speed/pagespeed).

> **More details from Google**
>
> When the browser lays out the page, it needs to be able to flow around replaceable elements such as images. It can begin to render a page even before images are downloaded, provided that it knows the dimensions to wrap non-replaceable elements around. If no dimensions are specified in the containing document, or if the dimensions specified don't match those of the actual images, the browser will require a reflow and repaint once the images are downloaded. To prevent reflows, specify the width and height of all images, either in the HTML <img> tag, or in CSS.
>
> **Reference**: [GTmetrix](https://gtmetrix.com/specify-image-dimensions.html)

## Installation 
1. Upload the plugin to the `/wp-content/plugins/` directory.
1. Activate the plugin through the `Plugins` menu in WordPress.
1. Let it settle in a for a minute and be amazed.

If there are any issues or questions, head over to our [FAQ](https://wordpress.org/plugins/specify-image-dimensions/faq) or our [Support](https://wordpress.org/support/plugin/specify-image-dimensions) page.

## Frequently Asked Questions 
### How does it work? 
The plugin will scan the contents in your posts and [*automagically*](http://www.dictionary.com/browse/automagically) specify the image dimensions by adding the correct `width` and `height`.

### Why is this important? 
Specifying a `width` and `height` for all images allows for faster rendering by eliminating the need for unnecessary re-flows and repaints. This is particularly helpful with website speed tools such as [GTmetrix](https://gtmetrix.com) and [Google's PageSpeed](https://developers.google.com/speed/pagespeed). More information can be found [here](https://developers.google.com/speed/pagespeed/module/filter-image-optimize#resize-image-dimensions).