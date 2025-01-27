<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pizzas = [
            [
                'name' => 'Margherita Pizza',
                'desc' => 'A classic Italian pizza topped with fresh mozzarella cheese, ripe tomatoes, basil leaves, and a drizzle of olive oil. Simple yet flavorful.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/margherita-pizza.jpg',
                'base_price' => '50000',
                'is_veg' => true,
            ],
            [
                'name' => 'Vegetable Supreme Pizza',
                'desc' => 'A hearty pizza loaded with a variety of fresh vegetables including bell peppers, mushrooms, onions, olives, and spinach, all covered with mozzarella cheese.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/vegetable-supreme-pizza.jpg',
                'base_price' => '60000',
                'is_veg' => true,
            ],
            [
                'name' => 'Pesto Veggie Pizza',
                'desc' => 'A delightful pizza featuring a pesto sauce base, topped with sun-dried tomatoes, artichoke hearts, spinach, and goat cheese.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/pesto-veggie-pizza.jpg',
                'base_price' => '65000',
                'is_veg' => true,
            ],
            [
                'name' => 'Four Cheese Pizza',
                'desc' => 'A rich and cheesy pizza made with a blend of four different cheeses, such as mozzarella, cheddar, parmesan, and gorgonzola, for a creamy and tangy flavor.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/four-cheese-pizza.jpg',
                'base_price' => '70000',
                'is_veg' => true,
            ],
            [
                'name' => 'Spinach and Feta Pizza',
                'desc' => 'A flavorful combination of spinach, feta cheese, and garlic, with a sprinkle of pine nuts and a dash of lemon zest.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/spinach-feta-pizza.jpg',
                'base_price' => '65000',
                'is_veg' => true,
            ],
            [
                'name' => 'Pepperoni Pizza',
                'desc' => 'A favorite among meat lovers, this pizza is topped with spicy pepperoni slices and melted mozzarella cheese, often accompanied by a tangy tomato sauce.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/pepperoni-pizza.jpg',
                'base_price' => '55000',
                'is_veg' => false,
            ],
            [
                'name' => 'BBQ Chicken Pizza',
                'desc' => 'A smoky and savory pizza featuring BBQ sauce, grilled chicken pieces, red onions, cilantro, and a blend of mozzarella and cheddar cheese.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/bbq-chicken-pizza.jpg',
                'base_price' => '70000',
                'is_veg' => false,
            ],
            [
                'name' => 'Meat Lover\'s Pizza',
                'desc' => 'A robust pizza topped with a variety of meats including sausage, bacon, pepperoni, and ham, all layered over a cheesy base.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/meat-lovers-pizza.jpg',
                'base_price' => '80000',
                'is_veg' => false,
            ],
            [
                'name' => 'Hawaiian Pizza',
                'desc' => 'A controversial but popular choice, this pizza combines ham and pineapple on a cheesy tomato base, offering a sweet and savory flavor profile.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/hawaiian-pizza.jpg',
                'base_price' => '65000',
                'is_veg' => false,
            ],
            [
                'name' => 'Seafood Pizza',
                'desc' => 'A delightful option for seafood enthusiasts, this pizza is topped with a mix of shrimp, calamari, and sometimes anchovies, along with garlic and fresh herbs.',
                'category' => 'PIZZAS',
                'img_path' => 'resources/images/pizzas/seafood-pizza.jpg',
                'base_price' => '75000',
                'is_veg' => false,
            ],
        ];
        
        $pastas = [
            [
                'name' => 'Penne Arrabbiata',
                'desc' => 'Penne pasta served with a spicy tomato sauce made with garlic, red chili flakes, and olive oil. Perfect for those who like a kick of heat.',
                'category' => 'PASTAS',
                'img_path' => 'resources/images/pastas/penne-arrabbiata.jpg',
                'base_price' => '50000',
                'is_veg' => true,
            ],
            [
                'name' => 'Fettuccine Alfredo',
                'desc' => 'Rich and creamy fettuccine pasta coated with a luscious Alfredo sauce made from butter, heavy cream, and parmesan cheese.',
                'category' => 'PASTAS',
                'img_path' => 'resources/images/pastas/fettuccine-alfredo.jpg',
                'base_price' => '60000',
                'is_veg' => true,
            ],
            [
                'name' => 'Pesto Pasta',
                'desc' => 'Pasta tossed in a fresh and aromatic pesto sauce made from basil, garlic, pine nuts, parmesan cheese, and olive oil. A flavorful vegetarian option.',
                'category' => 'PASTAS',
                'img_path' => 'resources/images/pastas/pesto-pasta.jpg',
                'base_price' => '55000',
                'is_veg' => true,
            ],
            [
                'name' => 'Spaghetti Carbonara',
                'desc' => 'A classic Italian pasta dish made with eggs, cheese, pancetta, and pepper. Creamy and rich with a savory flavor.',
                'category' => 'PASTAS',
                'img_path' => 'resources/images/pastas/spaghetti-carbonara.jpg',
                'base_price' => '55000',
                'is_veg' => false,
            ],
            [
                'name' => 'Lasagna',
                'desc' => 'A hearty layered pasta dish made with sheets of lasagna noodles, a rich meat sauce, béchamel, and cheese, baked to perfection.',
                'category' => 'PASTAS',
                'img_path' => 'resources/images/pastas/lasagna.jpg',
                'base_price' => '75000',
                'is_veg' => false,
            ],
        ];

        $sides = [
            [
                'name' => 'Garlic Bread',
                'desc' => 'Crispy bread slices toasted with a buttery garlic spread and topped with fresh parsley. A perfect accompaniment to any pasta dish.',
                'category' => 'SIDES',
                'img_path' => 'resources/images/sides/garlic-bread.jpg',
                'base_price' => '15000',
                'is_veg' => true,
            ],
            [
                'name' => 'Bruschetta',
                'desc' => 'Toasted bread topped with a mixture of ripe tomatoes, basil, garlic, and olive oil. Light, fresh, and bursting with flavor.',
                'category' => 'SIDES',
                'img_path' => 'resources/images/sides/bruschetta.jpg',
                'base_price' => '18000',
                'is_veg' => true,
            ],
            [
                'name' => 'Caprese Salad',
                'desc' => 'A refreshing salad featuring slices of ripe tomatoes, fresh mozzarella cheese, and basil, drizzled with balsamic glaze and olive oil.',
                'category' => 'SIDES',
                'img_path' => 'resources/images/sides/caprese-salad.jpg',
                'base_price' => '22000',
                'is_veg' => true,
            ],
            [
                'name' => 'Stuffed Mushrooms',
                'desc' => 'Mushroom caps filled with a savory mixture of breadcrumbs, cheese, and herbs, baked until golden and delicious.',
                'category' => 'SIDES',
                'img_path' => 'resources/images/sides/stuffed-mushrooms.jpg',
                'base_price' => '25000',
                'is_veg' => true,
            ],
        ];
        
        $drinks = [
            [
                'name' => 'Coca-Cola',
                'desc' => 'A classic carbonated soft drink with a refreshing cola flavor. Perfect for a satisfying and fizzy accompaniment to any meal.',
                'category' => 'DRINKS',
                'img_path' => 'resources/images/drinks/coca-cola.jpg',
                'base_price' => '15000',
                'is_veg' => true,
            ],
            [
                'name' => 'Sparkling Water',
                'desc' => 'Refreshing and effervescent sparkling water with a crisp, clean taste. A great palate cleanser and a light option to accompany any meal.',
                'category' => 'DRINKS',
                'img_path' => 'resources/images/drinks/sparkling-water.jpg',
                'base_price' => '12000',
                'is_veg' => true,
            ],
            [
                'name' => 'Lemonade',
                'desc' => 'A tangy and sweet lemonade made from fresh lemons, sugar, and water. A refreshing and revitalizing drink that pairs well with a variety of dishes.',
                'category' => 'DRINKS',
                'img_path' => 'resources/images/drinks/lemonade.jpg',
                'base_price' => '15000',
                'is_veg' => true,
            ],
        ];
         
        MenuItem::insert($pizzas);
        MenuItem::insert($pastas);
        MenuItem::insert($sides);
        MenuItem::insert($drinks);
    }
}
