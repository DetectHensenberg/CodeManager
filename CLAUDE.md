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

理念
核心信念
增量进步优于一步到位 — 优先选择能够编译并顺利通过测试的小步迭代。
从现有代码中学习 — 在动手实现新功能前，充分研究和规划。
务实优于教条 — 灵活适应项目的实际情况，而非僵守原则。
清晰意图优于巧妙代码 — 追求代码的直白与易懂，避免炫技。
简单意味着
每个函数或类只承担单一职责。
避免进行不成熟的抽象设计。
拒绝使用花哨的技巧，选择最稳妥、最直接的解决方案。
如果一段代码需要额外的解释才能被理解，那么它本身就过于复杂了。
流程
1. 规划与分阶段
将复杂的任务拆解为 3 到 5 个明确的阶段，并在 IMPLEMENTATION_PLAN.md 文件中详细记录：

## 阶段 N: [阶段名称]
**目标**: [明确的可交付成果]
**成功标准**: [可被量化和测试的成果]
**测试**: [具体的测试用例]
**状态**: [未开始 | 进行中 | 已完成]
在开发过程中，实时更新每个阶段的状态。
当所有阶段都完成后，删除此计划文件。
2. 实现流程
理解 — 深入研究代码库中已有的设计模式和实践。
测试 — 遵循测试驱动开发（TDD），首先编写失败的测试（红灯）。
实现 — 编写最精简的代码，使其能通过测试（绿灯）。
重构 — 在确保所有测试都能通过的前提下，优化和清理代码。
提交 — 撰写清晰的提交信息，并关联到相应的开发计划。
3. 遇到困难时（最多尝试 3 次）
核心原则：针对同一个问题，最多连续尝试 3 次。如果 3 次都未能解决，请暂停。

步骤 1：记录失败的尝试
详细描述你尝试过的方法。
附上具体的错误信息。
尽可能分析导致失败的根本原因。
步骤 2：研究替代方案
寻找 2 到 3 个备选解决方案。
重点关注与之前尝试不同的实现路径。
步骤 3：反思当前方法
当前的抽象层次是否恰当？
是否可以将这个问题拆分为更小的、可独立验证的步骤？
是否存在一个更简单、更直接的解决方案？
步骤 4：探索新的解决思路
能否利用不同的库或外部服务来解决问题？
是否可以采用不同的架构模式？
尝试减少依赖和约束后，问题是否可以更简单地被解决？
质量标准
架构原则
组合优于继承 — 优先使用依赖注入来组合功能。
接口优于单例 — 确保代码的可测试性和灵活性。
显式优于隐式 — 数据流和依赖关系应当清晰可见。
尽量不可变 — 优先使用不可变对象，减少副作用带来的复杂度。
代码质量
每一次提交必须：
能够成功编译。
通过所有已执行的测试。
为新功能配备对应的测试。
严格遵守项目的代码风格和格式化规范（linting）。
提交前：
运行所有格式化和代码检查工具。
仔细审视自己的代码变更。
确保提交信息清晰解释了"为什么"要进行此修改。
错误处理
严禁"静默失败" — 所有异常必须被妥善处理或显式上报。
在错误信息中包含足够的上下文，以便于调试时定位问题。
使用合适的日志级别记录异常。
严禁吞掉异常或以空 catch 块忽略错误。
技术决策框架
当面临多种可行的技术方案时，应按照以下优先级顺序进行考量：

可测试性 — 这个方案能否被轻松验证和测试？
可读性 — 新加入的团队成员能否理解这段代码在做什么？
一致性 — 这个方案是否与项目中已有的模式和约定保持一致？
性能 — 在满足以上三点的基础上，再考虑性能优化。
可维护性 — 未来如果需求变更，修改这段代码的难度和成本有多高？
项目规范
学习代码库
寻找 3 个功能相似的现有实现，识别和总结通用的设计模式和编码约定。
尽可能遵循项目中已有的测试模式和架构约定。
工具使用
使用项目统一的构建工具。
使用项目统一的测试框架。
遵循项目统一的格式规范。
在没有充分理由的情况下，不要引入新的框架、库或工具。
"完成"的定义
在声称一项任务完成之前，请逐项确认：

 所有相关测试都已通过。
 代码严格遵循项目的设计模式和编码约定。
 代码通过了格式化和 linting 检查。
 提交信息清晰解释了修改的目的和原因。
 代码中没有遗留任何调试用的日志或临时代码。
 没有未实现的存根（stub）函数或方法。
 任何未完成的功能都已明确标记 TODO 注释。
测试指南
将测试代码视为"活文档"，它们应当能清晰说明被测试代码的行为和预期。
在可能的情况下，每个测试用例只验证一个具体的行为。
测试应当同时覆盖正常场景和异常/边界场景。
确保所有测试都是确定性的，不会因为运行顺序或环境差异而产生不稳定的结果。
重要警告
永远不要使用 --no-verify 之类的选项来绕过代码检查和质量控制。
不要修改项目的 git 配置或版本控制钩子。
如果提交因为检查失败而无法成功，修复代码本身，而不是绕过验证机制。
永远不要使用破坏性的操作方式（如强制推送），确保团队成员能够同步工作。
不要主动创建文档、计划文件或总结文件，除非被明确要求这么做。
遇到同一个错误连续 3 次尝试都失败后，立即暂停，回顾并学习，而不是盲目继续尝试。
