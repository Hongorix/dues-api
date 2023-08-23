<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionsRecource;
use App\Models\Collections;
use App\Models\Contributors;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Collections $collection)
    {
        if ($request->has('ShowOnlyUnfinished')) {
            return CollectionsRecource::collection(
                $collection->get()->filter(function ($collection) {
                    return $collection->contributors->sum('amount') < $collection->target_amount;
                })
            );
        }

        return CollectionsRecource::collection(
            $collection->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $collection = Collections::create([
            ...$request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'target_amount' => 'required|numeric|min:1',
                'link' => [
                    'required',
                    'regex:/^(https?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(\/[a-zA-Z0-9-._?=&]*)?$/'
                ]
            ]),
            'user_id' => 1
        ]);

        return new CollectionsRecource($collection);
    }

    /**
     * Display the specified resource.
     */
    public function show(Collections $collection)
    {
        $collection->load('contributors');
        return new CollectionsRecource($collection);;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collections $collection)
    {
        $collection->update(
            $request->validate([
                'title' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'target_amount' => 'sometimes|numeric|min:1',
                'link' => [
                    'sometimes',
                    'regex:/^(https?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(\/[a-zA-Z0-9-._?=&]*)?$/'
                ]
            ]),
        );

        return new CollectionsRecource($collection);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collections $collection)
    {
        $collection->delete();
        return response(status: 204);
    }
}
