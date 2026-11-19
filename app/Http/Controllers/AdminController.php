<?php
namespace App\Http\Controllers;
use App\Models\{Product,Category,Order};use Illuminate\Http\Request;use Illuminate\Support\Str;use Inertia\Inertia;
class AdminController extends Controller {
 public function index(){return Inertia::render('Admin/Dashboard',['stats'=>['products'=>Product::count(),'orders'=>Order::count(),'revenue'=>Order::whereIn('status',['paid','processing','shipped','completed'])->sum('total')],'orders'=>Order::with('user')->latest()->take(8)->get()]);}
 public function products(){return Inertia::render('Admin/Products',['products'=>Product::with('category')->latest()->paginate(12),'categories'=>Category::all()]);}
 public function saveProduct(Request $request,?Product $product=null){$data=$request->validate(['name'=>'required|string|max:150','category_id'=>'nullable|exists:categories,id','description'=>'nullable|string','price'=>'required|integer|min:0','stock'=>'required|integer|min:0','image'=>'nullable|string|max:255']);$data['slug']=Str::slug($data['name']).'-'.Str::lower(Str::random(5));if($product && $product->exists){$data['slug']=$product->slug;$product->update($data);}else{Product::create($data);}return back()->with('success','Produk berhasil disimpan.');}
 public function updateProduct(Request $request,Product $product){return $this->saveProduct($request,$product);}
 public function deleteProduct(Product $product){$product->delete();return back()->with('success','Produk dihapus.');}
 public function orders(){return Inertia::render('Admin/Orders',['orders'=>Order::with('user','items')->latest()->paginate(15)]);}
 public function updateOrder(Request $request,Order $order){$data=$request->validate(['status'=>'required|in:pending,paid,processing,shipped,completed,cancelled']);$order->update($data);return back()->with('success','Status pesanan diperbarui.');}
}
