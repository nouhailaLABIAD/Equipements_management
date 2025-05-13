<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
{
    // Récupérer tous les logs, ou filtrer selon des critères comme le rôle, etc.
    $logs = ActivityLog::with('user')->orderBy('created_at', 'desc')->get();
    
    return view('admin.activity_logs.index', compact('logs'));
}
}
