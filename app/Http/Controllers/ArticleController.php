<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Order;
use Illuminate\Support\Str;

use function PHPUnit\Framework\directoryExists;

class ArticleController extends Controller
{
    public function index()
    {
        try {
            $articles = Article::with(['media'])->where('availability','>',0)->orderBy('updated_at', 'desc')->get();

            return response()->json($articles);

        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

    public function ArticleByCategorie(Categorie $categorie){
        try {

            $articles = Article::with(['media'])->where('availability','>',0)->where('categorie_id',$categorie->id)->get();

            return response()->json($articles);

        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

    public function ImageByArticle(Article $article){

        try {
            return response()->json($article->getMedia('articles'));
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }        
    }

    public function store(Request $request)
    {        
        try {            
            $request->validate([
                'name' => 'required|max:50|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)|unique:articles,name,',//unique:users,username'.$this->route('user'),
                'price' => 'required|numeric',
                'availability' => 'required|integer',
                'star_rating' => 'required|integer|min:1|max:5',
                'categorie_id' => 'required|integer',
                'tags' => 'required|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
                'add_information' => 'required|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)'
            ]);             
            $images = $request->images;
            foreach ($images as $image) {
                if (!is_file($image) || !file_exists($image)) {
                    return response()->json(['mensaje' => 'En el campo images debe ser de tipo archivo o no existe el archivo','status' => 'error'],500);                        
                }
            }
            $categorie = Categorie::find($request->categorie_id);
            if ($categorie == null) {
                return response()->json(['mensaje' => 'La categoría del artículo no existe','status' => 'error'],500);
            }

            $article = Article::create([
                'name' => $request->name,
                'price' => $request->price,
                'availability' => $request->availability,
                'star_rating' => $request->star_rating,
                'description' => $request->description,
                'categorie_id' => $categorie->id,
                'tags' => $request->tags,
                'add_information' => $request->add_information,
                'sku' => (integer)Str::random(10).(string)date('YmdHis')
            ]);

            $article->addMultipleMediaFromRequest(['images'])
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('articles');
                    });

            $token = auth()->user()->createToken('Token')->accessToken;

            return response()->json(['token' => $token,'status' => 'success'],200);

        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }
    
    public function edit(Article $article)
    {
        return response()->json($article->with('media')->first());
    }

    public function update(Request $request, Article $article)
    {
        try {            
            $request->validate([
                'name' => 'required|max:50|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)|unique:articles,name,'.$article->id,
                'price' => 'required|numeric',
                'availability' => 'required|integer',
                'star_rating' => 'required|integer|min:1|max:5',
                'categorie_id' => 'required|integer',
                'tags' => 'required|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
                'add_information' => 'required|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)'
            ]);
            
            $images = $request->images;
            foreach ($images as $image) {
                if (!is_file($image) || !file_exists($image)) {
                    return response()->json(['mensaje' => 'En el campo images debe ser de tipo archivo o no existe el archivo','status' => 'error'],500);                        
                }
            }

            $categorie = Categorie::find($request->categorie_id);
            if ($categorie == null) {
                return response()->json(['mensaje' => 'La categoría del artículo no existe','status' => 'error'],500);
            }

            $article->name         = $request->name;
            $article->price        = $request->price;
            $article->availability = $request->availability;
            $article->star_rating  = $request->star_rating;
            $article->description  = $request->description;
            $article->categorie_id = $categorie->id;
            $article->tags         = $request->tags;
            $article->add_information = $request->add_information;
                             

            $article->clearMediaCollection('articles');
            $article->addMultipleMediaFromRequest(['images'])
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('articles');
                    });
            $article->touch();

            $token = auth()->user()->createToken('Token')->accessToken;

            return response()->json(['token' => $token,'status' => 'success'],200);

        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

    public function destroy(Article $article)
    {
        try {
            $article->clearMediaCollection('articles');

            $article->delete();

            $token = auth()->user()->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);
        
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

    public function FindBy($name,$price,$availability,$categorie_id,$tags,$description,$add_information,$star_rating,$sku){
        if( $name == null && $price == null && $availability == null && 
        $categorie_id == null && $tags == null && $description == null && 
        $add_information == null && $star_rating == null && $sku){

            $articles = Article::with(['media'])->paginate(10);        

        }
        else{
            $articles = Article::with(['media'])
            ->where('name',$name)
            ->orWhere('price',$price)
            ->orWhere('availability',$availability)
            ->orWhere('categorie_id',$categorie_id)
            ->orWhere('tags',$tags)
            ->orWhere('description',$description)
            ->orWhere('add_information',$add_information)
            ->orWhere('star_rating',$star_rating)
            ->orWhere('sku',$sku)
            ->orderBy('updated_at', 'desc')->paginate(10);
        }

        return $articles;
    }

    public function FindArticles(Request $request){
        try {

            $request->name==null?$name=null:$name=$request->name;

            $request->price==null?$price=null:$price=$request->price;

            $request->availability==null?$availability=null:$availability=$request->availability;

            $request->categorie_id==null?$categorie_id=null:$categorie_id=$request->categorie_id;

            $request->tags==null?$tags=null:$tags=$request->tags;

            $request->description==null?$description=null:$description=$request->description;

            $request->add_information==null?$add_information=null:$add_information=$request->add_information;

            $request->star_rating==null?$star_rating=null:$star_rating=$request->star_rating;

            $request->sku==null?$sku=null:$sku=$request->sku;


            $articles = $this->FindBy($name,$price,$availability,$categorie_id,$tags,$description,$add_information,$star_rating,$sku);

            return response()->json($articles);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }   

    public function FindCantArticles(Request $request){
        try {

            $request->name==null?$name=null:$name=$request->name;

            $request->price==null?$price=null:$price=$request->price;

            $request->availability==null?$availability=null:$availability=$request->availability;

            $request->categorie_id==null?$categorie_id=null:$categorie_id=$request->categorie_id;

            $request->tags==null?$tags=null:$tags=$request->tags;

            $request->description==null?$description=null:$description=$request->description;

            $request->add_information==null?$add_information=null:$add_information=$request->add_information;

            $request->star_rating==null?$star_rating=null:$star_rating=$request->star_rating;

            $request->sku==null?$sku=null:$sku=$request->sku;

            $articles = $this->FindBy($name,$price,$availability,$categorie_id,$tags,$description,$add_information,$star_rating,$sku);
            
            return response()->json($articles->count());
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    
    }

    public function ArticleNotStock(){
        try {

            $articles = Article::with(['media'])->where('availability',0)->orderBy('updated_at', 'desc')->get();

            return response()->json($articles);

        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }       
    }

    public function SellArticle(Article $article){
        try {
            
            if ($article->availability == 0) {
                return response()->json(['mensaje' => 'El artículo no tiene disponibilidad','status' => 'error'],500);
            }
            $user = auth()->user();
            
            $order = Order::where('article_id',$article->id)
                                   ->where('user_id',$user->id)
                                   ->whereDate('updated_at',now()->toDateString())
                                   //->whereRaw('updated_at = DATE_ADD(NOW(), INTERVAL -1 DAY)')
                                   ->first();
            
            if($order == null){

                Order::create([
                    'article_id' => $article->id,
                    'user_id' => $user->id,
                    'cantidad' => 1 
                ]);
                $article->availability -= 1;
                $article->touch();
            }
            else{

                $order->cantidad += 1;

                $order->touch();

                $article->availability -= 1;
                $article->touch();
            }

            $token = auth()->user()->createToken('Token')->accessToken;

            return response()->json(['token' => $token,'status' => 'success'],200);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }

    }

    public function ShowTotalProfit(){
        try {
            
            $user = auth()->user();
            $cant_total = 0;
            
            $orders = Order::where('user_id',$user->id)
                                   //->whereDate('updated_at',now()->toDateString())
                                   ->get();
            return response()->json(['Total Profit' => $orders->Sum('cantidad')]);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

    public function ArticulosVendidos(){
        try {
            
            $user = auth()->user();
            $cant_total = 0;
            
            $orders = Order::where('user_id',$user->id)
                                   //->whereDate('updated_at',now()->toDateString())
                                   ->get();
                                   
            return response()->json(['Articulos Vendidos' => $orders]);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }
}
