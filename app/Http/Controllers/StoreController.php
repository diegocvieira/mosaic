<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Cookie;
use Mail;
use Validator;
use App\Models\Category;

class StoreController extends Controller
{
    public function list()
    {
        $categories = Category::has('stores')
            ->with(['stores' => function ($query) {
                $query->orderBy('name', 'ASC');
            }])
            ->orderBy('name', 'ASC')
            ->get();

        return view('list-stores', compact('categories'));
    }

    public function filterCategory($category_slug)
    {
        session(['filter_category' => $category_slug]);

        $stores = Store::whereIn('id', _getActiveStores());

        if ($category_slug != 'all') {
            $stores = $stores->whereHas('categories', function ($query) use ($category_slug) {
                    $query->where('slug', $category_slug);
                });
        }

        $stores = $stores->orderBy('name', 'ASC')->get();

        return json_encode($stores);
    }

    public function activate($store_id)
    {
        // $store_id = is_array($store_id) ? implode(',', $store_id) : $store_id;
        // $stores_id = _getStoreCookie() ? _getStoreCookie() . ',' . $store_id : $store_id;

        $array = is_array($store_id) ? $store_id : [$store_id];
        $stores_id = implode(',', array_merge($array, explode(',', Cookie::get('stores_id'))));

        Cookie::queue('stores_id', $stores_id, '525600');

        return json_encode(true);
    }

    public function desactivate($store_id)
    {
        $stores_id = explode(',', _getStoreCookie());

        if (($key = array_search($store_id, $stores_id)) !== false) {
            unset($stores_id[$key]);
        }

        Cookie::queue('stores_id', implode(',', $stores_id), '525600');

        return json_encode(true);
    }

    public function suggest(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['store_name' => 'required', 'store_url' => 'required'],
            ['store_name.required' => 'Informe o nome da loja.', 'store_url' => 'Informe o site da loja.']
        );

        if ($validator->fails()) {
            $return['message'] = $validator->errors()->first();
            $return['success'] = false;
        } else {
            try {
                Mail::send('emails.store-suggest', ['request' => $request], function ($query) {
                    $query->from('no-reply@mosaic.com.br', 'Mosaic');
                    $query->to('felipeoreis11@gmail.com')->subject('Nova sugestão de loja - Mosaic');
                });

                $return['message'] = 'Sugestão enviada com sucesso!';
                $return['success'] = true;
            } catch (\Exception $e) {
                $return['message'] = 'Ocorreu um erro inesperado. Por favor, tente novamente.';
                $return['success'] = false;
            }

            return json_encode($return);
        }
    }
}
