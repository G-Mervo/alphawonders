# CodeIgniter 3 to CodeIgniter 4 Migration Plan

## Overview
This document outlines the migration from CodeIgniter 3.1.6 to CodeIgniter 4.4+

## Key Changes Required

### 1. Directory Structure
- `application/` → `app/`
- `system/` → `vendor/codeigniter4/framework/system/`
- New: `writable/` directory for logs, cache, sessions, uploads
- New: `public/` directory for index.php and assets

### 2. Controllers
- Namespace required: `namespace App\Controllers;`
- Extend `BaseController` instead of `CI_Controller`
- Use dependency injection
- `$this->load->model()` → `$model = new ModelName()`
- `$this->load->view()` → `return view()`
- `$this->input->post()` → `$this->request->getPost()`
- `base_url()` → `base_url()` (helper still available)

### 3. Models
- Namespace required: `namespace App\Models;`
- Extend `CodeIgniter\Model`
- Use protected properties: `$table`, `$primaryKey`, `$allowedFields`
- Query Builder methods remain similar

### 4. Configuration
- Config files moved to `app/Config/`
- Database config: `app/Config/Database.php`
- Routes: `app/Config/Routes.php`
- Autoload: `app/Config/Autoload.php`

### 5. Routes
- Routes file format changed
- Use `$routes->get()`, `$routes->post()`, etc.
- Route groups available

### 6. Views
- `$this->load->view()` → `return view('view_name', $data)`
- View paths: `app/Views/`

## Migration Steps

1. ✅ Create CI4 directory structure
2. ⏳ Migrate configuration files
3. ⏳ Migrate controllers
4. ⏳ Migrate models  
5. ⏳ Migrate routes
6. ⏳ Update views
7. ⏳ Test functionality
8. ⏳ Update dependencies

