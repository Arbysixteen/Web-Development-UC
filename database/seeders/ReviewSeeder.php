<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products
        $products = Product::all();
        
        // Get all customer users
        $customers = User::where('role', 'customer')->get();
        
        if ($customers->isEmpty()) {
            $this->command->warn('No customers found. Creating dummy customers...');
            // Create some dummy customers if none exist
            for ($i = 1; $i <= 10; $i++) {
                $customers->push(User::create([
                    'name' => 'Customer ' . $i,
                    'email' => 'customer' . $i . '@example.com',
                    'phone' => '0812345678' . $i,
                    'password' => bcrypt('password'),
                    'role' => 'customer'
                ]));
            }
        }

        $reviewComments = [
            'Produk sangat bagus dan berkualitas!',
            'Penjual responsif dan produk sesuai deskripsi.',
            'Recommended seller! Fast delivery.',
            'Kualitas ok, harga bersaing.',
            'Sangat puas dengan pembelian ini.',
            'Produk original dan berkualitas tinggi.',
            'Pelayanan memuaskan, akan order lagi.',
            'Sesuai ekspektasi, packaging rapi.',
            'Recommended! Worth the price.',
            'Good quality, fast response from seller.',
            'Sangat membantu project saya, terima kasih!',
            'Keren banget, sesuai dengan yang diharapkan.',
            'Produk mantap, seller ramah dan cepat.',
            'Bagus banget, next order lagi.',
            'Memuaskan, produk berkualitas premium.',
            'Fast delivery, produk sesuai gambar.',
            'Top markotop! Highly recommended.',
            'Sangat worth it dengan harga segini.',
            'Produk bagus, packing aman dan rapi.',
            'Seller terpercaya, produk original.'
        ];

        foreach ($products as $product) {
            // Calculate number of reviews based on sold count
            // 30-50% of sold items get reviews
            $reviewCount = (int) ($product->sold * rand(30, 50) / 100);
            
            // Minimum 1 review if product has sales, maximum 20 reviews per product
            $reviewCount = max(1, min($reviewCount, 20));
            
            $this->command->info("Generating {$reviewCount} reviews for product: {$product->name}");

            // Shuffle customers to get random reviewers
            $shuffledCustomers = $customers->shuffle();
            
            for ($i = 0; $i < $reviewCount; $i++) {
                // Use different customer for each review (cycle through if needed)
                $customer = $shuffledCustomers[$i % $shuffledCustomers->count()];
                
                // Check if this customer already reviewed this product
                $existingReview = Review::where('user_id', $customer->id)
                    ->where('product_id', $product->id)
                    ->first();
                
                if (!$existingReview) {
                    // Generate rating (weighted towards higher ratings)
                    $rating = $this->generateWeightedRating();
                    
                    // 70% chance to have a comment
                    $comment = rand(1, 100) <= 70 
                        ? $reviewComments[array_rand($reviewComments)] 
                        : null;
                    
                    Review::create([
                        'user_id' => $customer->id,
                        'product_id' => $product->id,
                        'rating' => $rating,
                        'comment' => $comment,
                        'created_at' => now()->subDays(rand(1, 60)),
                    ]);
                }
            }
        }

        $this->command->info('Reviews seeded successfully!');
    }

    /**
     * Generate weighted rating (more 4-5 stars, less 1-2 stars)
     */
    private function generateWeightedRating(): int
    {
        $rand = rand(1, 100);
        
        if ($rand <= 50) return 5;      // 50% chance for 5 stars
        if ($rand <= 75) return 4;      // 25% chance for 4 stars
        if ($rand <= 90) return 3;      // 15% chance for 3 stars
        if ($rand <= 97) return 2;      // 7% chance for 2 stars
        return 1;                        // 3% chance for 1 star
    }
}
