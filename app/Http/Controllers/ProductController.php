<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\GroupProduct;
use Illuminate\Support\Facades\File;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data = Product::where('name', 'like', '%'.$key.'%')->orderby('priority','DESC')->paginate(5);
        }
        else {
            $data = Product::orderby('priority','DESC')->paginate(5);
        }

        return view('admin.sanpham.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhomsanphams=GroupProduct::orderby('name')->where('status',1)->select('id','name')->get();
        return view('admin.sanpham.create', compact('nhomsanphams'));
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
            'name'=>'required|unique:sanpham',
            'price'=>'required',
            'priority'=>'required',
        ],
        [
            'name.required' => 'Cần nhập tên nhóm sản phẩm',
            'name.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'price.required' => 'Cần nhập giá sản phẩm',
            'priority.required' => "Cần nhập mức độ ưu tiên",

        ]
        );
        if ($request->has('file_upload')){
            $file=$request->file_upload;
            $ext=$file->extension();

            $file_name=time().'-sp.'.$ext;

            $file->move(public_path('uploads'), $file_name);
            $request->merge(['image'=>$file_name]);
        }

        if(Product::create($request->all())){
            return redirect()->route('admin.sanpham.index')->with('success', 'Thêm mới sản phẩm thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show(Product $sanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $sanpham)
    {
        $nhomsanphams=GroupProduct::orderby('name')->where('status',1)->select('id','name')->get();

        return view('admin.sanpham.edit', ['sanpham'=>$sanpham, 'nhomsanphams'=>$nhomsanphams]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $sanpham)
    {
        $request->validate([
            'name'=>'required|unique:nhomsanpham,ten,'.$sanpham->id,
            'price'=>'required',
            'priority'=>'required',
        ],
        [
            'name.required' => 'Cần nhập tên nhóm sản phẩm',
            'name.unique' => 'Tên nhóm sản phẩm cần duy nhất',
            'price.required' => 'Cần nhập giá sản phẩm',
            'priority.required' => "Cần nhập mức độ ưu tiên",

        ]
        );

        $deleteimage=false;
        $oldimage=public_path('uploads/'.$sanpham->image);

        if ($request->has('file_upload')){
            $file=$request->file_upload;
            $ext=$file->extension();

            $file_name=time().'-sp.'.$ext;

            $file->move(public_path('uploads'), $file_name);
            $request->merge(['image'=>$file_name]);
            $deleteimage=true;
        }else{
            $request->merge(['image'=>$sanpham->anh]);
        }
        if($sanpham->update($request->only('name','mota','danhsachanh','nhomsanphamid','price','priceban','image','status','priority'))){
            if ($deleteimage){
                File::delete($oldimage);
            }
            return redirect()->route('admin.sanpham.index')->with('success','Cập nhật sản phẩm thành công.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $sanpham)
    {
        $sanpham->delete();
        return redirect()->route('admin.sanpham.index')->with('success','Xóa bản ghi thành công.');
    }
}
