<?php


use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A feature test to get all product data
     * @return void
     */
    public function test_to_get_all_products_data(): void
    {
        $response = $this->get('/api/v1/items')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    '*' => [
                        "id",
                        "name",
                        "price",
                        "description",
                    ],

                ]
            );

    }

    /**
     * A feature test to add a new product
     *
     * @return void
     */
    public function test_for_add_product(): void
    {

        $product = Product::create([
            'name' => fake()->word(),
            'price' => fake()->numberBetween(0, 1000),
            'description' => fake()->sentence(12),
            'image' => fake()->url(),
        ]);;

        $payload = [
            "name" => $product->name,
            "price" => $product->price,
            'description' => $product->description,
            'image' => $product->image,
        ];

        $this->json('POST', 'api/v1/items', $payload)
            ->assertStatus(200)
            ->assertJson([
                'code' => '200',
                'message' => 'New Product created.',
            ]);
    }

    /**
     * A feature test to get active product data based on product ID
     *
     * @return void
     */
    public function test_get_product_by_id(): void
    {
        $product_id = Product::get()->random()->id;
        $response = $this->get('/api/v1/items/' . $product_id)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    '*' => [
                        "id",
                        "name",
                        "price",
                        "description",
                    ],
                ]
            );
    }


    /**
     * A feature test to update product based on product ID
     *
     * @return void
     */
    public function test_for_update_product(): void
    {
        $payload = [
            "name" => fake()->word(),
            'price' => fake()->numberBetween(0, 1000),
            'description' => fake()->sentence(12),
            'updated_at' => fake()->date('Y-m-d', 'now'),

        ];
        $product_id = Product::get()->random()->id;

        $this->json('PUT', 'api/v1/items/' . $product_id, $payload)
            ->assertStatus(200)
            ->assertJson([
                'code' => '200',
                'message' => 'Product updated.',
            ]);
    }


    /**
     * A feature test to delete hotel review data
     *
     * @return void
     */
    public function test_for_delete_product(): void
    {
        $product_id = Product::get()->random()->id;

        $this->json('DELETE', 'api/v1/items/' . $product_id)
            ->assertStatus(200)
            ->assertJson([
                'code' => '200',
                'message' => 'product removed successfully.',
            ]);
    }

}
