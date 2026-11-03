# WPBrigade WordPress Theme Challenge

A custom Classic WordPress Theme built for the official **WPBrigade WordPress Theme Development Challenge**.

This theme is designed from the ground up to reproduce the dark green Adidas sports theme with pixel accuracy across desktop, tablet, and mobile devices, utilizing native WordPress APIs without external dependencies.

---

## Key Features

1. **Classic WordPress Theme Architecture**
   - Pure PHP templates following the official WordPress template hierarchy (`front-page.php`, `index.php`, `single.php`, `page.php`, `archive.php`, `search.php`, `404.php`, `comments.php`).
   - Prefix `wpbc_` on all global functions and constants.
   - Built to WordPress Coding Standards with sanitization, escaping (`esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`), and CSRF protection via nonces.

2. **Top Notification Bar**
   - Configurable from **Appearance → Theme Options**.
   - Custom announcement text and call-to-action link.
   - Dismissible with close button (remembers state for the session).

3. **Multi-level Navigation Menus**
   - Primary Menu with 3-level nested dropdowns (`WPBC_Walker_Nav_Menu`).
   - Secondary Utility Menu (`MEMBERSHIP` and `ACCOUNT`).
   - Dedicated mobile slideout navigation drawer with expandable accordion submenus and search form.

4. **Interactive Hero Slider with Theme Options Repeater & Video Popup**
   - Configurable from **Appearance → Theme Options** via dynamic JavaScript `+/-` repeater with WordPress Media Library integration (`wp.media`), or via `wpbc_slide` Custom Post Type.
   - Fields per slide: Slide Image, Title, Textarea Content, and Video Link.
   - Video Play button icon displayed conditionally when a video link is present.
   - Accessible modal video popup supporting YouTube and Vimeo embeds with overlay and escape key dismissal.

5. **Sports Category Carousel**
   - Displays 10 sports posts (`wpbc_sport` Custom Post Type) with responsive smooth horizontal scrolling.

6. **Random Sticky / Featured Post**
   - Dynamic query displaying a random sticky post (`sticky_posts` + `orderby => rand`) with safe fallback to design assets.

7. **Latest Posts Grid**
   - 3-column card grid displaying the latest blog posts with featured images, titles, excerpts, and "READ MORE" buttons.

8. **Events Sidebar Widget with AJAX Pagination**
   - Custom Post Type (`wpbc_event`) with custom meta boxes for Start Date/Time, End Date/Time, and Location.
   - AJAX-powered Next & Previous navigation buttons that update event listings without page reload.

9. **Categories Accordion Widget & Tag Cloud**
   - Dynamic WordPress taxonomy loop displaying parent categories with functional archive links.
   - Expandable subcategories accordion on parent chevron click with smooth rotation.
   - Categories tag cloud widget linking directly to category archives.

10. **Custom Widgets**
    - **Weather Widget:** Displays current weather condition, temperature (23°), city, and 4-day forecast.
    - **Date & Time Widget:** Live ticking digital clock with timezone support, configurable from Theme Options.
    - **Newsletter Widget:** Email subscription box with AJAX submission handling and optional Gravity Forms integration (`gravity_form_id`).

11. **Tabbed Content Section**
    - 3 tabs: "Match Info", "Match Results", and "Match Schedule".
    - Full WYSIWYG/HTML content configurable via Theme Options.

12. **FAQ Accordion & Contact Form**
    - Expandable accordion items.
    - "GET IN TOUCH WITH US" form with Name, Email, Country dropdown, State, Gender radio options, Message textarea, and Submit button.

13. **Footer & Disclaimer**
    - Site Map and Important Links menus/widgets.
    - Adidas branding and dynamic copyright year.
    - Terms & Conditions and Privacy Policy rendered via `[wpb-link url="..." title="..."]` shortcode.
    - Full-width disclaimer notification bar managed via Theme Options.

---

## Directory Structure

```text
wpbrigade-challenge/
├── assets/
│   ├── css/
│   │   ├── main.css          # Main stylesheet
│   │   ├── responsive.css    # Responsive rules (tablet & mobile)
│   │   └── admin.css         # Theme Options admin styling
│   ├── images/               # Extracted images & textures
│   └── js/
│       ├── theme.js          # Interactive frontend logic & AJAX
│       └── admin.js          # Admin scripts
├── inc/
│   ├── ajax-handlers.php     # AJAX endpoints (events pagination, newsletter)
│   ├── custom-meta-boxes.php # Slide and Event meta boxes
│   ├── custom-post-types.php # Slides, Sports, Events CPT registration
│   ├── enqueue-assets.php    # Scripts & styles enqueuing
│   ├── shortcodes.php        # [wpb-link] shortcode
│   ├── template-functions.php# Core template query and data helpers
│   ├── template-tags.php     # Nav walker and display tags
│   ├── theme-options.php     # Settings API Theme Options page
│   ├── theme-setup.php       # Theme supports, menus, and sidebars
│   └── widgets.php           # Weather, Date & Time, Newsletter widgets
├── lib/                      # Third-party code and vendor libraries
├── 404.php
├── archive.php
├── comments.php
├── footer.php
├── front-page.php            # Homepage template
├── functions.php
├── header.php
├── index.php
├── page.php
├── screenshot.png            # Theme preview (1200x900)
├── search.php
├── searchform.php
├── single.php
└── style.css
```

---

## Installation & Setup

1. Copy or clone this folder into `wp-content/themes/wpbrigade-challenge/`.
2. In the WordPress admin dashboard, navigate to **Appearance → Themes** and activate **WPBrigade Challenge**.
3. Go to **Appearance → Menus** to assign your Primary and Secondary navigation menus.
4. Go to **Appearance → Theme Options** to configure:
   - Top notification text and link
   - Match Info / Results / Schedule content
   - Twitter username and Facebook page URL
   - Weather and Date & Time widget cities
   - Footer disclaimer text and policy URLs

