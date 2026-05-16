<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function instagram()
    {
        $products = Product::where('status', 'published')->get();
        
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss version="2.0" xmlns:g="http://base.google.com/ns/1.0"></rss>');
        $channel = $xml->addChild('channel');
        $channel->addChild('title', 'Jahitan Nenek Product Feed');
        $channel->addChild('link', route('home'));
        $channel->addChild('description', 'Handcrafted Premium Knitwear');

        foreach ($products as $product) {
            $item = $channel->addChild('item');
            $item->addChild('g:id', $product->id, 'http://base.google.com/ns/1.0');
            $item->addChild('g:title', $product->name, 'http://base.google.com/ns/1.0');
            $item->addChild('g:description', strip_tags($product->description), 'http://base.google.com/ns/1.0');
            $item->addChild('g:link', route('product.show', $product->slug), 'http://base.google.com/ns/1.0');
            $item->addChild('g:image_link', $product->image_url, 'http://base.google.com/ns/1.0');
            $item->addChild('g:condition', 'new', 'http://base.google.com/ns/1.0');
            $item->addChild('g:availability', $product->stock > 0 ? 'in stock' : 'out of stock', 'http://base.google.com/ns/1.0');
            $item->addChild('g:price', $product->price . ' IDR', 'http://base.google.com/ns/1.0');
            $item->addChild('g:brand', 'Jahitan Nenek', 'http://base.google.com/ns/1.0');
            $item->addChild('g:google_product_category', 'Apparel &amp; Accessories &gt; Clothing', 'http://base.google.com/ns/1.0');
        }

        return response($xml->asXML(), 200)->header('Content-Type', 'text/xml');
    }
}
