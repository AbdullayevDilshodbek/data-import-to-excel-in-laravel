<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        // Excel file name for download
        $fileName = "buyurtmalar_" . date('Y-m-d') . ".xls";

        // Column names
        $fields = array('T/r', 'Ism sharf', 'Login','Yaratilgan');

        // Display column names as first row
        $excelData = implode("\t", array_values($fields)) . "\n";

        $data = $this->user->all();
        foreach($data as $user){
            $lineData = array($user['id'], $user['full_name'], $user['username'],$user['created_at']);
            array_walk($lineData, function(&$str){
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
            });
            $excelData .= implode("\t", array_values($lineData)) . "\n";
        }

        // Headers for download
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        // Render excel data
        echo $excelData;

        exit;
    }

    public function store(Request $request)
    {
        $this->user->create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        return response()->json(['message' => 'Ok'],201);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
