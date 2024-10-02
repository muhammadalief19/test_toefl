<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['title'] = 'Activity Log';
    }

    public function index() {
        $data = $this->data;
        $data["no"] = 1;
        $data['activityLogData'] = ActivityLog::with(['user'])->get();

        return view('activity-log.index', compact(['data']));
    }
}
