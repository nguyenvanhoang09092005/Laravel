<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Product_review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductReviewController extends Controller
{
    /**
     * Hiển thị danh sách tất cả đánh giá của sản phẩm.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function index(Product $product)
    {
        // $reviews = $product->product_reviews()->with('user')->get();
        // $ratings = $this->calculateRatings($product);

        return view('admin.product.manage_product_review');
    }


    // public function showReview(Product_review $review)
    // {
    //     return view('admin.product.showProductReview', compact('review'));
    // }


    // private function calculateRatings(Product $product)
    // {
    //     $reviews = $product->product_reviews()->get();
    //     $totalReviews = $reviews->count();

    //     $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

    //     foreach ($reviews as $review) {
    //         $ratingCounts[$review->rating]++;
    //     }

    //     $ratingPercentages = [];

    //     foreach ($ratingCounts as $stars => $count) {
    //         $ratingPercentages[$stars] = $totalReviews > 0 ? round(($count / $totalReviews) * 100, 2) : 0;
    //     }

    //     return $ratingPercentages;
    // }
}
