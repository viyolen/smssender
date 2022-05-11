<?php

namespace App\Http\Controllers;


use App\Models\MailGroupsReceiversModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleXLSX1\SimpleXLSX;

class MailGroupsReceiversController extends Controller
{
    private $db;
    private $modulName = "email.lists.users.";
    private $homeRoute;
    private $addRoute;
    private $updateRoute;
    private $addPostRoute;
    private $deletePostRoute;
    private $updatePostRoute;

    public function __construct()
    {
        $this->db = new MailGroupsReceiversModel();
        $this->homeRoute = $this->modulName;
        $this->addRoute = $this->modulName . ".add";
        $this->updateRoute = $this->modulName . ".update";
        $this->addPostRoute = $this->modulName . ".add.post";
        $this->updatePostRoute = $this->modulName . ".update.post";
    }

    public function index($id)
    {
        $data = $this->db->all()->where('group_id', $id);
        $first = DB::table('mail_groups')->where('id', $id)->first();

        return view($this->homeRoute . "home", compact('data', 'id', 'first'));
    }

    public function insertView($id)
    {
        $first = DB::table('mail_groups')->where('id', $id)->first();
        return view($this->homeRoute . "insert", compact('first', 'id'));
    }


    public function excel(Request $request, $group)
    {
        $json_data = array();

        $niceNames = array(
            'file' => 'Dosya',
        );

        $messages = [

        ];

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx',
        ], $messages, $niceNames)->validate();

        $file = $request->file('file');
        $logoExt = $file->getClientOriginalExtension();
        $fileName = Auth::id() . "." . $logoExt;
        Storage::disk('uploads')->makeDirectory('excel_uploads');


        $file->move("uploads/excel_uploads/", $fileName);


        if ($xlsx = SimpleXLSX::parse("uploads/excel_uploads/" . $fileName)) {
            $say = 0;
            $data = $xlsx->rows();


            foreach ($data as $index => $datum) {

                $data = $this->db->where('email', trim($datum[0]))->first();
                if (empty($data)) {
                    $arr = [
                        'user_id' => Auth::id(),
                        'group_id' => $group,
                        'email' => $datum[0],
                        'name_surname' => $datum[1]
                    ];
                    $this->db->create($arr);
                }


            }
            $json_data['state'] = true;

            echo json_encode($json_data);
        } else {
            echo SimpleXLSX::parseError();
            exit;
        }
    }

    public function updateView($group,$id)
    {
        $data = $this->db->where('id', $id)->first();
        if (empty($data))
            return redirect(route($this->homeRoute, $group));

        $data = $this->db->where('id', $id)->first();

        return view($this->homeRoute . "update", compact('data', 'id','group'));
    }

    public function insert(Request $request, $group)
    {
        $request->merge(['user_id' => Auth::id()]);
        $request->merge(['group_id' => $group]);

        $this->db->create($request->all());
        return redirect(route($this->homeRoute, $group));
    }
    public function update(Request $request, $group,$id)
    {
        $this->db->where('id', $id)->update($request->except('_token'));
        return redirect(route($this->homeRoute,$group));
    }

    public function delete(Request $request, $group, $id)
    {
        $this->db->where('id', $id)->delete();
        return redirect(route($this->homeRoute, $group));
    }
}
