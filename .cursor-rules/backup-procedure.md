# WordPress Backup Procedure Rule

## Rule Name: `backup-procedure`

## Purpose
Create consistent, complete WordPress backups using DDEV and WP-CLI with organized folder structure and standardized naming conventions.

## Prerequisites
- DDEV environment running
- WP-CLI available via DDEV
- Existing `backup/` folder in project root
- DDEV database snapshots enabled

## Standard Backup Procedure

### 1. Database Snapshot (DDEV)
```bash
ddev snapshot --name "backup-$(date +%Y%m%d_%H%M%S)"
```
- **Location**: `.ddev/db_snapshots/`
- **Naming**: `backup-YYYYMMDD_HHMMSS`
- **Restore Command**: `ddev snapshot restore [snapshot-name]`

### 2. Complete Files Backup
```bash
BACKUP_DIR="./backup/full_backup_$(date +%Y%m%d_%H%M%S)"
mkdir -p "$BACKUP_DIR"
cp -r wp-content "$BACKUP_DIR/"
cp wp-config.php "$BACKUP_DIR/"
```

### 3. Database Export to Backup Folder
```bash
ddev wp db export "$BACKUP_DIR/database_backup_$(date +%Y%m%d_%H%M%S).sql"
```

### 4. WordPress Core Backup (Optional)
```bash
ddev wp core download --path=./backup/wp_backup_$(date +%Y%m%d_%H%M%S) --force
```

## Folder Structure
```
backup/
├── full_backup_YYYYMMDD_HHMMSS/     # Complete site backup
│   ├── wp-content/                   # All themes, plugins, uploads
│   ├── wp-config.php                 # Configuration file
│   └── database_backup_YYYYMMDD_HHMMSS.sql  # Database export
└── wp_backup_YYYYMMDD_HHMMSS/       # Clean WordPress core files
    └── [WordPress core files]
```

## Naming Convention
- **Format**: `YYYYMMDD_HHMMSS` (e.g., `20250923_143037`)
- **Database Snapshots**: `backup-YYYYMMDD_HHMMSS`
- **File Backups**: `full_backup_YYYYMMDD_HHMMSS`
- **Core Backups**: `wp_backup_YYYYMMDD_HHMMSS`
- **Database Exports**: `database_backup_YYYYMMDD_HHMMSS.sql`

## Verification Commands
```bash
# List all DDEV snapshots
ddev snapshot --list

# Check backup folder contents
ls -la backup/

# Verify latest backup completeness
ls -la backup/full_backup_*/
```

## Restoration Procedure

### Database Restore
```bash
ddev snapshot restore [snapshot-name]
```

### Files Restore
```bash
# Restore wp-content
cp -r backup/full_backup_YYYYMMDD_HHMMSS/wp-content/* wp-content/

# Restore configuration
cp backup/full_backup_YYYYMMDD_HHMMSS/wp-config.php ./

# Alternative: Database import from SQL file
ddev wp db import backup/full_backup_YYYYMMDD_HHMMSS/database_backup_YYYYMMDD_HHMMSS.sql
```

## Success Criteria
✅ DDEV snapshot created and listed
✅ Complete wp-content folder backed up
✅ wp-config.php backed up
✅ Database exported as SQL file
✅ All files organized in timestamped folders
✅ Backup verification completed

## One-Line Backup Command
```bash
TIMESTAMP=$(date +%Y%m%d_%H%M%S) && ddev snapshot --name "backup-$TIMESTAMP" && BACKUP_DIR="./backup/full_backup_$TIMESTAMP" && mkdir -p "$BACKUP_DIR" && cp -r wp-content "$BACKUP_DIR/" && cp wp-config.php "$BACKUP_DIR/" && ddev wp db export "$BACKUP_DIR/database_backup_$TIMESTAMP.sql" && echo "✅ Complete backup created: $BACKUP_DIR"
```

## Notes
- Always use German communication but English commands/filenames
- Never commit backups to Git (should be in .gitignore)
- Keep snapshots organized by date for easy management
- Test restoration procedure periodically
- Clean up old backups as needed to save disk space

## Related Commands
- `ddev snapshot --help` - DDEV snapshot help
- `ddev wp db --help` - WP-CLI database commands
- `ddev wp core --help` - WP-CLI core commands
