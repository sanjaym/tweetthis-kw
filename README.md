K@W tweet-shortcode
==============

A WordPress plugin that lets you choose specific phrases or sentences to editorialize Tweets. Inspired by the NYTimes.com tweet plugin.


Lets you highlight specific parts of a WordPress post for one-click tweeting. Use:
<code>[tweetthis] Lorem ipsum...[/tweetthis]</code>

* Activate Plugin
* In post/page, move cursor to start of the target text and click ['Tweetthis'] button
* move cursor to the end of the desired selectable area and click the same button which should now say ['/Tweetthis'] to end the tag.
* **you can also highlight the target text and click the [Tweetthis] button
* edit the alt/hashtags/shorturl as needed
 

<blockquote>Schardt says that <code>[tweetthis]</code> finding creative journalists with an awareness of what technologies are available to them is half the battle.<code>[/tweetthis]</code> The advancements themselves outpace the average newsroom's awareness and ability, but funding continues to be overwhelmingly aimed at furthering these platforms — while journalists struggle to keep up.</blockquote>

Optionally, you can include an <code>alt</code> tag in the shortcode if you want the **Text of the tweet** to be different than the exact text you're highlighting:

<blockquote>Schardt says that &#91;tweetthis <code>alt=&#34;This is actually the text that will show up in the tweet&#34;</code>&#93;</strong> finding creative journalists with an awareness of what technologies are available to them is half the battle. &#91;/tweetthis&#93; The advancements themselves outpace the average newsroom's awareness and ability, but funding continues to be overwhelmingly aimed at furthering these platforms — while journalists struggle to keep up.</blockquote>

You can also add <code>hashtags</code> to the tweet:

<blockquote>Schardt says that 
&#91;tweetthis <code>hashtag=&#34;#journalism #publicmedia&#34;</code>&#93;  finding creative journalists with an awareness of what technologies are available to them is half the battle. &#91;/tweetthis&#93; The advancements themselves outpace the average newsroom's awareness and ability, but funding continues to be overwhelmingly aimed at furthering these platforms — while journalists struggle to keep up.</blockquote>

Shortened URLS are now supported <code>shorturl</code> otherwise the default  <code>wp_get_shortlink();</code> is used.


 <blockquote>Schardt says that &#91;tweetthis <code> shorturl=&#34;http://bit.ly/urlhere&#34;</code>&#93; finding creative journalists with an awareness of what technologies are available to them is half the battle.<strong>&#91;/tweetthis&#93;</strong> The advancements themselves outpace the average newsroom's awareness and ability, but funding continues to be overwhelmingly aimed at furthering these platforms — while journalists struggle to 
keep up.</blockquote>

***
<h3>All Together Now</h3>

<code>
[tweetthis alt=&#34;This is actually the text that will show up in the tweet.&#34; hashtag=&#34;#journalism #publicmedia&#34; short_url=&#34;http://knlg.net/urlhere&#34;]
</code>

***
 
<h2>Styling</h2>
You can use the <code>.tweetthislink</code> class in your css to style as needed. 

***

powered by the Knowledge@Wharton Technology Team


