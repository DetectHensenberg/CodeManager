# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a ZenTao integrated runtime environment package built with ZenPanel - a Windows service management tool that bundles Apache, MySQL, PHP, and other services required to run ZenTao project management software.

**Key Components:**
- **ZenPanel (ZenTao.exe)**: Qt-based GUI application for managing integrated services
- **ZenTao**: PHP-based project management system (version 22.1)
- **Integrated Services**: Apache 2.4.25, MySQL 10.1.25, PHP 7.4.30, XXD 9.6, RoadRunner 2.0.0, Redis 6.2.16

## Architecture

### Directory Structure

- `ZenTao.exe` - Main Qt application executable (64-bit Windows GUI)
- `app/zentao/` - ZenTao application files
  - `module/` - ZenTao modules (action, admin, ai, bug, build, etc.)
  - `framework/` - ZenTaoPHP framework
  - `config/` - Configuration files
  - `www/` - Web root directory
- `bin/` - Service binaries (apache, mysql, php, rr, redis, xxd, vc)
- `zbox/` - ZenPanel configuration and utilities
  - `config.yml` - Service definitions and default settings
  - `lang/` - UI language files (zh-cn, zh-tw, en)
  - `nssm/` - Windows service wrapper
- `etc/` - Service configuration files (apache, mysql, php, rr, xxb, zbox, zentao, ztaccess)
- `app/ztadmin/` - Database admin interface (Adminer)

### Service Management

Services are defined in `zbox/config.yml` with the following structure:
- Port configuration (with auto-port detection to avoid conflicts)
- Service paths and executables
- Before/after commands for initialization
- Account credentials (default: zentao/123456 for Apache, root/123456 for MySQL)

**Service Control Flow:**
1. ZenPanel reads `zbox/config.yml` for service definitions
2. Executes `beforeCommand` scripts (e.g., htpasswd setup, database initialization)
3. Installs Windows services via NSSM or native service commands
4. Runs `afterCommand` scripts (e.g., password changes, privilege flush)
5. Monitors service status and provides GUI controls

### ZenTao Application

ZenTao follows the ZenTaoPHP framework pattern:
- **Request routing**: PATH_INFO mode with `-` separator (e.g., `/module-method-params`)
- **Module structure**: Each module has `control.php` (controller), `model.php` (model), `config.php`, and view files
- **Configuration**: Main config in `app/zentao/config/config.php`, customizations in `my.php`
- **Supported visions**: rnd (R&D), lite, or (Operations)

## Development Commands

### Service Management

Services are managed through the ZenTao.exe GUI or via Windows service commands:

```bash
# Check service status
sc query <service-name>

# Start/stop Apache (if installed as service)
net start Apache2.4
net stop Apache2.4

# Start/stop MySQL (if installed as service)
net start MySQL
net stop MySQL
```

### Database Access

```bash
# Connect to MySQL
bin/mysql/bin/mysql.exe -u root -p123456 -P 3306

# Dump database
bin/mysql/bin/mysqldump.exe -u root -p123456 zentao > backup/zentao.sql
```

### Apache Configuration

Apache config: `etc/apache/httpd.conf`
- Uses custom access file: `.ztaccess` (instead of `.htaccess`)
- Document root: `%APP_PATH%htdocs`
- Default port: 80 (auto-adjusts if occupied)

### PHP Configuration

PHP config: `etc/php/php.ini`
- Version: 7.4.30
- Extensions located in: `bin/php/ext/`

## Important Notes

- **Path Requirements**: Installation path must contain only alphanumeric characters and underscores (no Chinese or special characters)
- **VC++ Runtime**: Requires Visual C++ Redistributable (VC 9.0 SP1) - installer will prompt if missing
- **Port Conflicts**: ZenPanel automatically detects and resolves port conflicts using `autoPorts` ranges
- **License**: LGPL v3 (Qt-based project)
- **Multi-language Support**: UI supports zh-cn, zh-tw, en (configured in `zbox/config.yml`)

## Configuration Files

- `zbox/config.yml` - Main service configuration
- `etc/apache/httpd.conf` - Apache web server settings
- `etc/mysql/my.ini` - MySQL database settings  
- `etc/php/php.ini` - PHP runtime settings
- `app/zentao/config/config.php` - ZenTao application config
- `app/zentao/config/my.php` - User customizations (create if needed)

## Security Defaults

- Apache authentication: Optional (disabled by default)
  - Default credentials: zentao/123456
  - Managed via htpasswd in `bin/apache/auth/.htaccess`
- MySQL root password: 123456 (should be changed in production)
- Access file: `.ztaccess` (custom Apache access control)
