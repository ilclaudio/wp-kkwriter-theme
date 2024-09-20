
# TODO list of the theme

## MB
- Privacy page and cookies management.
- DMARC: Action Recommended: It doesn't look like DMARC has been set up on your domain (michelebattaglino.it). We recommend using the DMARC protocol 
	because it helps protect your domain from unauthorized use.
	Please check out this step-by-step guide for details on how to add the DMARC record to your domain's DNS.
	https://wpmailsmtp.com/how-to-create-dmarc-record/

## BUGS
- Back-office: BUG theme configuration menu (it should not be visible in the main menu).
- Checks for article recovery with language change: automatic and by ID.
- Put Mock images, when absent.
- It should not lose the alt of the link: https://www.wp-recipes.com/wp-admin/post.php?post=609&action=edit&classic-editor

## Refactoring:
- Refactoring functions.php in object oriented way.
- ordering.php Renderlo parametrico in base alla pagina: section, blog o search.
- [Plugin] Refactoring SearchManager che ritorni un oggetto di tipo Book e non un array.
- Invocazione del wrapper delle immagini per recuperare e mostrare i dati di una foto (src e alt) dove manca (search?).
- Portare tutte le query per recuperare i contenuti dentro il ContentManager (blog ed altri).
- Togliere riferimenti a BootstrapItalia (svg/sprites.svg)


## Performance
 - Check: https://developer.wordpress.org/advanced-administration/performance/optimization/
 - Check: https://wordpress.org/plugins/performance-lab/?utm_source=lighthouse&utm_medium=devtools

## Security
- Check security (especially contact and search forms).
- Use NONCE in the blog page form: <?php wp_nonce_field( 'sf_blog_search_nonce', 'blog_search_nonce_field' ); ?>

## Accessibility

- Check correct and hidden sections definition.
- Check image tags.
- Check correct link and menu explanation.
- Touch targets do not have sufficient size or spacing.


## New features:
- Logo image management.
- Check theme installation and data reload after KKW_SITE_SECTIONS modification.
- Reading sections from taxonomy.
- Make sections dynamic (read from taxonomy after creation).
- Make post groups dynamic (read from plugin).
- Events calendar.
- Publishers page.
- Authors page.
- Refactoring taxonomy creation and pages and sections with generic language.
- Manage tags.
- Manage categories.
- Manage photo-galleries.
- CMB2 Field Leaflet Geocoder - Geolocalization of events.
- Photo gallery in books and posts.
- Remove custom styles and use SASS.

