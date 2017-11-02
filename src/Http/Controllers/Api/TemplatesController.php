<?php namespace Btybug\Resources\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Resources\Models\Template as Template;
use Illuminate\Http\Request;


/**
 * @property Template template
 */
class TemplatesController extends Controller
{
    /**
     * TemplatesController constructor.
     *
     * @param Template $template
     */
    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    /**
     * Provide the list of templates in system
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->template->search($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->template->template($id, 'json');
    }


}
