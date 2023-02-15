<?php

namespace App\Http\Controllers;

use App\Models\GroupProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class NhomsanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data =  GroupProduct::paginate(1);//Nhomsanpham::where('name', 'like', '%'.$key.'%')->orderby('priotiry','DESC')->paginate(5);
        }
        else {
            $data = GroupProduct::paginate(2);
        }

        return view('admin.nhomsanpham.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nhomsanpham.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:nhomsanpham,ten',
            'priotiry'=>'required',
        ],
        [
            'name.required' => 'Cần nhập tên nhóm sản phẩm',
            'name.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'priotiry.required' => "Cần nhập mức độ ưu tiên",

        ]
        );

        if (GroupProduct::create($request->all())){
            return redirect()->route('admin.nhomsanpham.index')->with('success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupProduct  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function show(GroupProduct $nhomsanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupProduct  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupProduct $nhomsanpham)
    {
        return view('admin.nhomsanpham.edit',["nhomsanpham"=>$nhomsanpham]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupProduct  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nhomsanpham $nhomsanpham)
    {
        $request->validate([
            'name'=>'required|unique:nhomsanpham,ten,'.$nhomsanpham->id,
            'priotiry'=>'required',
        ],
        [
            'name.required' => 'Cần nhập tên nhóm sản phẩm',
            'name.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'priotiry.required' => "Cần nhập mức độ ưu tiên",

        ]
        );

        if ($nhomsanpham->update($request->all())){
            return redirect()->route('admin.nhomsanpham.index')->with('success','Thêm mới thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupProduct  $nhomsanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupProduct $nhomsanpham)
    {
        //
        if ($nhomsanpham->sanphams()->count()>0){
            return redirect()->route('admin.nhomsanpham.index')->with('error','Xóa bản ghi không thành công do có chứa sản phẩm.');
        }
        else{
            $nhomsanpham->delete();
            return redirect()->route('admin.nhomsanpham.index')->with('success','Xóa bản ghi thành công.');
        }

    }
}
