<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategories;
use App\Models\ProductWebsite;
use App\Models\Website;
use Goutte\Client;
use DOMDocument;
use DOMXPath;
use Exception;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all();
   
    return view('home_page', compact('products'));
}
public function addform()

{

    $cates = Category::all();
    $webs =Website::all();
    return view('home_page',['is_add'=>true, 'cates'=>$cates,'webs'=>$webs]);
}
public function products()
{
    $product_detail = Product::all();
    return view('home_page',compact('product_detail'));
}

public function store(Request $request)
{
    // tạo bản ghi sản phẩm
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'barcode' => 'required|max:255',
        'sku' => 'required|max:255'
    ]);
    $currentTimestamp = now(); 
    $validatedData['created_at'] = $currentTimestamp;
    $validatedData['updated_at'] = $currentTimestamp;
    $product = Product::create($validatedData);

    //tạo bản ghi product_id
    $p_id = $product->id;

    // tạo category 
    $category = $request->validate([
        'cate_id' => 'required|max:255'
    ]);
    $category['p_id']= $p_id;
    $category['created_at'] = $currentTimestamp;
    $category['updated_at'] = $currentTimestamp;
    $cate = ProductCategories::create($category);
    // đẩy category

    // tạo bản ghi website
    $web = $request->validate([
        'web_id' => 'required|max:255'
    ]);
    $web['p_id']= $p_id;
    $web['last_price']= '0';
    $web['last_check']= $currentTimestamp;
    $web['created_at'] = $currentTimestamp;
    $web['updated_at'] = $currentTimestamp;
    $website = ProductWebsite::create($web);


    return redirect('/products')->with('success', 'Sản phẩm đã được lưu.');
}
public function update(Request $request, Product $product)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'barcode' => 'required|max:255',
        'sku' => 'required|max:255',     
    ]);

    $product->update($validatedData);
    return redirect('/products')->with('success', 'Sản phẩm đã được cập nhật.');
}


public function destroy(Product $product)
{
    $product->delete();
    return redirect('/products')->with('success', 'Sản phẩm đã được xóa.');
}
    





private function abScanner($link)
    {
        $client = new Client();
        try {
            $crawler = $client->request('GET', $link);
            $price = $crawler->filter('span.pro-price');
            if ($price->count() > 0) {
                // Chỉ lấy văn bản nếu có phần tử được tìm thấy
                return $this->cTN($price->text()) * 1000;
            } else {
                // Trả về giá trị ngầm định nếu không có phần tử nào
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }



    // Scanner của từng thương hiệu
    private function hasakiScanner($value)
    {
        $client = new Client();
        try {
            $crawler = $client->request('GET', $value);
            $finalPrices = $crawler->filter('#product_final_price');
            // Kiểm tra xem selector có trả về kết quả không
            if ($finalPrices->count() > 0) {
                $finalPrice = $finalPrices->attr('value');
                return $this->cTN($finalPrice);
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }


    private function guScanner($value)
    {
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        try {
            $dom->loadHTML(file_get_contents($value));
        } catch (Exception $e) {
            return 0;
        }
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $prices = $xpath->query("//span[@class='price']");
        // Kiểm tra xem có item nào được tìm thấy không
        if ($prices->length > 0) {
            $price = $prices->item(0)->nodeValue;
            return $this->cTN($price) * 1000;
        } else {
            return 0;
        }
    }
    private function tgScanner($value) {
        $dom = new DOMDocument;
        
        libxml_use_internal_errors(true);
        try {
            $dom->loadHTML(file_get_contents($value));
        } catch (Exception $e) {
            return 0;
        }
        libxml_clear_errors();
    
        $xpath = new DOMXPath($dom);
        $prices = $xpath->query("//div[@class='page-product-info-newprice']");
        
        // Kiểm tra xem có item nào được tìm thấy không
        if ($prices->length > 0) {
            $price = $prices->item(0)->nodeValue;
            return $this->cTN($price)*1000;
        } else {
            return 0;
        }
    }


    private function ltScanner($value) {
        $dom = new DOMDocument;
        
        libxml_use_internal_errors(true);
        try {
            $dom->loadHTML(file_get_contents($value));
        } catch (Exception $e) {
            return 0;
        }
        libxml_clear_errors();
    
        $xpath=new DOMXPath($dom);
        $prices = $xpath->query("//span[@class='current-price ProductPrice']");
        
        // Kiểm tra xem có item nào được tìm thấy không
        if ($prices->length > 0) {
            $price = $prices->item(0)->nodeValue; 
            return $this->cTN($price)*1000;
        } else {
            return 0;
        }
    }


    // đưa giá từ chuỗi ký tự về dạng số
    private function cTN($input)
    {
        $number = preg_replace('/[^\d,.]/', '', $input);
        $number = str_replace(',', '.', $number);
        $number = (float) $number;
        return $number;
    }
}