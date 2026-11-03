# Third-Party Libraries Directory (`lib/`)

This directory is designated for third-party libraries and vendor dependencies in accordance with WPBrigade challenge requirements.

## Current Architecture Note

The theme has been authored using native WordPress APIs and standard vanilla JavaScript (ES6) with zero external script bloat (e.g., no external jQuery sliders or bulky CSS frameworks). All custom scripts and styles are organized under `assets/js/` and `assets/css/`.

If third-party PHP libraries or JavaScript vendor scripts (such as composer packages or vendor polyfills) are introduced in the future, place them directly inside this `lib/` directory.

