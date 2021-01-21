# super-timeline-9000
Just another timeline plugin for Wordpress.

A plugin to create basic timelines that can be added to pages or posts by a shortcode. Is it janky? Yes. Does it work? I think so. I don't guarantee anything, there could be any kind of bugs.

## Creating timelines

The plugin adds a new type -- Timelines -- to the admin bar. Select All Timelines and click Add New. Name your timeline and use the plus and minus buttons to add entries. New entries are added to the bottom and old entries are removed from the bottom as well.

The "Date or time" field is a header and the "Content" is the... well, the content of the entry. Neither is required.

## Using timelines

Once you're happy with your entries, save the timeline and copy the shortcode at the top of the page. For example, the shortcode may be `[timeline-insert id="123"]`. Copy that into a post or page and the plugin will generate your timeline.

## Styling timelines

The plugin won't create styles for the timeline, it will only generate the HTML markup.

An example timeline may have this markup:

```html
<div class="timeline-container">
	<div class="timeline-row">
		<div class="timeline-entry">
			<h3 class="timeline-entry-head">16:00</h3>
			<p class="timeline-entry-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		</div>
	</div>
	<div class="timeline-row">
		<div class="timeline-entry">
			<h3 class="timeline-entry-head">17:00</h3>
			<p class="timeline-entry-content">In porta aliquam aliquam.</p>
		</div>
	</div>
	<div class="timeline-row">
		<div class="timeline-entry">
			<h3 class="timeline-entry-head">18:30</h3>
			<p class="timeline-entry-content">Quisque auctor lacus mauris, sit amet faucibus diam porttitor vel.</p>
		</div>
	</div>
</div>
```

Thus the following classes are used with timelines:

- `timeline-container`: The parent of all entries.
- `timeline-row`: Wrapper for an entry.
- `timeline-entry`: Container for the head and the content.
- `timeline-entry-head`: The "Date or time" field, `h3`.
- `timeline-entry-content`: The "Content" field, `p`.

## Missing features

The plugin won't do anything on deactivation/uninstall.