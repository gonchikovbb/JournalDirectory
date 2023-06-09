<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMagazineRequest;
use App\Models\Author;
use App\Models\Magazine;
use App\Services\MagazineService;
use Illuminate\Pagination\Paginator;

class MagazineController extends Controller
{
    private MagazineService $magazineService;

    public function __construct(MagazineService $magazineService)
    {
        $this->magazineService = $magazineService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function index(): Paginator
    {
        return Magazine::with('authors')->simplePaginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Magazine
     */
    public function add(StoreMagazineRequest $request)
    {
        $data = $request->validated();

        $magazine = Magazine::create($data);

        $authors = Author::find($data['author_ids']);

        $magazine->authors()->attach($authors);

        return $this->magazineService->saveMagazine($magazine, $request->file('photo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magazine  $magazine
     * @return Magazine
     */
    public function update(StoreMagazineRequest $request, $id)
    {
        $magazine = Magazine::query()->find($id);

        $magazine->update($request->all());

        return $this->magazineService->saveMagazine($magazine, $request->file('photo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Magazine  $magazine
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $magazine = Magazine::query()->find($id);

        $magazine->delete();

        return response()->json(['message' => 'User deleted'],200);
    }
}
