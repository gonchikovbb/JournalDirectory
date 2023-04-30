<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Author::simplePaginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(StoreAuthorRequest $request)
    {
        $author = Author::create($request->all());

        $author->save();

        return $author;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function update(StoreAuthorRequest $request, $id)
    {
        $data = $request->validated();

        $author = Author::query()->find($id);

        if (!empty($data['last_name'])) {
            if ($data['last_name'] !== $author->getLastName()) {
                $author->setLastName($data['last_name']);
            }
        }

        if (!empty($data['first_name'])) {
            if ($data['first_name'] !== $author->getFirstName()) {
                $author->setFirstName($data['first_name']);
            }
        }

        if (!empty($data['third_name'])) {
            if ($data['third_name'] !== $author->getThirdName()) {
                $author->setThirdName($data['third_name']);
            }
        }

        $author->update();

        $author->save();

        return $author;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $author = Author::query()->find($id);

        $author->delete();

        return response()->json(['message' => 'Author deleted'],200);

    }
}
