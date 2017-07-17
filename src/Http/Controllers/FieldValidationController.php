<?php
/**
 * Created by PhpStorm.
 * User: Sahak
 * Date: 10/31/2016
 * Time: 1:29 PM
 */

namespace App\Modules\Assets\Http\Controllers;


use App\Modules\Resources\Models\Forms\Forms;
use App\Modules\Users\User;
use Illuminate\Http\Request;

class FieldValidationController
{
    public function getIndex()
    {
        return view('resources::ftest');
    }

    public function postFormTest(Request $request)
    {
        return \Response::json(['success' => true, 'html' => Forms::typeRules($request->get('type'))]);
    }

    public function getRules()
    {
        return view('resources::types_rules');
    }

    public function postFormRule(Request $request)
    {
        return \Response::json(['success' => true, 'html' => Forms::ruler($request->get('rule'))]);
    }

    public function postFormRuleSave(Request $request)
    {
        return \Response::json(['success' => true, 'data' => Forms::rulerSave($request)]);
    }
}