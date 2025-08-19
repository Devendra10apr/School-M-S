<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    $permissions = [
    // Student Management
    'create-student', 'edit-student', 'delete-student', 'view-student',
    'upload-student-document', 'download-student-document',

    // Teacher Management
    'create-teacher', 'edit-teacher', 'delete-teacher', 'view-teacher',

    // Class & Section
    'create-class', 'edit-class', 'delete-class', 'view-class',
    'create-section', 'edit-section', 'delete-section', 'view-section',

    // Subject Management
    'create-subject', 'edit-subject', 'delete-subject', 'view-subject',
    'assign-subject', 'view-assigned-subjects',

    // Timetable
    'create-timetable', 'edit-timetable', 'delete-timetable', 'view-timetable',

    // Attendance
    'mark-attendance', 'edit-attendance', 'delete-attendance', 'view-attendance',

    // Exams & Marks
    'create-exam', 'edit-exam', 'delete-exam', 'view-exam',
    'enter-marks', 'edit-marks', 'view-marks',

    // Marksheet / Result
    'generate-marksheet', 'download-marksheet', 'view-result',

    // Fees Management
    'define-fee-structure', 'edit-fee-structure', 'view-fee-structure',
    'collect-fees', 'edit-fees', 'view-fees', 'print-fee-receipt',
    'view-due-fees', 'give-discount', 'refund-fees',

    // Reports
    'view-attendance-report', 'view-fee-report', 'view-result-report', 'export-reports',

    // Notifications
    'create-notice', 'edit-notice', 'delete-notice', 'view-notice',
    'send-notification', 'view-notification-log',

    // Transport
    'manage-vehicle', 'manage-driver', 'assign-transport', 'view-transport',

    // Hostel
    'manage-room', 'assign-hostel', 'view-hostel',

    // Library
    'add-book', 'edit-book', 'delete-book', 'view-book',
    'issue-book', 'return-book', 'view-issued-books',

    // Session
    'create-session', 'switch-session', 'view-session',

    // Settings
    'update-school-info', 'manage-logo', 'manage-favicon',
    'backup-database', 'restore-database',

    // Roles & Permissions
    'create-role', 'edit-role', 'delete-role', 'view-role',
    'assign-permission', 'view-permission',

    // Dashboard
    'view-dashboard', 'view-own-dashboard',

    // Parents (if needed)
    'view-own-child-record', 'view-own-child-result', 'view-own-child-attendance',

    // Optional - Audit Logs
    'view-audit-log', 'view-login-history',
];

foreach ($permissions as $permission) {
    Permission::firstOrCreate(['name' => $permission]);
    
}

    }
}
