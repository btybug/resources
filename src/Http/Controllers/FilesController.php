<?php namespace Btybug\Resources\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Resources\Models\Files\FilesBB;
use App\Modules\Resources\Models\Files\FileUpload;
use Datatables;
use File;
use Illuminate\Http\Request;
use View;


class FilesController extends Controller
{
    public $types;
    public $file_upload;

    public function __construct()
    {
        $this->file_upload = new FileUpload();
        $this->types = @json_decode(File::get(config('paths.files_path') . 'configTypes.json'), 1)['types'];
    }

    public function getIndex()
    {
        $files = FilesBB::getFilesTypes('csv');
        $types = $this->types;

        return view('resources::files.list', compact(['types', 'files']));
    }

    public function postFilesWithType(Request $request)
    {
        $main_type = $request->get('main_type');
        $files = FilesBB::getFilesTypes($main_type);
        $html = View::make('resources::files._partials.list_cube', compact(['files']))->render();

        return \Response::json(['html' => $html, 'error' => false]);
    }

    public function postUpload(Request $request)
    {
        return $this->file_upload->upload($request);
    }
}