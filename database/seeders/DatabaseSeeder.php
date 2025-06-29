<?php

namespace Database\Seeders;

use App\Models\Nvr;
use App\Models\User;
use App\Models\Godown;
use App\Models\Ledger;
use App\Models\Vendor;
use App\Models\Service;
use App\Models\Customer;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Location;
use App\Models\StockItem;
use App\Models\LedgerClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'merosoftnepal@gmail.com'
        ], [
            'name' => "MeroSoft Nepal",
            'password' => Hash::make('nayapati@12#'),
        ]);
        User::firstOrCreate([
            'email' => 'sanjay@sanjay.com'
        ], [
            'name' => "Sanjay",
            'password' => Hash::make('sanjay@sanjay.com'),
        ]);
        User::firstOrCreate([
            'email' => 'sunil@sunil.com'
        ], [
            'name' => "sunil",
            'password' => Hash::make('sunil@sunil.com'),
        ]);


        $classes = [
            'Asset' => ['Current Assets', 'Fixed Assets', 'Other Assets', 'Bank Accounts', 'Inventory', 'Accounts Receivable'],
            'Liability' => ['Current Liabilities', 'Long-term Liabilities', 'Accounts Payable'],
            'Equity' => ['Equity', 'Retained Earnings', 'Owner\'s Equity', 'Capital'],
            'Income' => ['Sales', 'Service Income', 'Other Income'],
            'Expense' => ['Cost of Goods Sold', 'Operating Expenses', 'Administrative Expenses', 'Salaries And Wages', 'Marketing Expenses', 'Depreciation Expenses', 'Other Expenses'],
        ];

        foreach ($classes as $type => $names) {
            foreach ($names as $name) {
                LedgerClass::firstOrCreate([
                    'name' => $name,
                    'type' => ucfirst($type),
                ]);
            }
        }

        $ledgers = [
            'Sales' => ['Sales Of Stock A/C'],
            'Service Income' => ['Service Charges A/C'],
        ];
         foreach ($ledgers as $parent => $children) {
            foreach ($children as $child) {
                Ledger::firstOrCreate([
                    'name' => $child,
                    'code' => $child,
                    'cash_bank' => false,
                    'ledger_class_id' => LedgerClass::where('name', $parent)->first()->id,
                ]);
            }
        }
        $cashBanks = ['Current Assets' => [
            'Counter Cash',
            'Cash In Hand',
            'Laxmi Sunrise Bank Savings',
            'NIC Asia Bank Current',
            'Nepal Investment Bank Savings',
            'Esewa',
            'Khalti',
            'IME Pay',
        ]];
        foreach ($cashBanks as $parent => $children) {
            foreach ($children as $child) {
                Ledger::firstOrCreate([
                    'name' => $child,
                    'code' => $child,
                    'cash_bank' => true,
                    'ledger_class_id' => LedgerClass::where('name', $parent)->first()->id,
                ]);
            }
        }
        Location::firstOrCreate([
            'name' => "Location Name First"
        ]);
        StockItem::firstOrCreate([
            'sku' => '32inchsamsungtv',
            'name' => "TV 32' inch Samsung",
        ], [
            'cost_price' => '40567',
            'selling_price' => '60567',
            'minimum_stock' => '5',
        ]);
        Service::firstOrCreate([
            'description' => 'Maintenance Service',
            'name' => "Maintenance",
        ], [
            'rate' => '5000',
            'unit' => 'one time',
        ]);
        $customerLedger = Ledger::firstOrCreate([
            'name' => 'Kiran Shrestha A/C',
            'code' => 'kiran_shrestha',
        ], [
            'cash_bank' => false,
            'ledger_class_id' => LedgerClass::where('name', 'Accounts Receivable')->first()->id,
        ]);
        Customer::firstOrCreate([
            'name' => 'Kiran Shrestha'
        ], [
            'email' => 'kiran@test.com',
            'location_id' => Location::first()->id,
            'ledger_id' => $customerLedger->id,
        ]);
        $nvr = Nvr::firstOrCreate([
            'ip' => '192.168.10.200',], [
            'name' => 'BARDAGHAT-CCTV CAMERA-POLICE',
            'location' => 'BARDAGHAT',
        ]);
        $nvr->cameras()->firstOrCreate([
            'ip' => '192.168.10.189',], [
            'name' => 'Pach Kune 01',
            'location' => 'Pach Kune 01',
        ]);
        $vendorLedger = Ledger::firstOrCreate([
            'name' => 'Samsung Electronics',
            'code' => 'samsung_electronics',
        ], [
            'cash_bank' => false,
            'ledger_class_id' => LedgerClass::where('name', 'Accounts Payable')->first()->id,
        ]
        );

        Vendor::firstOrCreate([
            'name' => 'Samsung Electronics'], [
            'contact' => '123 12334',
            'address' => 'Kathmandu, Nepal',
            'ledger_id' => $vendorLedger->id,
        ]);

        Godown::firstOrCreate([
            'name' => 'Store'], [
            'location' => 'store location',
        ]);



    }
}
