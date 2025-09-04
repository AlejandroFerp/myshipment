<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Waste;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Show the form for creating a new product.
     */
    
    public function create()
    {
        $wastes = Waste::all();
        $attributes = \App\Models\ProductAttribute::all(); // 👈
        return view('products.create', compact('wastes', 'attributes'));
    }

    public function edit(Product $product)
    {
        $wastes = Waste::all();
        $attributes = \App\Models\ProductAttribute::all(); // 👈
        $product->load('attributes', 'waste');
        return view('products.edit', compact('product', 'wastes', 'attributes'));
    }

    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with(['waste', 'attributes'])->get();
        return view('products.index', compact('products'));
    }


    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:service,item,waste',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock' => 'nullable|integer|min:0',
            'waste_id' => 'nullable|exists:wastes,id',
            'attributes' => 'nullable|array',
            'attributes.*.key' => 'required_with:attributes|string|max:255',
            'attributes.*.value' => 'nullable|string|max:255',
        ]);

        $product = Product::create($validated);

        // Guardar atributos dinámicos si existen
        if (!empty($validated['attributes'])) {
            foreach ($validated['attributes'] as $attr) {
                $product->attributes()->create($attr);
            }
        }
        $product = Product::create($validated);

        // Guardar valores de atributos (si vienen)
        if ($request->filled('attributes') && is_array($request->attributes)) {
            $sync = [];
            foreach ($request->attributes as $attrId => $value) {
                // ignora vacíos
                if ($value !== null && $value !== '') {
                    $sync[(int)$attrId] = ['value' => (string)$value];
                }
            }
            if (!empty($sync)) {
                $product->attributes()->sync($sync); // attach con pivot
            }
        }
        return redirect()->route('products.index')
                         ->with('success', 'Producto creado correctamente');
    }


    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'type' => 'required|in:service,item,waste',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock' => 'nullable|integer|min:0',
            'waste_id' => 'nullable|exists:wastes,id',
            'attributes' => 'nullable|array',
            'attributes.*.key' => 'required_with:attributes|string|max:255',
            'attributes.*.value' => 'nullable|string|max:255',
        ]);

        $product->update($validated);

        // Actualizar atributos dinámicos: primero eliminar los antiguos
        $product->attributes()->delete();

        if (!empty($validated['attributes'])) {
            foreach ($validated['attributes'] as $attr) {
                $product->attributes()->create($attr);
            }
        }
        $product->update($validated);

        $sync = [];
        if ($request->filled('attributes') && is_array($request->attributes)) {
            foreach ($request->attributes as $attrId => $value) {
                if ($value !== null && $value !== '') {
                    $sync[(int)$attrId] = ['value' => (string)$value];
                }
            }
        }
        // sync() adjunta/actualiza y elimina lo que no está en $sync
        $product->attributes()->sync($sync);

        return redirect()->route('products.index')
                         ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
                         ->with('success', 'Producto eliminado correctamente');
    }
}
