<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item;

use Response;
use View;
use App;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id','desc')->paginate(4);
        return view('item.item_list', compact('items'));
    }

    public function listItems($offset = 0, $limit = 10)
    {
        $book = Item::offset($offset)->limit($limit)->get();
        return Response::json($book);
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
    public function store(Request $request)
    {
        $imei = $request->input('imei');
        $sn = $request->input('sn');

        $items = [];
        
        if(sizeof($imei) > 0 && sizeof($sn) > 0) {
            $data = ['imei'=> $imei, 'sn'=> $sn];
            // print_r($data);
            Item::create($data);
        }
        
        return Response::json(['success' => true]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
