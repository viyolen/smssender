<?php

namespace App\Http\Controllers;

use App\Models\MailGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmailListController extends Controller
{
    private $db;
    private $modulName = "email.lists.";
    private $homeRoute;
    private $addRoute;
    private $updateRoute;
    private $addPostRoute;
    private $deletePostRoute;
    private $updatePostRoute;

    public function __construct()
    {
        $this->db = new MailGroups();
        $this->homeRoute = $this->modulName;
        $this->addRoute = $this->modulName . ".add";
        $this->updateRoute = $this->modulName . ".update";
        $this->addPostRoute = $this->modulName . ".add.post";
        $this->updatePostRoute = $this->modulName . ".update.post";
    }

    public function index()
    {
        $data = $this->db->all();
        foreach ($data as $index => $datum) {
            $data[$index]->d = DB::table("mail_groups_receivers")->where('group_id', $datum->id)->count();
        }
        return view($this->homeRoute . "home", compact('data'));
    }

    public function insertView()
    {
        return view($this->homeRoute . "insert");
    }

    public function updateView($id)
    {
        $data = $this->db->where('id', $id)->first();

        return view($this->homeRoute . "update", compact('data', 'id'));
    }

    public function insert(Request $request)
    {

        $request->merge(['user_id' => Auth::id()]);
        $this->db->create($request->all());
        return redirect(route($this->homeRoute));
    }

    public function update(Request $request, $id)
    {

        $request->merge(['user_id' => Auth::id()]);

        $this->db->where('id', $id)->update($request->except('_token'));
        return redirect(route($this->homeRoute));
    }

    public function delete(Request $request, $id)
    {


        $this->db->where('id', $id)->delete();
        DB::table("mail_groups_receivers")->where('group_id', $id)->delete();
        return redirect(route($this->homeRoute));
    }
}
