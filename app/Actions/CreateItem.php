<?php

namespace App\Actions;

use App\Models\Item;
use League\CommonMark\CommonMarkConverter;

class CreateItem
{
    public function handle(array $itemData): Item
    {
        $converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

        return Item::create([
            'name' => $itemData['name'],
            'price' => $itemData['price'],
            'url' => $itemData['url'],
            'description' => $converter->convert($itemData['description'])->getContent(),
        ]);
    }
}
