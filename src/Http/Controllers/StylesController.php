<?php
/**
 * Copyright (c) 2016.
 * *
 *  * Created by PhpStorm.
 *  * User: Edo
 *  * Date: 10/3/2016
 *  * Time: 10:44 PM
 *
 */

namespace Btybug\Resources\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Resources\Models\StyleItems;
use App\Modules\Resources\Models\Styles;
use App\Modules\Resources\Models\StyleUpload;
use Datatables;
use File;
use Illuminate\Http\Request;
use Sahakavatar\Cms\Helpers\helpers;
use Sahakavatar\Cms\Helpers\helpers;
use View;


/**
 * Class StylesController
 * @package App\Modules\Assets\Http\Controllers
 */
class StylesController extends Controller
{
    /**
     * @var
     */
    public $stUpload;
    /**
     * @var mixed
     */
    public $up;
    /**
     * @var dbhelper
     */
    protected $dhelp;

    /**
     * @var helpers
     */
    private $helper;

    /**
     * ClassesController constructor.
     *
     * @param Dhelper $dhelper
     */
    public function __construct(StyleUpload $stUpl)
    {
        $this->stUpload = $stUpl;
        $this->dhelp = new dbhelper();
        $this->helper = new helpers();
        $this->up = config('paths.styles_upl');
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        $styles = Styles::where('type', 'text')->get();

        return view('resources::styles.list')->with('styles', $styles);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddSub(Request $request)
    {
        $type = $request->get('type');
        $name = $request->get('name');

        if (!in_array($type, Styles::$stylesTypes)) return redirect()->back();

        Styles::create([
            'name' => $name,
            'type' => $type,
            'slug' => str_replace(' ', '-', strtolower($name))
        ]);

        return redirect()->back();
    }


    /**
     * Deleting Style Itoms
     */
    public function getStyleDelete(Request $request, $id)
    {
        $styleItom = StyleItems::find($id);
        if ($styleItom->delete()) return redirect()->back();

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpload(Request $request)
    {
        $style_id = $request->get('style_id');

        if ($style = Styles::find($style_id)) {
            $file = $request->file('file');
            $data = StyleItems::uplaodStyle($file);
            if ($data) {
                $data['style_id'] = $style->id;
                $data['type'] = $style->type;
                $data['slug'] = preg_replace('/\s+/', '', $data['slug']);
                if (StyleItems::create($data)) {
                    return \Response::json(['message' => 'Successfully', 'code' => '200', 'error' => false]);
                }
            }
        }

        return \Response::json(['message' => 'Style does not exists', 'code' => '500', 'error' => true]);
    }

    /**
     * @param Request $request
     * @return array|string
     */
    public function postUploadOld(Request $request)
    {
        $isValid = $this->stUpload->isCompress($request->file('file'));

        if (!$isValid) return $this->stUpload->ResponseError('Uploaded data is InValid!!!', 500);

        $response = $this->stUpload->upload($request);
        if (!$response['error']) {
            //save style
            $result = $this->stUpload->validateAndreturnData($response['folder'], $response['data']);
            if (!$result['error']) {
                File::deleteDirectory($this->up, true);
                $data = $result['data'];
                $styleSlug = $data['style'];
                if ($style = Styles::where('slug', $styleSlug)->first()) {

                    StyleItems::create([
                        'name' => $data['name'],
                        'slug' => $data['slug'],
                        'type' => $data['type'],
                        'css_data' => $data['css_data'],
                        'style_id' => $style->id,
                    ]);
                } else {
                    $result = ['message' => 'Style with slug ' . $styleSlug . ' does not exists', 'code' => '500', 'error' => true];
                }
            }

            File::deleteDirectory($this->up, true);

            return $result;

        } else {
            File::deleteDirectory($this->up, true);

            return $response;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRenderStyles(Request $request)
    {
        $main_type = $request->get('main_type');
        $subItem = $request->get('sub');
        $sort = $request->get('sort');
        $orderData = $this->helper->sorting($sort);

        if ((int)$subItem == false) {
//            $styleItems = StyleItems::where('type', $main_type)->orderBy($orderData['key'], $orderData['value'])->get();
            $styles = Styles::where('type', $main_type)->get();
            $html = View::make("resources::styles._partials.subs_list", compact(['styles', 'subItem', 'main_type', 'sort']))->render();
        } else {
            $style = Styles::find($subItem);
            if (!$style) return \Response::json(['message' => "Sub Style not found !!!", 'error' => true]);
            $styleItems = $style->items()->orderBy($orderData['key'], $orderData['value'])->get();

            $html = View::make("resources::styles._partials.list_cube", compact(['styleItems', 'subItem', 'main_type', 'sort']))->render();
        }


        return \Response::json(['html' => $html, 'subItem' => $subItem, 'error' => false]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postShowPopUp(Request $request)
    {
        $style_id = $request->get('id');

        $style_itom = StyleItems::find($style_id);

        $html = View::make("resources::styles._partials.pop_up", compact(['style_id', 'style_itom']))->render();

        return \Response::json(['html' => $html, 'style_id' => $style_id, 'error' => false]);
    }

    /**
     * @param $style_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getStylePreview($style_id)
    {
        $style = Styles::find($style_id);

        if (!$style) return redirect()->back();

        $items = $style->items;

        return view('resources::styles.style_preview')->with(['style' => $style, 'styleItems' => $items]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postStylePreview(Request $request, $id)
    {
        $subItem = $request->get('sub');
        $sort = $request->get('sort');
        $orderData = $this->helper->sorting($sort);

        $style = Styles::find($id);

        if (!$style) return \Response::json(['error' => true]);

        $styleItems = $style->items()->orderBy($orderData['key'], $orderData['value'])->get();

        $html = View::make("resources::styles._partials.list_cube", compact(['styleItems', 'subItem', 'sort']))->render();


        return \Response::json(['html' => $html, 'error' => false]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postStyleCssUpdate(Request $request)
    {
        $id = $request->get('id');
        $css = $request->get('css');
        $style_itom = StyleItems::find($id);
        $cssCode = "." . $style_itom->slug . "{" . $css . "}";
        $style_itom->css_data = $cssCode;
        $style_itom->save();

        return \Response::json(['id' => $id, 'css' => $css, 'cssCode' => '$cssCode', 'error' => false]);
    }

    /**
     * Get All Classes Related to Text
     *
     * @return view
     */
    public function getText()
    {
        $data = Classes::where('type', 'text')->get();

        return view('resources::classes.text')->with('classes', $data);
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getData($type)
    {
        $data = Classes::where('type', $type)->get();
        $obj = Datatables::of($data)->addColumn('action', function ($class) {
            $collection = [];
            if ($class->role) {
                $collection['delete'] = ['link' => '/admin/resources/delete/' . $class->id];
            }
            $collection['setting_same'] = ['link' => '/admin/resources/settings/' . $class->id];
            $collection['variations'] = ['link' => '/admin/resources/classes/variation-class/' . $class->id];

            return $this->dhelp->actionBtns($collection);
        });

        $obj = $obj->make(true);

        return $obj;
    }

    /**
     * @param $style_id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeDefault($style_id, $id)
    {
        $item = StyleItems::find($id);

        if (!$item) return redirect()->back();

        StyleItems::where('style_id', $style_id)->update([
            'is_default' => 0
        ]);

        $item->update([
            'is_default' => 1
        ]);

        return redirect()->back();
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getOptimize()
    {
        StyleItems::makeCss();

        return redirect()->back()->with('message', 'Styles Optimized');
    }
}
