<?php

namespace App\Helper;

use Illuminate\Support\Facades\Cookie;
use App\Models\ElectricCar; // Ensure the Car model is imported

class CarComparisonManagment
{
    const MAX_COMPARISON_ITEMS = 3;

    // add car to comparison
    static public function addCarToComparison($car_id)
    {
        $comparison_items = self::getComparisonItemsFromCookie();

        if (!in_array($car_id, $comparison_items) && count($comparison_items) < self::MAX_COMPARISON_ITEMS) {
            $comparison_items[] = $car_id;
        }

        self::addComparisonItemsToCookie($comparison_items);
        return count($comparison_items);
    }

    // remove product from cart
    static public function removeCarFromComparison($car_id)
    {
        $comparison_items = self::getComparisonItemsFromCookie();

        $comparison_items = array_diff($comparison_items, [$car_id]);

        self::addComparisonItemsToCookie($comparison_items);
        return $comparison_items;
    }

    // add card items to cookie
    static public function addComparisonItemsToCookie($comparison_items)
    {
        Cookie::queue('comparison_items', json_encode($comparison_items), 60 * 24 * 30);
    }

    // clear cart items from cookie
    static public function clearComparisonItemsFromCookie()
    {
        Cookie::queue(Cookie::forget('comparison_items'));
    }

    // get all cart items from cookie
    static public function getComparisonItemsFromCookie()
    {
        $comparison_items = json_decode(Cookie::get('comparison_items'), true);
        if ($comparison_items) {
            return $comparison_items;
        }
        return [];
    }

}
