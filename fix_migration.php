<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

// Get the current batch number
$currentBatch = DB::table('migrations')->max('batch') ?? 0;
$nextBatch = $currentBatch + 1;

// List of migrations that exist as files but might not be recorded
$migrationFiles = [
    '2025_01_01_000002_create_permintaan_table',

    '2025_01_01_000004_create_budgets_table',
    '2025_01_01_000005_create_persetujuan_table'
];

echo "Checking and fixing migration records...\n\n";

foreach ($migrationFiles as $migration) {
    // Check if the migration is already recorded
    $exists = DB::table('migrations')
        ->where('migration', $migration)
        ->exists();

    if (!$exists) {
        // Insert the migration record
        DB::table('migrations')->insert([
            'migration' => $migration,
            'batch' => $nextBatch
        ]);
        echo "✓ Migration $migration marked as completed in batch $nextBatch\n";
    } else {
        echo "- Migration $migration already exists in migrations table\n";
    }
}

echo "\nCurrent migrations:\n";
$migrations = DB::table('migrations')->orderBy('batch')->get();
foreach ($migrations as $migration) {
    echo "- {$migration->migration} (batch {$migration->batch})\n";
} 