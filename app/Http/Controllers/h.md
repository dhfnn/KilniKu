 public function store(Request $request)
    {

        $validatedData = $request->validate([
            'customerId' => 'required|exists:customers,id',
            'productId' => 'required|array',
            'productId.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'totalPrice' => 'required|numeric|min:0',
        ]);

        $validatedData['productId'] = json_encode($validatedData['productId']);
        $validatedData['quantity'] = json_encode($validatedData['quantity']);
    
        $validatedData['userId'] = auth()->user()->id;
        $validatedData['date'] = now();

        $uniqueCode = Faker::create()->unique()->bothify('???##?');
        while (Order::where('code', $uniqueCode)->exists()) {
            $uniqueCode = Faker::create()->unique()->bothify('???##?');
        }
        $validatedData['code'] = $uniqueCode;

        Order::create($validatedData);

        foreach ($request->productId as $index => $productId) {
            $product = Product::find($productId);
            $product->stock -= $request->quantity[$index];
            $product->save();
        }
    
    
        return response()->json(['code' => $uniqueCode]);
    }