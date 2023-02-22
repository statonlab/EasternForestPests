<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index()
    {
        return Chapter::withCount('pests')->get();
    }
}
