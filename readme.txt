=== Published Articles Since Last Visit ===
Contributors: Claudiu@Padicode, Marton@WebGurus
Tags: returning visitors, suggested articles, last visit, published since last visit
Requires at least: 2.6
Tested up to: 3.0

Display a list of published articles since a visitor's last visit.

== Description ==

I like to think of this plugin as the “What Would Seth Godin Do” on steroids version. The difference is that it tackles returning visitors that have already proved engagement for your blog and it displays them the content that they are looking for.

So, here is what you need to know about this plugin:

* It allows full configuration of the message to display to your returning visitors
* It is only displaying anything to the users that are returning to your blog and only in case they have missed some of your published posts.
* The plug in doesn’t place any files on your visitors computer.
* The plug in only works if you use Google Analytics for tracking. However, if you don’t use Google Analytics no errors of any kind will show up to your visitors.
* It doesn’t display anything for the visitors that visit you from your RSS feed. (only works if you use Feedburner)
* It allows you to connect to Google Analytics and see how many people viewed the suggested articles by this plug in and how many of them clicked on them. So, you really get to know if this plug in brings any value to you or not.

[More details](http://padicode.com/blog/published-articles-since-last-visit/).

== Installation ==

Upload the "Published Articles Since Last Visit" plugin to your blog and just go through the following steps:
1. Activate it;
2. Visit the settings page and customize it (*Settings > Published Articles Since Last Visit*);
3. Add `<?php norilsk_filter($content); ?>` just before `<?php if (have_posts()) : ?>` in the Main Index File (index.php) of your theme folder;
4. Preview how your returning visitors will see it (add ?date_prev=1971 to the links where you have set up to display the list of published articles since visitor's last visit)
4. Connect to Google Analytics to get reports on the plugin impact for your traffic.

That's it. Enjoy.

== Screenshots ==
1. Displaying published articles since last visit on homepage screenshot-1.gif
2. Editing settings screenshot-2.gif
3. Google Analytics plugin impact reports screenshot-3.gif

== Frequently Asked Questions ==

= What happens if I don't use Google Analytics? =
In case you don't use Google Analytics for tracking the traffic on your blog this plugin will not display anything to your visitors.

= How does monitoring the plugin performance work? =
If you decide to have reports on how many returning visitors see the published articles since their last visit all you need to do is to enter your Google Analytics credentials in the plugin settings page, select the profile for your blog from all the profiles you have in your Google Analytics account and our tool will offer you how many unique visitors see and click on the provided links by the plugin.

= How can I preview what will returning users see? =
Based on where you display the list of published articles since visitor's last visit just add the ?date_prev=1971 to the URL.

== Changelog ==

= 1.1 =

* Fixing comment bug.
* Adding async Google Analytics tracking codes

= 1.0 =

* Initial release. Stable version. Out of beta.



