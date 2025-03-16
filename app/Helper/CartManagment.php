<?php

namespace App\Helper;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
class CartManagment
{
    // add product to cart
    static public function addProductToCart($product_id, $quantity = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }
        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] ++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] *
                $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'slug' ,'price', 'name', 'images']);
            if ($product) {
                $cart_items[] = [
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'unit_amount' => $product->price,
                    'name' => $product->name,
                    'images' => $product->images,
                    'total_amount' => $product->price * $quantity
                ];
            }
        }
        // dd($cart_items);
        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    // add product to cart from details page
    static public function addProductToCartFromDetailsPage($product_id, $quantity = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
            }
        }
        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $quantity;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] *
                $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'slug' ,'price', 'name', 'images']);
            if ($product) {
                $cart_items[] = [
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'unit_amount' => $product->price,
                    'name' => $product->name,
                    'images' => $product->images,
                    'total_amount' => $product->price * $quantity
                ];
            }
        }
        // dd($cart_items);
        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    // remove product from cart
    static public function removeProductFromCart($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // add card items to cookie
    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // clear cart items from cookie
    static public function clearCartItemsFromCookie()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // get all cart items from cookie
    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if ($cart_items) {
            return $cart_items;
        }
        return [];
    }

    // increment product quantity
    static public function incrementProductQuantity($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                break;
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // decrement product quantity
    static public function decrementProductQuantity($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']--;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                break;
            }
        }
        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    // get cart total price
    static public function getCartTotalPrice($cart_items)
    {
        return array_sum(array_column($cart_items, 'total_amount'));
    }
}
