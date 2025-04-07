<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 



class ProductController extends Controller
{
    public function index()
    {
       $products = Product::paginate(6);

       return view('products.index', compact('products'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $productData = $request->validated();
            $productData['image_path'] = null;

            $product = Product::create($productData);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/image');
                $product->update(['image_path' => str_replace('public/', '', $imagePath)]);
            }

            if ($request->filled('seasons')) {
                $product->seasons()->attach($request->input('seasons'));
            }

            DB::commit();
            return redirect()->route('products.index')->with('success', '商品が登録されました。');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withErrors(['seasons' => '指定された季節IDが存在しません。']);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '商品の登録に失敗しました。']);
        }

    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->paginate(6);

        return view('products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $seasons = Season::all(); // 季節データを取得
        return view('products.edit', compact('product', 'seasons'));
    }

}
