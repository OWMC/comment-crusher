=== Comment Crusher ===

Contributors: olly-owmc
Donate link: owmc.co.uk
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 4.9.6
Requires PHP: 5.2.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Disable and remove comments on your WP site.

== Description ==

Many people use WP as a fully fledged CMS, building sites which don't even have a blog. In such cases, the WP comments functionality is a waste of pixels and needs completely removing. Comment Crusher was made to quickly and thoroughly clear your install of every trace of comment functionality.

For many years I have used this collection of hooks to achieve this end. So came the idea to put it in a plugin and make it available to the masses. Simply activate this plugin and never worry about comments again.

When activated, even though all pre-existing comments on your site won't be visible, they do still exist in your database. This plugin doesn't delete them. And so deactivating the plugin will restore full comments functionality and reveal all previous comments again. 

This plugin does not collect any data, neither does it modify your database.

*   Disable comment and trackback support from all post-types
*   Deactivate comments and pings on the front end
*   Hide all existing comments
*   Remove the comment metabox from the dashboard
*   Remove comments link from the toolbar
*   Remove the admin menu link for comments
*   Redirect anyone trying to access the comments admin page 

This plugin was built using the [WP Plugin Boilerplate](https://wppb.me) and the custom functionality code I think goes back to [Matt Clements in 2013](https://gist.github.com/mattclements/10a997775894c7a0eba1).


*   Stable tag should indicate the Subversion "tag" of the latest stable version, or "trunk," if you use `/trunk/` for
stable.

    Note that the `readme.txt` of the stable tag is the one that is considered the defining one for the plugin, so
if the `/trunk/readme.txt` file says that the stable tag is `4.3`, then it is `/tags/4.3/readme.txt` that'll be used
for displaying information about the plugin.  In this situation, the only thing considered from the trunk `readme.txt`
is the stable tag pointer.  Thus, if you develop in trunk, you can update the trunk `readme.txt` to reflect changes in
your in-development version, without having that information incorrectly disclosed about the current stable version
that lacks those changes -- as long as the trunk's `readme.txt` points to the correct stable tag.

    If no stable tag is provided, it is assumed that trunk is stable, but you should specify "trunk" if that's where
you put the stable version, in order to eliminate any doubt.

== Installation ==

1. Upload `comment-crusher.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.0 =
* All systems are go.