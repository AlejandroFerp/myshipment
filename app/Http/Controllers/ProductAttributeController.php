<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Show form to create a new attribute for a product.
     */
    public function create(Product $product)
    {
        return view('product_attributes.create', compact('product'));
    }

    /**
     * Store a new attribute for a product.
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
        ]);

        $product->attributes()->create($validated);

        return redirect()->route('products.edit', $product)
                         ->with('success', 'Atributo agregado correctamente');
    }

    /**
     * Show form to edit an attribute.
     */
    public function edit(Product $product, ProductAttribute $attribute)
    {
        return view('product_attributes.edit', compact('product', 'attribute'));
    }

    /**
     * Update an existing attribute.
     */
    public function update(Request $request, Product $product, ProductAttribute $attribute)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
        ]);

        $attribute->update($validated);

        return redirect()->route('products.edit', $product)
                         ->with('success', 'Atributo actualizado correctamente');
    }

    /**
     * Delete an attribute.
     */
    public function destroy(Product $product, ProductAttribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('products.edit', $product)
                         ->with('success', 'Atributo eliminado correctamente');
    }
}
