# KX - Premium WordPress Theme

A modern, high-performance WordPress theme for professional business websites with a focus on conversion optimization and premium design.

## 🎯 About the Project

The KX theme specializes in:
- **Premium web presence** for businesses
- **Conversion-optimized layouts** (Social Media → Website → Lead)
- **Mobile-first responsive design** with fluid typography
- **3D effects** and modern animations
- **Performance** and SEO optimization

Based on the [Underscores (_s) Starter Theme](https://underscores.me/) by Automattic.

## 🛠️ Tech Stack

### Frontend
- **CSS**: SASS/SCSS with fluid typography
- **JavaScript**: ES6+ with Babel transpilation
- **Icons**: Fantasticon (SVG → Icon Font)
- **Animations**: CSS Animations & Transforms

### Development Tools
- **Local Environment**: DDEV
- **Package Manager**: npm
- **CSS Preprocessor**: Sass (Dart Sass)
- **JS Bundler**: Babel with Minify
- **Live Reload**: Browser-Sync
- **WP-CLI**: For backups and DB management

## 📋 Prerequisites

- **DDEV** - Local development environment
- **Node.js** - Version 16 or higher
- **npm** - Package manager
- **PHP** 7.4+
- **MySQL** 8.0+ or MariaDB 10.5+

## 🚀 Installation & Setup

### 1. Start DDEV
```bash
ddev start
```

### 2. Install dependencies
```bash
cd wp-content/themes/kx
npm install
```

### 3. Compile theme
```bash
# Development (with source maps)
npm run watch

# Production (minified)
npm run build
```

## 💻 Development Workflow

### Theme Development

**Watch mode** (auto-compilation + Browser-Sync):
```bash
npm run watch
```

**Build for production**:
```bash
npm run build
```

**Compile SCSS only**:
```bash
npm run theme:build:scss
```

**Compile JavaScript only**:
```bash
npm run theme:build:js
```

### Generate icon font

Icons are located in `media/fonts/Icont/icons/*.svg`:

```bash
npm run icont:generate
```

### Internationalization

```bash
npm run theme:i18n:pot   # Create POT file
npm run theme:i18n:po    # Update PO files
npm run theme:i18n:mo    # Generate MO files
```

## 📂 Project Structure

```
wp-content/themes/kx/
├── css/
│   ├── components/
│   │   ├── _blocks.scss       # Gutenberg blocks
│   │   ├── _content.scss      # Content styles (Hero, Facts, etc.)
│   │   ├── _forms.scss        # Forms & buttons
│   │   └── _header.scss       # Header styles
│   ├── _elements.scss         # HTML elements & typography
│   ├── _variables.scss        # SASS variables
│   └── style.scss             # Main SCSS file
├── js/
│   ├── app.js                 # Main JavaScript
│   └── navigation.js          # Navigation functionality
├── media/
│   └── fonts/
│       └── Icont/             # Icon font
│           └── icons/         # SVG icons
├── utilities/                 # Theme utilities
├── gutenberg-codes/           # Gutenberg templates
├── backup/                    # Backup directory
└── functions.php              # Theme functions
```

## 🎨 Features

### Typography
- **Fluid typography**: Seamless scaling between mobile and desktop
- **Custom fonts**: Poppins (headings), Avenir (body)
- **Optimized line-heights**: 1.2 (headings), 1.5 (body)

### Components
- **Hero section**: 3D works ticker with infinite loop animation
- **Newsticker**: Mobile-optimized with auto-scroll
- **CTA bar**: Fixed, intersection-observer-based
- **Posts grid**: Filterable with AJAX load more
- **WhatsApp button**: SVG icon with transparent style

### Performance
- **Minification**: CSS & JavaScript
- **Lazy loading**: Images & iframes
- **Critical CSS**: Above-the-fold optimization
- **Clean code**: Modern SCSS architecture

## 🔒 Backup & Restore

### Create complete backup
```bash
TIMESTAMP=$(date +%Y%m%d_%H%M%S) && \
ddev snapshot --name "backup-$TIMESTAMP" && \
BACKUP_DIR="./backup/full_backup_$TIMESTAMP" && \
mkdir -p "$BACKUP_DIR" && \
cp -r wp-content "$BACKUP_DIR/" && \
cp wp-config.php "$BACKUP_DIR/" && \
ddev wp db export "$BACKUP_DIR/database_backup_$TIMESTAMP.sql"
```

### Restore
```bash
# Database
ddev snapshot restore [snapshot-name]

# Files
cp -r backup/full_backup_YYYYMMDD_HHMMSS/wp-content/* wp-content/
```

## 🎯 Essential Commands

### DDEV
```bash
ddev start                    # Start project
ddev stop                     # Stop project
ddev restart                  # Restart
ddev ssh                      # SSH into container
ddev wp                       # Use WP-CLI
ddev snapshot --list          # Show snapshots
```

### Theme Build
```bash
npm run watch                 # Development mode
npm run build                 # Production build
npm run theme:build:scss      # Compile CSS only
npm run theme:build:js        # Compile JS only
```

## 📐 Breakpoints

```scss
$breakpoints: (
    xs: 664px,
    sm: 782px,
    md: 1030px,
    lg: 1230px,    // Content max-width
    xl: 1660px,
    xxl: 1920px
);
```

## 🎨 Color Palette

- **Primary**: Dark Blue (`#043451`)
- **Secondary**: Light Blue (`#B3D3E6`)
- **Accent**: Orange (`#FC7016`)
- **Text**: Black (`#000000`)
- **Background**: Off-White (`#F9F9F9`)

See `css/_variables.scss` for the complete color palette.

## 📝 Code Conventions

- **SCSS**: BEM-like structure with nested selectors
- **JavaScript**: ES6+ with Babel transpilation
- **PHP**: WordPress Coding Standards
- **Commits**: Semantic commit messages (see `.cursor/rules/commit-message.mdc`)

## 🐛 Debugging

### Browser console
```javascript
// Newsticker control
NewstickerControl.pauseAll()
NewstickerControl.resumeAll()
NewstickerControl.setGlobalSpeed(100)
```

### SCSS source maps
Development builds include source maps for easy browser debugging.

## 📚 Documentation

Additional documentation in `.cursor/rules/`:
- `wordpress.mdc` - WordPress-specific rules
- `development.mdc` - General development rules
- `underscores.mdc` - _s theme-specific rules
- `backup-process.mdc` - Backup processes

## 🤝 Author

**artcom venture GmbH**  
Website: [artcom-venture.de](https://www.artcom-venture.de)

## 📄 License

GPL-2.0-or-later - GNU General Public License v2 or later

---

**Version**: 1.10.0  
**Text Domain**: kx  
**Based on**: Underscores (_s)
