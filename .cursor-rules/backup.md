# Backup Rule

## Rule: `backup`

### Summary
Standardized WordPress backup procedure using DDEV and WP-CLI with consistent naming and folder structure.

### When to Apply
- Before major updates or changes
- Regular maintenance backups
- Before deployment
- User requests backup creation

### Standard Backup Commands

#### Quick Backup (One Command)
```bash
TIMESTAMP=$(date +%Y%m%d_%H%M%S) && ddev snapshot --name "backup-$TIMESTAMP" && BACKUP_DIR="./backup/full_backup_$TIMESTAMP" && mkdir -p "$BACKUP_DIR" && cp -r wp-content "$BACKUP_DIR/" && cp wp-config.php "$BACKUP_DIR/" && ddev wp db export "$BACKUP_DIR/database_backup_$TIMESTAMP.sql" && echo "✅ Complete backup created: $BACKUP_DIR"
```

#### Step-by-Step Process
1. **Database Snapshot**: `ddev snapshot --name "backup-$(date +%Y%m%d_%H%M%S)"`
2. **Files Backup**: Copy `wp-content/` and `wp-config.php` to timestamped folder
3. **Database Export**: Export SQL to backup folder
4. **Verification**: List snapshots and check backup contents

### Naming Convention
- **Format**: `YYYYMMDD_HHMMSS`
- **Database Snapshots**: `backup-YYYYMMDD_HHMMSS`
- **File Backups**: `full_backup_YYYYMMDD_HHMMSS`

### Success Criteria
✅ DDEV snapshot created  
✅ wp-content backed up  
✅ wp-config.php backed up  
✅ Database exported as SQL  
✅ All organized in timestamped folders  

### Key Rules
- Always use German communication, English commands
- Use consistent timestamp format
- Store in `/backup/` folder (never commit to Git)
- Include both database and files
- Verify completion

### Reference
Full procedure documented in: `.cursor-rules/backup-procedure.md`
