<?php
namespace Database\Seeders;
use App\Models\{User,Category,Product};use Illuminate\Database\Seeder;use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {public function run():void{
 User::firstOrCreate(['email'=>'admin@tokokita.test'],['name'=>'Administrator','password'=>Hash::make('password'),'role'=>'admin']);
 User::firstOrCreate(['email'=>'customer@tokokita.test'],['name'=>'Pelanggan Demo','password'=>Hash::make('password'),'role'=>'customer']);
 foreach(['Fashion','Elektronik','Aksesoris','Rumah Tangga'] as $name){Category::firstOrCreate(['slug'=>str($name)->slug()],['name'=>$name]);}
 $items=[['Kaos Basic Premium','Fashion',89000,25,'👕'],['Sneakers Casual','Fashion',329000,12,'👟'],['Headphone Wireless','Elektronik',259000,18,'🎧'],['Smartwatch Sport','Elektronik',399000,9,'⌚'],['Tas Selempang','Aksesoris',149000,20,'👜'],['Botol Minum','Rumah Tangga',59000,30,'🧴'],['Lampu Meja Minimalis','Rumah Tangga',179000,14,'💡'],['Topi Everyday','Aksesoris',75000,22,'🧢']];
 foreach($items as [$name,$category,$price,$stock,$emoji]){$cat=Category::where('name',$category)->first();Product::firstOrCreate(['slug'=>str($name)->slug()],['category_id'=>$cat->id,'name'=>$name,'description'=>'Produk pilihan TokoKita dengan kualitas terbaik.','price'=>$price,'stock'=>$stock,'image'=>$emoji]);}
}}
