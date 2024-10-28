<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{

    private $data;

    public function __construct()
    {
        $this->data["title"] = "Assessment";
    }

    public function index() {
        $data = $this->data;
        $data['assessmentData'] = Assesment::all();
        $data['no'] = 1;

        return view('course-category.index', compact(['data']));
    }
}
