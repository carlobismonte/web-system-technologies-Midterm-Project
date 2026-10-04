<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Home1 extends BaseController
{
    public function index()
    {
        $model = new TaskModel();

        $data['tasks'] = $model->getTodayTasks();

        return view('home', $data);
    }
}