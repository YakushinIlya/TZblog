<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxUpload extends Controller
{
    public function editor(Request $request)
    {
        $fileExt = $request->file('upload')->getClientOriginalExtension();
        $fileName = md5(time());
        $destinationPath = '../public/uploads/editor/';
        $fileName = $fileName.'.'.mb_strtolower($fileExt);
        $request->file('upload')->move($destinationPath, $fileName);

        $callback = $_REQUEST['CKEditorFuncNum'];
        $full_path = '/uploads/editor/'.$fileName;

        $message = 'Good! Success upload.';

        $res = '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$callback.'",  "'.$full_path.'", "'.$message.'" );</script>';
        return $res;
    }
}
