<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProductsDataTable;
use App\Models\Product;
use App\Models\Category;
use App\Models\File as FileTbl;
use App\Models\Size;
use App\Models\OtherData;
use Upload;
use Storage;
use Yajra\DataTables\Facades\DataTables;

class Products extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $products = Product::all();
            return DataTables::of($products)
                ->addColumn('checkbox', 'admin.products.btn.checkbox')
                ->addColumn('actions', 'admin.products.btn.btn')
                ->rawColumns(['actions', 'checkbox'])
                ->make(true);
        } elseif (request()->ajax() && request()->has('filter')) {
            $products = Product::where('color_id', request('color_id'))->get();
            return DataTables::of($products)
                ->addColumn('checkbox', 'admin.products.btn.checkbox')
                ->addColumn('actions', 'admin.products.btn.btn')
                ->rawColumns(['actions', 'checkbox'])
                ->make(true);
        }
        return view('admin.products.index');
        // $product = Product::find(3);
        // ProductsDataTable::query($product);
        // return $datatable->render('admin.products.index');
    }
    public function filter(Request $request)
    {
        if (request()->ajax() && request()->has('category_id') || request()->has('color_id')) {
            $selectedPros = [];
            // $products = Product::with(['categories' => function ($q) {
            //     $q->where('category_id', request('category_id'));
            // }])->get();

            $products = Product::where('color_id', request('color_id'))->get();
            return DataTables::of($products)
                ->addColumn('checkbox', 'admin.products.btn.checkbox')
                ->addColumn('actions', 'admin.products.btn.btn')
                ->rawColumns(['actions', 'checkbox'])
                ->make(true);
        }

        return view('admin.products.index');
    }
    public function create()
    {
        $product = Product::create([
            'title' => ''
        ]);
        if (!empty($product)) {
            return redirect(aurl('products/' . $product->id . '/edit'));
        }
    }
    public function store(Request $request)
    {
    }
    public function deleteProductImage($id)
    {
        $product = Product::find($id);
        if (!empty($product->photo)) {
            $product->photo = '';
            $product->save();
            Storage::delete($product->photo);
        }
    }
    public function updateProductImage($id)
    {
        $product = Product::where('id', $id)->update([
            'photo' => Upload::upload([
                'file' => 'file',
                'path' => 'products/' . $id,
                'upload_type' => 'single',
                'delete_file' => ''
            ])
        ]);

        return response(['status' => true, 200]);
    }
    public function uploadImages($id)
    {

        if (request()->has('file')) {
            $fid =  Upload::upload([
                'file' => 'file',
                'path' => 'products/' . $id,
                'upload_type' => 'files',
                'file_type' => 'product',
                'relation_id' => $id,
            ]);

            return response(['status' => true, 'id' => $fid], 200);
        }
    }
    public function deleteImages()
    {

        if (request()->has('id')) {
            Upload::delete(request('id'));
        }
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $product->price;
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $parentCategories = Category::where('parent_id', NULL)->get();

        $subCategories = Category::where('parent_id', '!=', NULL)->get();
        $countries = \App\Models\Country::all();

        return view('admin.products.createOrUpdate', compact('product', 'parentCategories', 'subCategories'));
    }


    public function copyProduct($id)
    {
        if (request()->ajax()) {

            $copy_cat = Product::find($id)->toArray();
            $otherData = Product::find($id);

            unset($copy_cat['id']);
            $newProduct = Product::create($copy_cat);
            if (!empty($copy_cat['photo'])) {
                //ext , hashname , path

                $ext = \File::extension($copy_cat['photo']);
                $new_path = 'products/' . $newProduct->id . '/' . time() . '.' . $ext;

                \Storage::copy($copy_cat['photo'], $new_path);

                $newProduct->photo = $new_path;
                $newProduct->save();
            }

            //duplicate relations : malls


            foreach ($otherData->malls()->get() as $mall) {
                $newProduct->malls()->attach($mall->id);
            }
            //duplicate relations : otherdata

            foreach ($otherData->otherData()->get() as $other) {
                OtherData::create([
                    'product_id' => $newProduct->id,
                    'key_data' => $other->key_data,
                    'value_data' => $other->value_data,
                ]);
            }
            //duplicate relations : files
            foreach ($otherData->files()->get() as $file) {
                /*
	'name','size','file','path','full_file','mime_type','file_type','relation_id',
	 */
                $hashname = rand(0, 100);
                $ext = \File::extension($file->full_file);
                $new_path = 'products/' . $newProduct->id . '/' . $hashname . '.' . $ext;
                \Storage::copy($file->full_file, $new_path);
                $new_file = FileTbl::create([
                    'name' => $file->name,
                    'size' => $file->size,
                    'file' => $hashname,
                    'path' => 'products/' . $newProduct->id,
                    'full_file' => 'products/' . $newProduct->id . '/' . $hashname . '.' . $ext,
                    'mime_type' => $file->mime_type,
                    'file_type' => 'product',
                    'relation_id' => $newProduct->id,
                ]);
            }

            return response([
                'status' => true,
                'massage' => trans('admin.copy_success'),
                'id' => $newProduct->id
            ], 200);
        } else {

            return redirect(aurl('/'));
        }
    }
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'title'          => 'required',
            'content'        => 'required',
            'department_id'  => 'required|numeric',
            'trade_id'       => 'required|numeric',
            'unit_id'       => 'required|numeric',
            'manufact_id'        => 'required|numeric',
            'color_id'       => 'sometimes|nullable|numeric',
            'size_id'        => 'sometimes|nullable|numeric',
            'size'           => 'sometimes|nullable',
            'currency_id'    => 'sometimes|nullable|numeric',
            'price'          => 'required|numeric',
            'stock'          => 'required|numeric',
            'start_at'       => 'required|date',
            'end_at'         => 'required|date',
            'start_offer_at' => 'sometimes|nullable|date',
            'end_offer_at'   => 'sometimes|nullable|date',
            'price_offer'    => 'sometimes|nullable|numeric',
            'weight'         => 'sometimes|nullable',
            'state'         => 'sometimes|nullable|in:pending,refused,active',
            'reason'         => 'sometimes|nullable|numeric',
        ]);
        if (request()->has('mall_id')) {
            $product = Product::find($id);
            $product->malls()->sync(request('mall_id'));
        }

        if (request()->has('category_id')) {
            $product = Product::find($id);
            $product->categories()->sync(request('category_id'));
        }

        if (request()->has('input_key') && request()->has('input_value')) {
            $i = 0;
            $other_data = '';

            OtherData::where('product_id', $id)->delete();

            foreach (request('input_key') as $key) {
                $other_data .= $key . '||' . request('input_value')[$i] . '|';

                $value_data = !empty(request('input_value')[$i]) ? request('input_value')[$i] : '';
                $i++;
                OtherData::create([
                    'product_id' => $id,
                    'key_data' => $key,
                    'value_data' => $value_data
                ]);
            }
            $data['other_data'] = rtrim($other_data, '|');
        }
        Product::where('id', $id)->update($data);
        return response(['status' =>  true, 'message' => trans('admin.product_updated')], 200);
    }
    public function destroy($id)
    {
        // what do i want to delete?
        // the product , storage:photo , files , storage:file.
        $product = Product::find($id);
        $files = FileTbl::where('relation_id', $id)->where('file_type', 'product')->get();
        if (count($files) > 0) {
            foreach ($files as $file) {
                Storage::delete($file->path);
                Storage::deleteDirectory($file->path);
                $file->delete();
            }

            Storage::delete($product->photo);
            $product->malls()->delete();

            $product->delete();
        }
        session()->flash('success', trans('removed successfully'));

        return redirect(aurl('products'));
    }
    public function getSizesOfUnit($id)
    {
        $unit_id = request('id');
        $pro = request('proId');
        $sizes = Size::where('unit_id', $unit_id)->get();
        $size_of_product_if_existed =  Product::where('id', $pro)->select(['size_id'])->first();

        if ($size_of_product_if_existed[0] == NULL) {
            return response(['sizes' => $sizes, 'selectedSize' => NULL], 200);
        } else {
            return response(['sizes' => $sizes, 'selectedSize' => $size_of_product_if_existed], 200);
        }
    }
    public function multi_delete()
    {
        $items = request('item');
        $products = Product::findOrFail($items);
        $products->each(function ($product) {
            $this->destroy($product->id);
            $product->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
