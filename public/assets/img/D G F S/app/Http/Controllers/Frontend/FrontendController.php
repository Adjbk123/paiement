<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\models\Slider;
use App\models\Category;
use App\models\Product;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        $trendingProducts = Product::where('trending', '0')->latest()->take(15)->get();
        $newArrivalsProducts = Product::latest()->take(14)->get();
        $featuredproducts = Product::where('featured' , '1')->latest()->take(14)->get();
        return view('frontend.index' , compact('sliders' , 'trendingProducts', 'newArrivalsProducts' , 'featuredproducts'));
    }
    public function searchProducts(Request $request)
    {
        if($request->search){
           
            $searchProducts = Product::where('name' , 'LIKE' , '%'.$request
            ->search. '%')->latest()->paginate(15);
            return view('frontend.page.search' , compact('searchProducts'));
        } else{
            return redirect()->back()->with('message' , 'Empty seach');
                
        }
    }
    public function newArrrival()
    {
        $newArrivalsProducts = Product::latest()->take(16)->get();
        return view('frontend.page.new-arival' , compact('newArrivalsProducts'));
    }
    public function featuredproducts()
    {
        $featuredproducts = Product::where('featured' , '1')->latest()->get();
        return view('frontend.page.featured-products' , compact('featuredproducts'));
    }

    public function categories()
    {
        $categories = Category::where('status' , '0')->get();
        return view('frontend.collections.category.index' , compact('categories'));
    }
    public function products($category_slug)
    {
        $category = Category::where('slug' , $category_slug)->first();
        if($category){
            $products = $category->products()->get();
            return view('frontend.collections.products.index' , compact('category', 'products'));
        }else{
            return redirect()->back();
        }
    }
    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug' , $category_slug)->first();
        if($category){
            $product = $category->products()->where('slug' , $product_slug)->where('status' ,'0')->first();
                if($product){
                    return view('frontend.collections.products.view' , compact('category', 'product'));
                }else{
                    return redirect()->back();
                }   
        }else{
            return redirect()->back();
        }
    }
    public function thankyou()
    {
        return view('frontend.thank-you');
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function Connexion()
    {
        return view('frontend.connexion');
    }
}


















