<?php
namespace App\Http\Controllers;
use App\Models\Product;use Illuminate\Http\Request;use Inertia\Inertia;
class ShopController extends Controller {
 public function index(Request $request){$products=Product::with('category')->when($request->q,fn($q,$v)=>$q->where('name','like',"%{$v}%"))->latest()->paginate(12)->withQueryString();return Inertia::render('Shop/Index',['products'=>$products,'filters'=>$request->only('q')]);}
 public function show(Product $product){$product->load('category');return Inertia::render('Shop/Show',['product'=>$product]);}
 public function cart(){ $cart=session('cart',[]);$ids=array_keys($cart);$products=Product::whereIn('id',$ids)->get()->keyBy('id');$items=[];$total=0;foreach($cart as $id=>$row){if(!$products->has($id))continue;$p=$products[$id];$subtotal=$p->price*$row['qty'];$total+=$subtotal;$items[]=['product'=>$p,'qty'=>$row['qty'],'subtotal'=>$subtotal];}return Inertia::render('Shop/Cart',['items'=>$items,'total'=>$total]); }
 public function addToCart(Request $request,Product $product){$data=$request->validate(['qty'=>'required|integer|min:1']);abort_if($product->stock<$data['qty'],422,'Stok tidak mencukupi.');$cart=session('cart',[]);$cart[$product->id]['qty']=min(($cart[$product->id]['qty']??0)+$data['qty'],$product->stock);session(['cart'=>$cart]);return back()->with('success','Produk ditambahkan ke keranjang.');}
 public function updateCart(Request $request,Product $product){$data=$request->validate(['qty'=>'required|integer|min:0']);$cart=session('cart',[]);if($data['qty']===0)unset($cart[$product->id]);else{$cart[$product->id]=['qty'=>min($data['qty'],$product->stock)];}session(['cart'=>$cart]);return back()->with('success','Keranjang diperbarui.');}
 public function removeCart(Product $product){$cart=session('cart',[]);unset($cart[$product->id]);session(['cart'=>$cart]);return back()->with('success','Produk dihapus dari keranjang.');}
}
