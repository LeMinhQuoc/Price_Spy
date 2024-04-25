<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategories;
use App\Models\ProductWebsite;
use App\Models\Website;
use App\Models\DetecLink;
use App\Http\Controllers\WebsiteController;
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

    // get ad product form
    public function addform()
    {
        $cates = Category::all();
        $webs = Website::all();
        return view('home_page', ['is_add' => true, 'cates' => $cates, 'webs' => $webs]);
    }

    //get product detail
    public function products()
    {
        $product_detail = Product::all();
        return view('home_page', compact('product_detail'));
    }


    // store product
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
        $category['p_id'] = $p_id;
        $category['created_at'] = $currentTimestamp;
        $category['updated_at'] = $currentTimestamp;
        $cate = ProductCategories::create($category);
        // đẩy category

        // tạo bản ghi website
        /* $web = $request->validate([
                'web_id' => 'required|max:255'
            ]);
            $web['p_id'] = $p_id;
            $web['last_price'] = '0';
            $web['last_check'] = $currentTimestamp;
            $web['created_at'] = $currentTimestamp;
            $web['updated_at'] = $currentTimestamp;
            $website = ProductWebsite::create($web); */

        $web = $request->validate([
            'web' => 'required|max:255'
        ]);
        $webController = new WebsiteController;
        $detecter = $webController->detecLink($web);

        $detecwebs = DetecLink::all();
        if ($detecter) {
            foreach ($detecwebs as $lweb) {
                if ($detecter == $lweb) {
                }
            }
        } else {

            var_dump("chưa hỗ trợ");
            die();
        }





        return redirect('/products')->with('success', 'Sản phẩm đã được lưu.');
    }

    // 
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



    /* Scanner per brand */

    private function abScanner($link)
    {
        return $this->generalScanner($link, 'GET', 'span.pro-price', null, 1000);
    }
    private function hasakiScanner($value)
    {
        return $this->generalScanner($value, 'GET', '#product_final_price', 'value');
    }

    private function guScanner($value)
    {
        return $this->domScanner($value, 'GET', "//span[@class='price']", null, 1000);
    }

    private function tgScanner($value)
    {
        return $this->domScanner($value, 'GET', "//div[@class='page-product-info-newprice']", null, 1000);
    }

    private function ltScanner($value)
    {
        return $this->domScanner($value, 'GET', "//span[@class='current-price ProductPrice']", null, 1000);
    }
    private function generalScanner($value, $method, $selector, $attribute = null, $multiplier = 1)
    {

        $client = new Client();
        try {
            $crawler = $client->request('GET', $value);
            $elements = $crawler->filter($selector);
            if ($elements->count() > 0) {
                $elementValue = ($attribute !== null) ? $elements->attr($attribute) : $elements->text();
                return $this->cTN($elementValue) * $multiplier;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    private function domScanner($value, $method, $selector, $attribute = null, $multiplier = 1)
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
        $prices = $xpath->query($selector);
        if ($prices->length > 0) {
            $price = $prices->item(0)->nodeValue;
            return $this->cTN($price) * $multiplier;
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
