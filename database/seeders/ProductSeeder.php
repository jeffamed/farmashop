<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Laboratory;
use App\Models\Type;
use App\Models\Location;
use App\Models\Supplier;
use App\Models\Presentation;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Paracetamol 500mg', 'type' => 'Analgésico', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Ibuprofeno 400mg', 'type' => 'Antiinflamatorio', 'laboratory' => 'Bayer', 'presentation' => 'Tabletas'],
            ['name' => 'Amoxicilina 500mg', 'type' => 'Antibiótico', 'laboratory' => 'GlaxoSmithKline', 'presentation' => 'Cápsulas'],
            ['name' => 'Omeprazol 20mg', 'type' => 'Antiácido', 'laboratory' => 'AstraZeneca', 'presentation' => 'Cápsulas'],
            ['name' => 'Losartán 50mg', 'type' => 'Antihipertensivo', 'laboratory' => 'Merck', 'presentation' => 'Tabletas'],
            ['name' => 'Metformina 850mg', 'type' => 'Antidiabético', 'laboratory' => 'Sanofi', 'presentation' => 'Tabletas'],
            ['name' => 'Cetirizina 10mg', 'type' => 'Antihistamínico', 'laboratory' => 'Johnson & Johnson', 'presentation' => 'Tabletas'],
            ['name' => 'Loratadina 10mg', 'type' => 'Antihistamínico', 'laboratory' => 'Bayer', 'presentation' => 'Tabletas'],
            ['name' => 'Diclofenaco Gel', 'type' => 'Antiinflamatorio', 'laboratory' => 'Novartis', 'presentation' => 'Gel'],
            ['name' => 'Salbutamol Inhalador', 'type' => 'Respiratorio', 'laboratory' => 'GlaxoSmithKline', 'presentation' => 'Spray'],
            ['name' => 'Atorvastatina 20mg', 'type' => 'Cardiovascular', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Aspirina 100mg', 'type' => 'Analgésico', 'laboratory' => 'Bayer', 'presentation' => 'Tabletas'],
            ['name' => 'Ciprofloxacino 500mg', 'type' => 'Antibiótico', 'laboratory' => 'Roche', 'presentation' => 'Tabletas'],
            ['name' => 'Ranitidina 150mg', 'type' => 'Antiácido', 'laboratory' => 'GlaxoSmithKline', 'presentation' => 'Tabletas'],
            ['name' => 'Captopril 25mg', 'type' => 'Antihipertensivo', 'laboratory' => 'Bristol-Myers Squibb', 'presentation' => 'Tabletas'],
            ['name' => 'Glibenclamida 5mg', 'type' => 'Antidiabético', 'laboratory' => 'Sanofi', 'presentation' => 'Tabletas'],
            ['name' => 'Vitamina C 1000mg', 'type' => 'Vitaminas', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Complejo B', 'type' => 'Vitaminas', 'laboratory' => 'Bayer', 'presentation' => 'Cápsulas'],
            ['name' => 'Multivitamínico', 'type' => 'Suplementos', 'laboratory' => 'Johnson & Johnson', 'presentation' => 'Tabletas'],
            ['name' => 'Ketoconazol Crema', 'type' => 'Dermatológico', 'laboratory' => 'Novartis', 'presentation' => 'Crema'],
            ['name' => 'Hidrocortisona Crema', 'type' => 'Dermatológico', 'laboratory' => 'Pfizer', 'presentation' => 'Crema'],
            ['name' => 'Clotrimazol Crema', 'type' => 'Dermatológico', 'laboratory' => 'Bayer', 'presentation' => 'Crema'],
            ['name' => 'Butilhioscina 10mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Boehringer Ingelheim', 'presentation' => 'Tabletas'],
            ['name' => 'Loperamida 2mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Johnson & Johnson', 'presentation' => 'Cápsulas'],
            ['name' => 'Simeticona Gotas', 'type' => 'Gastrointestinal', 'laboratory' => 'Bayer', 'presentation' => 'Gotas'],
            ['name' => 'Ambroxol Jarabe', 'type' => 'Mucolítico', 'laboratory' => 'Boehringer Ingelheim', 'presentation' => 'Jarabe'],
            ['name' => 'Bromhexina Jarabe', 'type' => 'Mucolítico', 'laboratory' => 'Sanofi', 'presentation' => 'Jarabe'],
            ['name' => 'Acetilcisteína 600mg', 'type' => 'Mucolítico', 'laboratory' => 'Novartis', 'presentation' => 'Tabletas'],
            ['name' => 'Azitromicina 500mg', 'type' => 'Antibiótico', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Claritromicina 500mg', 'type' => 'Antibiótico', 'laboratory' => 'AbbVie', 'presentation' => 'Tabletas'],
            ['name' => 'Clindamicina 300mg', 'type' => 'Antibiótico', 'laboratory' => 'Pfizer', 'presentation' => 'Cápsulas'],
            ['name' => 'Dexametasona 4mg', 'type' => 'Antiinflamatorio', 'laboratory' => 'Merck', 'presentation' => 'Tabletas'],
            ['name' => 'Prednisona 5mg', 'type' => 'Antiinflamatorio', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Betametasona Crema', 'type' => 'Dermatológico', 'laboratory' => 'GlaxoSmithKline', 'presentation' => 'Crema'],
            ['name' => 'Fluconazol 150mg', 'type' => 'Antibiótico', 'laboratory' => 'Pfizer', 'presentation' => 'Cápsulas'],
            ['name' => 'Nistatina Suspensión', 'type' => 'Antibiótico', 'laboratory' => 'Bristol-Myers Squibb', 'presentation' => 'Suspensión'],
            ['name' => 'Insulina NPH', 'type' => 'Antidiabético', 'laboratory' => 'Eli Lilly', 'presentation' => 'Solución inyectable'],
            ['name' => 'Insulina Rápida', 'type' => 'Antidiabético', 'laboratory' => 'Eli Lilly', 'presentation' => 'Solución inyectable'],
            ['name' => 'Enoxaparina 40mg', 'type' => 'Cardiovascular', 'laboratory' => 'Sanofi', 'presentation' => 'Ampolla'],
            ['name' => 'Enalapril 10mg', 'type' => 'Antihipertensivo', 'laboratory' => 'Merck', 'presentation' => 'Tabletas'],
            ['name' => 'Amlodipino 5mg', 'type' => 'Antihipertensivo', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Valsartán 80mg', 'type' => 'Antihipertensivo', 'laboratory' => 'Novartis', 'presentation' => 'Tabletas'],
            ['name' => 'Carvedilol 6.25mg', 'type' => 'Cardiovascular', 'laboratory' => 'Roche', 'presentation' => 'Tabletas'],
            ['name' => 'Furosemida 40mg', 'type' => 'Cardiovascular', 'laboratory' => 'Sanofi', 'presentation' => 'Tabletas'],
            ['name' => 'Espironolactona 25mg', 'type' => 'Cardiovascular', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Digoxina 0.25mg', 'type' => 'Cardiovascular', 'laboratory' => 'GlaxoSmithKline', 'presentation' => 'Tabletas'],
            ['name' => 'Warfarina 5mg', 'type' => 'Cardiovascular', 'laboratory' => 'Bristol-Myers Squibb', 'presentation' => 'Tabletas'],
            ['name' => 'Clopidogrel 75mg', 'type' => 'Cardiovascular', 'laboratory' => 'Sanofi', 'presentation' => 'Tabletas'],
            ['name' => 'Rosuvastatina 10mg', 'type' => 'Cardiovascular', 'laboratory' => 'AstraZeneca', 'presentation' => 'Tabletas'],
            ['name' => 'Simvastatina 20mg', 'type' => 'Cardiovascular', 'laboratory' => 'Merck', 'presentation' => 'Tabletas'],
            ['name' => 'Tramadol 50mg', 'type' => 'Analgésico', 'laboratory' => 'Pfizer', 'presentation' => 'Cápsulas'],
            ['name' => 'Ketorolaco 10mg', 'type' => 'Analgésico', 'laboratory' => 'Roche', 'presentation' => 'Tabletas'],
            ['name' => 'Naproxeno 500mg', 'type' => 'Antiinflamatorio', 'laboratory' => 'Bayer', 'presentation' => 'Tabletas'],
            ['name' => 'Meloxicam 15mg', 'type' => 'Antiinflamatorio', 'laboratory' => 'Boehringer Ingelheim', 'presentation' => 'Tabletas'],
            ['name' => 'Celecoxib 200mg', 'type' => 'Antiinflamatorio', 'laboratory' => 'Pfizer', 'presentation' => 'Cápsulas'],
            ['name' => 'Alprazolam 0.5mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Clonazepam 2mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Roche', 'presentation' => 'Tabletas'],
            ['name' => 'Fluoxetina 20mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Eli Lilly', 'presentation' => 'Cápsulas'],
            ['name' => 'Sertralina 50mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Escitalopram 10mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Eli Lilly', 'presentation' => 'Tabletas'],
            ['name' => 'Levotiroxina 100mcg', 'type' => 'Suplementos', 'laboratory' => 'Merck', 'presentation' => 'Tabletas'],
            ['name' => 'Vitamina D3 1000UI', 'type' => 'Vitaminas', 'laboratory' => 'Bayer', 'presentation' => 'Cápsulas'],
            ['name' => 'Calcio + Vitamina D', 'type' => 'Suplementos', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Hierro 300mg', 'type' => 'Suplementos', 'laboratory' => 'Sanofi', 'presentation' => 'Tabletas'],
            ['name' => 'Ácido Fólico 5mg', 'type' => 'Vitaminas', 'laboratory' => 'Bayer', 'presentation' => 'Tabletas'],
            ['name' => 'Omega 3', 'type' => 'Suplementos', 'laboratory' => 'Johnson & Johnson', 'presentation' => 'Cápsulas'],
            ['name' => 'Coenzima Q10', 'type' => 'Suplementos', 'laboratory' => 'Pfizer', 'presentation' => 'Cápsulas'],
            ['name' => 'Magnesio 500mg', 'type' => 'Suplementos', 'laboratory' => 'Bayer', 'presentation' => 'Tabletas'],
            ['name' => 'Zinc 50mg', 'type' => 'Suplementos', 'laboratory' => 'Novartis', 'presentation' => 'Tabletas'],
            ['name' => 'Colágeno Hidrolizado', 'type' => 'Suplementos', 'laboratory' => 'Johnson & Johnson', 'presentation' => 'Polvo'],
            ['name' => 'Probióticos', 'type' => 'Suplementos', 'laboratory' => 'Pfizer', 'presentation' => 'Cápsulas'],
            ['name' => 'Clorfenamina 4mg', 'type' => 'Antihistamínico', 'laboratory' => 'Bayer', 'presentation' => 'Tabletas'],
            ['name' => 'Dextrometorfano Jarabe', 'type' => 'Respiratorio', 'laboratory' => 'Novartis', 'presentation' => 'Jarabe'],
            ['name' => 'Montelukast 10mg', 'type' => 'Respiratorio', 'laboratory' => 'Merck', 'presentation' => 'Tabletas'],
            ['name' => 'Budesonida Inhalador', 'type' => 'Respiratorio', 'laboratory' => 'AstraZeneca', 'presentation' => 'Spray'],
            ['name' => 'Ipratropio Inhalador', 'type' => 'Respiratorio', 'laboratory' => 'Boehringer Ingelheim', 'presentation' => 'Spray'],
            ['name' => 'Metoclopramida 10mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Sanofi', 'presentation' => 'Tabletas'],
            ['name' => 'Domperidona 10mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Johnson & Johnson', 'presentation' => 'Tabletas'],
            ['name' => 'Esomeprazol 40mg', 'type' => 'Antiácido', 'laboratory' => 'AstraZeneca', 'presentation' => 'Cápsulas'],
            ['name' => 'Pantoprazol 40mg', 'type' => 'Antiácido', 'laboratory' => 'Takeda', 'presentation' => 'Tabletas'],
            ['name' => 'Lansoprazol 30mg', 'type' => 'Antiácido', 'laboratory' => 'Takeda', 'presentation' => 'Cápsulas'],
            ['name' => 'Sucralfato Suspensión', 'type' => 'Antiácido', 'laboratory' => 'Sanofi', 'presentation' => 'Suspensión'],
            ['name' => 'Lactulosa Jarabe', 'type' => 'Gastrointestinal', 'laboratory' => 'AbbVie', 'presentation' => 'Jarabe'],
            ['name' => 'Bisacodilo 5mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Bayer', 'presentation' => 'Tabletas'],
            ['name' => 'Hidróxido de Aluminio', 'type' => 'Antiácido', 'laboratory' => 'Pfizer', 'presentation' => 'Suspensión'],
            ['name' => 'Albendazol 400mg', 'type' => 'Gastrointestinal', 'laboratory' => 'GlaxoSmithKline', 'presentation' => 'Tabletas'],
            ['name' => 'Mebendazol 100mg', 'type' => 'Gastrointestinal', 'laboratory' => 'Johnson & Johnson', 'presentation' => 'Tabletas'],
            ['name' => 'Metronidazol 500mg', 'type' => 'Antibiótico', 'laboratory' => 'Pfizer', 'presentation' => 'Tabletas'],
            ['name' => 'Nitrofurantoína 100mg', 'type' => 'Antibiótico', 'laboratory' => 'Bayer', 'presentation' => 'Cápsulas'],
            ['name' => 'Trimetoprima + Sulfametoxazol', 'type' => 'Antibiótico', 'laboratory' => 'Roche', 'presentation' => 'Tabletas'],
            ['name' => 'Aciclovir 400mg', 'type' => 'Antibiótico', 'laboratory' => 'GlaxoSmithKline', 'presentation' => 'Tabletas'],
            ['name' => 'Aciclovir Crema', 'type' => 'Dermatológico', 'laboratory' => 'GlaxoSmithKline', 'presentation' => 'Crema'],
            ['name' => 'Eritromicina Pomada Oftálmica', 'type' => 'Antibiótico', 'laboratory' => 'Pfizer', 'presentation' => 'Pomada'],
            ['name' => 'Gentamicina Gotas Oftálmicas', 'type' => 'Antibiótico', 'laboratory' => 'Novartis', 'presentation' => 'Gotas'],
            ['name' => 'Ciprofloxacino Gotas Oftálmicas', 'type' => 'Antibiótico', 'laboratory' => 'Bayer', 'presentation' => 'Gotas'],
            ['name' => 'Tobramicina Gotas Oftálmicas', 'type' => 'Antibiótico', 'laboratory' => 'Novartis', 'presentation' => 'Gotas'],
            ['name' => 'Ciprofloxacino Gotas Óticas', 'type' => 'Antibiótico', 'laboratory' => 'Bayer', 'presentation' => 'Gotas'],
            ['name' => 'Suero Fisiológico 100ml', 'type' => 'Respiratorio', 'laboratory' => 'Pfizer', 'presentation' => 'Solución inyectable'],
        ];

        $laboratories = Laboratory::all();
        $types = Type::all();
        $locations = Location::all();
        $suppliers = Supplier::all();
        $presentations = Presentation::all();

        foreach ($products as $index => $productData) {
            Product::create([
                'code' => 'PROD' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),
                'name' => $productData['name'],
                'price' => rand(50, 5000) / 10, // Price between 5.00 and 500.00
                'stock' => rand(10, 500),
                'discount' => rand(0, 30),
                'box_stock' => rand(1, 50),
                'unit_box' => rand(10, 100),
                'expired_at' => now()->addMonths(rand(6, 36)),
                'laboratory_id' => $laboratories->where('name', $productData['laboratory'])->first()?->id ?? $laboratories->random()->id,
                'type_id' => $types->where('name', $productData['type'])->first()?->id ?? $types->random()->id,
                'location_id' => $locations->random()->id,
                'supplier_id' => $suppliers->random()->id,
                'presentation_id' => $presentations->where('name', $productData['presentation'])->first()?->id ?? $presentations->random()->id,
            ]);
        }
    }
}
