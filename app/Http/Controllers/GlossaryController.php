<?php

namespace App\Http\Controllers;

use App\Models\Glossary;
use Illuminate\Http\Request;

class GlossaryController extends Controller
{
    public function index(Request $request)
    {
        $glossaries = Glossary::when(!empty($request->search), function ($query) use ($request) {
            $query->where('term', 'LIKE', $request->search . '%');
            $query->orWhere('description', 'LIKE', $request->search . '%');
        })->paginate(5);

        return $this->success($glossaries);
    }

    public function show(Request $request, Glossary $glossary)
    {

        // no authorization needed
        // request validation may be needed as filters are added
        $pest = Glossary::find($glossary);

        return $this->success($glossary);
    }

    public function create(Request $request)
    {
        // authorize user
        // validate request

        $glossary = Glossary::create([
            'term' => $request->term,
            'description' => $request->description,
        ]);

        return $this->success($glossary);
    }

    public function update(Request $request, Glossary $glossary)
    {
        // authorize user
        // validate request

        $glossary->update([
            'term' => $request->term,
            'description' => $request->description,
        ]);

        return $this->success($glossary);
    }

    public function destroy(Request $request, Glossary $glossary)
    {
        // authorize user
        // validate request

        $glossary->delete();

        return $this->success($glossary);
    }
}
