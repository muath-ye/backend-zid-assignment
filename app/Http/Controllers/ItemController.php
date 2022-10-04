<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Serializers\ItemSerializer;
use App\Serializers\ItemsSerializer;
use Illuminate\Http\JsonResponse;
use League\CommonMark\CommonMarkConverter;

class ItemController extends Controller
{
    protected $converter;

    public function __construct()
    {
        $this->converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);
    }

    public function index(): JsonResponse
    {
        return new JsonResponse(
            ['items' => (new ItemsSerializer(Item::all()))->getData()]
        );
    }

    public function store(ItemRequest $request): JsonResponse
    {
        $serializer = new ItemSerializer(Item::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'url' => $request->get('url'),
            'description' => $this->converter->convert($request->get('description'))->getContent(),
        ]));

        return new JsonResponse(['item' => $serializer->getData()]);
    }

    public function show(Item $item): JsonResponse
    {
        $serializer = new ItemSerializer($item);

        return new JsonResponse(['item' => $serializer->getData()]);
    }

    public function update(ItemRequest $request, Item $item): JsonResponse
    {
        $item->update([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'url' => $request->get('url'),
            'description' => $this->converter->convert($request->get('description'))->getContent(),
        ]);

        return new JsonResponse([
            'item' => (new ItemSerializer($item))->getData(),
        ]);
    }
}
