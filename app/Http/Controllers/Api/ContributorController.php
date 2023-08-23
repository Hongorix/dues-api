<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContributorsRecource;
use App\Models\Collections;
use App\Models\Contributors;
use Illuminate\Http\Request;

class ContributorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Collections $collection)
    {
        $contributors = $collection->contributors();

        return ContributorsRecource::collection(
            $contributors->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Collections $collection)
    {
        $contributor = $collection->contributors()->create([
            ...$request->validate([
                'user_name' => 'required|string|max:255',
                'amount' => 'required|numeric|min:1',
            ])
        ]);

        return new ContributorsRecource($contributor);
    }

    /**
     * Display the specified resource.
     */
    public function show(Collections $collection, Contributors $contributor)
    {
        return new ContributorsRecource($contributor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collections $collection, Contributors $contributor)
    {
        $contributor->update(
            $request->validate([
                'user_name' => 'sometimes|string|max:255',
                'amount' => 'sometimes|numeric|min:1',
            ])
        );

        return new ContributorsRecource($contributor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $collection, Contributors $contributor)
    {
        $contributor->delete();
        return response(status: 204);
    }
}
