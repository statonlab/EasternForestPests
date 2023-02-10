<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Responds;
use App\Models\Pest;
use Illuminate\Http\Request;

class PestController extends Controller
{
    use Responds;

    /**
     * Returns list of all pests and diseases in the database.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        // no authorization needed
        // request validation may be needed as filters are added

        // several filters will be added
        $pests = Pest::with('chapter')
            ->when(!empty($request->search), function ($query) use ($request) {
                $query->where('common_name', 'LIKE', $request->search . '%');
            })->paginate(5);

        return $this->success($pests);
    }

    public function show(Request $request, Pest $pest): \Illuminate\Http\JsonResponse
    {
        // no authorization needed
        // request validation may be needed as filters are added
        $pests = Pest::find($pest);

        return $this->success($pest);
    }

    public function create(Request $request)
    {
        // authorize user
        // validate request

        $pest = Pest::create([
            'common_name' => $request->common_name,
            'scientific_name' => $request->scientific_name,
            'description' => $request->description,
            'chapter' => $request->chapter,
            'major_hosts' => $request->major_hosts,
            'key_features' => $request->key_features,
            'control' => $request->control,
            'other_info_title' => $request->other_info_title,
            'other_info_body' => $request->other_info_body,
            'pest_type' => $request->pest_type,
            'affects_deciduous' => $request->affects_deciduous,
            'affects_conifer' => $request->affects_conifer,
            'is_disease' => $request->is_disease,
            'is_pest' => $request->is_pest,
            'disease_visiblity' => $request->disease_visiblity,
            'feeding_target' => $request->feeding_target
        ]);

        return $this->created($pest);
    }

    public function update(Request $request, Pest $pest): \Illuminate\Http\JsonResponse
    {
        // authorize user
        // validate request

        $pest->update([
            'common_name' => $request->common_name,
            'scientific_name' => $request->scientific_name,
            'description' => $request->description,
            'chapter' => $request->chapter,
            'major_hosts' => $request->major_hosts,
            'key_features' => $request->key_features,
            'control' => $request->control,
            'other_info_title' => $request->other_info_title,
            'other_info_body' => $request->other_info_body,
            'pest_type' => $request->pest_type,
            'affects_deciduous' => $request->affects_deciduous,
            'affects_conifer' => $request->affects_conifer,
            'is_disease' => $request->is_disease,
            'is_pest' => $request->is_pest,
            'disease_visiblity' => $request->disease_visiblity,
            'feeding_target' => $request->feeding_target
        ]);

        return $this->created($pest);
    }

    public function destroy(Request $request, Pest $pest): \Illuminate\Http\JsonResponse
    {
        // authorize user
        // validate request

        $pest->delete();

        return $this->success($pest);
    }
}
