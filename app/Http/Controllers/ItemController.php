<?php

namespace App\Http\Controllers;

use App\Actions\CreateItem;
use App\Actions\UpdateItem;
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
        return new JsonResponse(['items' => (new ItemsSerializer(Item::all()))->getData()]);
    }

    public function store(ItemRequest $request, CreateItem $createItem): JsonResponse
    {
        $serializer = new ItemSerializer($createItem->handle($request->all()));

        return new JsonResponse(['item' => $serializer->getData()]);
    }

    public function show(Item $item): JsonResponse
    {
        $serializer = new ItemSerializer($item);

        return new JsonResponse(['item' => $serializer->getData()]);
    }

    public function update(ItemRequest $request, Item $item, UpdateItem $updateItem): JsonResponse
    {
        $updateItem->handle($request->all(), $item);

        return new JsonResponse(['item' => (new ItemSerializer($item))->getData()]);
    }
}
