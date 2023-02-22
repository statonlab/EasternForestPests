<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Responds;
use App\Models\CommonName;
use App\Models\Pest;
use App\Models\ScientificName;
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

        $pests = Pest::with(['chapter', 'commonNames', 'scientificNames'])
            ->when(!empty($request->search), function ($query) use ($request) {
                $query->whereHas('commonNames', function ($query) use ($request) {
                    $query->where('name', 'like', $request->search . '%');
                });
                $query->orWhereHas('scientificNames', function ($query) use ($request) {
                    $query->where('name', 'like', $request->search . '%');
                });
                $query->orWhere('description', 'like', '%' . $request->search . '%');
                $query->orWhere('major_hosts', 'like', '%' . $request->search . '%');
                $query->orWhere('key_features', 'like', '%' . $request->search . '%');
                $query->orWhere('control', 'like', '%' . $request->search . '%');
                $query->orWhere('other_info_title', 'like', '%' . $request->search . '%');
                $query->orWhere('other_info_body', 'like', '%' . $request->search . '%');
                $query->orWhere('pest_type', 'like', '%' . $request->search . '%');
                $query->orWhere('disease_visiblity', 'like', '%' . $request->search . '%');
                $query->orWhere('feeding_target', 'like', '%' . $request->search . '%');
            })->paginate(5);

        return $this->success($pests);
    }

    public function show(Request $request, Pest $pest): \Illuminate\Http\JsonResponse
    {
        // no authorization needed
        // request validation may be needed as filters are added
        $pest = Pest::find($pest);

        return $this->success($pest);
    }

    public function create(Request $request)
    {
        // authorize user
        // validate request

        $pest = Pest::create([
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

        foreach($request->scientific_names as $name) {
            ScientificName::create([
                'name' => $name,
                'pest_id' => $pest->id
            ]);
        }

        foreach($request->common_names as $name) {
            CommonName::create([
                'name' => $name,
                'pest_id' => $pest->id
            ]);
        }

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
