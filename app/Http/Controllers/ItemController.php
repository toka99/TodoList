<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Requests\ItemRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::orderBy('created_at','DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $Item = new Item($request->all());
        $Item->save();

        return response(
          $Item
         ,Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Item = Item::find($id);

        if($Item)
        {
            $Item->completed = $request->item['completed'] ? true : false;
            $Item->completed_at = $request->item['completed'] ? Carbon::now() : false;
            $Item->save();

            return response(
                $Item
               ,Response::HTTP_CREATED);
            
        }

        return response()->json([
            'errors' => 'Item not found'
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Item = Item::find($id);

        if($Item)
        {
            $Item->delete();

            return response(null,Response::HTTP_NO_CONTENT);
            
        }

        return response()->json([
            'errors' => 'Item not found'
        ],Response::HTTP_NOT_FOUND);
    }
}
